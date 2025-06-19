<?php
$serverName = "localhost:3307";
// $serverName = "localhost:3308";

$username = "root";
$password = "1234";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=zulo", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
