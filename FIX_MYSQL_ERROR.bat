@echo off
echo ================================================
echo   FIX MySQL Error - XAMPP
echo ================================================
echo.
echo MySQL shutdown unexpectedly biasanya karena:
echo 1. Port 3306 sudah dipakai aplikasi lain
echo 2. Data MySQL corrupt
echo 3. my.ini config salah
echo.
echo SOLUSI CEPAT:
echo -------------
echo.
echo 1. Buka XAMPP Control Panel
echo 2. Klik tombol "Config" di baris MySQL
echo 3. Pilih "my.ini"
echo 4. Cari baris: innodb_force_recovery
echo 5. Tambahkan atau ubah jadi: innodb_force_recovery = 1
echo 6. Save file
echo 7. Start MySQL lagi
echo.
echo ATAU SOLUSI ALTERNATIF:
echo -----------------------
echo.
echo 1. Stop MySQL (jika running)
echo 2. Klik "Netstat" di XAMPP
echo 3. Cek apakah port 3306 dipakai aplikasi lain
echo 4. Tutup aplikasi yang pakai port 3306
echo 5. Start MySQL lagi
echo.
echo ATAU RESET DATA (HATI-HATI! DATA HILANG):
echo ------------------------------------------
echo.
echo 1. Stop MySQL
echo 2. Rename folder: C:\xampp\mysql\data
echo    Jadi: C:\xampp\mysql\data_old
echo 3. Copy folder: C:\xampp\mysql\backup
echo    Jadi: C:\xampp\mysql\data
echo 4. Start MySQL lagi
echo.
pause

echo.
echo Mencoba start MySQL otomatis...
echo.

cd C:\xampp
mysql_start.bat

echo.
echo Cek XAMPP Control Panel, MySQL harus HIJAU!
echo.
pause
