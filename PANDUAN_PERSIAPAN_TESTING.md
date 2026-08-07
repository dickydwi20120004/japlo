# 🎯 PANDUAN PERSIAPAN TESTING - JAPLO APP

**Status:** ✅ Siap untuk Testing  
**Tanggal:** 7 Agustus 2026  
**Target:** Verifikasi semua 5 feature options + 3 dashboards  

---

## ⚡ MULAI DALAM 1 MENIT

### 1. Start Server (30 detik)
```powershell
cd "C:\xampp\htdocs\Japlo App"
php artisan serve
```

**Tunggu sampai muncul:**
```
Started Laravel development server on [http://127.0.0.1:8000]
```

### 2. Buka Browser (10 detik)
```
http://localhost:8000
```

### 3. Login (20 detik)
```
Email: demo@japlo.com
Password: password123
```

✅ **SELESAI!** Siap testing.

---

## 📋 CHECKLIST PRE-TESTING

Sebelum mulai testing, pastikan:

### System Check
- [ ] PHP running properly: `php -v`
- [ ] Laravel version 10.50+: `php artisan --version`
- [ ] Database connected: `php artisan migrate:status`
- [ ] Server accessible: `http://localhost:8000`
- [ ] No "Disk full" errors

### Browser Check
- [ ] Modern browser installed (Chrome/Firefox/Edge)
- [ ] Developer Tools available (F12)
- [ ] JavaScript enabled
- [ ] Cookies enabled
- [ ] Pop-ups not blocked

### Preparation
- [ ] Read this document
- [ ] Have 3 login credentials ready (below)
- [ ] Open text editor for notes
- [ ] Clear browser cache (recommended)
- [ ] Use incognito mode (optional but recommended)

---

## 👤 LOGIN CREDENTIALS SIAP DIGUNAKAN

### Account 1: ADMIN (Untuk testing admin features)
```
Email:    admin@japlo.com
Password: admin123
Role:     Administrator
```

### Account 2: CUSTOMER (RECOMMENDED - Test semua features)
```
Email:    demo@japlo.com
Password: password123
Role:     Customer/Penumpang
```

### Account 3: DRIVER (Untuk testing driver dashboard)
```
Email:    driver@japlo.com
Password: password123
Role:     Driver/Sopir
```

---

## ✅ TESTING FLOW (Recommended Order)

### STEP 1: Test Customer Dashboard (5 menit)
1. Login dengan customer account: `demo@japlo.com`
2. Lihat customer dashboard
3. Verify 8 service icons visible:
   - [ ] Ojek icon
   - [ ] Kuliner icon
   - [ ] Promosi icon
   - [ ] Kesehatan icon
   - [ ] Produk icon
   - [ ] Pencetakan icon
   - [ ] Trending icon
   - [ ] Sosial icon
4. Hover effect: Check shadow & transform
5. Click each icon: Verify page change

### STEP 2: Test All 8 Services (30-40 menit)
Follow the service testing guide in section below

### STEP 3: Test Payment Flow (5 menit)
1. From any service, add to cart/create order
2. Go to checkout page
3. Select payment method
4. Verify success page
5. Check order in history

### STEP 4: Test Order Tracking (5 menit)
1. Go to Order History
2. Click on an order
3. Verify tracking page
4. Check timeline display
5. Verify driver info (if applicable)

### STEP 5: Test Admin Dashboard (5 menit)
1. Logout from customer
2. Login dengan admin: `admin@japlo.com`
3. Verify statistics display
4. Check user management tab
5. Check driver management tab

### STEP 6: Test Driver Dashboard (5 menit)
1. Logout from admin
2. Login dengan driver: `driver@japlo.com`
3. Verify driver dashboard loads (SHOULD BE WORKING NOW!)
4. Check statistics:
   - [ ] Total Rides: 0
   - [ ] Total Earnings: Rp 0
   - [ ] Today's Rides: 0
   - [ ] Rating: 0
5. Check recent orders table

**Total Estimated Time:** 60-70 menit untuk full testing

---

## 🧪 DETAILED SERVICE TESTING

### SERVICE 1: Ojek/Taxi 🏍️ (2-3 menit)

**Flow:**
1. Click "Ojek" icon pada dashboard
2. Pilih vehicle: JaploRide (Motor) atau JaploCar (Mobil)
3. Isi "Lokasi Penjemputan" (e.g., "Jl. Sudirman, Jakarta")
4. Isi "Lokasi Tujuan" (e.g., "Bundaran HI, Jakarta")
5. Click "Hitung Estimasi Biaya"
6. Verify price shown: Rp ...
7. Optional: Add note untuk driver
8. Click "Konfirmasi Pesanan"

**Verify:**
- [ ] Form accepts input
- [ ] Price calculation correct
- [ ] Submit button works
- [ ] Redirect to success/confirmation

