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
       <link rel="stylesheet" href="../assets/css/women.min.css">
       <link rel="stylesheet" href="../assets/css/reset.min.css">
       <link rel="stylesheet" href="../assets/css/nav.min.css">
       <link rel="stylesheet" href="./assets/css/footer.min.css">

       <!-- Font Awesome CDN  -->
       <link
           rel="stylesheet"
           href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
           integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
           crossorigin="anonymous" />


   </head>

   <body class="p-0">

       <div class="container-fluid m-0 p-0 full-body d-flex flex-column">
           <!-- Navigation  -->
           <header>
               <?php
                include_once "../partials/nav.php";
                ?>
           </header>
       </div>

       <div class="bg-dark text-white text-center p-5 mt-5 d-flex justify-content-center align-items-center flex-column">
           <h1 class="p-3 display-1">404</h1>
           <h3 class="p-3">
               The page you're looking for doesn't exist or probably moved somewhere...
           </h3>
           <h6 class="p-3 ">
               Please back to homepage or check our offer
           </h6>
           <button class="btn btn-primary mb-5"><a href="../index.php">Go back to home page</a></button>

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




       <script src="../assets/js/search.js"></script>


   </body>

   </html>