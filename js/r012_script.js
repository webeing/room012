/**
 * JS scripts
 */
jQuery(function($){
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return value != param;
    }, "Selezionare almeno un elemento");

    $("#r012_register_form").validate({
        onkeyup: function(element){this.element(element);}, //controlla alla pressione dei tasti
        rules: {
            //r012_studio: "required",
            r012_nome: "required",
            r012_cognome: "required",
            r012_titolo: {
                required: true,
                notEqual: "-1"
            },
            r012_provincia: "required",
            r012_citta: "required",
            //r012_numero: "required",
            //r012_ordine: "required",
            r012_mail: {
                email: true,
                required: true
            },
            r012_licenza: "required"
            //recaptcha_response_field: "required"
        },
        messages: {

            //r012_studio: "Richiesto",
            r012_nome: "Richiesto",
            r012_cognome: "Richiesto",
            r012_titolo: "Richiesto",
            r012_provincia: "Richiesto",
            r012_citta: "Richiesto",
            r012_mail: {
                email: "Inserisci una email valida",
                required: "Richiesto"
            },
            //r012_ordine:"Richiesto",
            //r012_numero: "Richiesto",
            //recaptcha_response_field: "",
            r012_licenza: "Accettare le condizioni sul trattamento dei dati"
        },
        highlight: function(label) {
            $(label).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(label) {
            label
                .text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }
    });
    $('#slider-gallery').carousel({
	    interval: 4000,
	    pause: 'hover'    
    });
    $('#menu-main-menu .dropdown-menu').find('.current-menu-item').parent().parent().addClass('current-menu-ancestor');
    $('#menu-main-menu .dropd a').click(function(){
    	$('#menu-main-menu .dropd a').parent().removeClass('current-menu-ancestor').addClass('current-menu-ancestor');
    });
    
    /*$("#users figure").hover(
      function () {
        $(this).find('.info-user').animate({'bottom':0});
      }, 
      function () {
        $(this).find('.info-user').animate({'bottom':-90});
      }
    );
    */
   // $('#claim-nl').modal();
    
});