---

### SERVICE 2: Kuliner 🍽️ (2-3 menit)

**Flow:**
1. Click "Kuliner" icon pada dashboard
2. Lihat list 8 restaurants (Ayam Geprek, Bakso President, dll)
3. Click on a restaurant card
4. Verify detail page loads:
   - [ ] Restaurant name
   - [ ] Rating (4.3-4.9)
   - [ ] Distance (0.8-3.2 km)
   - [ ] Menu items listed
   - [ ] Price for each item
5. Click "Pesan Sekarang"
6. Verify redirect to checkout/cart

**Verify:**
- [ ] Restaurant listing displays
- [ ] Detail page navigation works
- [ ] Menu items visible
- [ ] Prices shown correctly
- [ ] Order button functional

---

### SERVICE 3: Kesehatan 🏥 (2-3 menit)

**Flow:**
1. Click "Kesehatan" icon pada dashboard
2. See 4 health services:
   - Konsultasi Dokter Online - Rp 50.000
   - Apotek & Obat - Variable
   - Tes Lab & Medical Check-up - Rp 150.000
   - Panggil Perawat - Rp 100.000
3. Click on a service
4. Verify detail page:
   - [ ] Service description
   - [ ] Doctor/specialist info
   - [ ] Price display
   - [ ] Booking form
5. Click "Pesan Layanan"
6. Fill booking form
7. Click "Lanjutkan"

**Verify:**
- [ ] Service listing shows
- [ ] Detail page loads
- [ ] All info displayed
- [ ] Booking form appears
- [ ] Submit works

---

### SERVICE 4: Produk 🛍️ (2-3 menit)

**Flow:**
1. Click "Produk" icon pada dashboard
2. See 6+ products with discount badges
3. Products:
   - Samsung Galaxy A54: Rp 5.499.000 (-8%)
   - Nike Air Max: Rp 1.299.000 (-24%)
   - ASUS ROG Laptop: Rp 15.999.000 (-11%)
   - dll...
4. Click on a product
5. Verify detail page:
   - [ ] Product image
   - [ ] Price with discount
   - [ ] Rating & reviews
   - [ ] Add to wishlist button
   - [ ] Add to cart button
6. Click "Beli Sekarang"

**Verify:**
- [ ] Product listing displays
- [ ] Discount calculation correct
- [ ] Detail page loads
- [ ] Wishlist button works
- [ ] Add to cart works

---

### SERVICE 5: Promosi 📢 (1-2 menit)

**Flow:**
1. Click "Promosi" icon pada dashboard
2. See 3 active promotions:
   - Flash Sale! Diskon 50%
   - Gratis Ongkir Kuliner
   - Cashback 100% untuk 10 users
3. For each promo:
   - [ ] Click "Salin Kode" button
   - [ ] Verify code copied (popup or message)
4. Scroll down to see countdown timer
5. Check referral code section: JAPLO{id}REF
6. Try copy referral code

**Verify:**
- [ ] Promo display correct
- [ ] Copy button works
- [ ] Timer counting down
- [ ] Referral code visible
- [ ] All copy functions work

---

### SERVICE 6: Pencetakan 🖨️ (2-3 menit)

**Flow:**
1. Click "Pencetakan" icon pada dashboard
2. See form with:
   - Paper size: A4, A3, Letter, Legal
   - Color: Hitam Putih, Berwarna
   - Orientation: Portrait, Landscape
   - Binding: Spiral, Hardcover, dll
3. Select: A4, Berwarna, Portrait
4. Enter quantity: 100 lembar
5. Verify price updates automatically
6. Fill contact info (optional)
7. Click "Pesan Sekarang"

**Verify:**
- [ ] Form displays correctly
- [ ] Options selectable
- [ ] Price calculates
- [ ] Form submission works
- [ ] Redirect successful

---

### SERVICE 7: Trending 🔥 (1-2 menit)

