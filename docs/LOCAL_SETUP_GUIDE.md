# Within The Covers - Local Setup & Demo Guide

## 🚀 Quick Start (5 Minutes)

### Prerequisites

- PHP 7.4+ (recommend 8.1+)
- MySQL 5.7+ or MariaDB
- A code editor (VS Code recommended)
- Browser (Chrome, Firefox, Safari, Edge)

---

## 📋 Step 1: Install Required Software

### Windows Users

#### Option A: XAMPP (Easiest)

1. Download from: <https://www.apachefriends.org/>
2. Install XAMPP with PHP & MySQL
3. Start Apache and MySQL from XAMPP Control Panel
4. Verify: Open browser, go to `http://localhost/`

#### Option B: Chocolatey (Recommended)

```bash
choco install php mysql
```

### macOS Users

#### Using Homebrew

```bash
# Install PHP
brew install php

# Install MySQL
brew install mysql

# Start MySQL
mysql.server start
```

### Linux Users (Ubuntu/Debian)

```bash
# Update packages
sudo apt update

# Install PHP and extensions
sudo apt install -y php php-cli php-mysql php-mbstring php-zip php-gd php-curl

# Install MySQL
sudo apt install -y mysql-server

# Start MySQL
sudo systemctl start mysql
sudo systemctl enable mysql

# Verify MySQL is running
sudo systemctl status mysql
```

---

## 📁 Step 2: Set Up Your Project Locally

### 1. Clone or Copy Project

```bash
# Option A: Clone from Git
git clone https://github.com/dinahmaccodes/Within-The-Covers-.git
cd Within-The-Covers-

# Option B: If already downloaded, navigate to folder
cd /path/to/Within-The-Covers-
```

### 2. Create Project Directory in Web Root

**Windows (XAMPP):**

```bash
# Copy to XAMPP folder
xcopy /E /I . "C:\xampp\htdocs\shop"
cd C:\xampp\htdocs\shop
```

**macOS/Linux:**

```bash
# Copy to web root
sudo cp -r . /var/www/html/shop
cd /var/www/html/shop
sudo chown -R $USER:$USER /var/www/html/shop
```

---

## 🗄️ Step 3: Set Up MySQL Database

### 1. Create Database

```bash
# Open MySQL terminal
mysql -u root -p

# Or if no password set
mysql -u root
```

### 2. Create Database and User

```sql
-- Create database
CREATE DATABASE shop_db;

-- Create user (optional, for security)
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'password123';

-- Grant privileges
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;

-- Exit
EXIT;
```

### 3. Import Database Schema

```bash
# Navigate to project directory
cd /path/to/Within-The-Covers-

# Import the SQL file
mysql -u root -p shop_db < shop_db.sql

# If using shop_user
mysql -u shop_user -p shop_db < shop_db.sql
```

### 4. Verify Import

```bash
mysql -u root -p shop_db

# In MySQL terminal
SHOW TABLES;

# Should show:
# cart, message, orders, products, review, users

EXIT;
```

---

## ⚙️ Step 4: Configure PHP Connection

### 1. Update configuration.php

Edit `configuration.php` in your project root:

```php
<?php
// Current (LOCAL ONLY - NOT FOR PRODUCTION)
$conn = mysqli_connect('localhost', 'root', '', 'shop_db') or die('connection failed');
?>
```

### If you created shop_user

```php
<?php
$conn = mysqli_connect('localhost', 'shop_user', 'password123', 'shop_db') or die('connection failed');
?>
```

### 2. Create Directories (if missing)

```bash
# Create necessary folders
mkdir -p uploaded_img
mkdir -p logs
mkdir -p cache

# Set permissions (Linux/macOS)
chmod 755 uploaded_img
chmod 755 logs
chmod 755 cache
```

---

## 🌐 Step 5: Start the Application

### Option A: Using PHP Built-in Server (Easiest for Development)

```bash
# Navigate to project directory
cd /path/to/Within-The-Covers-

# Start PHP server on port 8000
php -S localhost:8000

# Output should show:
# Development Server (http://127.0.0.1:8000)
# Press Ctrl+C to quit
```

