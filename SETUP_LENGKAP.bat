@echo off
title SETUP LENGKAP - JAPLO APP
color 0A

echo.
echo ================================================
echo    SETUP LENGKAP - JAPLO APP
echo ================================================
echo.
echo Pastikan XAMPP MySQL sudah HIJAU (running)!
echo.
pause

cls
echo.
echo ================================================
echo    STEP 1: CEK DATABASE
echo ================================================
echo.

php -r "try { $pdo = new PDO('mysql:host=127.0.0.1', 'root', ''); echo 'MySQL: Connected!\n'; } catch(Exception $e) { echo 'ERROR: ' . $e->getMessage() . '\n'; exit(1); }"

if errorlevel 1 (
    echo.
    echo ERROR: MySQL tidak bisa diakses!
    echo Pastikan MySQL XAMPP sudah running.
    echo.
    pause
    exit /b 1
)

echo.
echo ================================================
echo    STEP 2: BUAT DATABASE (Jika Belum Ada)
echo ================================================
echo.

php -r "try { $pdo = new PDO('mysql:host=127.0.0.1', 'root', ''); $pdo->exec('CREATE DATABASE IF NOT EXISTS japlo_db'); echo 'Database japlo_db: Ready!\n'; } catch(Exception $e) { echo 'ERROR: ' . $e->getMessage() . '\n'; }"

echo.
echo ================================================
echo    STEP 3: RUN MIGRATIONS
echo ================================================
echo.

php artisan migrate --force

echo.
echo ================================================
echo    STEP 4: SEED ADMIN USER
echo ================================================
echo.

php artisan db:seed --class=AdminSeeder --force

echo.
echo ================================================
echo    STEP 5: BUAT DEMO USERS
echo ================================================
echo.

php setup_users.php

echo.
echo ================================================
echo    SETUP SELESAI!
echo ================================================
echo.
echo KREDENSIAL LOGIN:
echo -----------------
echo.
echo ADMIN:
echo   Email: admin@japlo.com
echo   Pass : admin123
echo.
echo PENUMPANG:
echo   Email: demo@japlo.com
echo   Pass : password123
echo.
echo DRIVER:
echo   Email: driver@japlo.com
echo   Pass : password123
echo.
echo ================================================
echo.
echo NEXT: Jalankan server
echo       Klik 2x: 1_JALANKAN_INI.bat
echo.
echo Lalu buka: http://localhost:8000/login
echo.
pause