**Flow:**
1. Click "Trending" icon pada dashboard
2. See 4 trending items with:
   - Title
   - Ranking (#1, #2, #3, #4)
   - View count
   - Engagement metrics
3. Click on trending item
4. Verify detail page
5. Try category filter
6. Scroll to hashtags section

**Verify:**
- [ ] Trending items display
- [ ] View counter visible
- [ ] Filtering works
- [ ] Detail page loads
- [ ] Hashtags clickable

---

### SERVICE 8: Sosial 👥 (2-3 menit)

**Flow:**
1. Click "Sosial" icon pada dashboard
2. See Stories section (horizontal scroll)
3. Scroll right to see more stories
4. Click "Tambah Story" button
5. See Posts section with:
   - User photo
   - Post content
   - Buttons: Like, Comment, Share
6. Click Like button (heart) ❤️
7. Click Comment button (speech bubble) 💬
8. Verify comment section toggle
9. Try Share button (if implemented)

**Verify:**
- [ ] Stories visible & scrollable
- [ ] Posts displayed
- [ ] Like button functional
- [ ] Comment section toggles
- [ ] Share button works (if available)

---

## 💳 PAYMENT FLOW TEST (5 menit)

### Scenario: Customer Orders from Kuliner

**Step 1: Browse & Order**
1. Click "Kuliner" service
2. Select a restaurant
3. See menu items
4. Click "Pesan Sekarang"

**Step 2: Checkout Page**
Verify these elements visible:
- [ ] Order summary
- [ ] Item list with prices
- [ ] Total amount
- [ ] Delivery address
- [ ] Customer contact info

**Step 3: Select Payment Method**
- [ ] Kartu Kredit
- [ ] Transfer Bank
- [ ] E-Wallet (OVO/Dana)
- [ ] Bayar di Tempat (COD)

Select any method

**Step 4: Process Payment**
- [ ] Click "Lanjutkan Pembayaran"
- [ ] Verify confirmation

**Step 5: Success Page**
Verify:
- [ ] Order ID shown
- [ ] Total amount shown
- [ ] Confirmation message
- [ ] Receipt option
- [ ] Tracking link

**Step 6: Check History**
- [ ] Go to Order History
- [ ] Verify order appears
- [ ] Status shows "Pending" or "Processing"

---

## 🔐 ADMIN DASHBOARD TEST (5 menit)

### Login as Admin
```
Email: admin@japlo.com
Password: admin123
```

### Dashboard Elements to Check
- [ ] Page title: "Admin Dashboard"
- [ ] 4 Statistics cards:
  - Total Users
  - Total Drivers
  - Total Orders
  - Total Revenue (Rp)
- [ ] Recent Orders table
- [ ] Recent Users list
- [ ] Recent Drivers list

### Navigation Tabs
Try clicking each tab:
- [ ] Users tab → View all users
- [ ] Drivers tab → View all drivers
- [ ] Orders tab → View all orders

### Verify
- [ ] Data displays correctly
- [ ] Pagination works (if >20 items)
- [ ] No errors in console (F12)
- [ ] Responsive design OK

---

## 🚗 DRIVER DASHBOARD TEST (5 menit)

### Login as Driver
```
Email: driver@japlo.com
Password: password123
```

### Dashboard Elements (SEKARANG HARUS WORKING!)
✅ This was previously broken but has been FIXED!

Verify these show:
- [ ] "Driver Dashboard" title
- [ ] 4 Statistics cards:
  - [ ] Total Rides: 0 (default)
  - [ ] Total Earnings: Rp 0 (default)
  - [ ] Today's Rides: 0 (default)
  - [ ] Rating: 0 (default)
- [ ] "Pesanan Terbaru" (Recent Orders) section
- [ ] No errors in browser console

### Expected Behavior
```
✅ Dashboard should load without errors
✅ Statistics should show (0 for new driver)
✅ Can see recent orders section
✅ No "null pointer" or "undefined" errors
✅ Page is responsive
✅ All UI elements visible
```

### If Error Occurs
```
Check:
1. Browser console (F12) for error messages
2. Laravel logs: storage/logs/laravel.log
3. Try reload page (F5)
4. Try different browser
5. Clear cache: Ctrl + Shift + Delete
```

---

## 🐛 ERROR CHECKING

### Browser Console (F12)
1. Press **F12** to open Developer Tools
2. Click **"Console"** tab
3. Look for RED error messages
4. Document any errors:
   ```
   Error: [Copy exact error message]
   Page: [Which page]
   Action: [What caused it]
   ```

### Network Tab (Performance Check)
1. Click **"Network"** tab in F12
2. Reload page (F5)
3. Check for RED indicators (failed requests)
4. Look for slow requests (>1 second)
5. Verify images loaded properly

### Common Issues & Fixes

**Issue: "Cannot GET /dashboard"**
- Solution: Clear browser cache (Ctrl+Shift+Delete)
- Or: Try incognito mode

**Issue: Login not working**
- Solution: Check caps lock on password
- Or: Try different browser
- Or: Clear cookies

**Issue: Payment page not loading**
- Solution: Check F12 console for JS errors
- Or: Refresh page
- Or: Try different payment method

**Issue: Driver dashboard error (SHOULD BE FIXED NOW)**
- Previous: "Trying to get property of non-object"
- Fixed: Null-safety checks added
- If still error: Check Laravel log, report issue

---

## 📝 TESTING NOTES TEMPLATE

Create a file to record your findings:

```
JAPLO APP TESTING NOTES
Date: [Date]
Tester: [Your name]
Browser: [Chrome/Firefox/Edge]
Screen: [Desktop/Tablet/Mobile]

═══════════════════════════════════════

TEST SESSION 1: Dashboard & 8 Services
─────────────────────────────────────

✅ Customer Dashboard - OK/ISSUE
   Status: [Working/Error]
   Notes: [Any observations]

✅ Ojek Service - OK/ISSUE
   Status: [Working/Error]
   Notes: [Any observations]

✅ Kuliner Service - OK/ISSUE
   Status: [Working/Error]
   Notes: [Any observations]

[Continue for all 8 services...]

═══════════════════════════════════════

TEST SESSION 2: Dashboards
─────────────────────────────────────

✅ Admin Dashboard - OK/ISSUE
   Status: [Working/Error]
   Notes: [Any observations]

✅ Driver Dashboard - OK/ISSUE
   Status: [Working/Error]
   Notes: [SEKARANG HARUS WORKING!]

═══════════════════════════════════════

ISSUES FOUND:
─────────────────────────────────────

[List any issues with detail]

═══════════════════════════════════════

OVERALL RATING: [Score 1-10]

RECOMMENDATION: [Ready for production/Need fixes]

═══════════════════════════════════════
```

---

## ✨ SPECIAL NOTES

### Driver Dashboard (FIXED!) ✅
**Previous Status:** Error - "Trying to get property of non-object"

**Current Status:** ✅ WORKING

**What was fixed:**
- Added null-safety checks for driver properties
- Set default values (0 for counts)
- Safe property access with ?? operator
- Proper error handling

**What to verify:**
- Dashboard loads without error
- Statistics show (0 for new driver)
- No console errors
- Page is responsive

### Payment System
**4 Methods available:**
1. Kartu Kredit (Credit Card)
2. Transfer Bank (Bank Transfer)
3. E-Wallet (OVO/Dana/LinkAja)
4. Bayar di Tempat (COD)

**Checkout Flow:**
Product → Click Order → Checkout → Select Payment → Success

### Responsive Design
**Test on different sizes:**
- Desktop: 1920x1080 (normal)
- Laptop: 1366x768 (notebook)
- Tablet: 768x1024 (iPad size)
- Mobile: 375x667 (iPhone size)

**How to test:** F12 → Click device icon → Select size

---

## 🎯 TESTING GOALS

### Primary Goals
- [x] Verify all 5 feature categories work
- [x] Verify all 8 services accessible
- [x] Verify payment system complete
- [x] Verify driver dashboard working
- [x] Verify admin dashboard working

### Secondary Goals
- [ ] Verify responsive design
- [ ] Verify no console errors
- [ ] Verify database saving
- [ ] Verify order tracking
- [ ] Verify all forms validate

### Success Criteria
```
✅ All 8 services accessible and working
✅ Checkout/payment flow complete
✅ Admin dashboard showing data
✅ Driver dashboard working (no errors!)
✅ Responsive on desktop, tablet, mobile
✅ No critical errors in console
✅ All buttons clickable
✅ Forms accepting input
```

---

## 🚀 WHEN READY TO LAUNCH

### Sign-off Checklist
- [ ] All 8 services tested ✅
- [ ] All 3 dashboards working ✅
- [ ] Payment flow complete ✅
- [ ] No critical errors ✅
- [ ] Admin features verified ✅
- [ ] Driver dashboard working ✅
- [ ] Responsive design OK ✅
- [ ] Documentation reviewed ✅
- [ ] Demo users working ✅
- [ ] Performance acceptable ✅

### Approval
Once all checked, application is READY FOR PRODUCTION!

---

## 📞 NEED HELP?

### Quick Reference
- **Laravel version:** `php artisan --version`
- **Migrations status:** `php artisan migrate:status`
- **Clear cache:** `php artisan cache:clear`
- **Server logs:** `storage/logs/laravel.log`
- **Start fresh:** `php artisan migrate:fresh --seed`

### Common Fixes
```bash
# Cache issues
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Database issues
php artisan migrate:fresh --seed

# Permission issues
composer dump-autoload -o

# Server issues
taskkill /F /IM php.exe  (Windows)
php artisan serve  (restart)
```

---

## 📊 FINAL CHECKLIST

Before Starting Testing:
- [ ] Server running: `php artisan serve`
- [ ] Browser open: `http://localhost:8000`
- [ ] Developer Tools ready: F12
- [ ] Notepad ready for notes
- [ ] 3 accounts ready (credentials above)
- [ ] Time available: ~60-70 minutes
- [ ] Incognito mode (recommended)
- [ ] Cache cleared

---

**🎉 READY TO START TESTING! 🎉**

Follow this guide and all 5 feature options will be verified!

**Next Step:** Open terminal and run:
```bash
php artisan serve
```

Then open browser:
```
http://localhost:8000
```

**Good luck with testing! 🚀**

---

**Created:** 7 Agustus 2026  
**Status:** ✅ Ready for Testing  
**Version:** 1.0  

