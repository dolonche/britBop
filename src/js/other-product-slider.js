$('.other-product__slider').owlCarousel({
  loop: true,
  startPosition: 1,
  margin: 20,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    768: {
      items: 2,
      nav: true
    },
    1280: {
      nav: true,
      items: 4,
    }
  }
});