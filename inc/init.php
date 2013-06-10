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

/*

$json = '[{"term_parent_id":"53","term_name":"Urbanistica, Pianificazione, Ambiente"},{"term_children":{"term_child":"93","term_name":"Architettura del paesaggio"}},{"term_children":{"term_child":"94","term_name":"Pianificazione territoriale e tutela ambientale"}},{"term_children":{"term_child":"92","term_name":"Progettazione urbanistica"}},{"term_children":{"term_child":"95","term_name":"Valutazioni d impatto ambientale"}},{"term_parent_id":"49","term_name":"Rilievo, Topografia, Catasto"},{"term_children":{"term_child":"86","term_name":"Catasto"}},{"term_children":{"term_child":"87","term_name":"Pratiche catastali"}},{"term_children":{"term_child":"84","term_name":"Rilievo"}},{"term_children":{"term_child":"85","term_name":"Tipografia"}},{"term_parent_id":"52","term_name":"Progettazioni Speciali"},{"term_children":{"term_child":"90","term_name":"Acustica"}},{"term_children":{"term_child":"88","term_name":"Prevenzione incendi"}},{"term_children":{"term_child":"91","term_name":"Progettazione meccanica"}},{"term_children":{"term_child":"89","term_name":"Risparmio energetico"}},{"term_parent_id":"41","term_name":"Progettazione Architettonica"},{"term_children":{"term_child":"63","term_name":"Architetture temporanee, installazioni"}},{"term_children":{"term_child":"57","term_name":"Commerciale"}},{"term_children":{"term_child":"58","term_name":"Direzionale, Uffici"}},{"term_children":{"term_child":"59","term_name":"Edilizia Scolastica"}},{"term_children":{"term_child":"56","term_name":"Residenziale"}},{"term_children":{"term_child":"61","term_name":"Ristorazione (___)"}},{"term_children":{"term_child":"60","term_name":"Settore turistico (strutture ricettive, stabilimenti balneari)"}},{"term_children":{"term_child":"62","term_name":"Strutture sanitarie"}},{"term_parent_id":"43","term_name":"Infrastrutture"},{"term_children":{"term_child":"72","term_name":"Progettazione ferroviaria"}},{"term_children":{"term_child":"73","term_name":"Progettazione marittima e portuale"}},{"term_children":{"term_child":"71","term_name":"Progettazione stradale"}},{"term_parent_id":"48","term_name":"Impiantistica"},{"term_children":{"term_child":"83","term_name":"Impianti fotovoltaici"}},{"term_children":{"term_child":"81","term_name":"Impianti termoidraulici"}},{"term_children":{"term_child":"82","term_name":"Impiantisti elettrici Telecomunicazioni"}},{"term_parent_id":"44","term_name":"Idraulica"},{"term_children":{"term_child":"70","term_name":"Idraulica"}},{"term_children":{"term_child":"69","term_name":"Opere idrauliche, condotte, fognature"}},{"term_parent_id":"45","term_name":"Geotecnica"},{"term_children":{"term_child":"75","term_name":"Indagini del sottosuolo, carotaggi"}},{"term_children":{"term_child":"74","term_name":"Progettazione geologica, geotecnica"}},{"term_parent_id":"54","term_name":"Disegno CAD, Grafica, Modellisti"},{"term_children":{"term_child":"96","term_name":"Disegno Cad e modellazione 3d"}},{"term_children":{"term_child":"97","term_name":"Grafica, computer art"}},{"term_children":{"term_child":"98","term_name":"Modellistica"}},{"term_parent_id":"46","term_name":"Direzione lavori e cantiere"},{"term_children":{"term_child":"77","term_name":"Coordinamento sicurezza del cantiere"}},{"term_children":{"term_child":"76","term_name":"Direzione lavori"}},{"term_parent_id":"47","term_name":"Design\/Arredo d interni"},{"term_children":{"term_child":"78","term_name":"Arredo e design d interni"}},{"term_children":{"term_child":"80","term_name":"Design industriale"}},{"term_children":{"term_child":"79","term_name":"Illuminazione d interni"}},{"term_parent_id":"51","term_name":"Consulenze"},{"term_parent_id":"50","term_name":"Computo e contabilit\u00e0"},{"term_parent_id":"42","term_name":"Calcolo Strutturale"},{"term_children":{"term_child":"64","term_name":"Calcolo strutturale edifici civili"}},{"term_children":{"term_child":"65","term_name":"Calcolo strutturale edifici industriali"}},{"term_children":{"term_child":"66","term_name":"Progettazione ponti e viadotti"}},{"term_children":{"term_child":"67","term_name":"Prove tecniche strutturali, collaudi"}},{"term_parent_id":"55","term_name":"Altro"}]';
$json_decode = json_decode($json);

foreach($json_decode as $term){

    if(($term->term_parent_id)){
       wp_insert_term(
            $term->term_name, // the term
            'attivita_professionisti' // the taxonomy

        );
        /* foreach ( $term as $term_child){
            wp_insert_term(
                $term->term_name, // the term
                'attivita_professionisti',
                 array('parent'=> $parent['term_id'])// the taxonomy

            );
        }
    }

}*/