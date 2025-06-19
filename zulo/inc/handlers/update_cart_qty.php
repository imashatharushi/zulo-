<?php
include_once "../db.php"; // Assuming db.php sets up a PDO connection
session_start();

if (isset($_GET["product_id"]) && isset($_GET["qty"])) {
    $productId = $_GET["product_id"];
    $quantity = $_GET["qty"];

    $sql = "UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Quantity updated successfully.";
    } else {
        echo "Failed to update quantity.";
    }
}
