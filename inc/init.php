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
define('R012_CAPTCHA_PUBKEY','6LckX98SAAAAAPyePexixG3fSlgvihmXJRvVMjpg');
define('R012_CAPTCHA_PRIVKEY','6LckX98SAAAAABAe0DbYYpNy891uMnPHHLhKLB0C');
define('R012_ADMIN_MAIL', 'info@room012.it');
define('R012_TEMPLATES_DIRECTORY', '/inc/templates/');


global $province;
global $regioni;

$regioni = array(
    "Seleziona la regione" => "0",
    "Abruzzo" => 1,
    "Basilicata" => 2,
    "Calabria"  => 3,
    "Campania" => 4,
    "Emilia Romagna" => 5,
    "Friuli Venezia Giulia" => 6,
    "Lazio" => 7,
    "Liguria" => 8,
    "Lombardia" => 9,
    "Marche" => 10,
    "Molise" => 11,
    "Piemonte" => 12,
    "Puglia" => 13,
    "Sardegna" => 14,
    "Sicilia" => 15,
    "Toscana" => 16,
    "Trentino Alto Adige" => 17,
    "Umbria" => 18,
    "Valle d'Aosta" => 19,
    "Veneto" => 20
);


$province = array(
    "Seleziona la provincia" => "0",
    "Agrigento" => "AG",
    "Alessandria" => "AL",
    "Ancona" => "AN",
    "Aquila" => "AQ",
    "Arezzo" => "AR",
    "Ascoli Piceno" => "AP",
    "Asti" => "AT",
    "Avellino" => "AV",
    "Bari" => "BA",
    "Barletta Andria Trani" => "BT",
    "Belluno" => "BL",
    "Benevento" => "BN",
    "Bergamo" => "BG",
    "Biella" => "BI",
    "Bologna" => "BO",
    "Bolzano" => "BZ",
    "Brescia" => "BS",
    "Brindisi" => "BR",
    "Cagliari" => "CA",
    "Caltanisetta" => "CL",
    "Campobasso" => "CB",
    "Carbonia-Iglesias" => "CI",
    "Caserta" => "CE",
    "Catania" => "CT",
    "Catanzaro" => "CZ",
    "Chieti" => "CH",
    "Como" => "CO",
    "Cosenza" => "CS",
    "Cremona" => "CR",
    "Crotone" => "KR",
    "Cuneo" => "CN",
    "Enna" => "EN",
    "Fermo" => "FM",
    "Ferrara" => "FE",
    "Firenze" => "FI",
    "Foggia" => "FG",
    "Forlì-Cesena" => "FC",
    "Frosinone" => "FR",
    "Genoa" => "GE",
    "Gorizia" => "GO",
    "Grosseto" => "GR",
    "Imperia" => "IM",
    "Isernia" => "IS",
    "Latina" => "LT",
    "Lecce" => "LE",
    "Lecco" => "LC",
    "Livorno" => "LI",
    "Lodi" => "LO",
    "Lucca" => "LU",
    "Macerata" => "MC",
    "Mantova" => "MN",
    "Massa-Carrara" => "MS",
    "Matera" => "MT",
    "Medio Campidano" => "VS",
    "Messina" => "ME",
    "Milano" => "MI",
    "Modena" => "MO",
    "Monza e Brianza" => "MB",
    "Napoli" => "NA",
    "Novara" => "NO",
    "Nuoro" => "NU",
    "Ogliastra" => "OG",
    "Olbia-Tempio" => "OT",
    "Oristano" => "OR",
    "Padova" => "PD",
    "Palermo" => "PA",
    "Parma" => "PR",
    "Pavia" => "PV",
    "Perugia" => "PG",
    "Pesaro e Urbino" => "PU",
    "Pescara" => "PE",
    "Piacenza" => "PC",
    "Pisa" => "PI",
    "Pistoia" => "PT",
    "Pordenone" => "PN",
    "Potenza" => "PZ",
    "Prato" => "PO",
    "Ragusa" => "RG",
    "Ravenna" => "RA",
    "Reggio Calabria" => "RC",
    "Reggio Emilia" => "RE",
    "Rieti" => "RI",
    "Rimini" => "RN",
    "Roma" => "RM",
    "Rovigo" => "RO",
    "Salerno" => "SA",
    "Sassari" => "SS",
    "Savona" => "SV",
    "Siena" => "SI",
    "Siracusa" => "SR",
    "Sondrio" => "SO",
    "Spezia" => "SP",
    "Taranto" => "TA",
    "Teramo" => "TE",
    "Terni" => "TR",
    "Torino" => "TO",
    "Trapani" => "TP",
    "Trento" => "TN",
    "Treviso" => "TV",
    "Trieste" => "TS",
    "Udine" => "UD",
    "Valle d'Aosta" => "AO",
    "Varese" => "VA",
    "Venezia" => "VE",
    "Verbano Cusio Ossola" => "VB",
    "Vercelli" => "VC",
    "Verona" => "VR",
    "Vibo Valencia" => "VV",
    "Vicenza" => "VI",
    "Viterbo" => "VT");



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