<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register - Zulo</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

    <!-- Bootstrap CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- External CSS  -->
    <link rel="stylesheet" href="../assets/css/addCategories.min.css">
    <link rel="stylesheet" href="../assets/css/women.min.css">
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="../assets/css/login.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" />
</head>

<body>
    <div class="container controls">
        <ul class="nav nav-pills nav-justified mb-3 w-100 px-5 py-4" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
                    aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
                    aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
        </ul>
    </div>
    <div class="container container-form rounded-3 col-4 d-flex justify-content-center align-items-center flex-column">
        <div class="tab-content">
            <!-- Login Form -->
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <div class="text-white login rounded-2">
                    <form class="h-75 d-flex flex-column justify-content-around" action="../inc/handlers/login_handler.php" method="post">
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Email" class="rounded-5 form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="rounded-5 form-control" id="exampleInputPassword1">
                        </div>
                        <div class="text-end mb-3">
                            <a href="#" class="text-light">Forgot Password?</a>
                        </div>

                        <button type="submit" name="submit" class="rounded-5 btn btn-primary">Login</button>
                    </form>
                </div>
            </div>

            <!-- Register Form -->
            <div class="tab-pane fade p-0" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <div class="text-white login rounded-2  h-100 d-flex justify-content-center flex-column">
                    <form class="d-flex flex-column justify-content-around " action="../inc/handlers/register_handler.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <input type="text" required name="fname" placeholder="First Name" class="rounded-5 form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <input type="text" required name="lname" placeholder="Last Name" class="rounded-5 form-control">
                            </div>
                        </div>

                        <div class="mb-2">
                            <input type="email" required name="email" placeholder="Email" class="rounded-5 form-control">
                        </div>

                        <div class="mb-2">
                            <input type="password" required name="password" placeholder="Password" class="rounded-5 form-control">
                        </div>

                        <div class="mb-2">
                            <input type="text" required name="phoneNum" placeholder="Phone Number" class="rounded-5 form-control">
                        </div>

                        <!-- Address Fields -->
                        <div class="mb-2">
                            <input type="text" required name="streetAddress" placeholder="Street Address" class="rounded-5 form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" required name="city" placeholder="City" class="rounded-5 form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" required name="province" placeholder="Province" class="rounded-5 form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" required name="zipCode" placeholder="Zip Code" class="rounded-5 form-control">
                            </div>
                        </div>

                        <button type="submit" name="submit" class="rounded-5 btn btn-primary">Register</button>
                    </form>
                    <div class="text-center mt-1">
                        <p>Already have an account? <a href="#" class="text-light">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($_GET["error"]) { ?>
        <div class="error">
            <div class="alert alert-danger" role="alert">
                <?php
                $error = $_GET["error"];

                if ($error == "password") {
                    echo "password not matching";
                } else if ($error == "stmtFailed") {
                    echo "something went wrong try again later..";
                } else {
                    echo "not registered try again..";
                }
                ?>
            </div>
        </div>
    <?php  }    ?>


    <!-- Bootstrap CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>