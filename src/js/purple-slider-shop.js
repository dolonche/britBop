$('.purple-slider-shop').owlCarousel({
  loop: false,
  margin: 10,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    768: {
      items: 1,
      margin: 0,
      nav: true
    },
    1280: {
      nav: true,
      items: 1,
    }
  }
});