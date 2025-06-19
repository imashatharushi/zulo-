const updateProductForms = document.querySelectorAll('.updateProduct');

updateProductForms.forEach((form) => {
  const updateBtn = form.update;

  updateBtn.addEventListener('click', (event) => {
    event.preventDefault();

    Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        const productId = form.productId.value;

        const xhr = new XMLHttpRequest();
        xhr.open(
          'GET',
          `../../../zulo/inc/handlers/updateProduct_handler.php?name=${form.productName.value}&price=${form.productPrice.value}&productId=${productId}`,
          true
        );

        xhr.onload = function () {
          if (this.status === 200) {
            Swal.fire({
              title: 'Success!',
              text: 'Product Updated!',
              icon: 'success'
            });
          }
        };

        xhr.send();
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info');
      }
    });
  });
});