Then open your browser: **<http://localhost:8000>**

### Option B: Using XAMPP (Windows)

1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL**
3. Open browser: **<http://localhost/shop>**

### Option C: Using Apache (Linux/macOS)

```bash
# Start Apache
sudo systemctl start apache2

# Enable mod_rewrite (if needed)
sudo a2enmod rewrite

# Open browser: http://localhost/shop
```

---

## 🔑 Step 6: Test Login Credentials

Use these credentials to test the application:

### User Account

```
Email: theeloiserosewood@gmail.com
Password: 1234
User Type: Regular User
```

### Admin Accounts

```
Email: dee96914@gmail.com
Password: n6789
User Type: Admin

OR

Email: h65dee@gmail.com
Password: 45678
User Type: Admin
```

---

## ✅ Step 7: Verify Everything Works

### Test Checklist

- [ ] Access homepage: `http://localhost:8000`
- [ ] See book catalog displayed
- [ ] Login with user credentials
- [ ] Add item to cart
- [ ] View cart page
- [ ] Proceed to checkout
- [ ] Login with admin credentials
- [ ] Access admin dashboard
- [ ] View products page
- [ ] Submit a review

---

## 🎥 Step 8: Create Demo Video

### Setup for Screen Recording

1. **Open two browser windows:**

   - Window 1: User view
   - Window 2: Admin panel (for comparison)

2. **Recommended Recording Tools:**
   - **Windows:** OBS Studio (free), Camtasia
   - **macOS:** QuickTime, OBS Studio
   - **Linux:** OBS Studio, SimpleScreenRecorder

### Demo Script (5-10 minutes)

#### Part 1: User Journey (3 minutes)

```
1. Homepage tour (0:00-0:30)
   - Show book catalog
   - Scroll through products
   - Highlight book details

2. Shopping (0:30-1:30)
   - Search for a book (optional if search works)
   - Click "Add to Cart"
   - Show cart page
   - Modify quantities

3. Checkout (1:30-2:30)
   - Click Checkout
   - Fill order form
   - Select payment method
   - Place order
   - Show order confirmation

4. Reviews (2:30-3:00)
   - View product reviews
   - Submit a review
   - Show review posted
```

#### Part 2: Admin Features (3 minutes)

```
1. Admin Login (0:00-0:30)
   - Login with admin credentials
   - Show admin dashboard

2. Dashboard Stats (0:30-1:00)
   - Show pending orders
   - Show completed payments
   - Show total orders

3. Product Management (1:00-2:00)
   - View products list
   - Show add product form
   - Demonstrate product upload

4. Order Management (2:00-2:30)
   - View all orders
   - Show order details
   - Highlight order status

5. User Management (2:30-3:00)
   - View users list
   - Show user details
```

#### Part 3: Features Highlight (2 minutes)

```
1. Database info
   - 12 books in catalog
   - Multiple user roles
   - Order tracking

2. Technical highlights
   - Responsive design
   - User-friendly interface
   - Complete feature set
```

### Recording Tips

1. **Preparation:**

   - Test login credentials before recording
   - Clear browser cache
   - Set browser zoom to 100%
   - Use full HD (1920x1080) resolution

2. **Audio:**

   - Speak clearly and slowly
   - Pause between sections
   - Add background music (optional)
   - Narrate what you're doing

3. **Visual:**
   - Move slowly between pages
   - Highlight important features
   - Show error messages (for testing)
   - Take screenshots for comparison

---

## 🐛 Troubleshooting

### Issue: Connection Refused

**Problem:** `connection failed` error

**Solution:**

```bash
# Check MySQL is running
# Windows: Check XAMPP Control Panel
# Linux: sudo systemctl status mysql
# macOS: mysql.server status

# Verify credentials in configuration.php
# Test connection:
mysql -u root -p shop_db

# If still failing, try:
mysql -u root shop_db
```

### Issue: Database Not Found

