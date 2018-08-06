var categoryButton = document.querySelector('.rubriki--mob p');
var categoryList = document.querySelector('.rubriki--mob .rubriki__list');
categoryButton.addEventListener('click', function (e) {
  if (categoryButton.parentNode.classList.contains('rubriki--open')) {
    categoryButton.parentNode.classList.remove('rubriki--open');
  } else {
    categoryButton.parentNode.classList.add('rubriki--open');
  }
})