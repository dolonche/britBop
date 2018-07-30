var body = document.querySelector('body');
var nav = document.querySelector('.mnav');
var navToggle = nav.querySelector('.mnav__toggle');
var navList = nav.querySelector('.mnav__menu');
var navListItem = navList.querySelector('.mnav__menu-item');
var navListArrow = navList.querySelector('.mnav__menu-item a .parent');
navToggle.addEventListener('click', function (e) {
  if (e.target.classList.contains('mnav__toggle--closed')) {
    e.target.classList.remove('mnav__toggle--closed');
    e.target.classList.add('mnav__toggle--opened');
    nav.classList.remove('mnav--closed');
  } else {
    e.target.classList.remove('mnav__toggle--opened');
    e.target.classList.add('mnav__toggle--closed');
    nav.classList.add('mnav--closed');
  }
})
navList.addEventListener('click', function (e) {
  if (e.target.classList.length === 1 && e.target.classList[0] === 'parent') {
    if (e.target.parentNode.classList.contains('mnav__menu-item--opened')) {
      e.target.parentNode.classList.remove('mnav__menu-item--opened');
    } else {
      e.target.parentNode.classList.add('mnav__menu-item--opened');
    }
  }
})
body.addEventListener('click', function (e) {
  if (!e.target.classList.contains('mnav__menu-item') && !e.target.classList.contains('mnav__toggle') && !e.target.classList.contains('parent') && !nav.classList.contains('mnav--closed')) {
    nav.classList.add('mnav--closed');
    navToggle.classList.remove('mnav__toggle--opened');
    navToggle.classList.add('mnav__toggle--closed');
  }
})
$(document).ready(function () {
  $(".purple-slider").owlCarousel();
  $(".teacher-slider").owlCarousel();
});
$('.purple-slider').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    768: {
      items: 1,
      nav: true
    },
    1200: {
      nav: true,
      items: 1,
      stagePadding: 250
    }
  }
});
$('.teacher-slider').owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    768: {
      items: 2,
      nav: true, 
    },
    1200: {
      items: 3,
      nav: true
    }
  }
})