**Problem:** `Unknown database 'shop_db'`

**Solution:**

```bash
# Verify database exists
mysql -u root -p
SHOW DATABASES;

# If missing, create it:
CREATE DATABASE shop_db;

# Then import:
mysql -u root -p shop_db < shop_db.sql
```

### Issue: Can't Upload Files

**Problem:** Upload fails in admin

**Solution:**

```bash
# Check folder permissions
# Linux/macOS:
chmod 777 uploaded_img

# Verify PHP upload settings
php -i | grep upload

# Windows: Run as Administrator
```

### Issue: Session Not Working

**Problem:** Logout redirects to login repeatedly

**Solution:**

```bash
# Delete browser cookies
# Or use private/incognito window
# Make sure cookies are enabled
```

### Issue: CSS/JavaScript Not Loading

**Problem:** Page looks broken

**Solution:**

```bash
# Clear browser cache (Ctrl+Shift+Delete)
# Hard refresh (Ctrl+F5)
# Check browser console (F12) for errors
# Verify file paths in HTML
```

---

## 💻 Useful Development Commands

### Check PHP Version

```bash
php -v
```

### Check MySQL Status

```bash
# Windows (XAMPP)
# Use Control Panel

# Linux
sudo systemctl status mysql

# macOS
mysql.server status
```

### Start PHP Development Server

```bash
php -S localhost:8000
```

### View PHP Configuration

```bash
php -i
```

### Test Database Connection

```php
<?php
$conn = mysqli_connect('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connected successfully";
}
?>
```

### Access MySQL

```bash
mysql -u root -p
mysql -u shop_user -p shop_db
```

---

## 📊 File Structure After Setup

```
Within-The-Covers-/
├── configuration.php         # Database config
├── index.php                 # Home page
├── loginpage.php             # Login
├── registrationpage.php      # Registration
├── shoppage.php              # Shop
├── cartpage.php              # Cart
├── checkoutpage.php          # Checkout
├── orders.php                # Orders
├── review.php                # Reviews
├── adminpage.php             # Admin dashboard
├── adminproducts.php         # Manage products
├── adminusers.php            # Manage users
├── adminorders.php           # Manage orders
├── header.php                # Header component
├── footer.php                # Footer component
├── css/                      # Stylesheets
│   ├── adminpagestyle.css
│   ├── registrationstyle.css
│   └── reviews.css
├── js/                       # JavaScript files
│   ├── adminscript.js
│   └── homescript.js
├── images/                   # Static images
├── uploaded_img/             # User uploads
├── logs/                     # Log files
├── shop_db.sql               # Database schema
└── documentation/            # Your docs
```

---

## 🎬 Recording the Demo Video

### Step-by-Step Recording Process

1. **Start Recording Tool**

   - Open OBS Studio or QuickTime
   - Set resolution to 1920x1080
   - Set frame rate to 30fps
   - Start recording

2. **Intro (10 seconds)**

   - "Welcome to Within The Covers, an online bookstore"
   - Show the homepage

3. **Feature Demo (8 minutes)**

   - Follow the demo script above
   - Take 2-3 seconds pause between sections
   - Narrate actions clearly

4. **Conclusion (30 seconds)**

   - "Thank you for watching this demo"
   - Show website name
   - End screen

5. **Stop & Save**
   - Stop recording
   - Export as MP4
   - Name it: `Within-The-Covers-Demo.mp4`

### Video Editing (Optional)

- Add intro/outro slides
- Add background music
- Add captions for key features
- Adjust audio levels
- Trim silent parts

---

## 📝 Quick Reference Cheat Sheet

| Task             | Command                                                              |
| ---------------- | -------------------------------------------------------------------- |
| Start PHP server | `php -S localhost:8000`                                              |
| Start MySQL      | `mysql.server start` (macOS) or `sudo systemctl start mysql` (Linux) |
| Access MySQL     | `mysql -u root -p`                                                   |
| Import database  | `mysql -u root -p shop_db < shop_db.sql`                             |
| View databases   | `SHOW DATABASES;` (in MySQL)                                         |
| View tables      | `USE shop_db; SHOW TABLES;`                                          |
| Open app         | `http://localhost:8000`                                              |
| User login       | `theeloiserosewood@gmail.com` / `1234`                               |
| Admin login      | `dee96914@gmail.com` / `n6789`                                       |

