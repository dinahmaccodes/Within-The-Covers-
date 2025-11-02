# Within The Covers - Deployment Guide

## Pre-Deployment Checklist

### Development Environment

- [ ] Clone repository to development machine
- [ ] Set up local MySQL database
- [ ] Import `shop_db.sql` to local database
- [ ] Configure `.env` file with local credentials
- [ ] Test all features locally
- [ ] Run security audit
- [ ] Fix all security issues identified

### Code Quality

- [ ] All SQL queries use prepared statements
- [ ] All passwords hashed with bcrypt
- [ ] File uploads validated
- [ ] Input validation implemented
- [ ] Error handling in place
- [ ] Logging configured
- [ ] CSRF tokens implemented
- [ ] Code reviewed by peer
- [ ] All tests passing

### Infrastructure Preparation

- [ ] Hosting account created
- [ ] SSL certificate obtained (Let's Encrypt recommended)
- [ ] PHP 7.4+ installed
- [ ] MySQL 5.7+ installed
- [ ] Web server configured (Apache/Nginx)
- [ ] Database credentials secured
- [ ] Backup strategy implemented
- [ ] Monitoring tools installed

---

## Step-by-Step Deployment Process

### Phase 1: Server Preparation (Day 1)

#### 1.1 Update System Packages

```bash
sudo apt update
sudo apt upgrade -y
sudo apt install -y curl wget git htop
```

#### 1.2 Install PHP 8.1

```bash
sudo apt install -y php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-zip php8.1-gd php8.1-curl
sudo systemctl start php8.1-fpm
sudo systemctl enable php8.1-fpm
```

#### 1.3 Install MySQL Server

```bash
sudo apt install -y mysql-server
sudo mysql_secure_installation
sudo systemctl start mysql
sudo systemctl enable mysql
```

#### 1.4 Install Nginx Web Server

```bash
sudo apt install -y nginx
sudo systemctl start nginx
sudo systemctl enable nginx
```

#### 1.5 Create Application User

```bash
sudo useradd -m -s /bin/bash appuser
sudo usermod -aG www-data appuser
sudo su - appuser
```

---

### Phase 2: Database Setup (Day 1)

#### 2.1 Create Database and User

```sql
-- Connect to MySQL as root
mysql -u root -p

-- Create database
CREATE DATABASE shop_db;

-- Create dedicated database user
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'secure_password_here';

-- Grant privileges
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;

-- Exit MySQL
EXIT;
```

#### 2.2 Import Database Schema

```bash
mysql -u shop_user -p shop_db < shop_db.sql
```

#### 2.3 Verify Database Import

```sql
mysql -u shop_user -p shop_db

-- Check tables
SHOW TABLES;

-- Check users table
SELECT * FROM users;

-- Exit
EXIT;
```

---

### Phase 3: Application Deployment (Day 2)

#### 3.1 Clone Repository

```bash
cd /var/www
sudo git clone https://github.com/dinahmaccodes/Within-The-Covers-.git shop
sudo chown -R appuser:www-data shop
sudo chmod -R 755 shop
cd shop
```

#### 3.2 Create Configuration Files

Create `.env` file:

```bash
cat > .env << EOF
# Database Configuration
DB_HOST=localhost
DB_USER=shop_user
DB_PASS=secure_password_here
DB_NAME=shop_db

# App Configuration
APP_ENV=production
APP_DEBUG=false
APP_URL=https://shop.example.com

# Security
HASH_COST=12
SESSION_TIMEOUT=1800

# Email Configuration
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USER=your-email@gmail.com
MAIL_PASS=your-app-password
MAIL_FROM=noreply@shop.example.com
EOF
```

#### 3.3 Create Required Directories

```bash
mkdir -p config
mkdir -p logs
mkdir -p uploads
mkdir -p cache
chmod -R 755 logs uploads cache
chmod 600 .env
```

#### 3.4 Copy Config Classes

Copy these files to `/var/www/shop/config/`:

- `Config.php`
- `Database.php`
- `FileUpload.php`
- `Logger.php`
- `ErrorHandler.php`
- `Security.php`
- `Validator.php`

---

### Phase 4: Web Server Configuration (Day 2)

#### 4.1 Configure Nginx

Create `/etc/nginx/sites-available/shop.conf`:

```nginx
upstream php_backend {
    server unix:/run/php/php8.1-fpm.sock;
}

server {
    listen 80;
    server_name shop.example.com www.shop.example.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name shop.example.com www.shop.example.com;

    # SSL Certificates
    ssl_certificate /etc/letsencrypt/live/shop.example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/shop.example.com/privkey.pem;

    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Document Root
    root /var/www/shop;
    index index.php index.html index.htm;

    # Access Logs
    access_log /var/log/nginx/shop_access.log;
    error_log /var/log/nginx/shop_error.log;

    # PHP Configuration
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass php_backend;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;

        # Security
        fastcgi_param HTTP_X_FORWARDED_FOR $remote_addr;
        fastcgi_param SERVER_PORT 443;
        fastcgi_param HTTPS on;
    }

    # Hide sensitive files
    location ~ /\. {
        deny all;
    }

    location ~ /\.env {
        deny all;
    }

    # Cache static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|woff|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    # Uploaded files
    location /uploaded_img/ {
        try_files $uri =404;
    }
}
```

#### 4.2 Enable Site and Test Configuration

```bash
sudo ln -s /etc/nginx/sites-available/shop.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

### Phase 5: SSL/TLS Setup (Day 2)

#### 5.1 Install Certbot

```bash
sudo apt install -y certbot python3-certbot-nginx
```

#### 5.2 Obtain SSL Certificate

```bash
sudo certbot certonly --nginx -d shop.example.com -d www.shop.example.com
```

#### 5.3 Set Up Auto-Renewal

```bash
sudo systemctl enable certbot.timer
sudo systemctl start certbot.timer
```

---

### Phase 6: Application Hardening (Day 3)

#### 6.1 PHP Configuration

Edit `/etc/php/8.1/fpm/php.ini`:

```ini
# Security settings
display_errors = Off
log_errors = On
error_log = /var/log/php/error.log
error_reporting = E_ALL

# Session security
session.secure = On
session.httponly = On
session.name = SHOP_SESSION
session.gc_maxlifetime = 1800

# Upload restrictions
upload_max_filesize = 5M
post_max_size = 5M

# Disable dangerous functions
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source

# Limits
memory_limit = 256M
max_execution_time = 30
```

Restart PHP-FPM:

```bash
sudo systemctl restart php8.1-fpm
```

#### 6.2 Set File Permissions

```bash
sudo chown -R www-data:www-data /var/www/shop
sudo chmod 755 /var/www/shop
sudo chmod -R 755 /var/www/shop/*
sudo chmod -R 777 /var/www/shop/uploaded_img
sudo chmod -R 777 /var/www/shop/logs
sudo chmod 600 /var/www/shop/.env
```

#### 6.3 Create Log Directories

```bash
sudo mkdir -p /var/log/php
sudo chown www-data:www-data /var/log/php
sudo chmod 755 /var/log/php
```

---

### Phase 7: Backup Configuration (Day 3)

#### 7.1 Create Backup Script

File: `/usr/local/bin/backup-shop.sh`

```bash
#!/bin/bash

BACKUP_DIR="/backups/shop"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
DB_NAME="shop_db"
DB_USER="shop_user"
DB_PASS="secure_password_here"

mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/db_$TIMESTAMP.sql.gz

# Files backup
tar -czf $BACKUP_DIR/files_$TIMESTAMP.tar.gz /var/www/shop/uploaded_img/

# Keep only last 30 days
find $BACKUP_DIR -name "*.gz" -mtime +30 -delete

echo "Backup completed: $TIMESTAMP"
```

#### 7.2 Set Cron Job

```bash
sudo chmod +x /usr/local/bin/backup-shop.sh

# Add to crontab
sudo crontab -e

# Add line:
# 2 3 * * * /usr/local/bin/backup-shop.sh
```

---

### Phase 8: Monitoring & Logging (Day 3)

#### 8.1 Set Up Log Rotation

File: `/etc/logrotate.d/shop`

```
/var/log/php/error.log
/var/www/shop/logs/*.log
{
    daily
    rotate 14
    compress
    delaycompress
    missingok
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

#### 8.2 Configure Monitoring

```bash
# Install health check script
cat > /var/www/shop/health.php << 'EOF'
<?php
header('Content-Type: application/json');

$health = [
    'status' => 'ok',
    'timestamp' => date('c'),
    'database' => 'checking'
];

// Check database connection
try {
    $conn = new mysqli('localhost', 'shop_user', 'secure_password_here', 'shop_db');
    if ($conn->connect_error) {
        $health['database'] = 'error';
        $health['status'] = 'error';
    } else {
        $health['database'] = 'ok';
        $conn->close();
    }
} catch (Exception $e) {
    $health['database'] = 'error';
    $health['status'] = 'error';
}

http_response_code($health['status'] === 'ok' ? 200 : 500);
echo json_encode($health);
EOF
```

---

### Phase 9: Testing (Day 4)

#### 9.1 Basic Functionality Tests

```bash
# Test homepage
curl -I https://shop.example.com/

# Test database connection
curl https://shop.example.com/health.php

# Check logs
tail -f /var/log/php/error.log
```

#### 9.2 Security Tests

- [ ] Test SQL injection attempts
- [ ] Verify HTTPS enforcement
- [ ] Check password hashing
- [ ] Verify file upload validation
- [ ] Test CSRF protection
- [ ] Verify session security

#### 9.3 Performance Tests

```bash
# Install Apache Bench
sudo apt install -y apache2-utils

# Run load test
ab -n 1000 -c 50 https://shop.example.com/
```

---

### Phase 10: Go-Live (Day 5)

#### 10.1 DNS Configuration

Update DNS records to point to your server:

```
A Record: shop.example.com -> YOUR_SERVER_IP
CNAME: www.shop.example.com -> shop.example.com
```

#### 10.2 Create Admin Account

```bash
# Connect to database
mysql -u shop_user -p shop_db

# Add admin user
INSERT INTO users (name, email, password, user_type) VALUES (
    'Administrator',
    'admin@shop.example.com',
    '$2y$12$...bcrypt_hash...',
    'admin'
);
```

#### 10.3 Final Verification

- [ ] Website loads correctly
- [ ] All pages accessible
- [ ] SSL certificate valid
- [ ] Forms submit correctly
- [ ] Admin panel functional
- [ ] Emails sending (if configured)
- [ ] Backups running
- [ ] Monitoring active

---

## Post-Deployment Maintenance

### Daily Tasks

- [ ] Monitor error logs
- [ ] Check disk space
- [ ] Verify backups completed
- [ ] Monitor server resources

### Weekly Tasks

- [ ] Review security logs
- [ ] Check for failed login attempts
- [ ] Update software packages (non-critical)
- [ ] Review performance metrics

### Monthly Tasks

- [ ] Full security audit
- [ ] Backup verification
- [ ] Database optimization
- [ ] SSL certificate renewal check
- [ ] User feedback review

### Quarterly Tasks

- [ ] Security penetration testing
- [ ] Database integrity check
- [ ] Performance optimization
- [ ] Update dependencies
- [ ] Review and update security policies

---

## Troubleshooting Guide

### Issue: White Screen of Death

1. Check error logs: `tail -f /var/log/php/error.log`
2. Check Nginx logs: `tail -f /var/log/nginx/shop_error.log`
3. Verify PHP-FPM is running: `sudo systemctl status php8.1-fpm`
4. Check file permissions: `ls -la /var/www/shop/`
5. Verify `.env` file exists and is readable

### Issue: Database Connection Error

1. Check MySQL is running: `sudo systemctl status mysql`
2. Verify credentials in `.env`
3. Test connection: `mysql -u shop_user -p -h localhost`
4. Check firewall: `sudo ufw status`
5. Review MySQL error log: `sudo tail /var/log/mysql/error.log`

### Issue: SSL Certificate Error

1. Verify certificate path in Nginx config
2. Check certificate validity: `sudo certbot certificates`
3. Renew certificate: `sudo certbot renew`
4. Restart Nginx: `sudo systemctl restart nginx`

### Issue: Upload Failures

1. Check directory permissions: `ls -la /var/www/shop/uploaded_img/`
2. Check disk space: `df -h`
3. Review PHP upload settings: `php -i | grep upload`
4. Check error logs for specific error

---

## Support & Documentation

- **Documentation:** `/var/www/shop/DEPLOYMENT_ANALYSIS.md`
- **Implementation Guide:** `/var/www/shop/IMPLEMENTATION_GUIDE.md`
- **Database Schema:** `/var/www/shop/shop_db.sql`
- **Configuration:** `/var/www/shop/.env`

For issues or questions, refer to these documents or contact your development team.

---

**Document Version:** 1.0
**Last Updated:** November 2, 2025
**Status:** Ready for Production Deployment
