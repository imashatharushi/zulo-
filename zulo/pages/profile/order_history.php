<?php
session_start();
include_once "../../inc/db.php";

// Check if the user is logged in and has a valid session
if (!isset($_SESSION["user_id"])) {
    die("User not authenticated.");
}

$userID = $_SESSION["user_id"];

try {
    // Fetch user's orders from the database
    $orderQuery = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($orders)) {
        $orders = [];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Zulo</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">

    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Bootstrap CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- External CSS  -->
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <link rel="stylesheet" href="../../assets/css/footer.min.css">
    <link rel="stylesheet" href="../../assets/css/nav.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.min.css">
    <link rel="stylesheet" href="../../assets/css/order_history.min.css">
</head>

<body>
    <?php
    $profilePage = "";
    $cartPage = "../../pages/cart.php";
    $logoutPage = "../../inc/handlers/logout_handler.php";

    include_once "../../partials/nav.php";

    ?>

    <div class="container-xl px-4 mt-4">
        <h1 class="mb-4">My Orders</h1>

        <!-- Account page navigation -->
        <nav class="nav nav-borders">
            <a class="nav-link" href="./index.php">Profile</a>
            <a class="nav-link active ms-0" href="./order_history.php">Order History</a>
            <a class="nav-link" href="./wishlist.php">Wishlist</a>
            <a class="nav-link" href="./security.php">Security</a>
        </nav>
        <hr class="mt-0 mb-4">

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Order Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order):
                            // Fetch product details based on product_id stored in orders
                            $productIDs = explode(',', $order['product_id']);
                            $products = [];
                            $productQuery = "SELECT product_name, price,image_url FROM products WHERE product_id IN (" . implode(",", $productIDs) . ")";
                            $stmt = $conn->prepare($productQuery);
                            $stmt->execute();
                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


                        ?>
                            <tr>
                                <td><?= date('F j, Y', strtotime($order['created_at'])); ?></td>
                                <td>
                                    <?php foreach ($products as $product):
                                        $imagePath = "../../assets/img/" . $product["image_url"];


                                    ?>

                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $imagePath  ?>" alt="<?= $product['product_name']; ?>" style="width: 45px; height: 45px; object-fit:cover; object-position:top center;" class="rounded-circle">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $product['product_name']; ?></p>
                                                <p class="text-muted mb-0">Rs <?= number_format($product['price'], 2); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $order['qty']; ?></td>
                                <td>Rs <?= number_format($order['total_amount'], 2); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $order['payment_status'] == 'Paid' ? 'success' : 'danger'; ?> rounded-pill d-inline">
                                        <?= ucfirst($order['payment_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded">View Details</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once "../../partials/footer.php"; ?>

    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>