---

## ✨ Next Steps After Setup

1. ✅ Get the app running locally
2. ✅ Test all features
3. ✅ Create demo video
4. ✅ Share with stakeholders
5. ⏭️ Begin Phase 1 security fixes (per DEPLOYMENT_ANALYSIS.md)

---

## 🆘 Need Help?

If you encounter issues:

1. **Check the logs:**

   ```bash
   tail -f logs/*.log
   ```

2. **Check browser console:**

   - Press F12
   - Click "Console" tab
   - Look for errors

3. **Check browser network:**

   - Press F12
   - Click "Network" tab
   - Reload page
   - Look for failed requests

4. **Common Issues Checklist:**
   - [ ] MySQL is running
   - [ ] Database is imported
   - [ ] configuration.php has correct credentials
   - [ ] Folders exist (uploaded_img, logs)
   - [ ] PHP server is running
   - [ ] Port 8000 is not in use
   - [ ] Browser cookies are enabled

---

---

## 🎥 Step 8: Create Demo Video

### ⚡ TL;DR - 5 Minute Setup

#### For Windows (Easiest)

```batch
1. Download & install XAMPP from apachefriends.org
2. Copy project to C:\xampp\htdocs\shop
3. Start Apache & MySQL in XAMPP Control Panel
4. Open MySQL shell in XAMPP, paste:
   CREATE DATABASE shop_db;
5. Import: mysql -u root shop_db < shop_db.sql
6. Edit configuration.php (no changes needed if root/no password)
7. Open: http://localhost/shop
8. Login with: theeloiserosewood@gmail.com / 1234
```

#### For macOS

```bash
brew install php mysql
mysql.server start
cp -r ~/Downloads/Within-The-Covers- ~/Sites/shop
mysql -u root << EOF
CREATE DATABASE shop_db;
EOF
mysql -u root shop_db < ~/Sites/shop/shop_db.sql
cd ~/Sites/shop && php -S localhost:8000
# Open: http://localhost:8000
```

#### For Linux

```bash
sudo apt install php mysql-server
sudo systemctl start mysql
cp -r ~/Downloads/Within-The-Covers- /var/www/html/shop
mysql -u root << EOF
CREATE DATABASE shop_db;
EOF
mysql -u root shop_db < /var/www/html/shop/shop_db.sql
cd /var/www/html/shop && php -S localhost:8000
# Open: http://localhost:8000
```

---

## 🎬 Demo Video Recording Script (10 minutes)

### Part 1: Introduction (1 minute)

```
[0:00-0:15] Welcome slide
"Welcome to Within The Covers,
 a modern online bookstore built with PHP and MySQL"

[0:15-0:30] Show homepage
"This is our bookstore application"

[0:30-1:00] Explain features
"Features include:
- User registration and login
- Shopping cart with 12 quality books
- Admin dashboard
- Order tracking and reviews"
```

### Part 2: User Features (4 minutes)

#### 2A: Browse & Shop (1:30)

```
[0:00-0:15] Navigate to shop
"First, let's explore the product catalog"

[0:15-0:45] Scroll through books
"We have 12 quality books including:
- The Cruel Prince
- Atomic Habits
- Americanah
- And more"

[0:45-1:30] Add item to cart
"Let me add 'Atomic Habits' to the cart"
Click on product → Enter quantity → Add to cart
Show success message
```

#### 2B: Shopping Cart (1:15)

```
[0:00-0:30] View cart
"Now let's see what's in the cart"
Navigate to cart page
Show items, quantities, total

[0:30-0:45] Modify quantities
"We can easily update quantities"
Change quantity → Update

[0:45-1:15] Proceed to checkout
"Ready to checkout? Let's proceed"
Click checkout button
```

