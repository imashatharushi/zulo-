<?php
session_start();
include_once "../../inc/db.php";
include_once '../../inc/function.php';

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
  $email = $_SESSION['email'];
}
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
  <title>Manage Users - Zulo Admin</title>

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
          <h1 class="mt-4">Manage Users</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Users</li>
          </ol>
          <!-- !content -->
          <h5 class="text-capitalize">filter users by roll</h3>
            <div class="form-group mb-4">
              <select
                class="form-select"
                name="userType"
                id="userType"
                onchange="filterUsers(event)">
                <option value="all">All</option>
                <option value="user">Users</option>
                <option value="admin">Admins</option>
              </select>
            </div>



            <table class="table align-middle mb-0 bg-white">
              <thead class="bg-light text-capitalize">
                <tr>
                  <th>Name</th>
                  <th>phone number</th>
                  <th>address</th>
                  <th>city</th>
                  <th>zip</th>
                  <th>province</th>
                  <th>roll</th>
                  <th>active</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody id="userTable">
                <?php
                // SQL query to fetch all user details
                $sql = "SELECT * FROM users"; // You can modify this to select specific fields if needed
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Check if any users are found
                if (count($users) > 0) {
                  foreach ($users as $user) {
                ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <img
                            src="../../assets/img/userProfile/<?php echo htmlspecialchars($user["image"]) ?>"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle" />
                          <div class="ms-3">
                            <p class="fw-bold mb-1"><?php echo htmlspecialchars($user["first_name"]) ?> <span class="badge rounded-pill bg-primary"><?php echo htmlspecialchars($user["roll"]) ?></span> </p>
                            <p class="text-muted mb-0"><?php echo htmlspecialchars($user["email"]) ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="fw-normal mb-1"><?php echo htmlspecialchars($user["phone_number"]) ?></p>
                      </td>
                      <td>
                        <p class="fw-normal mb-1"><?php echo htmlspecialchars($user["address"]) ?></p>
                      </td>
                      <td>
                        <p class="fw-normal mb-1"><?php echo htmlspecialchars($user["city"]) ?></p>
                      </td>
                      <td>
                        <p class="fw-normal mb-1"><?php echo htmlspecialchars($user["postal_code"]) ?></p>
                      </td>
                      <td>
                        <p class="fw-normal mb-1"><?php echo htmlspecialchars($user["province"]) ?></p>
                      </td>
                      <td>
                        <select name="roll" id="roll" name="roll" for="roll" onchange="updateUserRoll(event,<?php echo htmlspecialchars($user['user_id']) ?>)" class="form-select form-select-sm" style="width: 100px">
                          <option value="user" name="roll">user</option>
                          <option value="admin" name="roll">admin</option>
                        </select>
                      </td>
                      <td>
                        <form method="POST" action="../../inc/handlers/admin/update_user_status.php">
                          <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user["user_id"]) ?>">
                          <div>
                            <input type="checkbox" name="account_status" value="1" <?php echo ($user["account_status"] == 1 ? 'checked' : '') ?> onchange="this.form.submit()" />
                          </div>
                        </form>
                      </td>
                      <td>
                        <a href="#" class="btn btn-danger btn-sm rounded-pill" onclick="deleteUser(event, <?php echo htmlspecialchars($user['user_id']) ?>)">Delete</a>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo '<p>No users found.</p>';
                }
                ?>

              </tbody>
            </table>

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
  <script>
    function filterUsers(event) {
      console.log(event.target.value)
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `../../inc/handlers/admin/filterUsers.php?userType=${event.target.value}`, true);
      xhr.onload = function() {
        if (this.status === 200) {
          document.getElementById('userTable').innerHTML = this.responseText;
        }
      };
      xhr.send();
    }

    function updateUserRoll(event, userId) {
      const roll = event.target.value;
      console.log(roll);
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `../../inc/handlers/admin/updateUserRoll.php?userId=${userId}&roll=${roll}`, true);
      xhr.onload = function() {
        if (this.status === 200) {
          Swal.fire({
            title: 'Success!',
            text: 'Change User Roll',
            icon: 'success'
          });
        }
      }
      xhr.send();
    }
  </script>
</body>

</html>