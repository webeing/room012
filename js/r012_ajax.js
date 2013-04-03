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
            provincia: $('input[name="r012_provincia"]').val(),
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




  /*  jQuery('#upload_image_button').live('click',function() {
        var adminurl = r012_ajax_data.adminurl;
        formfield = jQuery('#upload_image').attr('name');
        tb_show('', adminurl + '/media-upload.php?type=post_id=12&image&amp;TB_iframe=true');
        return false;
    });*/

    /*
    $('.ml-submit #save').live('click',function(e){
        self.parent.tb_remove();
        return false;
    });
*/

 /*   window.send_to_editor =  function(html) {
            imgurl = jQuery('img',html).attr('src');
            $('#upload_image_id').val(imgurl);
            $('#upload_image_id').after('<img src="' + imgurl + '"  />');
            tb_remove();
        };
*/

/*
    jQuery('#upload_image_button').click(function() {
        //var adminurl = r012_ajax_data.adminurl;
        formfield = jQuery('#upload_image').attr('name');
        tb_show('',  'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        imgurl = jQuery('img',html).attr('src');
        jQuery('#upload_image').val(imgurl);
        tb_remove();
    }
*/
});


