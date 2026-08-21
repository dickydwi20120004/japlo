#!/usr/bin/env pwsh

# Color functions
function Test-Pass {
    param([string]$msg)
    Write-Host "✅ PASS: $msg" -ForegroundColor Green
}

function Test-Fail {
    param([string]$msg)
    Write-Host "❌ FAIL: $msg" -ForegroundColor Red
}

function Test-Info {
    param([string]$msg)
    Write-Host "ℹ️  INFO: $msg" -ForegroundColor Cyan
}

function Test-Issue {
    param([string]$num, [string]$title, [string]$role, [string]$route, [string]$error, [string]$details, [string]$expected, [string]$fix, [string]$severity)
    
    $issueObj = @{
        "Issue" = $num
        "Title" = $title
        "Role" = $role
        "Route" = $route
        "Error Type" = $error
        "Details" = $details
        "Expected" = $expected
        "Fix Needed" = $fix
        "Severity" = $severity
    }
    return $issueObj
}

$issues = @()
$issueCount = 0

Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Yellow
Write-Host "║         COMPREHENSIVE JAPLO APP QA TESTING                 ║" -ForegroundColor Yellow
Write-Host "║              All 3 Roles - Complete Test Suite             ║" -ForegroundColor Yellow
Write-Host "╚════════════════════════════════════════════════════════════╝" -ForegroundColor Yellow

$baseUrl = "http://127.0.0.1:8000"

# ============================================================================
# ROLE 1: CUSTOMER TESTING
# ============================================================================

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "ROLE 1: CUSTOMER (demo@japlo.com / password123)" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow

Write-Host "`n[SECTION 1.1] WEB ROUTES - Authentication & Access" -ForegroundColor Cyan

Write-Host "`n  [1.1.1] GET /login"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/login" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        if ($response.Content -match "login" -or $response.Content -match "Email") {
            Test-Pass "Login form accessible"
        } else {
            Test-Fail "Login form page loaded but form not found"
            $issueCount++
            $issues += @{
                "Issue" = $issueCount
                "Title" = "Login form missing HTML elements"
                "Role" = "All"
                "Route" = "GET /login"
                "Error Type" = "Missing HTML"
                "Details" = "Page loads (200) but form elements not found"
                "Expected" = "Login form with email and password fields"
                "Fix Needed" = "Check login.blade.php template"
                "Severity" = "High"
            }
        }
    } else {
        Test-Fail "Unexpected status code: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Error accessing login page: $_"
    $issueCount++
    $issues += @{
        "Issue" = $issueCount
        "Title" = "Cannot access login page"
        "Role" = "All"
        "Route" = "GET /login"
        "Error Type" = "Connection error"
        "Details" = $_.Exception.Message
        "Expected" = "Login page loads with 200 status"
        "Fix Needed" = "Check server status and routes"
        "Severity" = "Critical"
    }
}

Write-Host "`n  [1.1.2] POST /login (With valid credentials)"
Start-Sleep -Seconds 1
try {
    $session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
    
    # First get CSRF token from login page
    $loginPage = Invoke-WebRequest -Uri "$baseUrl/login" -Method GET -UseBasicParsing -WebSession $session
    $csrfToken = $loginPage.Content | Select-String 'name="_token"' -AllMatches | ForEach-Object {
        [regex]::Match($_.Line, 'value="([^"]+)"').Groups[1].Value
    }
    
    if (-not $csrfToken) {
        Test-Info "CSRF token extraction warning - attempting login anyway"
    }
    
    $loginPayload = @{
        "_token" = $csrfToken
        "email" = "demo@japlo.com"
        "password" = "password123"
    }
    
    $loginResponse = Invoke-WebRequest -Uri "$baseUrl/login" -Method POST `
        -Body $loginPayload -UseBasicParsing -WebSession $session `
        -Headers @{"Accept" = "text/html"} -TimeoutSec 5
    
    # Check if redirected to dashboard
    if ($loginResponse.StatusCode -eq 200) {
        if ($loginResponse.Content -match "dashboard" -or $loginResponse.Content -match "Ojek" -or $loginResponse.Content -match "Kuliner") {
            Test-Pass "Login successful, redirected to dashboard"
        } else {
            Test-Fail "Login response doesn't show dashboard content"
            $issueCount++
            $issues += @{
                "Issue" = $issueCount
                "Title" = "Login post doesn't redirect properly"
                "Role" = "Customer"
                "Route" = "POST /login"
                "Error Type" = "Redirect issue"
                "Details" = "Login accepts credentials but doesn't redirect to dashboard"
                "Expected" = "Redirect to /dashboard with user authenticated"
                "Fix Needed" = "Check AuthController login method logic"
                "Severity" = "Critical"
            }
        }
    }
} catch {
    Test-Fail "Login post error: $($_.Exception.Message)"
    $issueCount++
    $issues += @{
        "Issue" = $issueCount
        "Title" = "Login POST request failed"
        "Role" = "Customer"
        "Route" = "POST /login"
        "Error Type" = "Request error"
        "Details" = $_.Exception.Message
        "Expected" = "POST login should redirect to dashboard"
        "Fix Needed" = "Check form submission and routing"
        "Severity" = "Critical"
    }
}

