<?php
/**
 * creo le action Ajax per room012
 */
//Registro la mia action registration frontend
add_action('wp_ajax_r012_registration', 'r012_ajax_registration');
add_action('wp_ajax_nopriv_r012_registration', 'r012_ajax_registration');

//Registro la mia action per la creazione di nuovo progetto

add_action('wp_ajax_r012_nuovo_progetto', 'r012_ajax_nuovo_progetto');
add_action('wp_ajax_nopriv_r012_nuovo_progetto', 'r012_ajax_nuovo_progetto');

//Registro la mia action per la cancellazione del progetto

add_action('wp_ajax_r012_delete', 'r012_ajax_delete_progetto');
add_action('wp_ajax_nopriv_r012_delete', 'r012_ajax_delete_progetto');

//registro le mie action per le azioni sul profilo

add_action('wp_ajax_r012_modifica', 'r012_salva_dati');
add_action('wp_ajax_nopriv_r012_modifica', 'r012_salva_dati');


add_action('wp_ajax_r012_load', array('R012Professionista','r012_load'), 10 ,1);
add_action('wp_ajax_nopriv_r012_load', array('R012Professionista','r012_load'), 10 ,1);

/**
 * upload image
 */
add_action('wp_ajax_r012_upload_image', 'r012_ajax_upload_image');
add_action('wp_ajax_nopriv_r012_upload_image', 'r012_ajax_upload_image');



function r012_ajax_nuovo_progetto(){



    if($_POST){

        if($_POST['nome']==null) {
            echo responseReturn( 'error','Inserire il nome del progetto' );
            exit();
        }
        elseif ($_POST['citta']==null) {
            echo responseReturn( 'error','Inserire la città del progetto' );
            exit();
        }
        elseif ($_POST['provincia']==null) {
            echo responseReturn( 'error','Inserire la provincia del progetto' );
            exit();
        }
        elseif ($_POST['anno']==null) {
            echo responseReturn( 'error','Inserire anno del progetto' );
            exit();
        }
        elseif ($_POST['immagine']=="" && $_POST['postid']==null) {
            echo responseReturn( 'error_image','Inserire immagine progetto' );
            exit();
        }

        elseif ($_POST['oggetto']==null) {
            echo responseReturn( 'error','Inserire oggetto progetto' );
            exit();
        }
        else {
            if($_POST['postid']==null){
                echo responseReturn( 'success', 'Nuovo progetto creato');
                exit();

            } else{
                echo responseReturn( 'success', 'Progetto modificato');
                exit();

            }
        }
    }

}



/**
 * Ricevo i dati creo un nuovo cpt e invio mail
 */
