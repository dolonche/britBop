$('.teacher-slider').owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    768: {
      items: 2,
      nav: true,
    },
    1280: {
      items: 3,
      nav: true
    }
  }
});