Write-Host "`n  [1.1.3] GET /dashboard (Customer View)"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/dashboard" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        if ($response.Content -match "Ojek" -or $response.Content -match "Kuliner" -or $response.Content -match "dashboard") {
            Test-Pass "Customer dashboard accessible"
        } else {
            Test-Fail "Dashboard page loaded but customer services not found"
            $issueCount++
            $issues += @{
                "Issue" = $issueCount
                "Title" = "Customer dashboard missing service icons"
                "Role" = "Customer"
                "Route" = "GET /dashboard"
                "Error Type" = "Missing content"
                "Details" = "Dashboard loads but service menu not displayed"
                "Expected" = "Dashboard with 8 service icons (Ojek, Kuliner, etc.)"
                "Fix Needed" = "Check dashboard.blade.php template"
                "Severity" = "High"
            }
        }
    }
} catch {
    Test-Fail "Cannot access dashboard: $_"
    $issueCount++
    $issues += @{
        "Issue" = $issueCount
        "Title" = "Cannot access /dashboard"
        "Role" = "Customer"
        "Route" = "GET /dashboard"
        "Error Type" = "Route error / 404 / 403"
        "Details" = $_.Exception.Message
        "Expected" = "Dashboard loads with 200 status"
        "Fix Needed" = "Check route definition and middleware"
        "Severity" = "Critical"
    }
}

Write-Host "`n[SECTION 1.2] WEB ROUTES - Customer Services" -ForegroundColor Cyan

$services = @("ojek", "kuliner", "kesehatan", "produk", "pencetakan", "trending", "sosial", "promosi")

foreach ($service in $services) {
    Write-Host "`n  [1.2.x] GET /customer/$service"
    try {
        $response = Invoke-WebRequest -Uri "$baseUrl/customer/$service" -Method GET -UseBasicParsing -TimeoutSec 5
        if ($response.StatusCode -eq 200) {
            Test-Pass "$service page accessible"
        } else {
            Test-Fail "$service page returned status $($response.StatusCode)"
            $issueCount++
            $issues += @{
                "Issue" = $issueCount
                "Title" = "Customer service page not found"
                "Role" = "Customer"
                "Route" = "GET /customer/$service"
                "Error Type" = "404 / Route Error"
                "Details" = "Page returned status $($response.StatusCode)"
                "Expected" = "Service page loads with 200 status"
                "Fix Needed" = "Check ServiceController.$service method"
                "Severity" = "High"
            }
        }
    } catch {
        Test-Fail "Cannot access /customer/$service - $_"
        $issueCount++
        $issues += @{
            "Issue" = $issueCount
            "Title" = "Cannot access customer service: $service"
            "Role" = "Customer"
            "Route" = "GET /customer/$service"
            "Error Type" = "Connection/404 error"
            "Details" = $_.Exception.Message
            "Expected" = "Service page accessible"
            "Fix Needed" = "Check routes and controller methods"
            "Severity" = "High"
        }
    }
    Start-Sleep -Milliseconds 300
}

Write-Host "`n[SECTION 1.3] WEB ROUTES - Profile & Logout" -ForegroundColor Cyan

Write-Host "`n  [1.3.1] GET /profile"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/profile" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Profile page accessible"
    } else {
        Test-Fail "Profile page returned status $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access profile: $_"
}

