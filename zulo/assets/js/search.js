const SearchInput = document.querySelector('#search-bar');
const searchResult = document.querySelector('.search-result');

SearchInput.addEventListener('keyup', (event) => {
  const xhr = new XMLHttpRequest();
  xhr.open(
    'GET',
    `../../../zulo/inc/handlers/search_handler.php?searchQuery=${event.target.value}`,
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      const data = JSON.parse(this.responseText);

      searchResult.innerHTML = '';

      data.forEach((item) => {
        const imgPathOrg = `../../../zulo/assets/img/${item['image_url']}`;
        const output = `
        <a href="../../../zulo/partials/productDetails.php?product_id=${item['product_id']}">
        <img src="${imgPathOrg}">
        ${item['product_name']}
        </a>`;
        searchResult.innerHTML += output;

        if (event.target.value.length == 0) {
          searchResult.innerHTML = '';
        }
      });
    }
  };

  xhr.send();
});
