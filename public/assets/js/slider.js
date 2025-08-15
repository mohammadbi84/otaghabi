document.addEventListener("DOMContentLoaded", function () {

  var splide = new Splide("#slider0", {
      type: "loop",
    // drag: "free",
    direction: "rtl",
    focus: 'center',
    perPage: 1,
    omitEnd: true,
    pagination: (boolean = false),
  });
  splide.mount();

  var splide = new Splide("#slider2", {
    //   type: "loop",
    // drag: "free",
    direction: "rtl",
    focus: 'center',
    perPage: 3,
    gap: '2rem',
    omitEnd: true,
    pagination: (boolean = false),
    // perMove: 1,
    breakpoints: {
      991: {
        perPage: 1,
      },
    },
  });
  splide.mount();

  var splide = new Splide("#slider3", {
    type: "loop",
    drag: "free",
    gap: '1rem',
    direction: "rtl",
    focus: 0,
    perPage: 4,
    omitEnd: true,
    pagination: (boolean = false),
    // perMove: 1,
    breakpoints: {
      991: {
        perPage: 4,
      },
      480: {
        perPage: 1.5,
        drag: true,
      },
    },
  });
  splide.mount();

  // new Splide("#slider1").mount();
});
