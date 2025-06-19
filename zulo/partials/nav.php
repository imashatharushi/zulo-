<?php


$login = false;
$email = '';

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $userID = $_SESSION["user_id"];
    $login = true;

    // Assuming you already have a database connection as $conn
    $stmt = $conn->prepare("SELECT image FROM users WHERE user_id = :userID");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Fetch the user's profile image
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && !empty($result['image'])) {
        $profileImage = $result['image'];
    } else {
        // Default image if no profile image is set
        $profileImage = 'default.jpg';
    }
}



?>

<div class="bg-secondary text-white d-flex justify-content-center align-content-center ">
    <div class="container">
        <div id="carouselContent" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active text-center p-2">
                    <small class="text-white">
                        DELIVERY UPDATE - Kindly expect delivery times of 4-5 working days
                    </small>
                </div>
                <div class="carousel-item text-center p-2">
                    <small>
                        <span class="text-capitalize">Non-exchangeable</span> - items purchased on discount are not exchangeable
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-0 navigation ">
    <nav class="navbar navbar-expand-lg bg-body-light shadow p-0 sticky-top navbar-inverse">
        <div class="container-fluid p-0 d-flex">
            <div class="col-3 row">
                <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item d-flex justify-content-center align-items-center position-relative">
                                <div onclick="searchToggle()" class="h-100 d-flex justify-content-center search-btn">
                                    <button class="btn bg-white" data-toggle="tooltip" data-placement="top" title="Search" style="width: 50px">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                                <input type="search" class="p-2 text-black search-bar bg-light" id="search-bar" name="searchQuery" placeholder="Search..." />
                                <p class="search-result bg-white"></p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center ">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 h6 justify-content-end flex-grow-1 ">
                    <li class="nav-item">
                        <?php
                        $homePage = isset($homePage) ? $homePage : '../../../zulo/';
                        $menPage = isset($menPage) ? $menPage : '../../../zulo/pages/men.php';
                        $womenPage = isset($womenPage) ? $womenPage : '../../../zulo/pages/women.php';
                        $logoutPage = isset($logoutPage) ? $logoutPage : '../../../zulo/inc/handlers/logout_handler.php';
                        $cartPage = isset($cartPage) ? $cartPage : '../../zulo/pages/cart.php';

                        ?>
                        <a class="nav-link active" aria-current="page" href="<?php echo $homePage ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-black dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu bg-transparent" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="<?php echo $menPage ?>">Men</a></li>
                                <li><a class="dropdown-item" href="<?php echo $womenPage ?>">Women</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <a class="text-decoration-none" href="#">
                    <span class="display-5 z-text">&nbsp;Z</span><span class="ulo-text h3">ulo</span>
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-start h6  flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gift</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sale</a>
                    </li>
                </ul>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center pe-4 ">
                <div class="d-flex justify-content-end gap-2 ms-2 control-center">
                    

                    <div>
                        <a href="<?php echo $cartPage ?>">
                            <button class="btn btn-outline-dark cart-btn" data-toggle="tooltip" data-placement="top" title="cart">
                                <i class="bi bi-bag-fill"></i>
                                <span class="cart-items">
                                    <?php
                                    if ($login) {
                                        $sql = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = :user_id";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
                                        $stmt->execute();

                                        // Fetch the total items count
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $itemCount = $result['total_items'] ? $result['total_items'] : 0; // Set
                                        echo $itemCount;
                                    }
                                    ?>
                                </span>
                            </button>
                        </a>
                    </div>
                    <div>
                        <?php
                        if ($login) {
                            $profilePage = isset($profilePage) ? $profilePage : '../pages/profile/';
                            $imgFolder = isset($imgFolder) ? $imgFolder : '../../../zulo/assets/img/userProfile/';


                        ?>
                            <a href="<?php echo  $profilePage ?>">
                                <button class="btn btn-outline-white p-0" data-toggle="tooltip" data-placement="top" title="profile">
                                    <img src="<?php echo $imgFolder . $profileImage ?>" alt="" class="p-image">
                                </button>
                            </a>
                        <?php
                        } else {
                            $loginPage = isset($loginPage) ? $loginPage : '../pages/login.php'; ?>
                            <a href="<?php echo $loginPage ?>">
                                <button class="btn btn-outline-dark" data-toggle="tooltip" data-placement="top" title="profile">
                                    <i class="bi bi-person-circle"></i>
                                </button>
                            </a>
                        <?php  }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<?php if ($login): ?>
    <div class="bg-bg-transparent p-2 d-flex justify-content-end align-items-center logout">
        <span class="btn btn-primary text-white btn-sm fw-bold">
            <a href="<?php echo $profilePage ?>" class="text-decoration-none">
                <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </span>
        <a href="<?php echo $logoutPage ?>" class="ms-4" id="logout">
            <button class="btn btn-danger text-white btn-sm fw-bold" data-toggle="tooltip" data-placement="top" title="Log Out">
                Log Out
            </button>
        </a>
    </div>
<?php endif; ?>