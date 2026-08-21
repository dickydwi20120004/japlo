$baseUrl = "http://127.0.0.1:8000"
$issues = @()
$issueNum = 0

Write-Host "JAPLO APP - COMPREHENSIVE QA TEST" -ForegroundColor Green
Write-Host "================================="

# Test 1: Login page
Write-Host "`n[1] Testing GET /login..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/login" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "PASS: Login page loads" -ForegroundColor Green
    } else {
        Write-Host "FAIL: Login page status $($r.StatusCode)" -ForegroundColor Red
        $issueNum++
        $issues += @{num=$issueNum; title="Login page not accessible"; role="All"; route="GET /login"; error="HTTP $($r.StatusCode)"}
    }
} catch {
    Write-Host "ERROR: $_" -ForegroundColor Red
    $issueNum++
}

# Test 2: Dashboard
Write-Host "`n[2] Testing GET /dashboard..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/dashboard" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "PASS: Dashboard loads" -ForegroundColor Green
    } else {
        Write-Host "FAIL: Dashboard status $($r.StatusCode)" -ForegroundColor Red
        $issueNum++
    }
} catch {
    Write-Host "ERROR: Dashboard - $_" -ForegroundColor Red
    $issueNum++
}

# Test 3: Customer services
$services = @("ojek", "kuliner", "promosi", "kesehatan", "produk", "pencetakan", "trending", "sosial")
Write-Host "`n[3] Testing Customer Services..."
foreach ($svc in $services) {
    try {
        $r = Invoke-WebRequest -Uri "$baseUrl/customer/$svc" -Method GET -UseBasicParsing -TimeoutSec 5
        if ($r.StatusCode -eq 200) {
            Write-Host "PASS: /customer/$svc" -ForegroundColor Green
        } else {
            Write-Host "FAIL: /customer/$svc - Status $($r.StatusCode)" -ForegroundColor Red
            $issueNum++
        }
    } catch {
        Write-Host "ERROR: /customer/$svc" -ForegroundColor Red
        $issueNum++
    }
}

# Test 4: Profile
Write-Host "`n[4] Testing GET /profile..."
try {
    $r = Invoke-WebRequest -Uri "$baseUrl/profile" -Method GET -UseBasicParsing -TimeoutSec 5
    if ($r.StatusCode -eq 200) {
        Write-Host "PASS: Profile page loads" -ForegroundColor Green
    } else {
        Write-Host "FAIL: Profile status $($r.StatusCode)" -ForegroundColor Red
        $issueNum++
    }
} catch {
    Write-Host "ERROR: Profile page" -ForegroundColor Red
    $issueNum++
}

# Test 5: Admin routes
Write-Host "`n[5] Testing Admin Routes..."
$adminRoutes = @("/admin/dashboard", "/admin/users", "/admin/drivers", "/admin/orders")
foreach ($route in $adminRoutes) {
    try {
        $r = Invoke-WebRequest -Uri "$baseUrl$route" -Method GET -UseBasicParsing -TimeoutSec 5
        if ($r.StatusCode -eq 200) {
            Write-Host "PASS: $route" -ForegroundColor Green
        } else {
            Write-Host "FAIL: $route - Status $($r.StatusCode)" -ForegroundColor Red
            $issueNum++
        }
    } catch {
        Write-Host "ERROR: $route" -ForegroundColor Red
        $issueNum++
    }
}

# Test 6: API Health
Write-Host "`n[6] Testing API /api/health..."
try {
    $r = Invoke-RestMethod -Uri "$baseUrl/api/health" -Method GET -TimeoutSec 5
    if ($r.success -eq $true) {
        Write-Host "PASS: API health check OK" -ForegroundColor Green
    } else {
        Write-Host "FAIL: API health check failed" -ForegroundColor Red
        $issueNum++
    }
} catch {
    Write-Host "ERROR: API health" -ForegroundColor Red
    $issueNum++
}

Write-Host "`n=================================" -ForegroundColor Yellow
Write-Host "SUMMARY: $issueNum issues found" -ForegroundColor Yellow
Write-Host "=================================" -ForegroundColor Yellow
