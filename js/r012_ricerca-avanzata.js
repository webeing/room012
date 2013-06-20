/*
script per la ricerca avanzata
*/
jQuery(function($){
    var ajaxurl = r012_ajax_data.ajaxurl;
    var template_url = r012_ajax_data.template_url;
    //show/hide ricerca avanzata
    $(".ricerca-btn").click(function(){

        if ($(".content-research").css('display') == 'none') {
            $("div.content-research").slideDown("slow");

        } else {
            $("div.content-research").hide();

        }
    });

    //checkbox attività
    $(".content-checklist").click(function(){

        if ($(this).children().is(":checked"))
        {

            if($(this).next('.sub-checklist').children().length>0){
                //show the hidden ul
                $(this).next('.sub-checklist').show("fast");
            }

        }
        else
        {
            if($(this).next('.sub-checklist').children().length>0){
                //otherwise, hide ul
                $(this).next('.sub-checklist').hide("fast");
            }
        }
    });

    //checkbox provincia
    $('.regioni-checklist').click(function(){


        if ($(this).children().is(":checked"))
        {

            if($(this).next('.sub-checklist').children().length>0){
                //show the hidden ul
                $(this).next('.sub-checklist').show("fast");
            }

        }
        else
        {
            if($(this).next('.sub-checklist').children().length>0){
                //otherwise, hide ul
                $(this).next('.sub-checklist').hide("fast");
            }
        }
    });

    //filtro professionisti
    $('.ricerca-avanzata').click(function(){
        $("#r012_ricerca_professionisti_id").submit();
        $("div.content-research").hide();
    });

});