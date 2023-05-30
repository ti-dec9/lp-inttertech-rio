$(function ($) {
  "use strict";

  jQuery(document).ready(function () {

    // preloader
    $("#preloader").delay(300).animate({
      "opacity": "0"
    }, 2000, function () {
      $("#preloader").css("display", "none");
    });

    // Scroll Top
    var ScrollTop = $(".scrollToTop");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 500) {
        ScrollTop.removeClass("active");
      } else {
        ScrollTop.addClass("active");
      }
    });
    $('.scrollToTop').on('click', function () {
      $('html, body').animate({
        scrollTop: 0
      }, 1000);
      return false;
    });

    // Navbar Dropdown
    var dropdown_menu = $(".header-section .dropdown-menu");
    $(window).resize(function () {
      if ($(window).width() < 992) {
        dropdown_menu.removeClass('show');
      } else {
        dropdown_menu.addClass('show');
      }
    });
    if ($(window).width() < 992) {
      dropdown_menu.removeClass('show');
    } else {
      dropdown_menu.addClass('show');
    }

    // Autocomplete off
    $('input[type=text]').attr('autocomplete','off');

    // Sticky Header
    var fixed_top = $(".header-section");
    $(window).on("scroll", function () {
      if ($(window).scrollTop() > 50) {
        fixed_top.addClass("animated fadeInDown header-fixed");
      }
      else {
        fixed_top.removeClass("animated fadeInDown header-fixed");
      }
    });

    // Navbar Add Active Class
    $('.navbar-nav .nav-link').on('click', function () {
      $('.nav-link').removeClass('active');
      $(this).addClass("active");
    });

    // User Active
    $('.single-item .search-btn').on('click', function () {
      $('.search-content').toggleClass('active');
    });
    $('section').on('click', function () {
      $('.search-content').removeClass('active');
      $('.cart-content').removeClass('active');
      $('.user-content').removeClass('active');
    });

    // Range Value
    $( ".irs-handle" ).mouseenter(function() {
      var min_val = $( '.irs-from' ).text();
      var max_val = $( '.irs-to' ).text();
      $( ".min-val" ).html( min_val );
      $( ".max-val" ).html( max_val );
    });

    // grid and list style
    $(".grid-btn").on("click", function () {
      $(".grid-btn").addClass("active");
      $(".list-btn").removeClass("active");

      $(".single-item").removeClass("list");
      $("#grid").addClass("active");
      $("#list").removeClass("active");
    });
    $(".list-btn").on("click", function () {
      $(".list-btn").addClass("active");
      $(".grid-btn").removeClass("active");

      $(".single-item").addClass("list");
      $("#list").addClass("active");
      $("#grid").removeClass("active");
    });

    // Input Increase
    var minVal = 1, maxVal = 20;
    $(".increaseQty").on('click', function(){
      var $parentElm = $(this).parents(".qtySelector");
      $(this).addClass("clicked");
      setTimeout(function(){
          $(".clicked").removeClass("clicked");
      },100);
      var value = $parentElm.find(".qtyValue").val();
      if (value < maxVal) {
          value++;
      }
      $parentElm.find(".qtyValue").val(value);
    });
    $(".decreaseQty").on('click', function(){
      var $parentElm = $(this).parents(".qtySelector");
      $(this).addClass("clicked");
      setTimeout(function(){
          $(".clicked").removeClass("clicked");
      },100);
      var value = $parentElm.find(".qtyValue").val();
      if (value > 1) {
          value--;
      }
      $parentElm.find(".qtyValue").val(value);
    });

    // Cart Active
    $(".cart-btn").on("click", function () {
      $(".cart-content").toggleClass("active");
      $(".cart-overlay").toggleClass("active");
    });

    $(".cart-overlay, .close-btn").on("click", function () {
      $(".cart-overlay").removeClass("active");
      $(".cart-content").removeClass("active");
    });

  });
});