@echo off
echo ================================================
echo     JAPLO APP - Membuat User Demo
echo ================================================
echo.
echo User demo akan dibuat dengan kredensial:
echo.
echo CUSTOMER:
echo - Email: demo@japlo.com
echo - Password: password123
echo.
echo DRIVER:
echo - Email: driver@japlo.com  
echo - Password: password123
echo.
echo ================================================
echo.

php create_demo_user.php

echo.
echo ================================================
echo User demo berhasil dibuat!
echo ================================================
echo.
echo Sekarang Anda bisa login di: http://localhost:8000/login
echo.

pause
