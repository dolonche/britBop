'use strict'
var dropdownList = document.querySelector('.prime__descr--dropdown');
var dropdownArrow = document.querySelector('.dropdown-arrow');
dropdownArrow.addEventListener('click', function () {
  if (dropdownList.style.height == '100%') {
    dropdownList.style.height = '240px';
    dropdownArrow.classList.remove('dropdown-arrow--open');

  } else {
    dropdownList.style.height = '100%';
    dropdownArrow.classList.add('dropdown-arrow--open');
  }
});