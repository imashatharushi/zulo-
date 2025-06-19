<?php

include "../../inc/db.php";


$productID = 0;

if (isset($_GET['product_id'])) {
    $productID = $_GET['product_id'];
} else {
    echo "No product ID found.";
}


$sql = "SELECT product_name, description, price, stock_quantity, image_url, sku ,product_id
        FROM products 
        WHERE product_id = $productID;";


$stmt = $conn->prepare($sql);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

$imgName = $product["image_url"];
$imgPath = "../../assets/img/$imgName";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />

    <!-- font awesome cdn  -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/addCategories.min.css">
    <link rel="stylesheet" href="../assets/css/women.min.css">
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="./assets/css/footer.min.css">
    <link rel="stylesheet" href="../assets/css/productDetails.min.css">
</head>

<body class="">

    <div class="container-fluid bg-white pt-5 pb-5">
        <div class="col-lg-8 col-12 container d-flex flex-wrap p-5  bg-light p-3 mb-5">
            <div
                class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                <img
                    src="<?php echo $imgPath ?>"
                    alt="Lapel Long Sleeve Printed Top"
                    class="img-fluid rounded-3"
                    style="
            max-height: 400px;
            height: 400px;
            object-fit: cover;
            object-position: center;
          " />
            </div>
            <div class="col-md-6 col-12 p-4 mb-5">
                <h2 class="text-primary"><?php echo $product["product_name"] ?></h2>
                <small class="text-muted">Product ID: <?php echo $product["product_id"] ?>
                    <a href="">
                        <i class='bi bi-heart fs-5 text-danger' onclick="cartAdded(event)"></i>
                    </a>
                </small>

                <h1 class="mt-3 text-danger">Rs <?php echo $product["price"] ?></h1>
                <small class="text-muted">or 3 installments of $16.66</small>

                <p class="mt-4 fw-bold">Style: Casual</p>
                <p class="fw-bold">Size:</p>
                <p>
                    <span class="badge bg-secondary me-2 py-2">S</span>
                    <span class="badge bg-secondary me-2 py-2">M</span>
                    <span class="badge bg-secondary me-2 py-2">L</span>
                    <span class="badge bg-secondary me-2 py-2">XL</span>
                    <span class="badge bg-secondary py-2">XXL</span>
                </p>

                <p>
                    <button class="btn btn-outline-primary me-3">Add to Cart</button>
                    <button class="btn btn-outline-primary me-3">Add to wishlist</button>
                    <button class="btn btn-danger">Buy Now</button>
                </p>
            </div>
            <div>
                <p>
                    <?php
                    $productDetails = $product["description"];

                    $detailsArray = preg_split('/\s*(?<=:)\s*/', $productDetails);
                    $formattedDetails = [];

                    foreach ($detailsArray as $detail) {
                        $parts = explode(':', $detail, 2);
                        if (count($parts) === 2) {
                            $formattedDetails[] = '<strong>' . trim($parts[0]) . ':</strong> ' . trim($parts[1]);
                        } else {
                            $formattedDetails[] = '<strong>' . trim($parts[0]);
                        }
                    }

                    echo '<ul>';
                    foreach ($formattedDetails as $formattedDetail) {
                        echo '<li>' . $formattedDetail . '</li>';
                    }
                    echo '</ul>';
                    ?>

                </p>
            </div>
        </div>
    </div>



    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../assets/js/index.js"></script>
</body>

</html>