#### 2C: Checkout & Orders (1:15)

```
[0:00-0:45] Fill checkout form
"Enter delivery and payment details"
Fill: name, email, phone, address, payment method
Show form validation

[0:45-1:15] Place order & view history
"Place the order"
Click submit
Show order confirmation
"You can view all your orders in your account"
Navigate to orders page
```

### Part 3: Admin Features (3 minutes)

#### 3A: Admin Dashboard (0:45)

```
[0:00-0:20] Login as admin
"Now let's see the admin panel"
Login with admin credentials

[0:20-0:45] Show dashboard statistics
"The dashboard shows:
- Pending orders total
- Completed payments total
- Total number of orders"
Highlight statistics
```

#### 3B: Product Management (1:00)

```
[0:00-0:30] View products
"Admin can manage all products"
Show products list with 12 books

[0:30-1:00] Show how to add/delete
"Admins can add new books or remove them"
(You can show the forms without actually uploading)
```

#### 3C: Order Management (1:15)

```
[0:00-0:45] View all orders
"All customer orders are visible here"
Show orders list

[0:45-1:15] View order details
"Click on any order to see full details"
Show order details: items, total, address, payment status
```

### Part 4: Conclusion (1 minute)

```
[0:00-0:30] Summary
"Within The Covers provides:
✓ Easy shopping experience
✓ Multiple user roles
✓ Complete order tracking
✓ Admin management tools"

[0:30-1:00] Thank you
"Thank you for watching!
This application is ready for deployment."
```

---

## � How to Record (Step-by-Step)

### Step 1: Prepare Environment

- [ ] Close unnecessary applications
- [ ] Set browser zoom to 100%
- [ ] Set resolution to 1920x1080 (or 1280x720)
- [ ] Clear browser cache
- [ ] Have credentials ready

### Step 2: Setup Recording Tool

**Option A: OBS Studio (Free, Best)**

1. Download from obsproject.com
2. Open OBS Studio
3. Click "New Scene"
4. Add "Display Capture" source
5. Select your monitor
6. Set output folder
7. Click "Start Recording"

**Option B: QuickTime (macOS Only)**

1. Open QuickTime
2. File → New Screen Recording
3. Click red record button
4. Select area to record
5. Click Start Recording

**Option C: Built-in Tools**

- Windows 10+: Win + G (Game Bar)
- macOS: Command + Shift + 5
- Linux: SimpleScreenRecorder

### Step 3: Record Demo

- [ ] Start recording tool
- [ ] Follow script above
- [ ] Speak clearly and slowly
- [ ] Pause between sections (2-3 seconds)
- [ ] Test login before recording
- [ ] Use incognito window for clean session

### Step 4: Post-Recording

- [ ] Stop recording
- [ ] Save file as: `Within-The-Covers-Demo.mp4`
- [ ] Check file quality
- [ ] Trim beginning/end if needed

### Step 5: Optional Editing

- [ ] Add intro slide (5 seconds)
- [ ] Add outro slide (5 seconds)
- [ ] Add background music (royalty-free)
- [ ] Add captions for key features
- [ ] Adjust audio levels
- [ ] Export as MP4

---

## 📱 Mobile Testing Tips

### Test Responsive Design

1. Open app in browser
2. Press F12 (Developer Tools)
3. Click mobile device icon
4. Select different screen sizes
5. Verify layout adapts

### Screenshot on Mobile

1. Connect mobile phone
2. Use Chrome Remote Debugging
3. Capture screenshots
4. Document any issues

---

## 🎯 What Features to Showcase

### For Users

- ✅ Clean, intuitive interface
- ✅ Easy product browsing
- ✅ Simple cart management
- ✅ Straightforward checkout
- ✅ Order tracking
- ✅ Review system

### For Admins

- ✅ Dashboard statistics
- ✅ Product management
- ✅ User management
- ✅ Order tracking
- ✅ Message management

### Technical Highlights

- ✅ Responsive design
- ✅ User authentication
- ✅ Database-driven
- ✅ Multiple user roles
- ✅ Complete feature set

