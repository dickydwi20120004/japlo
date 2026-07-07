<?php

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║                     JAPLO APP - DIAGNOSTIC TOOL                              ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Test 1: PHP Version
echo "1. PHP Version Check\n";
echo "   PHP Version: " . phpversion() . "\n";
echo "   " . (version_compare(phpversion(), '8.1.0', '>=') ? "✅ OK" : "❌ PHP 8.1+ required") . "\n\n";

// Test 2: Laravel Check
echo "2. Laravel Installation Check\n";
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    echo "   ✅ Vendor folder exists\n";
    require __DIR__.'/vendor/autoload.php';
    
    if (file_exists(__DIR__.'/bootstrap/app.php')) {
        echo "   ✅ Bootstrap file exists\n";
        try {
            $app = require_once __DIR__.'/bootstrap/app.php';
            $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
            $kernel->bootstrap();
            echo "   ✅ Laravel bootstrap successful\n";
        } catch (Exception $e) {
            echo "   ❌ Bootstrap error: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ❌ Bootstrap file not found\n";
    }
} else {
    echo "   ❌ Vendor folder not found. Run: composer install\n";
}
echo "\n";

// Test 3: Environment File
echo "3. Environment Configuration\n";
if (file_exists(__DIR__.'/.env')) {
    echo "   ✅ .env file exists\n";
    $env = file_get_contents(__DIR__.'/.env');
    
    // Check DB config
    if (strpos($env, 'DB_DATABASE=') !== false) {
        echo "   ✅ Database configured\n";
    } else {
        echo "   ⚠️  Database not configured\n";
    }
    
    // Check APP_KEY
    if (strpos($env, 'APP_KEY=base64:') !== false) {
        echo "   ✅ APP_KEY generated\n";
    } else {
        echo "   ❌ APP_KEY not generated. Run: php artisan key:generate\n";
    }
} else {
    echo "   ❌ .env file not found\n";
    echo "   Run: copy .env.example .env\n";
}
echo "\n";

// Test 4: Database Connection
echo "4. Database Connection Test\n";
try {
    if (isset($app)) {
        $pdo = $app->make('db')->connection()->getPdo();
        echo "   ✅ Database connected\n";
        
        // Test users table
        $users = $app->make('db')->table('users')->count();
        echo "   ✅ Users table accessible ($users users found)\n";
    }
} catch (Exception $e) {
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
    echo "   → Check XAMPP MySQL is running\n";
    echo "   → Check .env DB settings\n";
}
echo "\n";

// Test 5: Routes
echo "5. Routes Check\n";
try {
    if (isset($app)) {
        $routes = $app->make('router')->getRoutes();
        echo "   ✅ Routes loaded (" . count($routes) . " routes)\n";
        
        // Check important routes
        $importantRoutes = ['home', 'login', 'register', 'dashboard'];
        foreach ($importantRoutes as $route) {
            if ($routes->hasNamedRoute($route)) {
                echo "   ✅ Route '{$route}' exists\n";
            } else {
                echo "   ❌ Route '{$route}' not found\n";
            }
        }
    }
} catch (Exception $e) {
    echo "   ❌ Routes error: " . $e->getMessage() . "\n";
}
echo "\n";

// Test 6: Views
echo "6. Views Check\n";
$views = [
    'resources/views/welcome.blade.php',
    'resources/views/auth/login.blade.php',
    'resources/views/auth/register.blade.php',
    'resources/views/layouts/app.blade.php',
    'resources/views/customer/dashboard.blade.php',
];

foreach ($views as $view) {
    if (file_exists(__DIR__.'/'.$view)) {
        echo "   ✅ $view\n";
    } else {
        echo "   ❌ $view not found\n";
    }
}
echo "\n";

// Test 7: Port Check
echo "7. Server Port Check\n";
$ports = [8000, 80, 443];
foreach ($ports as $port) {
    $connection = @fsockopen('127.0.0.1', $port, $errno, $errstr, 1);
    if (is_resource($connection)) {
        echo "   ✅ Port $port is OPEN (something is running)\n";
        fclose($connection);
    } else {
        echo "   ⚠️  Port $port is CLOSED\n";
    }
}
echo "\n";

// Test 8: URL Test
echo "8. Testing URLs\n";
$urls = [
    'http://localhost:8000',
    'http://127.0.0.1:8000',
];

foreach ($urls as $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $response = @curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($httpCode == 200) {
        echo "   ✅ $url - OK (HTTP $httpCode)\n";
    } elseif ($httpCode > 0) {
        echo "   ⚠️  $url - HTTP $httpCode\n";
    } else {
        echo "   ❌ $url - Cannot connect: $error\n";
    }
}
echo "\n";

// Summary
echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "SUMMARY\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "🔍 WHAT TO DO NEXT:\n\n";

if (!file_exists(__DIR__.'/.env')) {
    echo "⚠️  ACTION REQUIRED:\n";
    echo "   1. Copy .env file: copy .env.example .env\n";
    echo "   2. Generate key: php artisan key:generate\n";
    echo "   3. Run migrations: php artisan migrate\n\n";
}

echo "🚀 TO START SERVER:\n";
echo "   php artisan serve\n\n";

echo "🌐 TO ACCESS APP:\n";
echo "   Browser: http://localhost:8000\n";
echo "   OR: http://127.0.0.1:8000\n\n";

echo "🔑 LOGIN CREDENTIALS:\n";
echo "   Email: demo@japlo.com\n";
echo "   Password: password123\n\n";

echo "📝 IF BROWSER SHOWS ERROR:\n";
echo "   1. Check console for JavaScript errors (F12)\n";
echo "   2. Clear browser cache (Ctrl+Shift+Del)\n";
echo "   3. Try incognito/private mode\n";
echo "   4. Try different browser\n";
echo "   5. Check storage/logs/laravel.log for errors\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
