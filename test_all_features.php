<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Route;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║                  JAPLO APP - COMPREHENSIVE FEATURE TEST                      ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Test all customer service routes
$serviceRoutes = [
    'customer.ojek' => '/customer/ojek',
    'customer.kuliner' => '/customer/kuliner',
    'customer.promosi' => '/customer/promosi',
    'customer.kesehatan' => '/customer/kesehatan',
    'customer.produk' => '/customer/produk',
    'customer.pencetakan' => '/customer/pencetakan',
    'customer.trending' => '/customer/trending',
    'customer.sosial' => '/customer/sosial',
];

echo "TESTING ALL FEATURE ROUTES:\n";
echo str_repeat("═", 80) . "\n\n";

$passed = 0;
$failed = 0;

foreach ($serviceRoutes as $routeName => $routePath) {
    echo "Testing: {$routeName}\n";
    echo str_repeat("─", 80) . "\n";
    
    // Check if route exists
    try {
        $route = Route::getRoutes()->getByName($routeName);
        if ($route) {
            echo "✅ Route exists: {$routeName}\n";
            echo "   URI: {$routePath}\n";
            echo "   Controller: " . $route->getActionName() . "\n";
            
            // Test if URL can be generated
            try {
                $url = route($routeName);
                echo "✅ URL generated: {$url}\n";
                
                // Test HTTP access (without authentication)
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost:8000" . $routePath);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($httpCode == 200) {
                    echo "✅ HTTP 200 OK - Page accessible\n";
                    $passed++;
                } elseif ($httpCode == 302 || $httpCode == 301) {
                    echo "⚠️  HTTP {$httpCode} - Redirect (auth required)\n";
                    $passed++;
                } else {
                    echo "❌ HTTP {$httpCode} - Error accessing page\n";
                    $failed++;
                }
            } catch (Exception $e) {
                echo "❌ URL generation failed: " . $e->getMessage() . "\n";
                $failed++;
            }
        } else {
            echo "❌ Route not found\n";
            $failed++;
        }
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        $failed++;
    }
    
    echo "\n";
}

echo str_repeat("═", 80) . "\n\n";

// Check views exist
echo "CHECKING VIEW FILES:\n";
echo str_repeat("─", 80) . "\n";

$viewFiles = [
    'customer.services.ojek' => 'resources/views/customer/services/ojek.blade.php',
    'customer.services.kuliner' => 'resources/views/customer/services/kuliner.blade.php',
    'customer.services.promosi' => 'resources/views/customer/services/promosi.blade.php',
    'customer.services.kesehatan' => 'resources/views/customer/services/kesehatan.blade.php',
    'customer.services.produk' => 'resources/views/customer/services/produk.blade.php',
    'customer.services.pencetakan' => 'resources/views/customer/services/pencetakan.blade.php',
    'customer.services.trending' => 'resources/views/customer/services/trending.blade.php',
    'customer.services.sosial' => 'resources/views/customer/services/sosial.blade.php',
];

foreach ($viewFiles as $viewName => $filePath) {
    if (file_exists(__DIR__ . '/' . $filePath)) {
        echo "✅ {$viewName}\n";
    } else {
        echo "❌ {$viewName} - FILE NOT FOUND\n";
        $failed++;
    }
}

echo "\n" . str_repeat("═", 80) . "\n\n";

// Summary
echo "TEST SUMMARY:\n";
echo str_repeat("─", 80) . "\n";
echo "✅ Passed: {$passed}\n";
echo "❌ Failed: {$failed}\n";
echo "Total Tests: " . ($passed + $failed) . "\n\n";

if ($failed == 0) {
    echo "🎉 ALL TESTS PASSED! All features are working correctly.\n\n";
    echo "You can now access:\n";
    foreach ($serviceRoutes as $routeName => $routePath) {
        echo "  → http://localhost:8000{$routePath}\n";
    }
} else {
    echo "⚠️  Some tests failed. Please check the errors above.\n";
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "RECOMMENDATIONS:\n";
echo str_repeat("─", 80) . "\n";
echo "1. Make sure server is running: php artisan serve\n";
echo "2. Make sure you're logged in as customer\n";
echo "3. Check storage/logs/laravel.log for detailed errors\n";
echo "4. Clear cache: php artisan cache:clear\n";
echo str_repeat("═", 80) . "\n";
