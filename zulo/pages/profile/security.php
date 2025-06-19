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
    <title>My Security - Zulo</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">

    <!-- Bootstrap CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN  -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" />

    <!-- External CSS  -->
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <link rel="stylesheet" href="../../assets/css/footer.min.css">
    <link rel="stylesheet" href="../../assets/css/nav.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.min.css">
    <link rel="stylesheet" href="../../assets/css/security.min.css">


</head>

<body>
    <?php
    $profilePage = "";
    $cartPage = "../../pages/cart.php";
    $logoutPage = "../../inc/handlers/logout_handler.php";

    include_once "../../partials/nav.php";
    ?>


    <div class="container-xl px-4 mt-4">
        <h1 class="mb-4">My Security</h1>

        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link" href="./index.php" target="__blank">Profile</a>
            <a class="nav-link" href="./order_history.php" target="__blank">Order History</a>
            <a class="nav-link" href="./wishlist.php" target="__blank">Wishlist</a>
            <a class="nav-link active ms-0" href="./security.php" target="__blank">Security</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword">Current Password</label>
                                <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password">
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="newPassword">New Password</label>
                                <input class="form-control" id="newPassword" type="password" placeholder="Enter new password">
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password">
                            </div>
                            <button class="btn btn-primary" type="button">Save</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">


            </div>
        </div>
    </div>

    <?php
    include_once "../../partials/footer.php"
    ?>

    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>