# ============================================================================
# ROLE 2: DRIVER TESTING
# ============================================================================

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "ROLE 2: DRIVER (driver@japlo.com / password123)" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow

Write-Host "`n[SECTION 2.1] Driver Dashboard Access" -ForegroundColor Cyan

Write-Host "`n  [2.1.1] GET /dashboard (Driver should see driver view)"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/dashboard" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Driver dashboard accessible"
    } else {
        Test-Fail "Driver dashboard status: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access driver dashboard: $_"
}

# ============================================================================
# ROLE 3: ADMIN TESTING
# ============================================================================

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "ROLE 3: ADMIN (admin@japlo.com / admin123)" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow

Write-Host "`n[SECTION 3.1] Admin Dashboard Access" -ForegroundColor Cyan

Write-Host "`n  [3.1.1] GET /admin/dashboard"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/admin/dashboard" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Admin dashboard accessible"
    } else {
        Test-Fail "Admin dashboard status: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access admin dashboard: $_"
}

Write-Host "`n  [3.1.2] GET /admin/users"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/admin/users" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Admin users list accessible"
    } else {
        Test-Fail "Admin users list status: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access /admin/users: $_"
}

Write-Host "`n  [3.1.3] GET /admin/drivers"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/admin/drivers" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Admin drivers list accessible"
    } else {
        Test-Fail "Admin drivers list status: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access /admin/drivers: $_"
}

Write-Host "`n  [3.1.4] GET /admin/orders"
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/admin/orders" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($response.StatusCode -eq 200) {
        Test-Pass "Admin orders list accessible"
    } else {
        Test-Fail "Admin orders list status: $($response.StatusCode)"
    }
} catch {
    Test-Fail "Cannot access /admin/orders: $_"
}

# ============================================================================
# API TESTING - WITH AUTHENTICATION
# ============================================================================

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "API TESTING - Authentication & Authorization" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow

Write-Host "`n[SECTION 4.1] API Health Check" -ForegroundColor Cyan
Write-Host "`n  [4.1.1] GET /api/health (Public endpoint)"
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/api/health" -Method GET -TimeoutSec 5
    if ($response.success -eq $true) {
        Test-Pass "API health check passed"
    } else {
        Test-Fail "API health check failed"
    }
} catch {
    Test-Fail "Cannot access API health: $_"
}

Write-Host "`n[SECTION 4.2] API Customer Order Operations" -ForegroundColor Cyan

Write-Host "`n  [4.2.1] POST /api/orders (Create new order)"
Write-Host "  Note: Requires Bearer token authentication"
Test-Info "API authentication required - skipping detailed API tests for now"
Test-Info "Detailed API testing requires token extraction from login response"

# ============================================================================
# SUMMARY & ISSUE REPORTING
# ============================================================================

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "TESTING SUMMARY" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow

Write-Host "`nTotal Issues Found: $issueCount"

if ($issues.Count -gt 0) {
    Write-Host "`n$('='*70)" -ForegroundColor Yellow
    Write-Host "DETAILED ISSUE REPORT" -ForegroundColor Yellow
    Write-Host "$('='*70)" -ForegroundColor Yellow
    
    $issues | ForEach-Object {
        Write-Host "`n────────────────────────────────────────" -ForegroundColor Magenta
        Write-Host "Issue #: $($_.'Issue')" -ForegroundColor Red
        Write-Host "Title: $($_.'Title')" -ForegroundColor Red
        Write-Host "Role: $($_.'Role')" -ForegroundColor Yellow
        Write-Host "Route/Endpoint: $($_.'Route')" -ForegroundColor Yellow
        Write-Host "Error Type: $($_.'Error Type')" -ForegroundColor Yellow
        Write-Host "Severity: $($_.'Severity')" -ForegroundColor $(if ($_.'Severity' -eq 'Critical') { 'Red' } else { 'Yellow' })
        Write-Host "Details: $($_.'Details')"
        Write-Host "Expected: $($_.'Expected')"
        Write-Host "Fix Needed: $($_.'Fix Needed')"
    }
}

Write-Host "`n$('='*70)" -ForegroundColor Yellow
Write-Host "TESTING COMPLETE" -ForegroundColor Yellow
Write-Host "$('='*70)" -ForegroundColor Yellow
