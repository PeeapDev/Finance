<?php
// Test different MySQL connection combinations
$host = '127.0.0.1';
$port = 3307;
$database = 'mysql'; // Use default mysql database first

$credentials = [
    ['root', ''],
    ['root', 'root'],
    ['root', 'password'],
    ['mysql', ''],
    ['', ''],
];

foreach ($credentials as $cred) {
    $username = $cred[0];
    $password = $cred[1];
    
    echo "Trying: username='$username', password='$password'\n";
    
    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$database";
        $pdo = new PDO($dsn, $username, $password);
        echo "✅ SUCCESS! Connected with username='$username', password='$password'\n";
        
        // Try to create the database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS acculance_db");
        echo "✅ Database 'acculance_db' created successfully!\n";
        break;
        
    } catch (PDOException $e) {
        echo "❌ Failed: " . $e->getMessage() . "\n";
    }
    echo "---\n";
}
?>
