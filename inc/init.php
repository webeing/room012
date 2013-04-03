<?php
/**
 *
 */
define("R012_OGGETTO_MAIL_ADMIN","Nuova Registrazione");
define("R012_OGGETTO_MAIL_USER","Registrazione effettuata");
define("R012_OGGETTO_MAIL_REGISTRAZIONE", "Registrazione conclusa con successo");
define("R012_ID_PAGE_REGISTRAZIONE",12);
define("R012_ID_PAGE_TERMINI_CONDIZIONI", 361);
define("R012_ID_PAGE_PROFESSIONISTI", 354);
define('R012_CAPTCHA_PUBKEY','6LdC79kSAAAAAIaEsO8Feg5slnsVSvzHrNs63J1h');
define('R012_CAPTCHA_PRIVKEY','6LdC79kSAAAAAFYgw-5MyLEZavp8pyKQ3UpI_zad');
define('R012_ADMIN_MAIL', 'info@room012.it');
function r012_signin_admin_email($text, $data){

    $str = "";
    foreach ($data as $key => $value){
        $str .= "<p>$key: $value</p>";
    }

    $message = <<< MESSAGE
    <p>{$text}</p>
MESSAGE;

    return $message . $str;

}

function r012_signin_user_email(){
    $message = <<< MESSAGE
     <h1>Benvenuto in ROOM 012!</h1><br/>
<h3>Il tuo profilo sarà visibile non appena approvato dagli operatori.<br/>
Riceverai una mail di conferma appena approvato. <br/><br/>
A presto </h3>
MESSAGE;

    return $message ;

}

function r012_register_email($data){

$nome = $data['nome'];
$cognome = $data['cognome'];
$email = $data['mail'];
$username = $data['username'];
$password = $data['password'];
$url_login = get_bloginfo('home') ."/login";

    $message = <<< MESSAGE
    <h1>Complimenti {$nome} {$cognome} ({$email}),<br/>
    registrazione conclusa con successo!</h1>
    <h3>Questi i dati per effettuare il login:<br/><br/>
    Username: <strong>{$username}</strong><br/>
    Password: <strong>{$password}</strong></h3><br/>
    <h3><a href="{$url_login}" title="accedi subito a ROOM012" style="background:#BAAB9A none; color:#fff; padding: 20px 30px; text-decoration:none;">Accedi a ROOM012</a></h3>

MESSAGE;

    return $message;

}