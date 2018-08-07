'use strict'
var dropdownList = document.querySelector('.prime__descr--dropdown');
var dropdownArrow = document.querySelector('.dropdown-arrow');
dropdownArrow.addEventListener('click', function () {
  var dropdownListHeight = getComputedStyle(dropdownList.querySelector('.prime__descr-content')).height;
  if (dropdownList.style.height == dropdownListHeight) {
    dropdownList.style.height = '240px';
    dropdownArrow.classList.remove('dropdown-arrow--open');

  } else {
    dropdownList.style.height = dropdownListHeight;
    dropdownArrow.classList.add('dropdown-arrow--open');
  }
});