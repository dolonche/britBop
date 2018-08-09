$('.purple-slider').owlCarousel({
  loop: false,
  startPosition: 1,
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
    1280: {
      nav: true,
      items: 1,
      stagePadding: 250
    }
  }
});