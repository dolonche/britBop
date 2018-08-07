var categoryButton = document.querySelector('.rubriki--mob p');
var categoryList = document.querySelector('.rubriki--mob .rubriki__list');
$('.rubriki--mob p').click(function () {
  $('.rubriki--mob .rubriki__list').slideToggle();
  categoryButton.parentNode.classList.toggle('rubriki--open');
})