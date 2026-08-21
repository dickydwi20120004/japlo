$baseUrl = "http://127.0.0.1:8000"
$issues = @()
$issueNum = 0

function LogIssue {
    param($Title, $Role, $Route, $Error, $Details, $Expected, $Fix, $Severity)
    global $issueNum
    $issueNum++
    $issues += [PSCustomObject]@{
        "Issue#" = $issueNum
        "Title" = $Title
        "Role" = $Role
        "Route" = $Route
        "ErrorType" = $Error
        "Details" = $Details
        "Expected" = $Expected
        "Fix" = $Fix
        "Severity" = $Severity
    }
}

Write-Host "JAPLO APP - COMPREHENSIVE QA TEST" -ForegroundColor Green
Write-Host "==================================`n"

# Test 1: Login page
Write-Host "[1] Testing GET /login..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/login" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "✓ Login page loads" -ForegroundColor Green
    } else {
        Write-Host "✗ Login page status: $($r.StatusCode)" -ForegroundColor Red
        LogIssue "Login page not accessible" "All" "GET /login" "HTTP $($r.StatusCode)" "Page returned wrong status" "Should return 200" "Check routes" "High"
    }
} catch {
    Write-Host "✗ Error: $_" -ForegroundColor Red
    LogIssue "Login page connection error" "All" "GET /login" "Connection Error" "$_" "Login page should load" "Check server" "Critical"
}

# Test 2: Dashboard
Write-Host "`n[2] Testing GET /dashboard..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/dashboard" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "✓ Dashboard loads" -ForegroundColor Green
    } else {
        Write-Host "✗ Dashboard status: $($r.StatusCode)" -ForegroundColor Red
        LogIssue "Dashboard not found" "Customer" "GET /dashboard" "HTTP $($r.StatusCode)" "Dashboard returned $($r.StatusCode)" "Should return 200" "Check DashboardController" "High"
    }
} catch {
    Write-Host "✗ Error: $_" -ForegroundColor Red
    LogIssue "Dashboard connection error" "Customer" "GET /dashboard" "Connection Error" "$_" "Dashboard should load" "Check authentication" "Critical"
}

# Test 3: Customer services
$services = @("ojek", "kuliner", "promosi", "kesehatan", "produk", "pencetakan", "trending", "sosial")
Write-Host "`n[3] Testing Customer Services..."
foreach ($svc in $services) {
    try {
        $r = Invoke-WebRequest -Uri "$baseUrl/customer/$svc" -Method GET -UseBasicParsing -TimeoutSec 5
        if ($r.StatusCode -eq 200) {
            Write-Host "✓ /customer/$svc loads" -ForegroundColor Green
        } else {
            Write-Host "✗ /customer/$svc: $($r.StatusCode)" -ForegroundColor Red
            LogIssue "$svc service not found" "Customer" "GET /customer/$svc" "HTTP $($r.StatusCode)" "Service returned $($r.StatusCode)" "Service should load" "Check ServiceController" "High"
        }
    } catch {
        Write-Host "✗ /customer/$svc error" -ForegroundColor Red
        LogIssue "$svc service connection error" "Customer" "GET /customer/$svc" "Connection Error" "$_" "Service should load" "Check routes" "High"
    }
}

# Test 4: Profile
Write-Host "`n[4] Testing GET /profile..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/profile" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "✓ Profile page loads" -ForegroundColor Green
    } else {
        Write-Host "✗ Profile page: $($r.StatusCode)" -ForegroundColor Red
        LogIssue "Profile page not found" "All" "GET /profile" "HTTP $($r.StatusCode)" "Profile returned $($r.StatusCode)" "Should return 200" "Check routes" "Medium"
    }
} catch {
    Write-Host "✗ Profile page error" -ForegroundColor Red
    LogIssue "Profile page connection error" "All" "GET /profile" "Connection Error" "$_" "Profile page should load" "Check routes" "Medium"
}

# Test 5: Admin routes
Write-Host "`n[5] Testing Admin Routes..."
$adminRoutes = @("/admin/dashboard", "/admin/users", "/admin/drivers", "/admin/orders")
foreach ($route in $adminRoutes) {
    try {
        $r = Invoke-WebRequest -Uri "$baseUrl$route" -Method GET -UseBasicParsing -TimeoutSec 5
        if ($r.StatusCode -eq 200) {
            Write-Host "✓ $route loads" -ForegroundColor Green
        } else {
            Write-Host "✗ $route: $($r.StatusCode)" -ForegroundColor Red
            LogIssue "Admin route not found" "Admin" $route "HTTP $($r.StatusCode)" "Route returned $($r.StatusCode)" "Should return 200" "Check AdminController" "High"
        }
    } catch {
        Write-Host "✗ $route error" -ForegroundColor Red
        LogIssue "Admin route error" "Admin" $route "Connection Error" "$_" "Admin route should load" "Check middleware" "High"
    }
}

# Test 6: API Health
Write-Host "`n[6] Testing API /api/health..."
try {
    $r = Invoke-RestMethod -Uri "$baseUrl/api/health" -Method GET -TimeoutSec 5
    if ($r.success -eq $true) {
        Write-Host "✓ API health check OK" -ForegroundColor Green
    } else {
        Write-Host "✗ API health check failed" -ForegroundColor Red
        LogIssue "API health check failed" "All" "GET /api/health" "Logic Error" "API returned success=false" "Should return success=true" "Check API health endpoint" "Medium"
    }
} catch {
    Write-Host "✗ API health error" -ForegroundColor Red
    LogIssue "API health endpoint error" "All" "GET /api/health" "Connection Error" "$_" "API should respond to health check" "Check API routes" "High"
}

# Report Summary
Write-Host "`n`n================================" -ForegroundColor Yellow
Write-Host "SUMMARY" -ForegroundColor Yellow
Write-Host "================================" -ForegroundColor Yellow
Write-Host "Total Issues Found: $($issues.Count)" -ForegroundColor Yellow

if ($issues.Count -gt 0) {
    Write-Host "`n================================" -ForegroundColor Yellow
    Write-Host "ISSUES FOUND:" -ForegroundColor Yellow
    Write-Host "================================" -ForegroundColor Yellow
    $issues | ForEach-Object {
        Write-Host "`nIssue #$($_.Issue#): $($_.Title)" -ForegroundColor Red
        Write-Host "  Role: $($_.Role)"
        Write-Host "  Route: $($_.Route)"
        Write-Host "  Error: $($_.ErrorType)"
        Write-Host "  Details: $($_.Details)"
        Write-Host "  Expected: $($_.Expected)"
        Write-Host "  Fix: $($_.Fix)"
        Write-Host "  Severity: $($_.Severity)" -ForegroundColor $(if ($_.Severity -eq 'Critical') {'Red'} else {'Yellow'})
    }
}

Write-Host "`n✓ Testing Complete" -ForegroundColor Green
