# 🎯 LOCAL SETUP SUMMARY FOR YOU

## What You Have Now

I've created **3 complete guides** to help you run the app locally and make a demo:

1. **`docs/LOCAL_SETUP_GUIDE.md`** - Detailed step-by-step instructions
2. **`docs/QUICK_START.md`** - Visual diagrams and quick reference
3. **`docs/LOCAL_DEMO_GUIDE.md`** - Complete demo recording script

---

## ⚡ The Fastest Path (Your OS)

### Pick Your Operating System

#### 🪟 Windows (EASIEST - 5 minutes)

```
1. Download & install XAMPP from apachefriends.org
2. Copy your project to: C:\xampp\htdocs\shop
3. In XAMPP Control Panel, click START on:
   - Apache
   - MySQL
4. Open MySQL console in XAMPP and run:
   CREATE DATABASE shop_db;
5. In Command Prompt, run:
   cd C:\xampp\mysql\bin
   mysql -u root shop_db < "C:\xampp\htdocs\shop\shop_db.sql"
6. Open browser: http://localhost/shop
7. Login with: theeloiserosewood@gmail.com / 1234
✅ DONE! You're ready to demo!
```

#### 🍎 macOS (Terminal-based - 5 minutes)

```bash
# 1. Install (if needed)
brew install php mysql

# 2. Start MySQL
mysql.server start

# 3. Copy project
cp -r ~/Downloads/Within-The-Covers- ~/Sites/shop

# 4. Create database
mysql -u root << EOF
CREATE DATABASE shop_db;
EOF

# 5. Import database
mysql -u root shop_db < ~/Sites/shop/shop_db.sql

# 6. Start server
cd ~/Sites/shop
php -S localhost:8000

# 7. Open browser: http://localhost:8000
# 8. Login with: theeloiserosewood@gmail.com / 1234
# ✅ DONE!
```

#### 🐧 Linux (Ubuntu/Debian - 5 minutes)

```bash
# 1. Install (if needed)
sudo apt update
sudo apt install php mysql-server

# 2. Start MySQL
sudo systemctl start mysql

# 3. Copy project
sudo cp -r ~/Downloads/Within-The-Covers- /var/www/html/shop
sudo chown -R $USER:$USER /var/www/html/shop

# 4. Create database
mysql -u root << EOF
CREATE DATABASE shop_db;
EOF

# 5. Import database
mysql -u root shop_db < /var/www/html/shop/shop_db.sql

# 6. Start server
cd /var/www/html/shop
php -S localhost:8000

# 7. Open browser: http://localhost:8000
# 8. Login with: theeloiserosewood@gmail.com / 1234
# ✅ DONE!
```

---

## 🔑 Login Credentials (Copy-Paste)

### Regular User

```
Email: theeloiserosewood@gmail.com
Password: 1234
```

### Admin #1

```
Email: dee96914@gmail.com
Password: n6789
```

### Admin #2

```
Email: h65dee@gmail.com
Password: 45678
```

---

## ✅ Quick Verification (Before Demo)

After setup, check these in your browser:

- [ ] Homepage loads at <http://localhost:8000>
- [ ] Can see 12 books
- [ ] Can login with user credentials
- [ ] Can add book to cart
- [ ] Can view cart
- [ ] Can login with admin credentials
- [ ] Can access admin dashboard

If all ✅, you're ready to record!

---

## 🎥 Demo Video (10 minutes)

See **`docs/LOCAL_DEMO_GUIDE.md`** for complete script, but here's the quick version:

### Part 1: User Journey (4 min)

- Show homepage
- Browse 12 books
- Add to cart
- View cart
- Checkout
- See order confirmation

### Part 2: Admin Features (3 min)

- Login as admin
- Show dashboard stats
- Show product list
- Show order list

### Part 3: Summary (1 min)

- List key features
- Thank you

**Total: ~10 minutes**

---

## 🎬 How to Record

### Option 1: OBS Studio (Free, Best)

1. Download from obsproject.com
2. Open OBS
3. Add "Display Capture" source
4. Click "Start Recording"
5. Do your demo
6. Click "Stop Recording"
7. File saved automatically

### Option 2: QuickTime (macOS)

1. Open QuickTime
2. File → New Screen Recording
3. Click red dot to record
4. Do your demo
5. Click stop
6. Save file

### Option 3: Windows Built-in

1. Press Win + G
2. Click "Start recording"
3. Do your demo
4. Click stop

---

## 📋 What You'll Demonstrate

### User Side

✅ Homepage with 12 books  
✅ Product details  
✅ Add to cart  
✅ Shopping cart page  
✅ Modify quantities  
✅ Checkout form  
✅ Order placement  
✅ Order confirmation

### Admin Side

✅ Admin login  
✅ Dashboard stats  
✅ Product list  
✅ Add product form  
✅ User list  
✅ Order list  
✅ Order details

---

## 🐛 If Something Goes Wrong

