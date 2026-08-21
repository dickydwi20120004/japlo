# JAPLO APP - COMPREHENSIVE ROLE TESTING GUIDE

## ROLE 1: CUSTOMER (Penumpang)
### Test Account
- Email: demo@japlo.com
- Password: password123

### Customer Features to Test (dalam urutan):

#### 1. AUTH & DASHBOARD
- [ ] Login dengan customer account
- [ ] Verify redirect ke customer dashboard
- [ ] Check active order display
- [ ] Check recent orders list
- [ ] Check total orders count
- [ ] Check completed orders count

#### 2. SERVICES
- [ ] Ojek Service - List & Book
- [ ] Kuliner Service - Browse & Detail
- [ ] Kesehatan Service - Browse & Detail
- [ ] Produk Service - Browse & Detail
- [ ] Promosi - View promotions
- [ ] Pencetakan - Print order
- [ ] Sosial - Social features
- [ ] Trending - Trending items

#### 3. ORDER MANAGEMENT
- [ ] Create new order (ojek)
- [ ] View order details
- [ ] Track order location in real-time
- [ ] Cancel order (if pending/accepted)
- [ ] View order history with pagination

#### 4. PAYMENT
- [ ] Add items to cart
- [ ] Go to checkout page
- [ ] Fill payment form
- [ ] Select payment method (cash/ewallet)
- [ ] Process payment
- [ ] View payment success page
- [ ] Check order status change to confirmed

#### 5. RATING & REVIEW
- [ ] Complete an order (as if driver finished)
- [ ] Rate driver (1-5 stars)
- [ ] Add service review
- [ ] Check rating saved in database

#### 6. PROFILE
- [ ] View profile information
- [ ] Upload profile photo
- [ ] Edit name, phone, address
- [ ] Change password
- [ ] Logout

---

## ROLE 2: DRIVER
### Test Account
- Email: driver@japlo.com
- Password: password123

### Driver Features to Test (dalam urutan):

#### 1. AUTH & DASHBOARD
- [ ] Login dengan driver account
- [ ] Verify redirect ke driver dashboard
- [ ] Check total rides count
- [ ] Check total earnings
- [ ] Check rating
- [ ] Check today's orders count
- [ ] Check today's earnings
- [ ] Check pending nearby orders

#### 2. VEHICLE & PROFILE MANAGEMENT
- [ ] Update vehicle information
- [ ] Update driver profile photo
- [ ] Change password
- [ ] Logout

#### 3. AVAILABILITY & LOCATION
- [ ] Toggle availability status (online/offline)
- [ ] Update current location (latitude/longitude)
- [ ] Verify location saved in database
- [ ] Check pending orders near driver

#### 4. ORDER OPERATIONS
- [ ] Accept pending order
- [ ] Verify order status changes to accepted
- [ ] Update order status to picked_up
- [ ] Update order status to in_progress
- [ ] Update order status to completed
- [ ] Check earnings updated after completion
- [ ] Check total_rides incremented
- [ ] Check availability reset to true after completion

#### 5. EARNINGS & STATISTICS
- [ ] View total earnings
- [ ] View monthly earnings
- [ ] View today's earnings
- [ ] Check earnings calculation (base + per-km)
- [ ] Check rides counted correctly

#### 6. RATING HISTORY
- [ ] View all ratings received
- [ ] Check average rating calculation
- [ ] Check ratings from completed orders

---

## ROLE 3: ADMIN
### Test Account
- Email: admin@japlo.com
- Password: admin123

### Admin Features to Test (dalam urutan):

#### 1. AUTH & DASHBOARD
- [ ] Login dengan admin account
- [ ] Verify redirect ke admin dashboard
- [ ] Check total users count
- [ ] Check total drivers count
- [ ] Check total orders count
- [ ] Check total revenue (completed orders only)
- [ ] Check recent orders list
- [ ] Check recent users list
- [ ] Check recent drivers list

#### 2. USER MANAGEMENT
- [ ] Go to Users page
- [ ] View all customers
- [ ] Check pagination
- [ ] Verify user details shown
- [ ] Check user creation date
- [ ] Verify user count matches dashboard

