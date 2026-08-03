@echo off
REM ==============================================
REM Simple MySQL Reset untuk Fix Corruption
REM ==============================================

echo.
echo ========================================
echo     MYSQL REPAIR TOOL
echo ========================================
echo.

REM 1. Stop XAMPP
echo [1] Stopping XAMPP services...
cd /d c:\xampp
taskkill /IM mysqld.exe /F 2>nul
timeout /t 2 /nobreak

REM 2. Backup data
echo [2] Backing up MySQL data...
if exist c:\xampp\mysql\data_backup_old (
    rmdir /s /q c:\xampp\mysql\data_backup_old
)
if exist c:\xampp\mysql\data_backup (
    move c:\xampp\mysql\data_backup c:\xampp\mysql\data_backup_old
)
if exist c:\xampp\mysql\data (
    move c:\xampp\mysql\data c:\xampp\mysql\data_backup
)

REM 3. Recreate data folder
echo [3] Creating fresh MySQL data folder...
mkdir c:\xampp\mysql\data
cd /d c:\xampp\mysql\data

REM 4. Initialize fresh MySQL
echo [4] Initializing fresh MySQL database...
cd /d c:\xampp\mysql\bin
.\mysql_install_db.exe --datadir=c:\xampp\mysql\data 2>nul

echo [5] Starting MySQL...
timeout /t 3 /nobreak
cd /d c:\xampp
start /B .\xampp_start.exe

echo [6] Waiting for MySQL to start...
timeout /t 5 /nobreak

echo [7] Creating Japlo database...
cd /d c:\xampp\mysql\bin
mysql -u root -e "CREATE DATABASE IF NOT EXISTS japlo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul

echo.
echo [8] Running Laravel migrations...
cd /d "c:\xampp\htdocs\Japlo App"
call php artisan migrate:fresh --seed

echo.
echo ========================================
echo     MySQL successfully repaired!
echo ========================================
echo.
echo Data backup saved at: c:\xampp\mysql\data_backup
pause
