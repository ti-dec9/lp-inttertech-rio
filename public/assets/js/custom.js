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

    /* FORM CONTACT */
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    });


    /* FORM CTA WPP */
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const formsCta = document.querySelectorAll('#form-cta-wpp');

    // Loop over them and prevent submission
    Array.from(formsCta).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            } 
            form.classList.add('was-validated')
        }, false)
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





