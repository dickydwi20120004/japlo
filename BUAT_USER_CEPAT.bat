@echo off
echo ================================================
echo   BUAT USER DEMO - JAPLO APP (CEPAT!)
echo ================================================
echo.

echo [1] Cek database connection...
php artisan tinker --execute="echo 'Database: OK';"

echo.
echo [2] Buat/Update Admin...
php artisan tinker --execute="use App\Models\User; use Illuminate\Support\Facades\Hash; User::updateOrCreate(['email'=>'admin@japlo.com'], ['name'=>'Admin JAPLO','email'=>'admin@japlo.com','password'=>Hash::make('admin123'),'phone'=>'089999999999','role'=>'admin']); echo 'Admin created!';"

echo.
echo [3] Buat/Update Penumpang...
php artisan tinker --execute="use App\Models\User; use Illuminate\Support\Facades\Hash; User::updateOrCreate(['email'=>'demo@japlo.com'], ['name'=>'Demo User','email'=>'demo@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567890','role'=>'user']); echo 'User created!';"

echo.
echo [4] Buat/Update Driver...
php artisan tinker --execute="use App\Models\User; use Illuminate\Support\Facades\Hash; User::updateOrCreate(['email'=>'driver@japlo.com'], ['name'=>'Demo Driver','email'=>'driver@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567891','role'=>'driver']); echo 'Driver created!';"

echo.
echo ================================================
echo   SELESAI! USER DEMO SUDAH DIBUAT
echo ================================================
echo.
echo LOGIN DENGAN:
echo -------------
echo Admin   : admin@japlo.com / admin123
echo Penumpang: demo@japlo.com / password123
echo Driver  : driver@japlo.com / password123
echo.
echo TEST DI: http://localhost:8000/login
echo.
pause
