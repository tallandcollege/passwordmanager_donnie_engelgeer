<?php
$host = 'localhost';
$dbname = 'pwmanager';
$username = 'root';
$password = ''; // Empty on XAMPP/WAMP, 'root' on MAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}
?>