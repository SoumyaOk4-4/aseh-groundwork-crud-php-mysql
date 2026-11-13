<?php
$host = "localhost";
$dbname = "aseh_crud";
$username = "moshi";
$password = "YourPassword123!"; // Must match Step 2 exactly

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
