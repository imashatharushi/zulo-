<?php
include_once "../db.php";
session_start();

$userId = $_SESSION["user_id"];
echo $userId;


if (isset($_GET["product_id"])) {
    $productId = $_GET["product_id"]; // Get the product ID from the URL parameter 

    $sql = "DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "done";
    } else {
        echo "fail";
    }
}
