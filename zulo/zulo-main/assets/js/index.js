const logout = document.getElementById('logout');

logout.addEventListener('click', (event) => {
  event.preventDefault();
  Swal.fire({
    title: 'Are you sure you want to logout?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, logout'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'success!',
        text: 'Your file has been deleted.',
        icon: 'success'
      });
      window.location.href = `../../../zulo/inc/handlers/logout_handler.php`;
    }
  });
});

function addActiveClass(event) {
  const navUl = document.querySelector('#navUl');
  const navAnchorEl = navUl.querySelectorAll('a');

  navAnchorEl.forEach((element) => {
    if (element.classList.contains('active')) {
      element.classList.remove('active');
    }
  });

  event.target.classList.add('active');
}

const myCarouselElement = document.querySelector(
  '#carouselExampleAutoplayingM'
);

function searchToggle() {
  document.querySelector('#search-bar').classList.toggle('activeSearch');
}

function changeSection(section, event) {
  document.querySelector('#men').classList.toggle('d-none', section !== 'men');
  document
    .querySelector('#women')
    .classList.toggle('d-none', section !== 'women');

  if (section === 'men') {
    document.querySelector('#womenatag').classList.remove('text-success');
    document.querySelector('#menatag').classList.add('text-success');
  } else if (section === 'women') {
    document.querySelector('#menatag').classList.remove('text-success');
    document.querySelector('#womenatag').classList.add('text-success');
  }
}

function showLogin() {
  const loginElement = document.querySelector('#login');

  loginElement.classList.toggle('d-block');

  document.querySelector('#sign-up').classList.add('d-none');
  document.querySelector('#sign-in').classList.remove('d-none');
  document.querySelector('#sign-in').classList.add('d-block');
}

function showSignup() {
  document.querySelector('#sign-up').classList.toggle('d-none');
  document.querySelector('#sign-up').classList.add('d-block');

  document.querySelector('#sign-in').classList.add('d-none');
  document.querySelector('#sign-in').classList.remove('d-block');
}

const carousel = new bootstrap.Carousel(myCarouselElement, {
  interval: 30000,
  touch: false
});

function cartAdded(event) {
  console.log(event.target);
  event.target.setAttribute('class', 'bi bi-heart-fill fs-5 text-danger');
}
