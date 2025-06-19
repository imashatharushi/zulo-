<?php
session_start();
include_once "../db.php";

$userID = $_SESSION["user_id"];

// Ensure user is authenticated
if (!isset($userID)) {
    die('User not authenticated.');
}

try {
    // Fetch the user's shipping address from the users table
    $userQuery = "SELECT address FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($userQuery);
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userDetails) {
        die('User details not found.');
    }

    $shippingAddress = $userDetails['address'];  // Get the shipping address from the users table

    // Fetch cart items and product prices using a JOIN between cart and product tables
    $cartQuery = "SELECT c.product_id, c.quantity, p.price 
                  FROM cart c 
                  JOIN products p ON c.product_id = p.product_id 
                  WHERE c.user_id = :user_id";
    $stmt = $conn->prepare($cartQuery);
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If the cart is empty
    if (empty($cartItems)) {
        die('No items in cart.');
    }

    // Calculate total amount
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['quantity'] * $item['price']; // Sum up price * quantity
    }

    // Concatenate product IDs into a comma-separated string
    $productIDs = implode(',', array_column($cartItems, 'product_id'));

    // Assuming payment method comes from a form submission
    $paymentMethod = $_POST['paymentMethod'];

    // Insert the order into the orders table
    $sql = "INSERT INTO orders (user_id, total_amount, payment_status, created_at, shipping_address, qty, product_id) 
            VALUES (:user_id, :total_amount, :payment_status, NOW(), :shipping_address, :qty, :product_id)";
    $stmt = $conn->prepare($sql);

    // Assuming `qty` is the total quantity of items in the cart
    $qty = array_sum(array_column($cartItems, 'quantity'));

    // Bind values
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':total_amount', $total, PDO::PARAM_STR);
    $stmt->bindParam(':payment_status', $paymentMethod, PDO::PARAM_STR);
    $stmt->bindParam(':shipping_address', $shippingAddress, PDO::PARAM_STR);
    $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $productIDs, PDO::PARAM_STR);

    $stmt->execute();

    // Get the last inserted order ID
    $orderID = $conn->lastInsertId();

    // Clear the user's cart after order submission
    $sql = "DELETE FROM cart WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to the order confirmation page
    header("Location: ../../../../../zulo/pages/orderSuccess.php?order_id=$orderID");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}