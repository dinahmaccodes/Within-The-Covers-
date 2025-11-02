# Local Setup - Quick Visual Guide

## 🎯 5-Minute Setup Process

```
Step 1: Install Software
   ├─ PHP 7.4+
   ├─ MySQL 5.7+
   └─ Code Editor (Optional)
        ↓
Step 2: Copy Project Files
   ├─ Clone or copy to your machine
   └─ Place in web-accessible folder
        ↓
Step 3: Create Database
   ├─ Create shop_db database
   ├─ Import shop_db.sql
   └─ Verify tables created
        ↓
Step 4: Configure Connection
   ├─ Edit configuration.php
   └─ Set database credentials
        ↓
Step 5: Start Server
   ├─ Start PHP development server
   ├─ Start MySQL
   └─ Open browser
        ↓
Step 6: Test Login
   ├─ User: theeloiserosewood@gmail.com / 1234
   └─ Admin: dee96914@gmail.com / n6789
        ↓
✅ Ready for Demo Video!
```

---

## 🚀 Fastest Setup (Copy-Paste)

### Windows (with XAMPP)

```batch
REM 1. Download XAMPP and install

REM 2. Place project in XAMPP
xcopy /E /I "C:\Users\YourUsername\Downloads\Within-The-Covers-" "C:\xampp\htdocs\shop"

REM 3. Start XAMPP Control Panel and click:
REM    - Start Apache
REM    - Start MySQL

REM 4. Open MySQL console in XAMPP and paste:
CREATE DATABASE shop_db;
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;

REM 5. Import database (open Command Prompt):
cd C:\xampp\mysql\bin
mysql -u root shop_db < "C:\xampp\htdocs\shop\shop_db.sql"

REM 6. Edit C:\xampp\htdocs\shop\configuration.php:
REM    Change: $conn = mysqli_connect('localhost', 'root', '', 'shop_db');

REM 7. Open browser and go to: http://localhost/shop
```

---

### macOS (with Homebrew)

```bash
# 1. Install PHP and MySQL
brew install php mysql

# 2. Start MySQL
mysql.server start

# 3. Copy project
cp -r ~/Downloads/Within-The-Covers- ~/Sites/shop
cd ~/Sites/shop

# 4. Create database
mysql -u root << EOF
CREATE DATABASE shop_db;
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;
EOF

# 5. Import database
mysql -u root shop_db < shop_db.sql

# 6. Create directories
mkdir -p uploaded_img logs cache
chmod 755 uploaded_img logs cache

# 7. Start PHP server
php -S localhost:8000

# 8. Open browser: http://localhost:8000
```

---

### Linux (Ubuntu/Debian)

```bash
# 1. Install packages
sudo apt update
sudo apt install -y php php-cli php-mysql mysql-server

# 2. Start MySQL
sudo systemctl start mysql

# 3. Copy project
sudo cp -r ~/Downloads/Within-The-Covers- /var/www/html/shop
sudo chown -R $USER:$USER /var/www/html/shop
cd /var/www/html/shop

# 4. Create database
mysql -u root << EOF
CREATE DATABASE shop_db;
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;
EOF

# 5. Import database
mysql -u root shop_db < shop_db.sql

# 6. Create directories
mkdir -p uploaded_img logs cache
chmod 755 uploaded_img logs cache

# 7. Start PHP server
php -S localhost:8000

# 8. Open browser: http://localhost:8000
```

---

## 🔓 Test Credentials

```
REGULAR USER:
  Email: theeloiserosewood@gmail.com
  Password: 1234

ADMIN USER #1:
  Email: dee96914@gmail.com
  Password: n6789

ADMIN USER #2:
  Email: h65dee@gmail.com
  Password: 45678
```

---

## 🌐 Access URLs

After setup, access the app at:

| Feature  | URL                                        | Login Required |
| -------- | ------------------------------------------ | -------------- |
| Homepage | http://localhost:8000                      | No             |
| Shop     | http://localhost:8000/shoppage.php         | Yes            |
| Cart     | http://localhost:8000/cartpage.php         | Yes            |
| Checkout | http://localhost:8000/checkoutpage.php     | Yes            |
| Admin    | http://localhost:8000/adminpage.php        | Yes (Admin)    |
| Login    | http://localhost:8000/loginpage.php        | No             |
| Register | http://localhost:8000/registrationpage.php | No             |

---

## 📊 Database Info

**Database Name:** shop_db

**Tables Created:**

```
users         - 5 users (1 regular, 2 admins)
products      - 12 books
cart          - Shopping cart items
orders        - Order history
message       - Contact messages
review        - Product reviews
```

**Sample Data Included:**

- ✅ 12 fiction/finance books ready to buy
- ✅ 2 sample orders
- ✅ 4 product reviews
- ✅ 1 contact message

---

## ✅ What to Test

### User Features (Regular Login)

- [ ] View homepage
- [ ] Browse shop
- [ ] Add items to cart
- [ ] Modify cart quantities
- [ ] View cart total
- [ ] Proceed to checkout
- [ ] Place order
- [ ] View order history
- [ ] Submit review
- [ ] View reviews

