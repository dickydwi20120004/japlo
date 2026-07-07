<?php

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║                     JAPLO APP - WEB ACCESS TEST                              ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Test URLs
$urls = [
    'http://localhost:8000',
    'http://127.0.0.1:8000',
    'http://localhost/Japlo%20App/public',
];

foreach ($urls as $url) {
    echo "Testing: $url\n";
    echo str_repeat("─", 80) . "\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    if ($httpCode == 200) {
        echo "✅ SUCCESS! HTTP $httpCode\n";
        echo "Content-Type: " . $info['content_type'] . "\n";
        echo "Size: " . strlen($response) . " bytes\n";
        
        // Check if it's HTML
        if (stripos($response, '<html') !== false) {
            echo "✅ Valid HTML Response\n";
            
            // Check for Laravel/Japlo specific content
            if (stripos($response, 'JAPLO') !== false) {
                echo "✅ JAPLO App Detected!\n";
            }
            if (stripos($response, 'Laravel') !== false) {
                echo "✅ Laravel Framework Detected!\n";
            }
            
            // Show first 500 characters
            echo "\nFirst 500 characters of response:\n";
            echo "┌" . str_repeat("─", 78) . "┐\n";
            $preview = substr(strip_tags($response), 0, 500);
            $preview = preg_replace('/\s+/', ' ', $preview);
            echo wordwrap($preview, 76, "\n") . "\n";
            echo "└" . str_repeat("─", 78) . "┘\n";
            
            echo "\n✅ THIS URL WORKS! Open in browser: $url\n";
        }
    } elseif ($httpCode > 0) {
        echo "⚠️  HTTP $httpCode\n";
        
        if ($httpCode == 404) {
            echo "❌ Page not found\n";
        } elseif ($httpCode == 500) {
            echo "❌ Server error - Check storage/logs/laravel.log\n";
        } elseif ($httpCode == 302 || $httpCode == 301) {
            echo "➡️  Redirect detected\n";
            echo "Location: " . ($info['redirect_url'] ?? 'Unknown') . "\n";
        }
    } else {
        echo "❌ CANNOT CONNECT\n";
        echo "Error: $error\n";
        echo "\nPossible reasons:\n";
        echo "1. Server is not running\n";
        echo "2. Port is blocked by firewall\n";
        echo "3. Wrong URL\n";
        echo "\nTry:\n";
        echo "- Start server: php artisan serve\n";
        echo "- Or use: START_SERVER.bat\n";
    }
    
    echo "\n" . str_repeat("═", 80) . "\n\n";
}

// Check which ports are open
echo "PORT STATUS:\n";
echo str_repeat("─", 80) . "\n";

$ports = [
    8000 => 'Laravel Server',
    80 => 'XAMPP Apache',
    3306 => 'MySQL',
];

foreach ($ports as $port => $service) {
    $connection = @fsockopen('127.0.0.1', $port, $errno, $errstr, 1);
    if (is_resource($connection)) {
        echo "✅ Port $port ($service) - OPEN\n";
        fclose($connection);
    } else {
        echo "❌ Port $port ($service) - CLOSED\n";
    }
}

echo "\n" . str_repeat("═", 80) . "\n\n";

echo "RECOMMENDATIONS:\n";
echo str_repeat("─", 80) . "\n";

// Check if port 8000 is open
$port8000 = @fsockopen('127.0.0.1', 8000, $errno, $errstr, 1);
if (!is_resource($port8000)) {
    echo "⚠️  Port 8000 is CLOSED!\n\n";
    echo "ACTION NEEDED:\n";
    echo "1. Double-click: START_SERVER.bat\n";
    echo "2. Or run manually: php artisan serve\n";
    echo "3. Don't close the terminal window\n";
    echo "4. Then open browser: http://localhost:8000\n\n";
} else {
    fclose($port8000);
    echo "✅ Port 8000 is OPEN!\n\n";
    echo "Server is running. You can access:\n";
    echo "→ http://localhost:8000\n";
    echo "→ http://127.0.0.1:8000\n\n";
    echo "LOGIN WITH:\n";
    echo "Email: demo@japlo.com\n";
    echo "Password: password123\n\n";
}

echo str_repeat("═", 80) . "\n";
