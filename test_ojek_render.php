<?php
// Simple test to debug ojek view rendering

require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

try {
    echo "Testing ojek view rendering...\n";
    echo "View exists: " . (file_exists('resources/views/customer/services/ojek.blade.php') ? 'YES' : 'NO') . "\n";
    
    // Try to render the view
    $view = \View::make('customer.services.ojek');
    echo "View object created successfully\n";
    
    $content = $view->render();
    echo "View rendered successfully\n";
    echo "Content length: " . strlen($content) . "\n";
    
    if (strpos($content, 'Ojek') !== false) {
        echo "✓ Ojek content found in rendered view\n";
    } else {
        echo "✗ Ojek content NOT found\n";
    }
    
    if (strlen($content) > 5000) {
        echo "✓ Content is substantial (> 5000 chars)\n";
    } else {
        echo "✗ Content seems too small\n";
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
?>
