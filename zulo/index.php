<?php
// DB Connection 
include_once "./inc/db.php";

// Start Session 
session_start();


$sqlWomen = "SELECT product_name, description, price, stock_quantity, image_url, sku ,product_id
        FROM products 
        WHERE category_id = 2 
        ORDER BY product_id DESC 
        LIMIT 8;";

$sqlMen = "SELECT product_name, description, price, stock_quantity, image_url, sku ,product_id
        FROM products 
        WHERE category_id = 1
        ORDER BY product_id DESC 
        LIMIT 8;";

$stmtWomen = $conn->prepare($sqlWomen);
$stmtWomen->execute();

$wProducts = $stmtWomen->fetchAll(PDO::FETCH_ASSOC);

$stmtMen = $conn->prepare($sqlMen);
$stmtMen->execute();

$mProducts = $stmtMen->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Title  -->
  <title>Zulo - Your Style, Your Way</title>

  <link rel="icon" type="image/png" href="./assets/img/favicon-48x48.png" sizes="48x48" />
  <link rel="icon" type="image/svg+xml" href="./assets/img/favicon.svg" />
  <link rel="shortcut icon" href="./assets/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/apple-touch-icon.png" />
  <link rel="manifest" href="./assets/img/site.webmanifest" />


  <!-- Bootstrap CDN  -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!-- Font Awesome CDN  -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" />

  <!-- External CSS   -->
  <link rel="stylesheet" href="./assets/css/nav.min.css" />
  <link rel="stylesheet" href="./assets/css/footer.min.css">
  <link rel="stylesheet" href="./assets/css/index.min.css" />
  <link rel="stylesheet" href="./assets/css/reset.min.css" />
</head>

