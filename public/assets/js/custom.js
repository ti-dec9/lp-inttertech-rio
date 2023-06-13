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

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault()
                event.stopPropagation()
                //console.log($('#frm-contact').serialize());
                // Send
                $.ajax({
                    url: BASE_URL + 'sendmail/contato',
                    type: 'GET',
                    data: $('#frm-contact').serialize(),
                    contentType: false,
                    processData: false,
                    //async: false, //blocks window close
                    beforeSend: function (data) {
                        //console.log(data);
                        msg("<b>Processando... Por favor, aguarde!<b>", 'alert');
                    },
                    success: function (data) {
                        console.log(data);
                        if (data === 'TRUE') {
                            msg("Recebemos a sua solicitação! <br> Em breve, entraremos em contato.", "success");
                            setTimeout(() => {
                                $(location).attr('href', '');
                            }, 10000);
                        } else if (data === 'FALSE') {
                            msg("Dados não enviados!", "error");
                        }
                    },
                    error: function (data) {
                        //console.log(data);
                        msg("Erro crí­tico! Por favor, consulte o administrador do sistema!", "error");
                        setTimeout(() => {
                            $('.msg').fadeOut('slow');
                        }, 2000);
                    }
                });
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





