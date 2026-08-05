# OJEK FEATURE - COMPREHENSIVE TESTING GUIDE

## PRE-REQUISITES
- ✅ Laravel server running on http://localhost:8000 (Process running)
- ✅ MySQL database: japlo_db
- ✅ Demo account: demo@japlo.com / password123

## ARCHITECTURE VERIFICATION

### 1. Frontend (View)
- **File**: `resources/views/customer/services/ojek.blade.php`
- **Status**: ✅ Complete and proper
- **Features**:
  - Vehicle selection (Motor/Car)
  - Form with pickup/destination locations
  - Price calculation with random distance
  - Form submission to API endpoint
  - Error handling with Toast notifications

### 2. Routes
- **File**: `routes/web.php`
- **Route**: `POST /api/orders` → `OrderController@createOrder`
- **Name**: `api.orders.create`
- **Status**: ✅ Properly configured
- **Auth**: Requires `auth` middleware

### 3. Controller
- **File**: `app/Http/Controllers/Api/OrderController.php`
- **Method**: `createOrder(Request $request)`
- **Features**:
  - ✅ Flexible validation (with/without GPS coordinates)
  - ✅ Uses default dummy coordinates for web form
  - ✅ Calculates price if not provided
  - ✅ Generates unique order number
  - ✅ Creates order in database

### 4. Model
- **File**: `app/Models/Order.php`
- **Methods**:
  - ✅ `generateOrderNumber()` - Creates unique order ID
  - ✅ `calculatePrice($distance)` - Calculates price based on distance
  - ✅ `relationships()` - Links to User, Driver, Rating

### 5. Layout
- **File**: `resources/views/layouts/app.blade.php`
- **Features**:
  - ✅ CSRF token meta tag for form security
  - ✅ Toast notification system (JavaScript)
  - ✅ Bootstrap 5 styling

## TEST WORKFLOW

### Test 1: Access Ojek Page
1. Open browser → http://localhost:8000/login
2. Login with: demo@japlo.com / password123
3. Go to Dashboard → Layanan → Ojek & Taxi
4. **Expected Result**: Full page loads with:
   - Hero section with title
   - Two vehicle options (Motor/Car)
   - Booking form
   - Features section

### Test 2: Select Vehicle
1. Click "Pilih JaploRide" (Motor) or "Pilih JaploCar" (Car)
2. **Expected Result**:
   - Vehicle type selector updates
   - Green toast: "Kendaraan: JaploRide (Motor)"
   - Form scrolls into view

### Test 3: Calculate Price
1. Fill in:
   - Lokasi Penjemputan: "Jl. Merdeka No. 123"
   - Lokasi Tujuan: "Jl. Sudirman No. 456"
2. Click "Hitung Estimasi Biaya"
3. **Expected Result**:
   - Jarak Estimasi: 2-17 km (random)
   - Waktu Estimasi: calculated based on distance
   - Total Biaya: displayed in Rp format
   - Green toast: "Estimasi biaya sudah dihitung!"

### Test 4: Submit Booking
1. After calculating price, click "Konfirmasi Pesanan"
2. **Expected Result**:
   - Button shows loading state: "Memproses..."
   - Request sent to POST /api/orders
   - Green toast: "Pesanan berhasil dibuat! Order: JPL..."
   - Redirects to /order/history after 1.5 seconds

### Test 5: Verify Database
1. Open terminal in "Japlo App" directory
2. Run: `php artisan tinker`
3. Run: `App\Models\Order::latest()->first();`
4. **Expected Result**: Shows created order with:
   - order_number (JPL + date + number)
   - pickup_address (from form)
   - destination_address (from form)
   - price (calculated amount)
   - status: "pending"

## ERROR TESTING

### Test 6: Validation Errors
1. Try to submit without filling pickup location
2. **Expected Result**: Toast error + form validation message

### Test 7: Missing Price Estimation
1. Fill locations but don't calculate price
2. Try to submit
3. **Expected Result**: Yellow toast: "Hitung estimasi biaya terlebih dahulu"

## BROWSER DEVELOPER TOOLS CHECKS

### Network Tab
- POST /api/orders should return 201 with JSON response:
  ```json
  {
    "success": true,
    "message": "Order created successfully",
    "data": { ...order details... }
  }
  ```

### Console Tab
- No red errors should appear
- Check for any JavaScript exceptions

## SUCCESS CRITERIA
- ✅ Page loads without errors
- ✅ All form interactions work
- ✅ Price calculation works
- ✅ Form submission succeeds
- ✅ Toast notifications display correctly
- ✅ Data saved to database
- ✅ Redirect to order history works

## KNOWN ISSUES & FIXES APPLIED

### Issue 1: Form not connected to API
- **Fixed**: Added fetch() call to /api/orders endpoint

### Issue 2: Validation too strict
- **Fixed**: Added flexible validation for web form (no GPS coords required)

### Issue 3: Missing CSRF token
- **Fixed**: Added X-CSRF-TOKEN header in fetch request

### Issue 4: Incomplete view file
- **Fixed**: Ensured all closing tags present (@endsection)

## NEXT STEPS FOR DEVELOPER
If any test fails:
1. Check browser console for JavaScript errors
2. Check Network tab for API response errors
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify database connection: `php artisan db:show`
5. Clear cache: `php artisan cache:clear && php artisan view:clear`

---
Generated: 2026-08-06
Status: Ready for testing
