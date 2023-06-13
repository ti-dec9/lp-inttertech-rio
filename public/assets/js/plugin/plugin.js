$(function ($) {
  "use strict";

  jQuery(document).ready(function () {

    /* niceSelect */
    $("select").niceSelect();
    
    // counter Up
    if (document.querySelector('.counter') !== null) {
      $('.counter').counterUp({
        delay: 10,
        disableOn: 0,
        time: 2000
      });
    }

    /* Magnific Popup */
    if (document.querySelector('.popupvideo') !== null) {
      $('.popupvideo').magnificPopup({
        disableOn: 300,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
      });
    }

    /* Wow js */
    new WOW().init();

    // testimonial-carousel
    $(".testimonial-carousel").not('.slick-initialized').slick({
      infinite: true,
      autoplay: false,
      centerMode: true,
      centerPadding: "0px",
      focusOnSelect: true,
      speed: 1000,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      prevArrow: "<button type='button' class='slick-prev pull-left'><i class=\"icon-d-right-arrow-2\"  aria-hidden='true'></i></button>",
      nextArrow: "<button type='button' class='slick-next pull-right'><i class=\"icon-d-right-arrow-2\"  aria-hidden='true'></i></button>",
      dots: true,
      dotsClass: 'section-dots',
      customPaging: function (slider, i) {
        var slideNumber = (i + 1),
          totalSlides = slider.slideCount;
        return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
      },
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });

    /* range slider js */
    if (document.querySelector('#rangeslider') !== null) {
      $("#rangeslider").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 0,
        max: 250,
        from: 50,
        to: 170
      });
    }

    // Shop Slider
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerPadding: "0px",
        centerMode: true,
        focusOnSelect: true,
        responsive: [
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 3,
            }
          }
        ]
    });

  });
});