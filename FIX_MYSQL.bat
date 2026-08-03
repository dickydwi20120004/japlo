@echo off
REM Fix MySQL crash dan corruption

echo Stopping MySQL...
cd /d c:\xampp
.\xampp_stop.exe

REM Tunggu sebentar
timeout /t 3 /nobreak

echo.
echo Backing up MySQL data folder...
REM Backup data folder (optional, untuk safety)
if exist c:\xampp\mysql\data_backup (
    rmdir /s /q c:\xampp\mysql\data_backup
)
xcopy c:\xampp\mysql\data c:\xampp\mysql\data_backup /s /i /q

echo.
echo Removing corrupted MySQL files...
REM Hapus file yang bermasalah
cd /d c:\xampp\mysql\data
if exist mysql (
    cd mysql
    del /q *.MYI 2>nul
    del /q *.MYD 2>nul
    del /q *.frm 2>nul
    cd ..
)

echo.
echo Starting MySQL fresh...
cd /d c:\xampp
.\xampp_start.exe

echo.
echo Waiting for MySQL to start...
timeout /t 5 /nobreak

echo.
echo Repairing MySQL tables...
cd /d c:\xampp\mysql\bin
mysql -u root < "%~dp0\..\..\..\mysql\data\repair.sql" 2>nul

echo.
echo Creating database...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS japlo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

echo.
echo Running Laravel migrations...
cd /d c:\xampp\htdocs\Japlo App
php artisan migrate:fresh --seed

echo.
echo Selesai! MySQL sudah diperbaiki.
pause