### Admin Features (Admin Login)

- [ ] View admin dashboard
- [ ] See pending orders
- [ ] See completed orders
- [ ] View products list
- [ ] Add new product (optional - requires image upload)
- [ ] Delete product (optional)
- [ ] View all users
- [ ] View all orders
- [ ] View messages

### General Features

- [ ] Homepage responsive design
- [ ] Mobile view works
- [ ] Logout functionality
- [ ] Session management
- [ ] Error messages appear correctly

---

## 🎬 Demo Video Recording

### Recommended Flow (10 minutes)

**Intro (30 seconds)**

- Welcome screen
- Show app name

**User Journey (5 minutes)**

1. Homepage tour (1 min)

   - Show catalog
   - Scroll products

2. Shopping demo (2 min)

   - Add to cart
   - View cart
   - Show totals

3. Checkout (1.5 min)

   - Enter details
   - Place order
   - Show confirmation

4. Reviews (0.5 min)
   - View reviews
   - Submit review

**Admin Features (3 minutes)**

1. Admin login (30 sec)
2. Dashboard (1 min)
   - Show stats
3. Management (1.5 min)
   - Products
   - Orders

**Outro (30 seconds)**

- Thank you
- Features summary

---

## 🎥 Recording Tools

| Tool       | Platform          | Cost | Quality   |
| ---------- | ----------------- | ---- | --------- |
| OBS Studio | Windows/Mac/Linux | Free | Excellent |
| QuickTime  | macOS             | Free | Good      |
| Camtasia   | All               | $$$  | Excellent |
| ScreenFlow | macOS             | $$   | Excellent |
| ShareX     | Windows           | Free | Good      |

---

## 📁 Project Structure After Setup

```
shop/
├── configuration.php ..................... DB config
├── index.php ............................ Homepage
├── loginpage.php ........................ Login form
├── registrationpage.php ................. Sign up form
├── shoppage.php ......................... Product catalog
├── cartpage.php ......................... Shopping cart
├── checkoutpage.php ..................... Order placement
├── orders.php ........................... Order history
├── review.php ........................... Reviews
├── display_reviews.php .................. Show reviews
├── submit_review.php .................... Add review
├── contactpage.php ...................... Contact form
├── adminpage.php ........................ Admin dashboard
├── adminproducts.php .................... Manage products
├── adminusers.php ....................... Manage users
├── adminorders.php ...................... Manage orders
├── admincontacts.php .................... View messages
├── header.php ........................... Header component
├── index_header.php ..................... Homepage header
├── adminheader.php ...................... Admin header
├── footer.php ........................... Footer component
├── logoutpage.php ....................... Logout
├── add_to_cart.php ...................... Add to cart logic
├── shop_db.sql .......................... Database schema
├── css/
│   ├── registrationstyle.css ........... Form styles
│   ├── adminpagestyle.css .............. Admin styles
│   └── reviews.css ..................... Review styles
├── js/
│   ├── homescript.js ................... Homepage JS
│   └── adminscript.js .................. Admin JS
├── images/ ............................. Static images
├── uploaded_img/ ....................... Product images
└── LOCAL_SETUP_GUIDE.md ................ This file
```

---

## 🆘 Common Issues & Fixes

### "Connection failed" Error

```bash
# Check MySQL is running
# Windows: XAMPP Control Panel
# macOS: mysql.server status
# Linux: sudo systemctl status mysql

# Verify credentials in configuration.php
# Test: mysql -u root -p shop_db
```

### "Unknown database 'shop_db'"

```bash
# Create database:
mysql -u root -p
CREATE DATABASE shop_db;
EXIT;

# Import:
mysql -u root -p shop_db < shop_db.sql
```

### "Can't upload files"

```bash
# Fix permissions (Linux/macOS):
chmod 777 uploaded_img

# Windows: Run as Administrator
```

### "Blank page or 404"

```bash
# Hard refresh browser: Ctrl+Shift+Delete
# Or use incognito mode
# Check PHP is running: http://localhost:8000
# Check logs: tail -f logs/*.log
```

### "Session not working"

```bash
# Clear cookies
# Use incognito/private window
# Make sure PHP session.save_path is writable
```

---

## 💡 Pro Tips

1. **Use incognito window** for clean session state
2. **Keep developer tools open** (F12) to see errors
3. **Clear cache** if pages don't update: Ctrl+Shift+Delete
4. **Hard refresh** page: Ctrl+F5
5. **Test mobile** view: F12 → Click mobile icon
6. **Record at 1920x1080** for best quality
7. **Use microphone** for narration during recording
8. **Test all features** before recording demo

---

## ✨ Next Steps

1. ✅ Follow setup guide above
2. ✅ Verify app loads
3. ✅ Test login with credentials
4. ✅ Test features
5. ✅ Record demo video
6. ✅ Share demo link
7. ⏭️ Begin Phase 1 security fixes

---

**Local Setup Complete!**

See **`docs/LOCAL_SETUP_GUIDE.md`** for detailed instructions.

For deployment to production, see **`docs/DEPLOYMENT_STEPS.md`**.
