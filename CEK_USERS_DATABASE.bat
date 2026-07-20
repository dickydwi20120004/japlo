@echo off
echo ================================================
echo   CEK USERS & ROLES DI DATABASE - JAPLO APP
echo ================================================
echo.

echo Pastikan MySQL XAMPP sudah running!
echo.
echo [1] Cek migration status...
php artisan migrate:status
echo.

echo [2] Cek struktur table users...
php artisan tinker --execute="DB::select('DESCRIBE users');"
echo.

echo [3] Cek semua users yang ada...
php artisan tinker --execute="DB::table('users')->select('id', 'name', 'email', 'role')->get();"
echo.

echo [4] Cek jumlah user per role...
php artisan tinker --execute="DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();"
echo.

echo ================================================
echo   SELESAI CEK DATABASE
echo ================================================
pause
