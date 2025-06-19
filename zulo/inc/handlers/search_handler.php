<?php
include_once "../db.php"; // Assuming db.php sets up a PDO connection



if (isset($_GET["searchQuery"])) {

    $searchQuery = $_GET["searchQuery"];


    $sql = "SELECT product_id,product_name, description, price, stock_quantity, image_url, sku FROM products WHERE  product_name LIKE '%" . $searchQuery . "%'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
}
