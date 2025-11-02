# Within The Covers - Implementation Guide

## Priority 1: Fixing SQL Injection Vulnerabilities

### Current Vulnerable Code Pattern

```php
// INSECURE - DO NOT USE
mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
```

### Secure Implementation Using Prepared Statements

#### Create a Database Helper Class

File: `config/Database.php`

```php
<?php

class Database {
    private $conn;
    private $host = 'localhost';
    private $db_name = 'shop_db';
    private $db_user = 'root';
    private $db_pass = '';

    public function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->db_user,
            $this->db_pass,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die('Database Connection Error: ' . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }
}
?>
```

#### Example: Secure Login Implementation

File: `loginpage.php` (UPDATED)

```php
<?php
require 'config/Database.php';

session_start();
$message = [];
$db = new Database();
$conn = $db->connect();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $message[] = 'Please fill in all fields';
    } else {
        // Use prepared statement
        $stmt = $conn->prepare("SELECT id, name, email, password, user_type FROM users WHERE email = ?");

        if (!$stmt) {
            $message[] = 'Database error. Please try again later.';
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Use password verification instead of plain text comparison
                if (password_verify($password, $row['password'])) {

                    // Set session variables
                    if ($row['user_type'] == 'admin') {
                        $_SESSION['admin_id'] = $row['id'];
                        $_SESSION['admin_name'] = $row['name'];
                        $_SESSION['admin_email'] = $row['email'];
                        header('Location: adminpage.php');
                        exit();
                    } else {
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = $row['name'];
                        $_SESSION['user_email'] = $row['email'];
                        header('Location: homepage.php');
                        exit();
                    }
                } else {
                    $message[] = 'Invalid email or password';
                }
            } else {
                $message[] = 'Invalid email or password';
            }
            $stmt->close();
        }
    }
}
?>
```

---

## Priority 2: Implementing Password Hashing

### Registration with Bcrypt

File: `registrationpage.php` (UPDATED)

```php
<?php
require 'config/Database.php';

$message = [];
$db = new Database();
$conn = $db->connect();

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $user_type = $_POST['user_type'] ?? 'user';

    // Validation
    $errors = [];

    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        $errors[] = 'All fields are required';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters';
    }

    if ($password !== $cpassword) {
        $errors[] = 'Passwords do not match';
    }

    if (empty($errors)) {
        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = 'Email already registered';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);

            if ($stmt->execute()) {
                $message[] = 'Registration successful! Redirecting to login...';
                header('Refresh: 2; URL=loginpage.php');
            } else {
                $errors[] = 'Registration failed. Please try again.';
            }
            $stmt->close();
        }
    }

    // Merge errors into message array
    $message = array_merge($message, $errors);
}
?>
```

---

## Priority 3: Fixing File Upload Vulnerabilities

### Secure File Upload Handler

File: `config/FileUpload.php`

```php
<?php

class FileUpload {
    private $upload_dir = '../uploaded_img/';
    private $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private $max_file_size = 2 * 1024 * 1024; // 2MB
    private $allowed_mimes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    public function upload($file) {
        $errors = [];

        // Check if file exists
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            $errors[] = 'No file provided';
            return ['success' => false, 'errors' => $errors];
        }

        // Check file size
        if ($file['size'] > $this->max_file_size) {
            $errors[] = 'File size exceeds 2MB limit';
        }

        // Validate MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $this->allowed_mimes)) {
            $errors[] = 'Invalid file type. Only images allowed.';
        }

        // Validate extension
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file_ext, $this->allowed_extensions)) {
            $errors[] = 'Invalid file extension';
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Generate unique filename
        $new_filename = bin2hex(random_bytes(16)) . '.' . $file_ext;
        $upload_path = $this->upload_dir . $new_filename;

        // Create directory if not exists
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return [
                'success' => true,
                'filename' => $new_filename,
                'path' => $upload_path
            ];
        } else {
            $errors[] = 'Failed to upload file';
            return ['success' => false, 'errors' => $errors];
        }
    }

    public function delete($filename) {
        $filepath = $this->upload_dir . $filename;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }
}
?>
```

### Updated Admin Products Upload

File: `adminproducts.php` (UPDATED)

```php
<?php
require 'config/Database.php';
require 'config/FileUpload.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($admin_id)) {
    header('Location: loginpage.php');
    exit();
}

$db = new Database();
$conn = $db->connect();
$uploader = new FileUpload();
$message = [];

if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = intval($_POST['price']);

    // Validate input
    if (empty($name) || $price <= 0) {
        $message[] = 'Invalid product name or price';
    } else {
        // Check if product exists
        $stmt = $conn->prepare("SELECT id FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $message[] = 'Product already exists';
        } else {
            // Upload file
            if (isset($_FILES['image'])) {
                $upload_result = $uploader->upload($_FILES['image']);

                if ($upload_result['success']) {
                    $filename = $upload_result['filename'];

                    // Insert product
                    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
                    $stmt->bind_param("sis", $name, $price, $filename);

                    if ($stmt->execute()) {
                        $message[] = 'Product added successfully!';
                    } else {
                        $message[] = 'Failed to add product';
                        $uploader->delete($filename); // Clean up uploaded file
                    }
                    $stmt->close();
                } else {
                    $message = array_merge($message, $upload_result['errors']);
                }
            } else {
                $message[] = 'Please select an image';
            }
        }
    }
}
?>
```

---

## Priority 4: Environment Configuration

### .env File

File: `.env` (DO NOT COMMIT TO GIT)

