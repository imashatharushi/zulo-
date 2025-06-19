<?php
session_start();
include_once "../inc/db.php";
$userID = $_SESSION["user_id"];
$total = 0;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart - Zulo</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">
    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- External CSS  -->
    <link rel="stylesheet" href="../assets/css/cart.min.css">
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="../assets/css/nav.min.css">
</head>

<body>
<div class="container-fluid m-0 p-0 full-body d-flex flex-column">
           <!-- Navigation  -->
           <header>

               <?php
                include_once "../partials/nav.php";
                ?>
           </header>
       </div>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card shopping-cart" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 px-5 py-4">

                                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>
                                    <?php


                                    if (!isset($userID)) {
                                        die('User not authenticated.');
                                    }

                                    try {
                                        // SQL query to fetch cart items and product details using PDO
                                        $sql = "
                                                    SELECT c.product_id, c.quantity, c.added_at, p.product_name, p.price, p.image_url
                                                    FROM cart c
                                                    JOIN products p ON c.product_id = p.product_id
                                                    WHERE c.user_id = :user_id
                                                ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT); // Bind userID from session
                                        $stmt->execute();
                                        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results

                                        if (count($cartItems) > 0) {



                                            foreach ($cartItems as $item) {

                                                $itemTotal = $item['price'] * $item['quantity'];
                                                $total += $itemTotal;
                                                // Template to display cart items
                                                echo '
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="flex-shrink-0">
                                                            <img src="../assets/img/' . htmlspecialchars($item['image_url']) . '" class="img-fluid" style="width: 150px;" alt="Product image">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <a href="" onclick="removeFromCart(' . $item['product_id'] . ',event)" class="float-end"><i class="fas fa-trash-alt"></i></a>
                                                            <h5 class="text-primary">' . htmlspecialchars($item['product_name']) . '</h5>
                                                           
                                                            <h6 style="color: #9e9e9e;">Added on: ' . htmlspecialchars($item['added_at']) . '</h6>
                                                            <div class="d-flex align-items-center">
                                                                <p class="fw-bold mb-0 me-5 pe-3">Rs.' .  number_format($item['price'], 2) . '</p>
                                                                <div class="def-number-input number-input safari_only">
                                                                    <button data-mdb-button-init onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown() , updateCartQty(event, ' . $item['product_id'] . ')" class="minus"></button>
                                                                    <input class="quantity fw-bold bg-body-tertiary text-body" min="1" name="quantity" value="' . htmlspecialchars($item['quantity']) .
                                                    '" type="number">
                                                                    <button data-mdb-button-init onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp() ,updateCartQty(event, ' . $item['product_id'] . ')"" class="plus"></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                        } else {
                                            echo '<p>Your cart is empty.</p>';
                                        }
                                    } catch (PDOException $e) {
                                        // Handle errors
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>


                                    <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">

                                    <div class="d-flex justify-content-between px-x">
                                        <p class="fw-bold">Discount:</p>
                                        <p class="fw-bold"></p>
                                    </div>
                                    <div class="d-flex justify-content-between p-2 mb-2 bg-primary">
                                        <h5 class="fw-bold mb-0">Total:</h5>
                                        <h5 class="fw-bold mb-0">Rs.
                                            <?php
                                            echo $total;
                                            ?>
                                        </h5>
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
                                            <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Shpping Details</h3>
                                            <form class="mb-5">
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <label class="form-label" for="typeText">Name </label>
                                                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                                        value="<?php echo $userDetails["first_name"] . " " . $userDetails["last_name"] ?>" />
                                                </div>
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <label class="form-label" for="typeName">Name on card</label>
                                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                                        value="<?php echo $userDetails["email"] ?>" />
                                                </div>
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <label class="form-label" for="typeName">Phone Number</label>
                                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                                        value="<?php echo $userDetails["phone_number"] ?>" />
                                                </div>
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <label class="form-label" for="typeName">Country</label>
                                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                                        value="<?php echo $userDetails["country"] ?>" />
                                                </div>
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <label class="form-label" for="typeName">province</label>
                                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
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
                                            </form>
                                            <form action="../inc/handlers/process_payment.php" method="POST">
                                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment Method</h3>
                                                <div class="form-check">
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
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Start  -->
    <footer>
        <?php
        $imgPathForFooter = "../assets/img/";

        include_once "../partials/footer.php"
        ?>
    </footer>

    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function removeFromCart(productId, event) {
            event.preventDefault();
            const result = confirm("Are you sure you want to remove this product from your cart?");

            if (result) {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `../inc/handlers/remove_from_cart.php?product_id=${productId}`, true);
                xhr.onload = function() {
                    if (this.status === 200) {
                        location.reload();
                    }
                };
                xhr.send();
            }
        }

        function updateCartQty(event, productId) {

            console.log(productId);
            const qty = event.target.parentElement.querySelector('input').value;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `../inc/handlers/update_cart_qty.php?product_id=${productId}&qty=${qty}`, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    location.reload();
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>