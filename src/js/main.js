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
navList.addEventListener('click', function(e){
})