@echo off
title JAPLO APP SERVER
color 0A
cls

echo.
echo ╔══════════════════════════════════════════════════════════════╗
echo ║                                                              ║
echo ║               🚀 JAPLO APP - SERVER STARTING 🚀             ║
echo ║                                                              ║
echo ╚══════════════════════════════════════════════════════════════╝
echo.
echo.
echo  🌐 Server akan berjalan di: http://localhost:8000
echo.
echo  🔑 Login dengan:
echo     Email: demo@japlo.com
echo     Password: password123
echo.
echo  ⚠️  PENTING: JANGAN TUTUP WINDOW INI!
echo.
echo ══════════════════════════════════════════════════════════════
echo.
echo  Starting server...
echo.

php artisan serve

echo.
echo.
echo  Server dihentikan.
pause
