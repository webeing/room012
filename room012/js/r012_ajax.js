
/**
 * funzioni ajax
 */
jQuery(function($){


    //var nonce = r012_ajax_data.nonce;

    $("#registerbtn").live('click',function() {

        var ajaxurl = r012_ajax_data.ajaxurl;
        var template_url = r012_ajax_data.template_url;

        if( !$('#r012_register_form').valid() ){
            $('#result_register').html('Alcuni campi contengono degli errori. Correggi e reinvia il modulo')
            return false;
        }

        $('#result_register').html('<img src="' + template_url + '/images/loader.gif" class="loader" />').fadeIn();

        var data = {
            action: 'r012_registration',
            nome: $('input[name="r012_nome"]').val(),
            cognome: $('input[name="r012_cognome"]').val(),
            piva: $('input[name="r012_piva"]').val(),
            titolo: $('select#r012_titolo_id option:selected').val(),
            ordine: $('input[name="r012_ordine"]').val(),
            numero: $('input[name="r012_numero"]').val(),
            nome_studio: $('input[name="r012_nome_studio"]').val(),
            posizione: $('input[name="r012_posizione"]').val(),
            telefono: $('input[name="r012_telefono"]').val(),
            mobile: $('input[name="r012_mobile"]').val(),
            fax: $('input[name="r012_fax"]').val(),
            mail: $('input[name="r012_mail"]').val(),
            sito_web: $('input[name="r012_sito"]').val(),
            citta: $('input[name="r012_citta"]').val(),
            via: $('input[name="r012_via"]').val(),
            cap: $('input[name="r012_cap"]').val(),
            provincia: $('select#r012_provincia_id option:selected').val(),
            regione: $('select#r012_regione_id option:selected').val(),
            img: $('input[name="upload_image"]').val(),
            licenza: $('#r012_licenza').attr('checked'),
            remote_addr: $('#r012_remote_addr').val(),
            recaptcha_challenge_field: $('#recaptcha_challenge_field').val(),
            recaptcha_response_field: $('#recaptcha_response_field').val()
            //nonce_professionisti: nonce
        };


        $.post(ajaxurl, data, function(response) {

            if (response.status == 'success'){

                $('.loader').remove();
                $('<div class="' + response.status + '">').html(response.value).appendTo('div#result_register').hide().fadeIn('slow');
                $("#r012_register_form").submit();


                return;

            }

            if (response.status == 'error'){
                    Recaptcha.reload();
                $('.loader').remove();
                $('<div class="' + response.status + '">').html(response.value).appendTo('div#result_register').hide().fadeIn('slow');
                return;
            }
         }, 'json');
        return false;
    });


    //nuovo progetto
    $("#progettobtn").live('click',function() {

        var ajaxurl = r012_ajax_data.ajaxurl;
        var template_url = r012_ajax_data.template_url;

        $('#result_progetto').html('<img src="' + template_url + '/images/loader.gif" class="loader" />').fadeIn();

        var data = {
            action: 'r012_nuovo_progetto',
            autore: $('input[name="r012_autore"]').val(),
            autoreadmin: $('#r012_autore_id option:selected').val(),
            nome: $('input[name="r012_name_project"]').val(),
            oggetto: $("#r012_oggetto_id option:selected").val(),
            tipologia: $('#r012_tipologia_id option:selected').val(),
            attivita: $('#r012_attivita_id option:selected').val(),
            citta: $('input[name="r012_citta_project"]').val(),
            provincia: $('#r012_provincia_project_id option:selected').val(),
            regione: $('#r012_regione_project_id option:selected').val(),
            commitente: $('input[name="r012_committente_project"]').val(),
            concept: $('textarea[name="r012_concept_project"]').val(),
            studio: $('input[name="r012_studio_project"]').val(),
            anno: $('input[name="r012_anno_project"]').val(),
            immagine: $('input[name="r012_immagine_project"]').val(),
            postid: $('input[name="r012_post"]').val()
        };


        $.post(ajaxurl, data, function(response) {

            if (response.status == 'success'){

                $('.loader').remove();
                $('<div class="alert alert-success">').html(response.value).appendTo('div#result_progetto').hide().fadeIn('slow');
                $("#r012_form_progetto_id").submit();
                $("#upload_foto_nuovo").submit();
                return;

            }

            if (response.status == 'error'){

                $('.loader').remove();
                $('<div class="alert alert-error">').html(response.value).appendTo('div#result_progetto').hide().fadeIn('slow');
                $("#r012_form_progetto_id").submit();
                $("#upload_foto_nuovo").submit();
                return;
            }

            if (response.status == 'error_image'){

                $('.loader').remove();
                $('<div class="alert alert-error">').html(response.value).appendTo('div#result_progetto').hide().fadeIn('slow');
                $("#upload_foto_nuovo").submit();
                return;
            }
        }, 'json');
        return false;
    });



    var name;
    $('.change a').live('click',function() {

        name = $(this).attr('id');
        if($(this).hasClass('r012-button-aggiungi')){

        }else{
            $('.slidedown').addClass('hidden');
        }
        $('#slide-' + name).slideToggle('fast', function(){
           $(this).toggleClass('hidden');
        });
        return false;
    });

    //button update profile
    //Aggiornamento dati al click del button salva
    $('.edit-submit').live('click',function() {


        $d = $(this).parent().parent();

        $idpost = $('input[name="r012_post"]').val();

        $userid = $('input[name="r012_user_id"]').val();

       if($(this).attr('id') == "save-foto"){
            var data = {
                action: 'r012_modifica',
                immagine: $('input[file="r012_immagine"]').val(),
                idpost: $idpost
            };
        } else {
            var data = {
                action: 'r012_modifica',
                campi: $d.serialize(),
                idpost: $idpost
            };
        }

        var ajaxurl = r012_ajax_data.ajaxurl;



        var toload = {
            action: 'r012_load',
            idpost: $idpost,
            userid: $userid,
            area: $d.parent().attr('id')

        };
        $.post(ajaxurl, data, function(response) {

            if (response.status == 'success'){

                $($d).parents('.editable').load(ajaxurl,toload);

                //$d.parent().parent().slideUp();
                $d.parents('.slidedown').slideUp('fast', function(){
                    $d.parents('.slidedown').addClass('hidden');
                });
            }

            if (response.status == 'error'){
                // if error alert
                alert('Errore');
            }
        }, 'json');

        return false;

    });


    $('.upload-btn').live('click',function() {
        //$(this).parent().parent().slideUp();
        var button = $(this);

        button.parents('.slidedown').slideUp('fast', function(){
            button.parents('.slidedown').addClass('hidden');
        });
        $('#photo-edit').removeClass('hidden');
        $('#bio-photo').hide();

    });


    $('.cancel-btn').live('click',function() {
        var button = $(this);
        //$(this).parent().parent().slideUp();
        button.parents('.slidedown').slideUp('fast', function(){
            button.parents('.slidedown').addClass('hidden');
        });

    });


    $('#deleteprogettobtn').live('click',function() {
        $('<div id="dialog">Sei sicuro di voler eliminare questo progetto</div>').appendTo('#deleteprogettobtn');


        $("#dialog").dialog({

            modal: true,
            title: "Elimina progetto",


             buttons: {
                "SI": function() {
                    $d =  $( this );
                    $idpost = $('input[name="r012_post"]').val();
                    $userid = $('input[name="r012_autore"]').val();

                    var ajaxurl = r012_ajax_data.ajaxurl;

                    var data = {
                        action: 'r012_delete',
                        idpost: $idpost,
                        userid: $userid
                    };


                    $.post(ajaxurl, data, function(response) {

                        if (response.status == 'success'){

                            $d.dialog( "close" );

                            window.location.href = response.value;
                        }

                        if (response.status == 'error'){

                            alert('Errore');
                        }
                    }, 'json');
                    return false;

                },
                "NO": function(){

                    $( this ).dialog( "close" );

                }
            }
        });

    });



});

