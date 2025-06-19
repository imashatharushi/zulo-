<?php
include_once "../db.php"; // Assuming db.php sets up a PDO connection

session_start();

$user = false;
$userID = null;


if (isset($_SESSION["email"])) {
    $user = true;

    // Get the email from the session
    $email = $_SESSION["email"];

    // Prepare and execute the query to fetch user ID using PDO
    $sql = "SELECT user_id FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);  // Bind email parameter
    $stmt->execute();

    // Check if a user is found
    if ($stmt->rowCount() > 0) {
        // Fetch the user ID
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $row['user_id'];
    } else {
        echo "No user found with this email.";
        $user = false;
    }
}


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // echo "product id: " . $product_id;
}



if ($user && $product_id) {
    $total = $_POST['productPrice'];
    $paymentStatus = $_POST["paymentMethod"];
    $shippingAddress = $_POST["name"];
    $qty = 1;



    $sql = "INSERT INTO orders (user_id, total_amount,shipping_address, payment_status, qty, product_id) 
            VALUES (:user_id, :total_amount, :shipping_address, :payment_status, :qty, :product_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':total_amount', $total, PDO::PARAM_STR);
    $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
    $stmt->bindParam(':shipping_address', $shippingAddress, PDO::PARAM_STR);
    $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);  // Bind qty as integer
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);  // Bind product_id as integer

    $stmt->execute();

    header("Location: ../../../../../zulo/pages/orderSuccess.php?order_id=" . $conn->lastInsertId());
}