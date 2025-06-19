<div class='card shadow-sm' style='width: 18rem; margin: 0 auto'>
    <a href='../../partials/admin/productDetails.php?product_id=<?php echo $productId ?>' class="text-decoration-none  d-block">

        <div>
            <img
                src='<?php echo $imgPath ?>'
                data-sizes='auto'
                alt='Example Image 3' />
        </div>
        <div class='card-body'>
            <!-- Product Title -->
            <h6 class='card-title text-center fw-bold text-uppercase mb-4'>
                <?php echo $productTitle ?>
            </h6>
    </a>
    <!-- Price and Icons Section -->
    <div class='bg-light p-3 rounded shadow-sm'>
        <div
            class='d-flex justify-content-between align-items-center mb-3'>
            <span class='h5 fw-bold text-danger'> Rs. <?php echo $productPrice ?>
            </span>
            <div class='d-flex gap-3 align-items-center'>
                <i class='bi bi-bag fs-5 text-dark'></i>
            </div>
        </div>
        <!-- Buy Now Buttons -->
        <div class='d-flex justify-content-center gap-2'>
            <a href="../../zulo/inc/handlers/cart_handler.php?product_id=<?php echo $productId ?>">
                <button class='btn btn-outline-danger'>Add to Cart</button>
            </a>
            <button class='btn btn-danger text-white'>Buy Now</button>
        </div>
    </div>
</div>

</div>