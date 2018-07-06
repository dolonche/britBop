var kursy = document.querySelector('.kursy');
kursy.addEventListener('click', function (e) {
  var kursItem = e.target.parentNode.parentNode.parentNode;
  if (e.target.classList.contains('pop-arrow')) {
    if (kursItem.classList.contains('kursy__lvl--closed')) {
      kursItem.classList.remove('kursy__lvl--closed');
      kursItem.classList.add('kursy__lvl--opened');
    } else {
      kursItem.classList.remove('kursy__lvl--opened');
      kursItem.classList.add('kursy__lvl--closed');
    }
  }
})