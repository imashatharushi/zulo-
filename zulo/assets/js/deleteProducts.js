// deleteProduct(event, <?php echo $productId; ?>)

function deleteProduct(event, productId) {
  const xhr = new XMLHttpRequest();
  xhr.open(
    'GET',
    `../../inc/handlers/deleteProduct_handler.php?productId=${productId}`,
    true
  );
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.status === 200) {
      alert('deleted');
    }
  };
  xhr.send();
}
