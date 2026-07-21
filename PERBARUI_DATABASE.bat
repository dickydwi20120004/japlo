@echo off
echo ================================================
echo   PERBARUI DATABASE - JAPLO APP
echo ================================================
echo.
echo PASTIKAN:
echo [x] MySQL XAMPP sudah HIJAU (running)
echo.
pause

echo.
echo [1] Drop semua table dan migrate ulang...
echo.
php artisan migrate:fresh --force

echo.
echo [2] Seed admin user...
echo.
php artisan db:seed --class=AdminSeeder --force

echo.
echo [3] Buat demo users (Penumpang & Driver)...
echo.
php artisan tinker --execute="use App\Models\User; use Illuminate\Support\Facades\Hash; User::updateOrCreate(['email'=>'demo@japlo.com'], ['name'=>'Demo User','email'=>'demo@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567890','role'=>'user']); User::updateOrCreate(['email'=>'driver@japlo.com'], ['name'=>'Demo Driver','email'=>'driver@japlo.com','password'=>Hash::make('password123'),'phone'=>'081234567891','role'=>'driver']); echo 'Demo users created!';"

echo.
echo ================================================
echo   DATABASE BERHASIL DIPERBARUI!
echo ================================================
echo.
echo KREDENSIAL LOGIN:
echo -----------------
echo.
echo PENUMPANG:
echo   Email: demo@japlo.com
echo   Pass : password123
echo.
echo DRIVER:
echo   Email: driver@japlo.com
echo   Pass : password123
echo.
echo ADMIN:
echo   Email: admin@japlo.com
echo   Pass : admin123
echo.
echo ================================================
echo.
echo NEXT: Jalankan server dengan klik file:
echo       1_JALANKAN_INI.bat
echo.
echo Lalu buka browser:
echo       http://localhost:8000/login
echo.
pause