---

## 📊 Database Info

### Tables Included

| Table    | Records | Purpose                             |
| -------- | ------- | ----------------------------------- |
| users    | 5       | 1 user + 2 admins + 2 test accounts |
| products | 12      | Book catalog                        |
| cart     | 5       | Sample cart items                   |
| orders   | 2       | Sample orders                       |
| message  | 1       | Contact form sample                 |
| review   | 4       | Product reviews                     |

### Sample Data Ready to Use

- ✅ 12 books with images
- ✅ Test user accounts
- ✅ Sample orders
- ✅ Sample reviews
- ✅ No setup needed!

---

## ✨ Quick Reference URLs

After setup, access at:

| Page            | URL                                          |
| --------------- | -------------------------------------------- |
| Home            | <http://localhost:8000>                      |
| Shop            | <http://localhost:8000/shoppage.php>         |
| Cart            | <http://localhost:8000/cartpage.php>         |
| Checkout        | <http://localhost:8000/checkoutpage.php>     |
| Orders          | <http://localhost:8000/orders.php>           |
| Reviews         | <http://localhost:8000/review.php>           |
| Contact         | <http://localhost:8000/contactpage.php>      |
| Admin Dashboard | <http://localhost:8000/adminpage.php>        |
| Manage Products | <http://localhost:8000/adminproducts.php>    |
| Manage Users    | <http://localhost:8000/adminusers.php>       |
| Manage Orders   | <http://localhost:8000/adminorders.php>      |
| Login           | <http://localhost:8000/loginpage.php>        |
| Register        | <http://localhost:8000/registrationpage.php> |

---

## 🐛 Troubleshooting During Setup

### Error: "Connection failed"

```bash
# Verify MySQL is running
# Windows: Check XAMPP Control Panel
# macOS: mysql.server status
# Linux: sudo systemctl status mysql

# Test connection
mysql -u root -p
```

### Error: "Unknown database"

```bash
# Create database
mysql -u root -p << EOF
CREATE DATABASE shop_db;
EOF

# Verify created
mysql -u root -p -e "SHOW DATABASES;"
```

### Error: "Table doesn't exist"

```bash
# Import SQL file
mysql -u root -p shop_db < shop_db.sql

# Verify tables
mysql -u root -p shop_db -e "SHOW TABLES;"
```

### Error: "Page not found"

```bash
# Check file path
# Windows: C:\xampp\htdocs\shop\index.php exists?
# macOS: ~/Sites/shop/index.php exists?
# Linux: /var/www/html/shop/index.php exists?

# Verify server is running
# Windows: XAMPP Apache running?
# macOS/Linux: php -S localhost:8000 running?
```

### Error: "Cannot upload files"

```bash
# Check folder permissions
chmod 777 uploaded_img

# Verify folder exists
mkdir -p uploaded_img
chmod 777 uploaded_img
```

---

## 🎁 Bonus: Enhancement Ideas for Video

### Add Visual Polish

- Screenshot of database structure
- Show sample data in tables
- Display code snippets
- Show folder structure

### Add Technical Details

- Show query examples
- Display database schema
- Show admin statistics
- Display error messages handled

### Add User Testimonials

- "Easy to use interface"
- "Great book selection"
- "Smooth checkout process"
- "Excellent admin tools"

---

## 📋 Final Checklist Before Recording

**Setup:**

- [ ] All software installed and running
- [ ] Database imported successfully
- [ ] All 12 books visible
- [ ] Login works for user and admin
- [ ] Can add items to cart
- [ ] Checkout form appears
- [ ] Admin dashboard loads

**Recording Prep:**

- [ ] Browser at 100% zoom
- [ ] Resolution set to 1920x1080 (or 1280x720)
- [ ] Recording tool ready
- [ ] Microphone working
- [ ] Script prepared
- [ ] Credentials written down
- [ ] No distracting browser tabs
- [ ] No notifications enabled

**Quality Check:**

