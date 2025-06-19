function sortProducts(method, page) {
  const menDiv = document.getElementById('clothes_div');
  menDiv.innerHTML = '';

  const xhr = new XMLHttpRequest();
  xhr.open(
    'GET',
    `../../../zulo/inc/handlers/filter_handler.php?sort=${method}&page=${page}`,
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      const products = JSON.parse(this.responseText);

      let timerInterval;

      Swal.fire({
        title: 'Loading...!',
        html: 'please wait...',
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          const timer = Swal.getPopup().querySelector('b');
          timerInterval = setInterval(() => {
            timer.textContent = `${Swal.getTimerLeft()}`;
          }, 100);
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          products.forEach((product) => {
            const imgPathOrg = `../assets/img/${product.image_url}`;
            const imgPathLow = `../assets/img/low-quality/${product.image_url}`;

            const productDiv = document.createElement('div');
            productDiv.className = 'product';

            productDiv.innerHTML = `
          <div class='card shadow-sm' style='width: 18rem; margin: 0 auto'>
    <a href='../../zulo/partials/productDetails.php?product_id=${product.productId}' class="text-decoration-none  d-block">
        <div>
            <img
                src="${imgPathLow}"
                data-sizes="auto"
                data-src="${imgPathOrg}"
                class="lazyload blur-up d-block w-100"
                alt="Example Image 3" />
        </div>
        <div class='card-body'>
            <!-- Product Title -->
            <h6 class='card-title text-center fw-bold text-uppercase mb-4'>
                ${product.product_name}
            </h6>
    </a>
    <!-- Price and Icons Section -->
    <div class='bg-light p-3 rounded shadow-sm'>
        <div
            class='d-flex justify-content-between align-items-center mb-3'>
            <span class='h5 fw-bold text-danger'> Rs. ${product.price}
            </span>
            <div class='d-flex gap-3 align-items-center'>
                <i class='bi bi-bag fs-5 text-dark'></i>
                <button class='btn' > <i class='bi ${product.heartClass} fs-5 text-danger' onclick='addToWishlist(event, ${product.productId})'   data-product_id='${product.productId}'></i></button>
            </div>
        </div>
        <!-- Buy Now Buttons -->
        <div class='d-flex justify-content-center gap-2'>
            <button class='btn btn-outline-danger' onclick="addToCart(${product.productId})">Add to Cart</button>
            <button class='btn btn-danger text-white' onclick="buyNow(event,${product.productId})">Buy Now</button>
        </div>
    </div>
</div>
        `;
            menDiv.appendChild(productDiv); // Append each product to the 'men' div
          });
        }
      });
    }
  };

  xhr.send();
}

function filterProducts(category, event) {
  const menDiv = document.getElementById('clothes_div');
  menDiv.innerHTML = ''; // Clear current content

  const xhr = new XMLHttpRequest();
  xhr.open(
    'GET',
    `../../../zulo/inc/handlers/filter_handler.php?category=${category}`,
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      const products = JSON.parse(this.responseText);

      let timerInterval;

      Swal.fire({
        title: 'Loading...!',
        html: 'please wait...',
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          const timer = Swal.getPopup().querySelector('b');
          timerInterval = setInterval(() => {
            timer.textContent = `${Swal.getTimerLeft()}`;
          }, 100);
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          products.forEach((product) => {
            const imgPathOrg = `../assets/img/${product.image_url}`;
            const imgPathLow = `../assets/img/low-quality/${product.image_url}`;

            const productDiv = document.createElement('div');
            productDiv.className = 'product';

            productDiv.innerHTML = `
          <div class='card shadow-sm' style='width: 18rem; margin: 0 auto'>
    <a href='../../zulo/partials/productDetails.php?product_id=${product.productId}' class="text-decoration-none  d-block">
        <div>
            <img
                src="${imgPathLow}"
                data-sizes="auto"
                data-src="${imgPathOrg}"
                class="lazyload blur-up d-block w-100"
                alt="Example Image 3" />
        </div>
        <div class='card-body'>
            <!-- Product Title -->
            <h6 class='card-title text-center fw-bold text-uppercase mb-4'>
                ${product.product_name}
            </h6>
    </a>
    <!-- Price and Icons Section -->
    <div class='bg-light p-3 rounded shadow-sm'>
        <div
            class='d-flex justify-content-between align-items-center mb-3'>
            <span class='h5 fw-bold text-danger'> Rs. ${product.price}
            </span>
            <div class='d-flex gap-3 align-items-center'>
                <i class='bi bi-bag fs-5 text-dark'></i>
                <button class='btn' > <i class='bi ${product.heartClass} fs-5 text-danger' onclick='addToWishlist(event, ${product.productId})'   data-product_id='${product.productId}'></i></button>
            </div>
        </div>
        <!-- Buy Now Buttons -->
        <div class='d-flex justify-content-center gap-2'>
            <button class='btn btn-outline-danger' onclick="addToCart(${product.productId})">Add to Cart</button>
            <button class='btn btn-danger text-white' onclick="buyNow(event,${product.productId})">Buy Now</button>
        </div>
    </div>
</div>
        `;
            menDiv.appendChild(productDiv); // Append each product to the 'men' div
          });
        }
      });
    }
  };

  xhr.send();
}