#### 3. DRIVER MANAGEMENT
- [ ] Go to Drivers page
- [ ] View all drivers
- [ ] Check driver vehicle information
- [ ] Check driver status (available/unavailable)
- [ ] Check driver verification status
- [ ] Check driver ratings
- [ ] Check driver earnings
- [ ] Verify driver count matches dashboard

#### 4. ORDER MANAGEMENT
- [ ] Go to Orders page
- [ ] View all orders
- [ ] Check order details (pickup, destination)
- [ ] Check order status
- [ ] Check payment status
- [ ] Check driver assignment
- [ ] Check pricing
- [ ] Filter/search orders (if available)
- [ ] Verify order count matches dashboard

#### 5. REVENUE ANALYTICS
- [ ] Check total revenue calculation
- [ ] Verify revenue only counts completed orders
- [ ] Check revenue breakdown by payment method
- [ ] Check daily/monthly revenue (if available)

#### 6. ADMIN PROFILE
- [ ] Go to profile (if available)
- [ ] Change password
- [ ] Logout

---

## TEST ORDER FLOW (End-to-End)

### Scenario: Full Order Lifecycle

1. **Customer Creates Order**
   - [ ] Login as customer
   - [ ] Go to Ojek service
   - [ ] Create order with:
     - Pickup: Senayan, Jakarta
     - Destination: Kota Tua, Jakarta
     - Distance: ~10km
     - Payment: Cash
   - [ ] Verify order_number generated (JPLYYYYMMDDnnnn format)
   - [ ] Verify status = 'pending'
   - [ ] Verify payment_status = 'pending'

2. **Driver Accepts Order**
   - [ ] Login as driver
   - [ ] Check pending nearby orders
   - [ ] Accept the order
   - [ ] Verify driver_id assigned
   - [ ] Verify status = 'accepted'
   - [ ] Verify driver availability = false

3. **Driver Updates Status**
   - [ ] Driver updates to picked_up
   - [ ] Verify status = 'picked_up'
   - [ ] Driver updates to in_progress
   - [ ] Verify status = 'in_progress'
   - [ ] Driver updates to completed
   - [ ] Verify status = 'completed'
   - [ ] Verify completed_at timestamp set
   - [ ] Verify availability = true
   - [ ] Verify total_rides incremented
   - [ ] Verify total_earnings increased

4. **Customer Rates Order**
   - [ ] Login as customer
   - [ ] Go to Order History
   - [ ] Open completed order
   - [ ] Submit rating (4 stars)
   - [ ] Add review
   - [ ] Verify rating saved
   - [ ] Check driver rating updated

5. **Admin Verifies**
   - [ ] Login as admin
   - [ ] Check dashboard updated
   - [ ] Verify order visible in orders list
   - [ ] Verify driver stats updated
   - [ ] Verify revenue increased

---

## EXPECTED ERRORS & FIXES

### Common Errors to Check:
1. **Missing View File**
   - Error: View not found
   - Fix: Create blade template in resources/views

2. **Undefined Relationship**
   - Error: Call to undefined method
   - Fix: Add relationship in Model

3. **Missing Database Field**
   - Error: Column not found
   - Fix: Create/update migration

4. **Middleware Blocking**
   - Error: 403 Unauthorized
   - Fix: Check role assignment

5. **Missing Controller Method**
   - Error: Call to undefined method
   - Fix: Create method in Controller

---

## TESTING CHECKLIST SUMMARY

### All Tests Must Pass:
- [ ] All 3 roles can login
- [ ] All role-specific routes accessible
- [ ] All role-specific features work
- [ ] Authorization checks working (can't access other roles)
- [ ] Full order lifecycle works (customer→driver→complete→rate)
- [ ] Admin dashboard shows correct statistics
- [ ] Payment processing works
- [ ] Database updates correctly

### Total Tests: ~100+ test cases across 3 roles
### Expected Duration: ~30-60 minutes for full testing

---

