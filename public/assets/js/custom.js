$(document).ready(function () {
    BASE_URL = window.location.origin + '/lp/controlador-de-temperatura-west-6100/';
    //HOMOLOG
    //BASE_URL = window.location.origin + '/lp-inttertech-rio/';

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    'use strict'

    $('.recaptcha-error-form-contact').hide();
    $('.recaptcha-error-form-cta').hide();

    /* FORM CONTACT */      
    $('.needs-validation').validate({
        submitHandler: function (form) {
          var response = grecaptcha.getResponse();
          console.log(response);
          //recaptcha failed validation
          if (response.length == 0) {
            $('.recaptcha-error-form-contact').show();
            return false;
          }
            //recaptcha passed validation
          else {
            $('.recaptcha-error-form-contact').hide();
            return true;
          }
        }
    });


    /* FORM CTA WPP */
    $('#form-cta-wpp').validate({
        submitHandler: function (form) {
          var response = grecaptcha.getResponse();
          console.log(response);
          //recaptcha failed validation
          if (response.length == 0) {
            $('.recaptcha-error-form-cta').show();
            return false;
          }
            //recaptcha passed validation
          else {
            $('.recaptcha-error-form-cta').hide();
            return true;
          }
        }
    });

    /************************
    * VALIDATION FUNCTION
    ************************/
    function msg(msg, tipo) {
        var retorno = $(".msg");
        var tipo = (tipo === 'success') ? 'success' : (tipo === 'alert') ? 'warning' : (tipo === 'error') ? 'danger' : (tipo === 'info') ? 'info' : '';
        retorno.empty().fadeOut('fast', function () {
            return $(this).html('<div class="alert alert-' + tipo + '">' + msg + '</div>').fadeIn('slow');
        });
        //esconde a div depois de 5 segundos
        /* setTimeout(function() {
            retorno.fadeOut('slow');
        }, 3000); */
    }

});