- [ ] Clear audio (no background noise)
- [ ] Smooth mouse movements
- [ ] Adequate pauses between sections
- [ ] All features demonstrated
- [ ] Professional appearance
- [ ] 8-10 minute duration

---

## 🚀 Next Steps After Demo

1. ✅ Record demo video
2. ✅ Share with stakeholders
3. ✅ Get feedback
4. ⏭️ Begin Phase 1: Security Fixes
5. ⏭️ Follow DEPLOYMENT_ANALYSIS.md
6. ⏭️ Implement fixes using IMPLEMENTATION_GUIDE.md

---

## 📞 Still Having Issues?

1. **Check QUICK_START.md** - Visual quick reference
2. **Check browser console** - Press F12 for errors
3. **Check server logs** - Look for error messages
4. **Check database** - Verify tables exist

---

## 📝 Quick Reference Cheat Sheet

| Task             | Command                                                              |
| ---------------- | -------------------------------------------------------------------- |
| Start PHP server | `php -S localhost:8000`                                              |
| Start MySQL      | `mysql.server start` (macOS) or `sudo systemctl start mysql` (Linux) |
| Access MySQL     | `mysql -u root -p`                                                   |
| Import database  | `mysql -u root -p shop_db < shop_db.sql`                             |
| View databases   | `SHOW DATABASES;` (in MySQL)                                         |
| View tables      | `USE shop_db; SHOW TABLES;`                                          |
| Open app         | `http://localhost:8000`                                              |
| User login       | `theeloiserosewood@gmail.com` / `1234`                               |
| Admin login      | `dee96914@gmail.com` / `n6789`                                       |

---

## ✨ Next Steps After Setup

1. ✅ Get the app running locally
2. ✅ Test all features
3. ✅ Create demo video
4. ✅ Share with stakeholders
5. ⏭️ Begin Phase 1 security fixes (per DEPLOYMENT_ANALYSIS.md)

---

**Happy Testing! 🎉**

For detailed technical analysis, see: `DEPLOYMENT_ANALYSIS.md`  
For production deployment, see: `DEPLOYMENT_STEPS.md`  
For code fixes, see: `IMPLEMENTATION_GUIDE.md`

---

## 🔄 How to Restart Later - QUICK REFERENCE

### ⚡ Super Quick Start (Copy & Paste)

Use this command every time you want to run the app locally:

#### WINDOWS (XAMPP)

```batch
REM LOCATION: C:\xampp\htdocs\shop
REM 1. Open XAMPP Control Panel
REM 2. Click START on Apache
REM 3. Click START on MySQL
REM 4. Open browser: http://localhost/shop
```

#### macOS

```bash
# LOCATION: ~/Sites/shop or /var/www/html/shop

# 1. Open Terminal

# 2. Navigate to project
cd ~/Sites/shop

# 3. Make sure MySQL is running
mysql.server start

# 4. Start PHP server
php -S localhost:8000

# 5. Open browser: http://localhost:8000/index.php
```

#### LINUX (Ubuntu/Debian)

```bash
# LOCATION: /var/www/html/shop

# 1. Open Terminal

# 2. Navigate to project
cd /var/www/html/shop

# 3. Make sure MySQL is running
sudo systemctl start mysql

# 4. Start PHP server
php -S localhost:8000

# 5. Open browser: http://localhost:8000/index.php
```

---

### 📋 Complete Restart Procedure (All Platforms)

#### Step 1: Navigate to Project Directory

**Windows (XAMPP):**

```batch
REM LOCATION: C:\xampp\htdocs\shop
cd C:\xampp\htdocs\shop
```

**macOS:**

```bash
# LOCATION: ~/Sites/shop
cd ~/Sites/shop
```

**Linux:**

```bash
# LOCATION: /var/www/html/shop
cd /var/www/html/shop
```

#### Step 2: Start Database Server

**Windows (XAMPP):**

```batch
REM LOCATION: XAMPP Control Panel
REM Just click "Start" button next to MySQL
```

**macOS:**

```bash
# LOCATION: Terminal
mysql.server start
```

**Linux:**

