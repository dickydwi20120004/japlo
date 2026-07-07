@echo off
echo.
echo Membuka Japlo App di browser...
echo.
echo Pastikan server sudah running (file: 1_JALANKAN_INI.bat)
echo.
timeout /t 2 /nobreak >nul

start http://localhost:8000

echo.
echo Browser dibuka!
echo.
echo Jika halaman tidak muncul, pastikan:
echo 1. File "1_JALANKAN_INI.bat" sudah dijalankan
echo 2. Window server TIDAK ditutup
echo.
pause
