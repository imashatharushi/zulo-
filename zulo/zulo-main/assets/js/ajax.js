function addToWishlist(event, productId) {
  if (productId == 0) {
    window.location.href = '../../../zulo/pages/login.php';
  } else {
    if (event.target.classList.contains('bi-heart-fill')) {
      const xhr = new XMLHttpRequest();
      xhr.open(
        'GET',
        `../../../zulo/inc/handlers/wishlist_handler.php?cart=false&product_id=${event.target.dataset.product_id}`,
        true
      );
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
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
        `../../../zulo/inc/handlers/wishlist_handler.php?cart=true&product_id=${event.target.dataset.product_id}`,
        true
      );
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
        if (this.status === 200) {
          Swal.fire({
            title: 'Success!',
            text: 'Product added to Wishlist',
            icon: 'success',
            footer:
              '<a href="../../../zulo/pages/profile/wishlist.php">View Wishlist</a>'
          });
        }
      };

      xhr.send();
    }

    event.target.classList.toggle('bi-heart');
    event.target.classList.toggle('bi-heart-fill');
  }
}

function addToCart(productId) {
  if (productId == 0) {
    window.location.href = '../../../zulo/pages/login.php';
  } else {
    const xhr = new XMLHttpRequest();
    xhr.open(
      'GET',
      `../../../zulo/inc/handlers/cart_handler.php?product_id=${productId}`,
      true
    );
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
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
}

function buyNow(event, productId) {
  const result = confirm('are you sure want to buy this product?');
  if (result) {
    window.location.href = `../../../zulo/pages/buyNow.php?product_id=${productId}`;
  }
}
