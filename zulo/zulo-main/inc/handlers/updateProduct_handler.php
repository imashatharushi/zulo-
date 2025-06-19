<?php
$serverName = "localhost:3307";
$username = "root";
$password = "1234";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=zulo", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET["productId"])) {
    $productId = $_GET["productId"];
    $productName = $_GET["name"];
    $productPrice = $_GET["price"];
    $sql = "UPDATE products SET product_name = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$productName, $productPrice, $productId]);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Missing product ID"]);
}
