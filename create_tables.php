<?php
$host = '127.0.0.1';
$db   = 'bakri_store';
$user = 'root';
$pass = ''; // Default for local usually empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERR_MODE            => PDO::ERR_MODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     
     // Create guides table if not exists
     $pdo->exec("CREATE TABLE IF NOT EXISTS guides (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        icon VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        is_active TINYINT(1) DEFAULT 1,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL
     )");

     // Create guide_steps table if not exists
     $pdo->exec("CREATE TABLE IF NOT EXISTS guide_steps (
        id INT AUTO_INCREMENT PRIMARY KEY,
        guide_id INT NOT NULL,
        image_path VARCHAR(255),
        description TEXT,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY (guide_id) REFERENCES guides(id) ON DELETE CASCADE
     )");
     
     echo "Tables created successfully.\n";
} catch (\PDOException $e) {
     echo "Error: " . $e->getMessage() . "\n";
}
