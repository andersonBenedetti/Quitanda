jQuery(document).ready(function () {
  jQuery(".carousel-logos").slick({
    autoplay: true,
    dots: false,
    arrows: false,
    infinite: true,
    speed: 1000,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 1,
    swipeToSlide: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  });

  jQuery(".carousel-home").slick({
    autoplay: true,
    dots: false,
    arrows: true,
    infinite: true,
    speed: 1000,
    autoplaySpeed: 2000,
    slidesToShow: 1,
    slidesToScroll: 1,
  });
});
