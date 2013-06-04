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


    $(".change a").validate({
        onkeyup: function(element){this.element(element);}, //controlla alla pressione dei tasti
        rules: {
            //r012_studio: "required",

            r012_titolo: {
                required: true,
                notEqual: "-1"
            },
            r012_provincia: "required",
            r012_citta: "required"

        },
        messages: {

            r012_titolo: "Richiesto",
            r012_provincia: "Richiesto",
            r012_citta: "Richiesto"

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

    $("#r012_form_progetto_id").validate({

        onkeyup: function(element){this.element(element);}, //controlla alla pressione dei tasti
        rules: {
            r012_name_project: "required",
            r012_tipologia: {
                required: true,
                notEqual: "-1"
            },
            r012_citta_project: "required",
            r012_provincia_project: {
                required: true,
                notEqual: "0"
            },
            r012_anno_project: "required",
            r012_immagine_project: "required"

        },
        messages: {
            r012_name_project: "Inserire il nome progetto",
            r012_tipologia: "Inserire la tipologia del progetto",
            r012_citta_project: "Inserire città del progetto",
            r012_provincia_project: "Inserire provincia del progetto",
            r012_anno_project: "Inserire anno del progetto",
            r012_immagine_project: "Inserire immagine del progetto"


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


    $("#upload_foto_nuovo").validate({
        onkeyup: function(element){this.element(element);}, //controlla alla pressione dei tasti
        rules: {
            r012_immagine_project: "required"

        },
        messages: {
            r012_immagine_project: "Inserire immagine del progetto"

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


    $(".r012-button-aggiungi-image").live('click',function() {

        var obj;

        if( $('ul#image-list li').size() < 10 ){
           var index;
           var i;
            for(i=1; i<=10; i++){
            // console.log($("#r012_didascalia_id_"+ i).length == 0);
                if($("#r012_didascalia_id_"+ i).length == 0){
                    index = i;
                    break;
                }
            }

           if($(this).hasClass('edit')){

                   obj = "<li class='single-image span6'>";
                   obj = obj + "<p class='control-group'>";
                   obj = obj + "Inserisci immagine: <input type='file' name='r012_immagine_project_"+ index + "' id='r012_immagine_project_id_"+ index + "' value=''></p>";
                   obj = obj + "<p class='control-group'><label>Didascalia: </label>"
                   obj = obj + "<input type='text' value='' id='r012_didascalia_id_"+ index + "' name='r012_didascalia_project_"+ index + "'></p></li>";



               $('ul#image-list').append( obj );

               $("#r012_immagine_project_id_"+ index).css('display', 'block');
           }


           else{


                obj = $('ul#image-list').find('li').eq(0).clone(true);
                $('ul#image-list').append( obj );

                $('ul#image-list li').find('input').eq(-2).attr("id", "r012_immagine_project_id_" + index);
                $('ul#image-list li').find('input').eq(-2).attr("name", "r012_immagine_project_" + index);

                $('ul#image-list li').find('input').eq(-1).attr("id", "r012_didascalia_id_" + index);
                $('ul#image-list li').find('input').eq(-1).attr("name", "r012_didascalia_project_" + index);
                obj.find('input').val('');


           }
           $('ul#image-list li').eq(-1).append( '<br class="clear"/><a class="r012-button-rimuovi-image" href="">[-] Rimuovi</a>');
        }
        return false;
    });

    $(".r012-button-rimuovi-image").live('click',function() {

        $(this).parent().remove();
        return false;

    });


    $(".r012-button-modifica-image").live('click',function() {
        $(this).hide();
        $(this).next().css('display', 'block');
       return false;
    });

    $('a.no-limited-height').live('click',function(){

        $(this).siblings('.limited-height').css(
            'max-height', 'inherit');
        $(this).addClass('hidden');
        $(this).siblings('.yes-limited-height').removeClass('hidden');
        return false;
    });

    $('a.yes-limited-height').live('click',function(){

        $(this).siblings('.limited-height').css(
            'max-height', '65px');
        $(this).addClass('hidden');
        $(this).siblings('.no-limited-height').removeClass('hidden');
        return false;
    });
});