### "Connection failed" error

- Make sure MySQL is running
- Windows: Check XAMPP Control Panel
- macOS/Linux: `mysql.server status` or `sudo systemctl status mysql`

### "Unknown database" error

- Create database: `mysql -u root -p -e "CREATE DATABASE shop_db;"`
- Import: `mysql -u root -p shop_db < shop_db.sql`

### "Page won't load"

- Windows: Make sure Apache is running in XAMPP
- macOS/Linux: Make sure `php -S localhost:8000` is running
- Try accessing: <http://localhost:8000>

### "Can't login"

- Check browser cookies are enabled
- Try incognito/private window
- Verify database was imported: `mysql -u root -p shop_db -e "SELECT * FROM users LIMIT 1;"`

---

## 📁 Your Project Structure

```
Within-The-Covers-/
├── index.php ...................... Homepage
├── loginpage.php .................. Login
├── shoppage.php ................... Shop
├── cartpage.php ................... Cart
├── checkoutpage.php ............... Checkout
├── orders.php ..................... Order history
├── review.php ..................... Reviews
├── adminpage.php .................. Admin dashboard
├── adminproducts.php .............. Product management
├── adminusers.php ................. User management
├── adminorders.php ................ Order management
├── configuration.php .............. Database config (NO CHANGES NEEDED)
├── shop_db.sql .................... Database (already imported)
├── css/ ........................... Stylesheets
├── js/ ............................ JavaScript
├── images/ ........................ Static images
├── uploadedimg/ ....................... Product images
└── LOCAL_DEMO_GUIDE.md ................ Recording instructions
```

---

## 🎯 Timeline

### Step 1: Setup (5 minutes)

Follow instructions for your OS above

### Step 2: Verify (5 minutes)

Check all features work

### Step 3: Record (15-20 minutes)

Record your demo video

### Step 4: Edit (Optional - 10-20 minutes)

Add intro/outro and music

### Step 5: Share

Upload and share demo link

**Total Time: 30-45 minutes**

---

## 📊 What's Already Included

✅ Database with sample data  
✅ 12 books ready to view  
✅ 5 test users (1 regular, 2 admin, 2 other)  
✅ 2 sample orders  
✅ 4 sample reviews  
✅ All images included

**You don't need to add anything - it's ready to demo!**

---

## 🌐 Access URLs After Setup

```
Homepage:        http://localhost:8000
Shop:           http://localhost:8000/shoppage.php
Cart:           http://localhost:8000/cartpage.php
Checkout:       http://localhost:8000/checkoutpage.php
Orders:         http://localhost:8000/orders.php
Reviews:        http://localhost:8000/review.php
Admin:          http://localhost:8000/adminpage.php
Login:          http://localhost:8000/loginpage.php
Register:       http://localhost:8000/registrationpage.php
```

---

## 💡 Pro Tips

1. **Use incognito window** - Cleaner sessions
2. **Set browser zoom to 100%** - Better recording
3. **Close other apps** - Better performance
4. **Test before recording** - Don't make mistakes on video
5. **Speak slowly** - People can rewatch but not re-listen
6. **Record in 1920x1080** - Best quality
7. **Take pauses** - 2-3 seconds between sections

---

## ✨ Demo Video Ideas

### Quick Demo (5 minutes)

- Homepage
- Login
- Shopping
- Admin dashboard

### Complete Demo (10 minutes)

- All user features
- All admin features
- Order placement
- Review submission

### Detailed Demo (15 minutes)

- Complete user journey
- Complete admin journey
- Database overview
- Technical highlights

---

## 📞 Where to Find Help

**For Setup Help:**

- See: `docs/LOCAL_SETUP_GUIDE.md` (detailed instructions)
- See: `docs/QUICK_START.md` (quick reference)

**For Recording Help:**

- See: `docs/LOCAL_DEMO_GUIDE.md` (complete script)

**For Technical Issues:**

- Check browser console (F12)
- Check browser network (F12 → Network)
- Look at error messages
- Check database exists: `mysql -u root -p -e "SHOW DATABASES;"`

---

## 🎉 You're All Set

Everything you need is:

1. ✅ In the `docs/LOCAL_SETUP_GUIDE.md` (detailed)
2. ✅ In the `docs/QUICK_START.md` (quick reference)
3. ✅ In the `docs/LOCAL_DEMO_GUIDE.md` (recording script)

**Just follow the instructions for your OS and you'll be recording in 30 minutes!**

---

## ⏭️ After Your Demo

1. Share the demo video with stakeholders
2. Get feedback
3. Then begin Phase 1 fixes using: **`docs/IMPLEMENTATION_GUIDE.md`**
4. Deploy to production using: **`docs/DEPLOYMENT_STEPS.md`**

---

**Ready to go? Pick your OS and follow the instructions above! 🚀**

---

Created: November 2, 2025  
Status: READY FOR LOCAL DEMO RECORDING
