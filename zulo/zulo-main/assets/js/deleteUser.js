function deleteUser(event, userId) {
  const xhr = new XMLHttpRequest();
  xhr.open(
    'GET',
    `../../../zulo/inc/handlers/admin/deleteUser_handler.php?id=${userId}`,
    true
  );
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.status === 200) {
      Swal.fire({
        title: 'User Removed!',
        text: 'User removed successfully',
        icon: 'success'
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });
    }
  };
  xhr.send();
}