```bash
# LOCATION: Terminal
sudo systemctl start mysql
```

#### Step 3: Start PHP Development Server

**All Platforms (Windows Command Prompt, macOS/Linux Terminal):**

```bash
# LOCATION: Terminal/Command Prompt (from Step 1 directory)
php -S localhost:8000
```

You should see:

```
PHP 8.3.6 Development Server (http://127.0.0.1:8000) started
Listening on http://127.0.0.1:8000
Press Ctrl+C to quit
```

#### Step 4: Open Browser

**All Platforms:**

```
http://localhost:8000/index.php
```

You should see the **Within The Covers homepage with 12 books!** 📚

---

### 🛑 How to STOP the Application

#### Stop PHP Server (All Platforms)

**In the Terminal/Command Prompt where PHP is running:**

```
Ctrl+C
```

You should see: `Terminated`

#### Stop MySQL (Optional)

**Windows (XAMPP):**

```batch
REM LOCATION: XAMPP Control Panel
REM Click "Stop" button next to MySQL
```

**macOS:**

```bash
# LOCATION: Terminal
mysql.server stop
```

**Linux:**

```bash
# LOCATION: Terminal
sudo systemctl stop mysql
```

---

### 📋 Restart Checklist (Use Every Time)

Use this checklist each time you want to run the app:

- [ ] **Navigate:** `cd /var/www/html/shop` (or your project location)
- [ ] **MySQL Start:** `sudo systemctl start mysql` (Linux) or `mysql.server start` (macOS) or XAMPP button (Windows)
- [ ] **PHP Start:** `php -S localhost:8000`
- [ ] **Browser:** Open `http://localhost:8000/index.php`
- [ ] **See 12 books?** ✅ If yes, you're ready to demo!
- [ ] **Done!** Ready to test or record

---

### 🔑 Login Credentials (Always the Same)

**Keep these for reference - never change them:**

```
Regular User:
  Email: theeloiserosewood@gmail.com
  Password: 1234

Admin User:
  Email: dee96914@gmail.com
  Password: n6789
```

---

### 🐛 Quick Troubleshooting

**Q: "Port 8000 already in use"**

```bash
# Use a different port
php -S localhost:9000
# Then open: http://localhost:9000/index.php
```

**Q: "Cannot connect to database"**

```bash
# Check MySQL is running
mysql -u root -e "SELECT 1;"

# If error, start MySQL:
# Linux: sudo systemctl start mysql
# macOS: mysql.server start
```

**Q: "Connection refused"**

```bash
# Make sure PHP server is running (Step 3 above)
# Should show: "Development Server (http://127.0.0.1:8000) started"
```

---

### 💡 Pro Tips

1. **Keep terminal open** while testing

   - Shows server status
   - Displays any errors in real-time

2. **Use a new browser window** each time

   - Clears browser cache
   - Prevents login issues

3. **Check browser console** for errors

   - Press F12 (or Cmd+Option+I on macOS)
   - Click "Console" tab
   - Look for red error messages

4. **If stuck,** just:
   - Press `Ctrl+C` to stop PHP
   - Restart MySQL (see Stop section above)
   - Run Step 3 again: `php -S localhost:8000`

---

### 📁 Project Locations Reference

| OS                  | Location               | Start Command           |
| ------------------- | ---------------------- | ----------------------- |
| **Windows (XAMPP)** | `C:\xampp\htdocs\shop` | Use XAMPP Control Panel |
| **macOS**           | `~/Sites/shop`         | `php -S localhost:8000` |
| **Linux**           | `/var/www/html/shop`   | `php -S localhost:8000` |

---

### ✨ You're All Set

**Next Time You Want to Run It:**

1. Navigate to project (see table above)
2. Start MySQL (if needed)
3. Run: `php -S localhost:8000`
4. Open: `http://localhost:8000/index.php`
5. Test features or record demo!

---

**Document Created:** November 2, 2025  
**Last Updated:** November 2, 2025  
**Status:** READY FOR LOCAL SETUP & RESTART
