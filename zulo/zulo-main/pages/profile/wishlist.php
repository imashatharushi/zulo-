<?php
session_start();
include_once "../../inc/db.php";

// Check if the user is logged in and has a valid session
if (isset($_SESSION["user_id"])) {
  $userID = $_SESSION["user_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Wishlist - Zulo</title>
  <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">

  <!-- Bootstrap CDN  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CDN  -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" />


  <!-- External CSS -->
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
  $homePage = "../../index.php";
  $menPage = "../../pages/men.php";
  $womenPage = "../../pages/women.php";
  $logoutPage = "../../inc/handlers/logout_handler.php";

  include_once "../../partials/nav.php";
  ?>

  <div class="container-xl px-4 mt-4">
    <h1 class="mb-4">My Wishlist</h1>

    <!-- Account Page Navigation-->
    <nav class="nav nav-borders">
      <a class="nav-link" href="./index.php" target="__blank">Profile</a>
      <a class="nav-link" href="./order_history.php" target="__blank">Order History</a>
      <a class="nav-link active ms-0" href="./wishlist.php" target="__blank">Wishlist</a>
      <a class="nav-link" href="./security.php" target="__blank">Security</a>
    </nav>
    <hr class="mt-0 mb-4">


    <div class="container my-5 ">
      <table class="table align-middle mb-0">
        <thead class="bg">
          <tr>
            <th>Items</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT wishlist.wishlist_id, wishlist.added_date, products.product_id, products.product_name, products.price,products.image_url
            FROM wishlist
            JOIN products ON wishlist.product_id = products.product_id
            WHERE wishlist.user_id = :user_id";

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT); // Use the logged-in user's ID
          $stmt->execute();

          // Fetch all the wishlist items along with product details
          $wishlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Loop through the wishlist items and display them with product details
          if (!empty($wishlistItems)) {
            foreach ($wishlistItems as $item) {

              $imgPath = "../../assets/img/" . $item["image_url"];

          ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="<?php echo $imgPath ?>"
                      alt=""
                      style="width: 45px; height: 45px; object-fit:cover;object-position:top center;"
                      class="rounded-circle" />
                    <div class="ms-3">
                      <p class="fw-bold mb-1"><?php echo $item["product_name"] ?></p>
                      <p class="text-muted mb-0">Rs.<?php echo $item["price"] ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <a href="../../inc/handlers/wishlist_handler.php?cart=false&product_id=<?php echo $item["product_id"] ?>&page=cart">
                    <button class="btn btn-outline-danger">remove</button>
                  </a>
                </td>
              </tr>

          <?php
            }
          } else {
            echo "No items found in your wishlist.";
          }



          ?>


        </tbody>
      </table>
    </div>

    <?php
    include_once "../../partials/footer.php"
    ?>

    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>