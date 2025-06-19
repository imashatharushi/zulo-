<?php
session_start();
include_once "../../inc/db.php";

// Check if the user is logged in and has a valid session
if (isset($_SESSION["user_id"])) {
    $userID = $_SESSION["user_id"];

    // Fetch the user details based on the user_id from the database
    $sql = "SELECT first_name, last_name, email, password, phone_number, address, city, postal_code, country, created_at, province, account_status ,image ,roll
            FROM users WHERE user_id = :userID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":userID", $userID);
    $stmt->execute();

    // If user details are found, fetch them
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User not logged in.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Zulo</title>
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

</head>

<body>
    <?php

    $profilePage = "";
    $cartPage = "../../pages/cart.php";
    $logoutPage = "../../inc/handlers/logout_handler.php";



    include_once "../../partials/nav.php";
    ?>


    <div class="container-xl px-4 mt-4">
        <h1 class="mb-4">My Account</h1>
        <div class="row">
            <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <nav class="nav nav-borders">
                    <a class="nav-link active ms-0" href="./index.php" target="__blank">Profile</a>
                    <a class="nav-link" href="./order_history.php" target="__blank">Order History</a>
                    <a class="nav-link" href="./wishlist.php" target="__blank">Wishlist</a>
                    <a class="nav-link" href="./security.php" target="__blank">Security</a>
                    <?php
                    if ($user["roll"] == "admin") { ?>
                        <a class="nav-link" href="../admin/" target="__blank">Dashboard</a>
                    <?php }
                    ?>
                </nav>
                <hr class="mt-0 mb-4">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <?php
                                $imageName = htmlspecialchars($user['image']);
                                $imagePath = "../../assets/img/userProfile/" . $imageName;
                                ?>
                                <img class="img-account-profile rounded-circle mb-2" src="<?php echo $imagePath  ?>" alt="">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <div class="mb-3">
                                    <form action="../../inc/handlers/profilePic_handler.php" method="post" enctype="multipart/form-data" class="d-flex">
                                        <input type="file" class="form-control flex-1" id="uploadImg" name="uploadImg" required>
                                        <input type="submit" class="py-2 px-1 h6 border btn btn-outline-primary" name="uploadImg">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card -->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form method="POST" id="form">
                                    <!-- First Name and Last Name -->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">First Name</label>
                                            <input class="form-control" id="inputFirstName" type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Last Name</label>
                                            <input class="form-control" id="inputLastName" type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                                        </div>
                                    </div>

                                    <!-- Email and Password -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmail">Email</label>
                                        <input class="form-control" id="inputEmail" type="email" name="email" disabled value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    </div>
                                    <!-- Phone Number and Address -->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Phone Number</label>
                                            <input class="form-control" id="inputPhone" type="tel" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputAddress">Address</label>
                                            <input class="form-control" id="inputAddress" type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                                        </div>
                                    </div>

                                    <!-- City and Postal Code -->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputCity">City</label>
                                            <input class="form-control" id="inputCity" type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPostalCode">Postal Code</label>
                                            <input class="form-control" id="inputPostalCode" type="text" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required>
                                        </div>
                                    </div>

                                    <!-- Country and Province -->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputCountry">Country</label>
                                            <input class="form-control" id="inputCountry" type="text" name="country" value="<?php echo htmlspecialchars($user['country']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputProvince">Province</label>
                                            <input class="form-control" id="inputProvince" type="text" name="province" value="<?php echo htmlspecialchars($user['province']); ?>" required>
                                        </div>
                                    </div>

                                    <!-- Save changes button -->
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    const form = document.getElementById("form");

                                    form.addEventListener("submit", (e) => {
                                        e.preventDefault();

                                        const xhr = new XMLHttpRequest();
                                        xhr.open("POST", "../../inc/handlers/profile_handler.php", true);

                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                Swal.fire({
                                                    title: "Profile Updated!",
                                                    text: "Your account details have been saved successfully.",
                                                    icon: "success"
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: "Error",
                                                    text: "There was a problem updating your profile.",
                                                    icon: "error"
                                                });
                                            }
                                        };

                                        // Use FormData to send form data
                                        const formData = new FormData(form);
                                        xhr.send(formData);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
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