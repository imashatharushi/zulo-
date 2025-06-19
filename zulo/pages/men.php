   <?php
    session_start();
    include_once "../inc/db.php";

    $sql = "SELECT product_id,product_name, description, price, stock_quantity, image_url, sku FROM products WHERE category_id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


    ?>

   <!doctype html>
   <html lang="en">

   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Mens - Zulo</title>
       <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

       <!-- Bootstrap CDN -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

       <!-- External CSS  -->
       <link rel="stylesheet" href="../assets/css/addCategories.min.css">
       <link rel="stylesheet" href="../assets/css/men.min.css">
       <link rel="stylesheet" href="../assets/css/reset.min.css">
       <link rel="stylesheet" href="../assets/css/nav.min.css">
       <link rel="stylesheet" href="./assets/css/footer.min.css">


       <!-- Font Awesome CDN  -->
       <link
           rel="stylesheet"
           href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
           integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
           crossorigin="anonymous" />

       <style>
           .styled-radio {
               appearance: none;
               width: 20px;
               height: 20px;
               border-radius: 50%;
               border: 2px solid #007bff;
               outline: none;
               cursor: pointer;
               position: relative;
           }

           .styled-radio:checked {
               background-color: #007bff;
           }

           .styled-radio:checked::before {
               content: '';
               display: block;
               width: 12px;
               height: 12px;
               border-radius: 50%;
               background-color: white;
               position: absolute;
               top: 3px;
               left: 3px;
           }
       </style>
   </head>

   <body>

       <div class="container-fluid m-0 p-0 full-body d-flex flex-column">
           <!-- Navigation  -->
           <header>

               <?php
                include_once "../partials/nav.php";
                ?>
           </header>
       </div>

       <div id="carouselExampleIndicators" class="carousel slide mb-5 carousel-slider">
           <div class="carousel-indicators">
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
               <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
           </div>
           <div class="carousel-inner h-100">
               <div class="carousel-item active">
                   <img src="../assets/img/menpageslide03.jpg" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item">
                   <img src="../assets/img/menpageslide02.jpg" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item">
                   <img src="../assets/img/menpageslide01.jpg" class="d-block w-100" alt="...">
               </div>
           </div>
           <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
           </button>
           <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
           </button>
       </div>

       <div class="container d-flex product-section">
           <div class="col-3 border-end border-secondary">
               <div class="form-check  d-flex flex-wrap flex-column pt-5 bg-light">
                   <h5 class="">FILTER OPTIONS</h1>
                       <div class="my-2 p-2">
                           <input class="form-check-input styled-radio" type="radio" id="radio1" name="sort" value="ASC" checked onclick="sortProducts('ASC',1)">
                           <label class="form-check-label" for="radio1" onclick="sortProducts('ASC')">Price: Low to High</label> <br>
                       </div>
                       <div class="my-2 p-2">
                           <input class="form-check-input styled-radio" type="radio" id="radio2" name="sort" value="DESC" onclick="sortProducts('DESC',1)">
                           <label class="form-check-label" for="radio2" onclick="sortProducts('DESC')">Price: High to Low</label>
                       </div>
                       <div class="mt-5">
                           <h5 class="">MEN CLOTHES CATEGORIES</h1>
                               <div class="form-check d-flex flex-wrap flex-column bg-light">
                                   <div class="my-2 p-2">
                                       <input class="form-check-input" type="radio" id="tshirts" name="category" value="T-SHIRTS" onclick="filterProducts('tShirts',event)">
                                       <label class="form-check-label" for="tshirts" onclick="filterProducts('tShirts',event)">T-SHIRTS</label> <br>
                                   </div>
                                   <div class="my-2 p-2">
                                       <input class="form-check-input" type="radio" id="shirts" name="category" value="SHIRTS" onclick="filterProducts('shirts',event)">
                                       <label class="form-check-label" for="shirts" onclick="filterProducts('shirts',event)">SHIRTS</label>
                                   </div>
                                   <div class="my-2 p-2">
                                       <input class="form-check-input" type="radio" id="casual-Shirts" name="category" value="casual-shirts" onclick="filterProducts('casual-shirts',event)">
                                       <label class="form-check-label" for="casual-Shirts" onclick="filterProducts('casualShirts',event)">CASUAL SHIRTS</label>
                                   </div>
                               </div>
                       </div>
               </div>
           </div>
           <div class="col-9 d-flex flex-wrap gap-4 " id="clothes_div">
               <?php
                foreach ($products as $product) {

                    $productPrice = $product["price"];
                    $imgName = $product["image_url"];
                    $productTitle = $product["product_name"];
                    $imgPathOrg = "../assets/img/$imgName";
                    $imgPathLow = "../assets/img/low-quality/$imgName";
                    $productId = $product["product_id"];

                    include "../partials/productCard.php";
                }
                ?>
           </div>
       </div>

       <!-- Footer Start  -->
       <footer>
           <?php
            $imgPathForFooter = "../assets/img/";

            include_once "../partials/footer.php"
            ?>
       </footer>

       <!-- External JS  -->
       <script src="../assets/js/index.js"></script>

       <!-- Bootstrap CDN -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

       <!-- Lazysizes  -->
       <script src="./node_modules/lazysizes/lazysizes.min.js" async=""></script>

       <!-- Lazysizes CDN -->
       <script
           src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
           integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
           crossorigin="anonymous"
           referrerpolicy="no-referrer"></script>


       <!-- SweetAlert2 for enhanced alerts -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

       <!-- Ajax For Handling Wishlist and add to cart function  -->
       <?php
        if (isset($_SESSION["user_id"])) { ?>
           <script>
               function addToWishlist(event) {
                   if (event.target.classList.contains('bi-heart-fill')) {
                       const xhr = new XMLHttpRequest();
                       xhr.open(
                           'GET',
                           `../../zulo/inc/handlers/wishlist_handler.php?cart=false&product_id=${event.target.dataset.product_id}`,
                           true
                       );
                       xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                       xhr.onload = function() {
                           if (this.status === 200) {
                               Swal.fire({
                                   title: 'Success!',
                                   text: 'Product Removed From Wishlist',
                                   icon: 'success'
                               });
                           }
                       };

                       xhr.send();
                   } else if (event.target.classList.contains('bi-heart')) {
                       const xhr = new XMLHttpRequest();
                       xhr.open(
                           'GET',
                           `../../zulo/inc/handlers/wishlist_handler.php?cart=true&product_id=${event.target.dataset.product_id}`,
                           true
                       );
                       xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                       xhr.onload = function() {
                           if (this.status === 200) {
                               Swal.fire({
                                   title: 'Success!',
                                   text: 'Product added to Wishlist',
                                   icon: 'success',
                                   footer: '<a href="../pages/profile/wishlist.php">View Wishlist</a>'
                               });
                           }
                       };

                       xhr.send();
                   }

                   event.target.classList.toggle('bi-heart');
                   event.target.classList.toggle('bi-heart-fill');
               }

               function addToCart(productId) {
                   console.log(productId);
                   const xhr = new XMLHttpRequest();
                   xhr.open(
                       'GET',
                       `../../zulo/inc/handlers/cart_handler.php?product_id=${productId}`,
                       true
                   );
                   xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                   xhr.onload = function() {
                       if (this.status === 200) {
                           Swal.fire({
                               title: 'Success!',
                               text: 'Product added to cart',
                               icon: 'success'
                           });
                       }
                   };
                   xhr.send();
               }

               function buyNow(event, productId) {
                   const result = confirm('are you sure want to buy this product?');

                   if (result) {
                       window.location.href = `../../../zulo/pages/buyNow.php?product_id=${productId}`;
                   }
               }
           </script>
       <?php }
        ?>

       <script src="../assets/js/search.js"></script>
       <script src="../assets/js/filter.js"></script>


   </body>

   </html>