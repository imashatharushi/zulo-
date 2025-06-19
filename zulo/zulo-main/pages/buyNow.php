<?php
session_start();
include_once "../inc/db.php";
$userID = $_SESSION["user_id"];

if (!isset($_SESSION["user_id"])) {
    header("location: ../pages/login.php");
}

if (isset($_GET["product_id"])) {
    $productID = $_GET["product_id"];
    $sql = "SELECT product_name, description, price, stock_quantity, image_url, sku ,product_id
            FROM products 
            WHERE product_id = $productID;";


    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Now - Zulo</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome CDN  -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" />

    <!-- External CSS  -->
    <!-- <link rel="stylesheet" href="../assets/css/cart.min.css"> -->
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="../assets/css/nav.min.css">
    <link rel="stylesheet" href="../assets/css/footer.min.css">
    <link rel="stylesheet" href="../assets/css/index.min.css">
</head>

<body>
    <?php
    include_once "../partials/nav.php"
    ?>

    <div class="container d-flex ">
        <?php

        $productPrice = $product["price"];
        $imgName = $product["image_url"];
        $productTitle = $product["product_name"];
        $imgPathOrg = "../assets/img/$imgName";
        $imgPathLow = "../assets/img/low-quality/$imgName";
        $productId = $product["product_id"];
        ?>

        <div class="col-6">
            <div class="mt-5 d-block">
                <img src="<?php echo $imgPathOrg ?>" alt="" style="width: 400px;height:450px;object-fit:cover;object-position:center top">
                <h6 class="mt-3 display-5 w-75"><?php echo $productTitle ?></h6>
                <h5 class="display-4 text-primary"><?php echo $productPrice ?>LKR</h5>
            </div>


        </div>
        <?php
        try {
            // Prepare a query to fetch user details based on the logged-in user ID
            $sql = "SELECT * FROM users WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);

            // Bind the user ID parameter to prevent SQL injection
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the user details
            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the user was found
            if ($userDetails) { ?>
                <div class="col-lg-6 px-5 py-4">
                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Shipping Details</h3>
                    <form action="../inc/handlers/buyNow_handler.php?product_id=<?php echo $productID ?>" method="POST">
                        <div data-mdb-input-init class="form-outline mb-2">
                            <label class="form-label" for="typeText">Name </label>
                            <input type="text" name="name" id="typeText" class="form-control form-control-lg" size="17"
                                value="<?php echo $userDetails["first_name"] . " " . $userDetails["last_name"] ?>" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <label class="form-label" for="typeName">Phone Number</label>
                            <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                value="<?php echo $userDetails["phone_number"] ?>" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <label class="form-label" for="typeName">Country</label>
                            <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                value="<?php echo $userDetails["country"] ?>" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <label class="form-label" for="typeName">province</label>
                            <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                value="<?php echo $userDetails["province"] ?>" />
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div data-mdb-input-init class="form-outline">
                                    <label class="form-label" for="typeExp">Address</label>
                                    <input type="text" id="typeExp" class="form-control form-control-lg" value="<?php echo $userDetails["address"] ?>"
                                        size="7" id="exp" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div data-mdb-input-init class="form-outline">
                                    <label class="form-label" for="typeText">city</label>
                                    <input type="text" id="typeText" class="form-control form-control-lg"
                                        value="<?php echo $userDetails["city"] ?>" size="1" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div data-mdb-input-init class="form-outline">
                                    <label class="form-label" for="typeText">postal code</label>
                                    <input type="text" id="typeText" class="form-control form-control-lg"
                                        value="<?php echo $userDetails["postal_code"] ?>" size="1" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment Method</h3>
                                <div class="form-check">
                                    <input type="number" value="<?php echo $productPrice ?>" hidden name="productPrice">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery" value="Cash On Delivery" required checked>
                                    <label class="form-check-label" for="cashOnDelivery">
                                        Cash On Delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="cardPayment" value="Card Payment" required>
                                    <label class="form-check-label" for="cardPayment">
                                        Card Payment
                                    </label>
                                </div>
                                <button type="submit" class="mt-5 btn btn-primary btn-block">Buy now</button>
                    </form>

                    <h5 class="fw-bold mb-5" style="position: absolute; bottom: 0;">
                        <a href="../index.php"><i class="fas fa-angle-left me-2"></i>Back to shopping</a>
                    </h5>


                </div>
        <?php
            } else {
                echo "No user found with this ID.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>

    </div>
    </div>
    <?php
    $imgPathForFooter = "../assets/img/";

    include_once "../partials/footer.php"
    ?>



    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>