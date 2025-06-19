<?php

include_once "../db.php";

if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
    $page = $_GET["page"];

    if ($sort == "ASC") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE category_id = $page ORDER BY price ASC";
    } else if ($sort == "DESC") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE category_id = $page ORDER BY price DESC";
    }
} else if (isset($_GET["category"])) {
    $category = $_GET["category"];

    if ($category == "tShirts") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'Tshirts M'";
    } else if ($category == "shirts") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'Shirts M'";
    } else if ($category == "casualShirts") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'casualShirts M'";
    } elseif ($category == "Denims") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'Denims W'";
    } elseif ($category == "T-Shirts") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'Tshirts W'";
    } else if ($category == "TopsW") {
        $sql = "SELECT product_id, product_name, description, price, stock_quantity, image_url, sku FROM products WHERE subCategory = 'Tops W'";
    }
}










$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