```
# Database Configuration
DB_HOST=localhost
DB_USER=shop_user
DB_PASS=secure_password_here
DB_NAME=shop_db

# App Configuration
APP_ENV=production
APP_DEBUG=false
APP_URL=https://within-the-covers.com

# Security
HASH_COST=12
SESSION_TIMEOUT=1800

# Email Configuration
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USER=your-email@gmail.com
MAIL_PASS=your-app-password
MAIL_FROM=noreply@within-the-covers.com
```

### Load Environment Variables

File: `config/Config.php`

```php
<?php

class Config {
    private static $config = [];

    public static function load($file = '.env') {
        if (!file_exists($file)) {
            throw new Exception('.env file not found');
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos($line, '=') === false || strpos($line, '#') === 0) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, ' "\'');

            self::$config[$key] = $value;
        }
    }

    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }

    public static function all() {
        return self::$config;
    }
}

// Load configuration
Config::load();
?>
```

### Updated Database Connection

File: `config/Database.php` (UPDATED)

```php
<?php
require 'Config.php';

class Database {
    private $conn;

    public function connect() {
        $host = Config::get('DB_HOST');
        $user = Config::get('DB_USER');
        $pass = Config::get('DB_PASS');
        $db = Config::get('DB_NAME');

        $this->conn = new mysqli($host, $user, $pass, $db);

        if ($this->conn->connect_error) {
            error_log('Database Connection Error: ' . $this->conn->connect_error);
            die('Database connection failed. Please contact support.');
        }

        $this->conn->set_charset('utf8mb4');
        return $this->conn;
    }
}
?>
```

---

## Priority 5: Error Handling & Logging

### Create Error Logger

File: `config/Logger.php`

```php
<?php

class Logger {
    private static $log_file = '../logs/app.log';

    public static function init() {
        $log_dir = dirname(self::$log_file);
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0755, true);
        }
    }

    public static function error($message, $context = []) {
        self::log('ERROR', $message, $context);
    }

    public static function warning($message, $context = []) {
        self::log('WARNING', $message, $context);
    }

    public static function info($message, $context = []) {
        self::log('INFO', $message, $context);
    }

    private static function log($level, $message, $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $context_str = !empty($context) ? json_encode($context) : '';
        $log_message = "[$timestamp] [$level] $message $context_str\n";

        error_log($log_message, 3, self::$log_file);
    }
}

Logger::init();
?>
```

### Global Error Handler

File: `config/ErrorHandler.php`

```php
<?php

class ErrorHandler {
    public static function setup() {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handleError($errno, $errstr, $errfile, $errline) {
        $app_debug = Config::get('APP_DEBUG', false);

        Logger::error('PHP Error', [
            'errno' => $errno,
            'errstr' => $errstr,
            'file' => $errfile,
            'line' => $errline
        ]);

        if (!$app_debug) {
            die('An error occurred. Our team has been notified.');
        }

        return true;
    }

    public static function handleException($exception) {
        $app_debug = Config::get('APP_DEBUG', false);

        Logger::error('Exception', [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ]);

        if (!$app_debug) {
            die('An error occurred. Our team has been notified.');
        }

        throw $exception;
    }
}

ErrorHandler::setup();
?>
```

---

## Priority 6: CSRF Protection

### CSRF Token Generator

File: `config/Security.php`

```php
<?php

class Security {
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function getCSRFField() {
        return '<input type="hidden" name="csrf_token" value="' . self::generateCSRFToken() . '">';
    }
}
?>
```

### Usage in Forms

```php
<?php require 'config/Security.php'; ?>

<form method="post" action="">
    <?php echo Security::getCSRFField(); ?>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php
// Validate in PHP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::validateCSRFToken($_POST['csrf_token'] ?? '')) {
        die('CSRF token validation failed');
    }
    // Process form
}
?>
```

---

## Priority 7: Input Validation Helper

File: `config/Validator.php`

```php
<?php

class Validator {
    private $errors = [];

    public function required($field, $message = null) {
        if (empty($_POST[$field])) {
            $this->errors[] = $message ?? ucfirst($field) . ' is required';
        }
        return $this;
    }

    public function email($field, $message = null) {
        if (!filter_var($_POST[$field] ?? '', FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = $message ?? 'Invalid email address';
        }
        return $this;
    }

    public function min($field, $length, $message = null) {
        if (strlen($_POST[$field] ?? '') < $length) {
            $this->errors[] = $message ?? ucfirst($field) . ' must be at least ' . $length . ' characters';
        }
        return $this;
    }

    public function max($field, $length, $message = null) {
        if (strlen($_POST[$field] ?? '') > $length) {
            $this->errors[] = $message ?? ucfirst($field) . ' must not exceed ' . $length . ' characters';
        }
        return $this;
    }

    public function match($field1, $field2, $message = null) {
        if (($_POST[$field1] ?? '') !== ($_POST[$field2] ?? '')) {
            $this->errors[] = $message ?? ucfirst($field1) . ' and ' . $field2 . ' do not match';
        }
        return $this;
    }

    public function isValid() {
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>
```

---

## Deployment Checklist

- [ ] All SQL queries converted to prepared statements
- [ ] All passwords hashed with bcrypt
- [ ] File upload validation implemented
- [ ] Environment configuration set up
- [ ] Error handling and logging implemented
- [ ] CSRF protection added
- [ ] Input validation implemented
- [ ] Security headers configured
- [ ] HTTPS/SSL enabled
- [ ] Database backups configured
- [ ] Monitoring and alerting set up
- [ ] UAT testing completed
- [ ] Security audit passed
- [ ] Production deployment completed

---

**Document Version:** 1.0
**Implementation Priority:** High
