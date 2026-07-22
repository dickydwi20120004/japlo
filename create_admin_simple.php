<?php
// Simple script to create admin user directly via PDO
echo "Creating admin user...\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=japlo_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Hash password
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    
    // Insert or update admin
    $sql = "INSERT INTO users (name, email, password, phone, role, created_at, updated_at) 
            VALUES ('Admin JAPLO', 'admin@japlo.com', ?, '089999999999', 'admin', NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
            password = ?, updated_at = NOW()";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$password, $password]);
    
    echo "✓ Admin created: admin@japlo.com / admin123\n";
    
    // Create demo user
    $password2 = password_hash('password123', PASSWORD_BCRYPT);
    
    $sql2 = "INSERT INTO users (name, email, password, phone, role, created_at, updated_at) 
             VALUES ('Demo User', 'demo@japlo.com', ?, '081234567890', 'user', NOW(), NOW())
             ON DUPLICATE KEY UPDATE 
             password = ?, updated_at = NOW()";
    
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$password2, $password2]);
    
    echo "✓ User created: demo@japlo.com / password123\n";
    
    // Create demo driver
    $sql3 = "INSERT INTO users (name, email, password, phone, role, created_at, updated_at) 
             VALUES ('Demo Driver', 'driver@japlo.com', ?, '081234567891', 'driver', NOW(), NOW())
             ON DUPLICATE KEY UPDATE 
             password = ?, updated_at = NOW()";
    
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([$password2, $password2]);
    
    echo "✓ Driver created: driver@japlo.com / password123\n";
    
    echo "\nSUCCESS! You can now login.\n";
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    
    if (strpos($e->getMessage(), "Unknown database") !== false) {
        echo "\nCreating database...\n";
        try {
            $pdo2 = new PDO('mysql:host=127.0.0.1', 'root', '');
            $pdo2->exec("CREATE DATABASE IF NOT EXISTS japlo_db");
            echo "Database created. Now run: php artisan migrate\n";
        } catch (Exception $e2) {
            echo "Cannot create database: " . $e2->getMessage() . "\n";
        }
    } elseif (strpos($e->getMessage(), "doesn't exist") !== false) {
        echo "\nTable not found. Run: php artisan migrate\n";
    }
}
