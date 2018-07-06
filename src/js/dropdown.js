var kursy = document.querySelector('.kursy');
kursy.addEventListener('click', function (e) {
  var kursItem = e.target.parentNode.parentNode;
  if (e.target.parentNode.classList.contains('kursy__lvl-title') || e.target.parentNode.classList.contains('kursy__lvl-top')) {
    if (kursItem.classList.contains('kursy__lvl-top')) {
      kursItem = e.target.parentNode.parentNode.parentNode;
    } else {
      kursItem = e.target.parentNode.parentNode;
    }
    if (kursItem.classList.contains('kursy__lvl--closed')) {
      kursItem.classList.remove('kursy__lvl--closed');
      kursItem.classList.add('kursy__lvl--opened');
    } else {
      kursItem.classList.remove('kursy__lvl--opened');
      kursItem.classList.add('kursy__lvl--closed');
    }
  }
})