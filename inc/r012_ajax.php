<?php
/**
 * creo le action per room012
 */
//Registro la mia action registration frontend
add_action('wp_ajax_r012_registration', 'r012_ajax_registration');
add_action('wp_ajax_nopriv_r012_registration', 'r012_ajax_registration');
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


