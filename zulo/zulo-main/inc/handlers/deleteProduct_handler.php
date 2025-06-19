<?php
include_once "../db.php"; // Assuming db.php sets up a PDO connection


if (isset($_GET["productId"])) {
    $productId = $_GET["productId"];
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$productId]);
    echo "Product deleted successfully.";
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Missing product ID"]);
    echo "Product not deleted";
}
