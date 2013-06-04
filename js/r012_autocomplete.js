/**
 * funzione ajax autocomplete
 */
jQuery(function($){

    var ajaxurl = r012_autocomplete_data.adminurl;

    //eventuale loader
    var template_url = r012_ajax_data.template_url;
    var pt;

    $(".r012-button-aggiungi").live('click',function() {

        text = $(this).siblings('input.r012_autocomplete').val();
        if(text==""){

        }else{
               if($(this).siblings('.element-collaborazioni').length){

                   $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="' + text +'" />' + text + '</li>');

               } else{
                   $(this).after('<ul class="element-collaborazioni"></ul>');

                        if($(this).parent().parent().parent().parent().is('#edit-change-collaborazioni')){
                            $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" style="display:none;"  name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="0" /></li>');

                        }
                   $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="' + text +'" />' + text + '</li>');

               }


        }
        $(this).siblings('input.r012_autocomplete').val('');

        return false;
    });

    $( ".r012_autocomplete" ).live('keyup',function(){

        var s = $(this).val();
        pt = $(this).attr('name');
        $(this).autocomplete({
            minLength: 1,
            delay: 0,
            source: function( request, response ){
                var data = {
                    action: 'r012_autocomplete',
                    search: s,
                    posttype: pt
                };

                $.ajax({
                    data: data,
                    url: ajaxurl,
                    type: 'post',
                    dataType: "json",


                    success: function( data ) {

                        response( $.map( data, function( item ) {

                            return {

                                label: item.post_title,
                                value: item.post_title,
                                id:item.ID

                            }
                        }));
                    },
                    error: function( results ){
                        console.log('Nessun risultato' );
                    }
                });
                return false;
            },

            select: function( event, ui ) {

                if($(this).siblings('.element-collaborazioni').length){

                    $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="' + ui.item.id +'" />' + ui.item.label + '</li>');

                } else {
                    $(this).siblings('.r012-button-aggiungi').after('<ul class="element-collaborazioni"></ul>');

                    if($(this).parent().parent().parent().parent().is('#edit-change-collaborazioni')){
                        $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" style="display:none;" name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="0" /></li>');

                    }
                    $(this).siblings('.element-collaborazioni').append('<li><input type="checkbox" name="r012_autocomplete_' + pt + '_item[]" checked="checked" value="' + ui.item.id +'" />' + ui.item.label + '</li>');


                }

                $('.r012_autocomplete').val('');

                return false;
            }

        });

    });
});