function r012_ajax_registration(){

    if($_POST){

        $r012_mail = $_POST['mail'];

        $user_id = email_exists($r012_mail);

        $resp = recaptcha_check_answer (R012_CAPTCHA_PRIVKEY,$_SERVER['REMOTE_ADDR'],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

        if(!$resp->is_valid){
            echo responseReturn( 'error', "Controllare di nuovo il codice di sicurezza" );
            exit();
        }

        if($_POST['licenza']==null) {

            echo responseReturn( 'error','Necessario accettare le condizioni per proseguire' );
            exit();
        }

        if($user_id=="" && $r012_mail!=""){

            echo responseReturn('success', "Iscrizione avvenuta con successo" );
            exit();
        }
        else {
            echo responseReturn('error', "Attenzione! Utente esistente o mail non valida" );
            exit();
        }
    }
}

function responseReturn($status = "success", $value="" ){
    return json_encode(
        array(
            'status'    => $status,
            'value'     => $value
        ));
}


function r012_salva_dati(){

    if($_POST){


        //$userid = $_POST[userid];
        $postid = $_POST[idpost];
        $str_campi = $_POST[campi];

        $array_dati_bio = array();
        parse_str($str_campi, $array_dati_bio);

        if($_POST['immagine']){

            //Gestisce l'upload delle immagini
            $cognome = get_post_meta($postid,'r012_cognome_saved',true);
            $nome = get_post_meta($postid,'r012_nome_saved',true);
            $nome_immagine = str_replace(" ", "", $nome.'-'.$cognome);
            $uploaded_id = R012Utility::r012_upload_image($_POST['immagine'],$nome_immagine, $postid);

            set_post_thumbnail($postid , $uploaded_id );
        }

        foreach($array_dati_bio as $key => $value){

            switch ($key){

                case 'r012_titolo_saved':

                    $term = get_term( $value, 'categorie_professionisti' );
                    $r012_name_term = $term->name;
                    wp_set_object_terms($postid,$r012_name_term,'categorie_professionisti');
                    break;

                case 'r012_ordine_saved':

                    $term = get_term( $value, 'ordini_professionisti' );
                    $r012_name_term = $term->name;
                    wp_set_object_terms($postid,$r012_name_term,'ordini_professionisti');
                    break;

                case 'r012_content_saved':

                    $r012_post_professionista = array();
                    $r012_post_professionista['ID'] = $postid;
                    $r012_post_professionista['post_content'] = $value;
                    wp_update_post( $r012_post_professionista );
                    break;

                case 'r012_attivita_item':
                    $id_term = array();
                    foreach ($value as $intvalue){

                        array_push($id_term, intval($intvalue));
                    }
                    foreach ($value as $intvalue){
                        $parent  = get_term_by( 'id', $intvalue, 'attivita_professionisti');

                        array_push($id_term, intval($parent->parent));

                    }

                    wp_set_object_terms($postid,$id_term,'attivita_professionisti');
                    break;

                case 'r012_autocomplete_professionisti_item':

                    $id_professionista = array();
                    foreach ($value as $intvalue){
                        if($intvalue =="0"){

                        }else {
                            array_push($id_professionista, $intvalue);
                        }
                    }

                    if(count($id_professionista) == 0){
                        $id_professionista = array();
                    }
                    update_post_meta($postid,'r012_collaborazioni_professionisti_saved', $id_professionista);

                    break;

                case 'r012_autocomplete_aziende_item':
                    $id_aziende = array();
                    foreach ($value as $intvalue){
                        if($intvalue =="0"){

                        }else {
                            array_push($id_aziende, $intvalue);
                        }
                    }

                    if(count($id_aziende) == 0){
                        $id_aziende = array();
                    }
                    update_post_meta($postid,'r012_collaborazioni_aziende_saved', $id_aziende);

                    break;

                case 'r012_autocomplete_operatori_item':
                    $id_operatori = array();
                    foreach ($value as $intvalue){
                        if($intvalue =="0"){

                        }else {
                            array_push($id_operatori, $intvalue);
                        }
                    }

                    if(count($id_operatori) == 0){
                        $id_operatori = array();
                    }
                    update_post_meta($postid,'r012_collaborazioni_operatori_saved', $id_operatori);

                    break;

                case 'r012_autocomplete_rivenditori_item':
                    $id_rivenditori = array();
                    foreach ($value as $intvalue){
                        if($intvalue =="0"){

                        }else {
                            array_push($id_rivenditori, $intvalue);
                        }
                    }

                    if(count($id_rivenditori) == 0){
                        $id_rivenditori = array();
                    }
                    update_post_meta($postid,'r012_collaborazioni_rivenditori_saved', $id_rivenditori);

                    break;


                default:

                    update_post_meta($postid,$key, $value);
                    break;

            }

        }

        echo responseReturn('success', 'salvataggio completato');
        exit();
    }
}

/**
 * Ricevo i dati ed elimino il progetto
 */
function r012_ajax_delete_progetto(){

    if($_POST){
        $array_progetti = array();
        $postid = $_POST['idpost'];
        $userid = $_POST['userid'];

        $posts = get_post_meta( $userid, 'r012_progetti_professionisti_saved', true);
        foreach ($posts as $post){
            if($post == $postid){

            } else{
                array_push($array_progetti, intval($post));
            }
        }
        update_post_meta($userid,'r012_progetti_professionisti_saved', $array_progetti);

        wp_delete_post( $postid );
        $r012_link = get_permalink($userid);

        echo responseReturn('success', $r012_link);
        exit();

    }
}




?>