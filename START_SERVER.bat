@echo off
title JAPLO APP - Laravel Server
color 0A

echo ╔══════════════════════════════════════════════════════════════════════════════╗
echo ║                     JAPLO APP - Starting Laravel Server                      ║
echo ╚══════════════════════════════════════════════════════════════════════════════╝
echo.

REM Check if PHP is available
php --version >nul 2>&1
if errorlevel 1 (
    echo ❌ ERROR: PHP tidak ditemukan!
    echo.
    echo Pastikan PHP sudah terinstall dan ada di PATH.
    echo.
    pause
    exit /b 1
)

echo ✅ PHP Version:
php --version | findstr /C:"PHP"
echo.

REM Check if we're in the right directory
if not exist "artisan" (
    echo ❌ ERROR: File 'artisan' tidak ditemukan!
    echo.
    echo Pastikan Anda menjalankan script ini dari folder root Japlo App.
    echo.
    pause
    exit /b 1
)

echo ✅ Directory: OK
echo.

REM Kill any existing PHP server on port 8000
echo 🔄 Checking port 8000...
netstat -ano | findstr :8000 >nul 2>&1
if not errorlevel 1 (
    echo ⚠️  Port 8000 sudah digunakan. Mencoba menghentikan...
    for /f "tokens=5" %%a in ('netstat -ano ^| findstr :8000') do taskkill /F /PID %%a >nul 2>&1
    timeout /t 2 /nobreak >nul
    echo ✅ Port 8000 dibersihkan
    echo.
)

REM Clear cache
echo 🔄 Clearing cache...
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
echo ✅ Cache cleared
echo.

echo ╔══════════════════════════════════════════════════════════════════════════════╗
echo ║                            SERVER STARTING...                                ║
echo ╚══════════════════════════════════════════════════════════════════════════════╝
echo.
echo 🌐 Server URL: http://localhost:8000
echo 🌐 Alternative: http://127.0.0.1:8000
echo.
echo 🔑 Login Credentials:
echo    Email: demo@japlo.com
echo    Password: password123
echo.
echo ⚠️  PENTING: JANGAN TUTUP WINDOW INI!
echo    Window ini harus tetap terbuka selama server running.
echo.
echo 🛑 Untuk stop server: Tekan Ctrl+C
echo.
echo ═══════════════════════════════════════════════════════════════════════════════
echo.

REM Start the server
php artisan serve

echo.
echo.
echo Server telah dihentikan.
echo.
pause
