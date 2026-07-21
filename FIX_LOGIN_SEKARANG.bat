@echo off
echo ================================================
echo   FIX LOGIN - JAPLO APP
echo ================================================
echo.
echo Pastikan XAMPP MySQL sudah running (hijau)!
echo.
pause

echo.
echo [1] Clear cache...
php artisan optimize:clear
echo.

echo [2] Migrate database...
php artisan migrate --force
echo.

echo [3] Seed admin user...
php artisan db:seed --class=AdminSeeder --force
echo.

echo [4] Create demo users...
php artisan tinker --execute="use App\Models\User; use Illuminate\Support\Facades\Hash; $users = [['name'=>'Demo User','email'=>'demo@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567890','role'=>'user'],['name'=>'Demo Driver','email'=>'driver@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567891','role'=>'driver']]; foreach($users as $u){User::updateOrCreate(['email'=>$u['email']],$u);} echo 'Demo users created!';"
echo.

echo ================================================
echo   SELESAI!
echo ================================================
echo.
echo CREDENTIALS:
echo ------------
echo USER    : demo@japlo.com / password123
echo DRIVER  : driver@japlo.com / password123
echo ADMIN   : admin@japlo.com / admin123
echo.
echo Test login di: http://localhost:8000/login
echo.
pause