<body class="bg-white">
  <div class="container-fluid m-0 p-0 full-body d-flex flex-column">
    <!-- Navigation  -->
    <header>
      <?php
      $loginPage = "./pages/login.php";
      $imgFolder = "../../zulo/assets/img/userProfile/";
      $profilePage = "../zulo/pages/profile/";
      $homePage = "../zulo/";
      $menPage = "../zulo/pages/men.php";
      $womenPage = "../zulo/pages/women.php";
      $logoutPage = "../zulo/inc/handlers/logout_handler.php";

      include_once "./partials/nav.php"
      ?>
    </header>

    <div class="container-fluid new-fashion p-0 m-0 flex-grow-1">
      <img src="./assets/img/low-quality/bg2.jpg"
        data-sizes="auto"
        data-src="./assets/img/bg2.jpg"
        class="lazyload blur-up bg-img2"
        alt="Example Image 3" />

      <img src="./assets/img/low-quality/bg2.jpg"
        data-sizes="auto"
        data-src="./assets/img/bg2.jpg"
        class="lazyload blur-up bg-img"
        alt="Example Image 3" />

      <img src="./assets/img/low-quality/bg3Copy.png"
        data-sizes="auto"
        data-src="./assets/img/bg3.png"
        class="lazyload blur-up bg-img3"
        alt="Example Image 3" />
      <div class="text-card ">
        <p>
          <span class="display-6 zulo">ZULO</span> <br>
          <span class="display-1">FASHION</span>
        </p>
        <p class="slogan text-muted">Unleashing Style, Redefining Fashion</p>
        <div class="w-75 d-flex justify-content-around mt-5 p-3">
          <button class="btn btn-outline-dark">
            <a href="./pages/men.php" class="text-decoration-none">shop men</a>
          </button>
          <button class=" btn btn-outline-dark ">
            <a href=" ./pages/women.php" class="text-decoration-none">shop women</a>
          </button>
        </div>
      </div>


      <!-- login section  -->
      <div class="container bg-white login" id="login">
        <!-- SIGN IN SECTION  -->
        <div class="container-fluid d-block py-5 px-3" id="sign-in">
          <h4>My Account</h4>
          <form action="./inc/handlers/login_handler.php" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <br />
              <input
                type="email"
                class="form-control border border-1 border-dark"
                id="exampleInputEmail1"
                name="email" />
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input
                type="password"
                class="form-control border border-1 border-dark"
                id="exampleInputPassword1"
                name="pwd" />
            </div>
            <small class="d-block mb-2 text-danger"><a href="">forgot your password ?</a></small>
            <button
              type="submit"
              name="submit"
              class="btn btn-outline-dark display-block w-100">

              Login
            </button>
          </form>
          <div class="mt-5">
            <hr class="" />
            <h4 class="mt-3">SIGN UP</h4>
            <button
              class="btn btn-outline-dark display-block w-100 mt-3"
              onclick="showSignup()">
              SIGN UP NOW
            </button>
          </div>
        </div>

        <!-- SIGN UP SECTION  -->
        <div class="container-fluid d-block d-none py-5 px-3" id="sign-up">
          <h4>SIGN UP</h4>
          <form action="./inc/handlers/register_handler.php" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">FIRST NAME *</label>
              <input
                type="text"
                class="form-control border border-1 border-dark"
                name="fname" />
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">LAST NAME *</label>
              <input
                type="text"
                class="form-control border border-1 border-dark"
                name="lname" />

            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">EMAIL *</label>
              <input
                type="email"
                class="form-control border border-1 border-dark"
                name="email" />
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">PASSWORD *</label>
              <input
                type="password"
                class="form-control border border-1 border-dark"
                name="pwd" />
            </div>

            <button type="submit" name="submit" class="btn btn-outline-dark display-block w-100">
              SIGN UP NOW!
            </button>
          </form>
          <div class="mt-5">
            <hr class="" />
            <button
              class="btn btn-outline-dark display-block w-100 mt-3"
              onclick="showLogin()">
              RETURN TO STORE
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="trusted-brands">
    <div class="container-fluid">
      <div class="brand-container">
        <img
          src="https://img.logo.dev/Prada.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 1"
          class="brand-logo" />
        <img
          src="https://img.logo.dev/adidas.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 2"
          class="brand-logo" />
        <img
          src="https://img.logo.dev/next.co.uk?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 3"
          class="brand-logo" />
        <img
          src="https://img.logo.dev/converse.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 4"
          class="brand-logo" />
        <img
          src="https://img.logo.dev/dior.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 5"
          class="brand-logo" />
        <img
          src="https://img.logo.dev/sablecard.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 6"
          class="brand-logo" />

        <img
          src="https://img.logo.dev/carbon38.com?token=pk_CxZ_18mkTfacSXZv3gB7og"
          alt="Brand 2"
          class="brand-logo" />
      </div>
    </div>
  </section>

  <!-- New Collection Start  -->
  <div class="container-fluid new-collections">

    <div class="d-flex justify-content-center align-items-center">
      <h1 class="main-title display-5 mt-5 text-center d-block w-100 p-3">
        New Collections
      </h1>
    </div>

    <section class="py-5">
      <div
        id="carouselExampleSlidesOnly"
        class="carousel slide col-3 row"
        data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="./assets/img/low-quality/slidew01.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidew01.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Fashion shapes the way we present ourselves to the world.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidew02.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidew02.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Beauty is the harmony of inner confidence and outer expression.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidew03.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidew03.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Elegance is crafted when self-expression meets timeless design.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div
        id="carouselExampleSlidesOnly"
        class="carousel slide col-4 row"
        data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="./assets/img/low-quality/slidem01.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidem01.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Fashion and beauty are the perfect blend of style and self-expression.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidem02.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidem02.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Style and beauty come together to highlight the best version of ourselves.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidem03.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidem03.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              True beauty radiates when confidence meets creativity in style.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div
        id="carouselExampleSlidesOnly"
        class="carousel slide col-3 row"
        data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="./assets/img/low-quality/slidek01.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidek01.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />

            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Where style meets grace, beauty is born.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidek02.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidek02.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Beauty emerges when personality is woven into every detail.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="./assets/img/low-quality/slidek03.jpg"
              data-sizes="auto"
              data-src="./assets/img/slidek03.jpg"
              class="lazyload blur-up d-block w-100"
              alt="Example Image 3" />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              Style thrives when individuality is woven into every thread.
              </p>
            </div>
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>
              True style is revealed when confidence is tailored to perfection.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Banner  -->
  <div>
    <img src="./assets/img/KOKO.gif" alt="">
  </div>


  <!-- Category Start  -->
  <div class="container-fluid category ">
    <div class="d-flex justify-content-center align-items-center">
      <h1 class="main-title mt-5 text-center d-block w-100 p-3">
        Shop By Category
      </h1>
    </div>
    <div id="category-grid" class="mt-5">
      <div id="div1">
        <a href="google.lk" class="linkurl">Denims</a>
        <img src="./assets/img/low-quality/categories/cwDenims.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cwDenims.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div3">
        <a href="google.lk" class="linkurl">Dresses</a>
        <img src="./assets/img/low-quality/categories/cwDresses.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cwDresses.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div9">
        <a href="google.lk" class="linkurl">Shirts</a>
        <img src="./assets/img/low-quality/categories/cmShirts.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cmShirts.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div10">
        <a href="google.lk" class="linkurl">T-Shirts</a>
        <img src="./assets/img/low-quality/categories/cwTshirts.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cwTshirts.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div11">
        <a href="google.lk" class="linkurl">Tops</a>

        <img src="./assets/img/low-quality/categories/cwTops.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cwTops.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div13">
        <a href="google.lk" class="linkurl">Crop Tops</a>
        <img src="./assets/img/low-quality/categories/cwCropTops.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cwCropTops.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
      <div id="div12">
        <a href="google.lk" class="linkurl">T-Shirts</a>
        <img src="./assets/img/low-quality/categories/cmTshirts.webp"
          data-sizes=" auto"
          data-src="./assets/img/categories/cmTshirts.webp"
          class="lazyload blur-up "
          alt="Example Image 3" />
      </div>
    </div>

    <div class="d-flex justify-content-center align-items-center ">
      <h1 class="main-title mt-5 text-center d-block w-100 p-3">
        New Arrivals
      </h1>
    </div>

    <!-- Category Section -->
    <h3 class="text-center text-capitalize mb-4 text-white">
      <span
        class="mx-2 text-decoration-none text-success cursor-pointer"
        onclick="changeSection('men' , event)"
        id="menatag">MENS
      </span>
      <span
        class="mx-2 text-decoration-none cursor-pointer"
        onclick="changeSection('women',
          event)"
        id="womenatag">WOMEN
      </span>
    </h3>
    <div class="container d-none" id="women">
      <h3 class="d-flex justify-content-end mb-5">
        <button type="button" class="btn btn-outline-primary">
          <a href="./pages/women.php" class="text-decoration-none">See All</a>
        </button>
      </h3>
      <div class="d-flex flex-wrap gap-4">
        <?php
        foreach ($wProducts as $product) {

          $productPrice = $product["price"];
          $imgName = $product["image_url"];
          $productTitle = $product["product_name"];
          $imgPathOrg = "./assets/img/$imgName";
          $imgPathLow = "./assets/img/low-quality/$imgName";
          $productId = $product["product_id"];

          include "./partials/productCard.php";
        }

        ?>
      </div>
    </div>

    <div class="container pb-5" id="men">
      <h3 class="d-flex justify-content-end mb-5">
        <button type="button" class="btn btn-outline-primary"><a href="./pages/men.php" class="text-decoration-none">See All</a></button>
      </h3>

      <div class="gap-4  d-flex flex-wrap">
        <?php
        foreach ($mProducts as $product) {

          $productPrice = $product["price"];

          $imgName = $product["image_url"];
          $productTitle = $product["product_name"];
          $imgPathOrg = "./assets/img/$imgName";
          $imgPathLow = "./assets/img/low-quality/$imgName";
          $productId = $product["product_id"];


          include "./partials/productCard.php";
        }

        ?>
      </div>
    </div>
  </div>

  <div class="bg-dark text-white discount">
    <img src="./assets/img/low-quality/fl.jpg"
      data-sizes=" auto"
      data-src="./assets/img/fl.jpg"
      class="lazyload blur-up img-0"
      alt="Example Image 3" />
    <p class="text text-white">
      Get 25% Discount on your first purchase.
      Just Sign Up & Register it now to become member.
      <button class="btn btn-primary">Signup Now</button>
    </p>
  </div>

  <!-- Footer Start  -->
  <footer class=" bg-dark text-white">
    <?php
    $imgPathForFooter = "./assets/img/";

    include_once "./partials/footer.php";
    ?>
  </footer>



  <!-- Lazysizes  -->
  <script src="./node_modules/lazysizes/lazysizes.min.js" async=""></script>

  <!-- Lazysizes CDN -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
    integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>


  <!-- Bootstrap  CDN  -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <!-- SweetAlert2 for enhanced alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- External JS  -->
  <script src="./assets/js/index.js"></script>

  <!-- Ajax For Handling Wishlist  -->


  <!-- SweetAlert2 for enhanced alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="./assets/js/ajax.js"></script>


  <script src="../zulo/assets/js/search.js"></script>
</body>

</html>