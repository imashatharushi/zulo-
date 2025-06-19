<?php
session_start();
include_once "../../inc/db.php";
include_once '../../inc/function.php';

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $email = $_SESSION['email'];
}


$sql = "SELECT product_name, description, price, stock_quantity, image_url, sku ,product_id
        FROM products;";

$stmt = $conn->prepare($sql);
$stmt->execute();

$Products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Manage Products - Zulo Admin</title>

  <link rel="icon" type="image/png" href="../../assets/img/favicon-48x48.png" sizes="48x48" />
  <link rel="icon" type="image/svg+xml" href="../../assets/img/favicon.svg" />
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/apple-touch-icon.png" />
  <link rel="manifest" href="../../assets/img/site.webmanifest" />

  <link href="css/styles.css" rel="stylesheet" />

  <script
    src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
    crossorigin="anonymous"></script>

  <!-- Bootstrap CDN  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- External CSS  -->
  <link rel="stylesheet" href="../../assets/css/reset.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Welcome <br> <?php echo $_SESSION['firstName']; ?></a>
    <!-- Sidebar Toggle-->
    <button
      class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
      id="sidebarToggle"
      href="#!">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form
      class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input
          class="form-control"
          type="text"
          placeholder="Search for..."
          aria-label="Search for..."
          aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          id="navbarDropdown"
          href="#"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="#!">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Dashboard
            </a>
            <a
              class="nav-link collapsed"
              href="../../index.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-home"></i>
              </div>
              Home
            </a>
            <a
              class="nav-link collapsed"
              href="#"
              data-bs-toggle="collapse"
              data-bs-target="#collapseLayouts"
              aria-expanded="false"
              aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon">
                <i class="fas fa-columns"></i>
              </div>
              Manage
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>

            <div
              class="collapse"
              id="collapseLayouts"
              aria-labelledby="headingOne"
              data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="users.php">Users</a>
                <a class="nav-link" href="products.php">Products</a>
                <a class="nav-link" href="category.php">Category</a>
                <a class="nav-link" href="subCategory.php">Sub Category</a>
              </nav>
            </div>
            <div
              class="collapse"
              id="collapsePages"
              aria-labelledby="headingTwo"
              data-bs-parent="#sidenavAccordion">
              <nav
                class="sb-sidenav-menu-nested nav accordion"
                id="sidenavAccordionPages">
                <a
                  class="nav-link collapsed"
                  href="#"
                  data-bs-toggle="collapse"
                  data-bs-target="#pagesCollapseAuth"
                  aria-expanded="false"
                  aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                  </div>
                </a>
                <div
                  class="collapse"
                  id="pagesCollapseAuth"
                  aria-labelledby="headingOne"
                  data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="login.html">Login</a>
                    <a class="nav-link" href="register.html">Register</a>
                    <a class="nav-link" href="password.html">Forgot Password</a>
                  </nav>
                </div>
                <a
                  class="nav-link collapsed"
                  href="#"
                  data-bs-toggle="collapse"
                  data-bs-target="#pagesCollapseError"
                  aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  Error
                  <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                  </div>
                </a>
                <div
                  class="collapse"
                  id="pagesCollapseError"
                  aria-labelledby="headingOne"
                  data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="401.html">401 Page</a>
                    <a class="nav-link" href="404.html">404 Page</a>
                    <a class="nav-link" href="500.html">500 Page</a>
                  </nav>
                </div>
              </nav>
            </div>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as: <br> <?php echo $email ?>
            <br>
            <button class="btn-danger btn btn-sm rounded-pill mt-4" type="button"><a href="../../inc/handlers/logout_handler.php" class="text-decoration-none text-white">logout</a></button>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Manage Products</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Products</li>
          </ol>
          <!-- !content -->
          <h3 class="mt-4 mb-3 bg-dark text-light p-2">All Products</h3>
          <div class="container d-flex flex-wrap flex-column product-container">
            <table class="table align-middle mb-0 bg-white">
              <thead class="bg-light text-capitalize">
                <tr>
                  <th class="text-center">Product Image</th>
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($Products as $product) {

                  $productPrice = $product["price"];
                  $imgName = $product["image_url"];
                  $productTitle = $product["product_name"];
                  $imgPath = "../../assets/img/$imgName";
                  $productId = $product["product_id"];
                ?>
                  <tr>
                    <form method="GET" class="updateProduct">
                      <td>
                        <div class="d-flex justify-content-center align-items-center">
                          <img
                            src="<?php echo $imgPath; ?>"
                            alt=""
                            style="width: 45px; height: 45px; object-position: top center;"
                            class="rounded-circle object-fit-cover " />
                        </div>
                        <div></div>
                      </td>
                      <td scope="row">
                        <input type="text" name="productName" class="fw-normal mb-1" value="<?php echo $productTitle; ?>"> <br>
                        <label for="" class="text-muted">Product Id:</label>
                        <input class="text-muted" name="productId" value="<?php echo $productId; ?>"></input>
                      </td>
                      <td><input type="text" name="productPrice" value="<?php echo $productPrice; ?>"></td>
                      <td>
                        <button class="btn btn-success" name="update">Update</button>
                        <button class="btn btn-danger deleteBtn" onclick="deleteProduct(event, <?php echo $productId; ?>)">Delete</button>
                      </td>
                    </form>
                  </tr>
                <?php  } ?>

              </tbody>
            </table>
          </div>
          <section>
            <!-- Update the form with the correct method and action -->
            <form class="col-12 my-0 " action="../../inc/handlers/admin/addProducts.php" method="post" enctype="multipart/form-data">
              <h3 class="mt-4 mb-3 bg-dark text-light p-2">Add New Product</h3>
              <div class="px-3 mt-5">
                <div class="mb-3">
                  <label for="productName" class="form-label">Product Name</label>
                  <input type="text" class="form-control" id="productName" name="productName" aria-describedby="productNameHelp" required>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" placeholder="Leave a description here" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="text" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                  <label for="stock" class="form-label">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="mb-3">
                  <label for="sku" class="form-label">sku</label>
                  <input type="text" class="form-control" id="sku" name="sku" required>
                </div>
                <div class="mb-3">
                  <label for="uploadImage" class="form-label">Image</label>
                  <input type="file" class="form-control" id="uploadImage" name="uploadImage" required>
                </div>
                <div class="mb-3">
                  <label for="category" class="form-label">Categories</label>
                  <select class="form-control" id="category" name="category">
                    <?php
                    // Fetch main categories
                    $sqlMainCategories = "SELECT id, main_category_name FROM maincategories";
                    $stmtMainCategories = $conn->prepare($sqlMainCategories);
                    $stmtMainCategories->execute();
                    $maincategories = $stmtMainCategories->fetchAll(PDO::FETCH_ASSOC);

                    // Populate dropdown with main categories
                    foreach ($maincategories as $category) {
                      echo "<option value='" . $category['id'] . "'>" . $category['main_category_name'] . "</option>";
                    }
                    ?>
                  </select>


                </div>
                <div class="mb-3">
                  <label for="subCategories" class="form-label">Sub Categories</label>
                  <select class="form-control" id="subCategories" name="subCategories">
                    <?php
                    // Fetch subcategories
                    $sqlSubCategories = "SELECT category_id, subCategoryName FROM subcategories";
                    $stmtSubCategories = $conn->prepare($sqlSubCategories);
                    $stmtSubCategories->execute();
                    $subCategories = $stmtSubCategories->fetchAll(PDO::FETCH_ASSOC);

                    // Populate dropdown with subcategories
                    foreach ($subCategories as $subCategory) {
                      echo "<option value='" . $subCategory['subCategoryName'] . "'>" . $subCategory['subCategoryName']  . "</option>";
                    }
                    ?>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </section>
          <!-- ! end content -->
          <div class="card mb-4">
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div
            class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Zulo 2024</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <!-- Jquery CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js' integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==' crossorigin='anonymous'></script>
  <!-- Bootstrap CDN  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- SweetAlert2 CDN  -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- External JS  -->
  <script src="../../assets/js/admin.js"></script>
  <script src="../../assets/js/updateProduct.js"></script>
  <script src="../../assets/js/deleteProducts.js"></script>
  <script src="../../assets/js/deleteUser.js"></script>
</body>

</html>