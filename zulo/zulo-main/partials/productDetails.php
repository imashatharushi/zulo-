<?php
include "../inc/db.php";
session_start();

$heartClass = "bi bi-heart";


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
$imgPath = "../assets/img/$imgName";





if (isset($_SESSION["user_id"])) {
  // Assuming you already have the user_id and product_id
  $user_id = $_SESSION['user_id']; // Example: get from session
  $product_id = $productID; // Example: get from URL or request

  // SQL Query
  $sql = "SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
  $stmt = $conn->prepare($sql);

  // Bind parameters
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

  // Execute the statement
  $stmt->execute();

  // Check if the product is in the wishlist
  if ($stmt->rowCount() > 0) {
    // Product is in wishlist, show filled heart
    $heartClass = "bi bi-heart-fill";
  } else {
    // Product is not in wishlist, show empty heart
    $heartClass = "bi bi-heart";
  }
} else {
  $product_id = 0;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Zulo - <?php echo $product["product_name"]; ?> </title>


  <link rel="icon" type="image/png" href="../assets/img/favicon-48x48.png" sizes="48x48" />
  <link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg" />
  <link rel="shortcut icon" href="../assets/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/apple-touch-icon.png" />
  <link rel="manifest" href="../assets/img/site.webmanifest" />


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
  <link rel="stylesheet" href="../assets/css/nav.min.css">
</head>

<body class="">
  <?php
  include "../../zulo/partials/nav.php";
  ?>
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
          </span>
          <div class='d-flex gap-3 align-items-center'>
            <i class='bi bi-bag fs-5 text-dark'></i>
            <?php
            if ($heartClass == "bi bi-heart") {
              echo
              "
        <button class='btn' > <i class='bi bi-heart fs-5 text-danger' onclick='addToWishlist(event," . $product_id . ")'   data-product_id='" . $productID . "'></i></button>
        ";
            } else if ($heartClass == "bi bi-heart-fill") {
              echo
              "
        <button class='btn'> <i class='bi bi-heart-fill fs-5 text-danger' onclick='addToWishlist(event, " . $product_id . ")' data-product_id='" . $productID . "'></i></button>
      ";
            }
            ?>


          </div>
        </small>

        <h1 class="mt-3 text-danger">Rs <?php echo $product["price"] ?></h1>
        <small class="text-muted">or 3 installments of <?php echo $product["price"] / 3, ".00 LKR" ?></small>

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
          <button class='btn btn-outline-danger' onclick="addToCart(<?php echo $product_id ?>)">Add to Cart</button>
          <button class="btn btn-danger" onclick="buyNow(event,<?php echo $product_id ?>)">Buy Now</button>
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

  <!-- footer start  -->
  <footer>
    <?php
    include_once "../partials/footer.php"
    ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="../assets/js/index.js"></script>
  <script src="../assets/js/search.js"></script>
  <script src="../assets/js/ajax.js"></script>

</body>

</html>