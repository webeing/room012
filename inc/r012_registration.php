<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Webeing.net
 * Date: 15/11/12
 * Time: 14:15
 */

/**
 * Ricevo i dati creo un nuovo cpt e invio mail
 *
 */
function r012_registration(){
    if($_POST){
        $r012_studio = $_POST['r012_studio'];
        $r012_nome = $_POST['r012_nome'];
        $r012_cognome = $_POST['r012_cognome'];
        $r012_piva = $_POST['r012_piva'];
        $r012_titolo = $_POST['r012_titolo'];
        $r012_ordine = $_POST['r012_ordine'];
        $r012_numero = $_POST['r012_numero'];
        $r012_nome_studio = $_POST['r012_nome_studio'];
        $r012_posizione = $_POST['r012_posizione'];
        $r012_telefono = $_POST['r012_telefono'];
        $r012_mobile = $_POST['r012_mobile'];
        $r012_fax = $_POST['r012_fax'];
        $r012_mail = $_POST['r012_mail'];
        $r012_sito = $_POST['r012_sito'];
        $r012_citta = $_POST['r012_citta'];
        $r012_via = $_POST['r012_via'];
        $r012_cap = $_POST['r012_cap'];
        $r012_provincia = $_POST['r012_provincia'];
        $r012_biografia = $_POST['r012_biografia'];
        $r012_facebook = $_POST['r012_facebook'];
        $r012_twitter = $_POST['r012_twitter'];
        $r012_skype = $_POST['r012_skype'];
        $r012_linkedin   = $_POST['r012_linkedin'];


        $term = get_term( $r012_titolo, 'categorie_professionisti' );
        $r012_name_term_titolo = $term->name;

        $r012_post = array( 'post_name'  => $r012_nome. '-' .$r012_cognome,
            'post_title'     => $r012_nome. ' ' .$r012_cognome,
            'post_content'   => $r012_biografia,
            'post_type'      => 'professionisti'
        );
        $r012_post_id = wp_insert_post( $r012_post);
        wp_set_object_terms($r012_post_id,$r012_name_term_titolo,'categorie_professionisti');

        //Gestisce l'upload delle immagini

        $uploaded_id = R012Utility::r012_upload_image($_FILES['r012_immagine'],$r012_nome. '-' .$r012_cognome);

        if($r012_post_id) {
            update_post_meta($r012_post_id,'r012_studio_saved', $r012_studio);
            update_post_meta($r012_post_id,'r012_nome_saved', $r012_nome);
            update_post_meta($r012_post_id,'r012_cognome_saved', $r012_cognome);
            update_post_meta($r012_post_id,'r012_telefono_saved', $r012_telefono);
            update_post_meta($r012_post_id,'r012_fax_saved', $r012_fax);
            update_post_meta($r012_post_id,'r012_email_saved', $r012_mail);
            update_post_meta($r012_post_id,'r012_sito_saved', $r012_sito);
            update_post_meta($r012_post_id,'r012_citta_saved', $r012_citta);
            update_post_meta($r012_post_id,'r012_via_saved', $r012_via);
            update_post_meta($r012_post_id,'r012_cap_saved', $r012_cap);
            update_post_meta($r012_post_id,'r012_provincia_saved', $r012_provincia);
            update_post_meta($r012_post_id,'r012_ordine_saved', $r012_ordine);
            update_post_meta($r012_post_id,'r012_numero_saved', $r012_numero);
            update_post_meta($r012_post_id,'r012_nome_studio_saved', $r012_nome_studio);
            update_post_meta($r012_post_id,'r012_posizione_saved', $r012_posizione);
            update_post_meta($r012_post_id,'r012_mobile_saved', $r012_mobile);
            update_post_meta($r012_post_id,'r012_piva_saved', $r012_piva);
            update_post_meta($r012_post_id,'r012_facebook_saved', $r012_facebook);
            update_post_meta($r012_post_id,'r012_twitter_saved', $r012_twitter);
            update_post_meta($r012_post_id,'r012_skype_saved', $r012_skype);
            update_post_meta($r012_post_id,'r012_linkedin_saved', $r012_linkedin);

            set_post_thumbnail( $r012_post_id, $uploaded_id );

            $from = R012_ADMIN_MAIL;
            $headers = 'From: '.$from . "\r\n";
            $headers .= 'Content-Type: text/html; charset="UTF-8"';

            $subject = R012_OGGETTO_MAIL_ADMIN;
            $msg = r012_signin_admin_email('Nuovo professionista iscritto e in attesa di approvazione', array(
                    'nome' =>$r012_nome,
                    'cognome' =>$r012_cognome,
                    'mail' =>$r012_mail
                ));
            //da riattivare
            wp_mail( $from, $subject, $msg, $headers );

            $from = R012_ADMIN_MAIL;
            $headers = 'From: '.$from . "\r\n";
            $headers .= 'Content-Type: text/html; charset="UTF-8"';

            $subject = R012_OGGETTO_MAIL_USER;
            $msg = r012_signin_user_email();
            wp_mail( $r012_mail, $subject, $msg, $headers );

            return $r012_post_id;
            //da riattivare

            //echo responseReturn('success', "Iscrizione avvenuta con successo" );
            //exit();
        }
        else
            return false;
    }
}

function register_nuovo_progetto(){
   if($_POST){

    $r012_autore = (int) $_POST['r012_autore'];
    $r012_stato = $_POST['r012_stato'];
    $r012_nome = $_POST['r012_name_project'];
    $r012_oggetto = $_POST['r012_oggetto'];
    $r012_tipologia = $_POST['r012_tipologia'];
    $r012_attivita = $_POST['r012_attivita'];
    $r012_citta = $_POST['r012_citta_project'];
    $r012_provincia = $_POST['r012_provincia_project'];
    $r012_regione = $_POST['r012_regione_project'];
    $r012_committente = $_POST['r012_committente_project'];
    $r012_concept = $_POST['r012_concept_project'];
    $r012_studio = $_POST['r012_studio_project'];
    $r012_anno = $_POST['r012_anno_project'];
    $r012_collaborazioni_professionisti = $_POST['r012_autocomplete_professionisti_item'];
    $r012_collaborazioni_aziende = $_POST['r012_autocomplete_aziende_item'];
    $r012_collaborazioni_rivenditori = $_POST['r012_autocomplete_rivenditori_item'];
    $r012_collaborazioni_operatori = $_POST['r012_autocomplete_operatori_item'];


    $r012_post_progetto = array( 'post_name'  => $r012_nome,
        'post_title'     => $r012_nome,
        'post_content'   => $r012_concept,
        'post_type'      => 'progetto',
        'post_status'   => 'publish'
    );
    $r012_post_progetto_id = wp_insert_post( $r012_post_progetto);


        if($r012_post_progetto_id) {
            $array_progetti = array();




                update_post_meta($r012_post_progetto_id,'r012_autore_saved', $r012_autore);

                $elements = get_post_meta( $r012_autore, 'r012_progetti_professionisti_saved', true);


                foreach ($elements as $element){
                    $array_progetti[] = $element;
                }
                $array_progetti[] = $r012_post_progetto_id;

                update_post_meta($r012_autore,'r012_progetti_professionisti_saved', $array_progetti);



            $term_oggetto = get_term( $r012_oggetto, 'oggetto' );
            $r012_name_term_oggetto = $term_oggetto->name;
            wp_set_object_terms($r012_post_progetto_id,$r012_name_term_oggetto,'oggetto');

            $term_attivita = get_term( $r012_attivita, 'attivita' );
            $r012_name_term_attivita = $term_attivita->name;
            wp_set_object_terms($r012_post_progetto_id,$r012_name_term_attivita,'attivita');

            $term_tipologia = get_term( $r012_tipologia, 'tipologia' );
            $r012_name_term_tipologia = $term_tipologia->name;
            wp_set_object_terms($r012_post_progetto_id,$r012_name_term_tipologia, 'tipologia');

            $term_stato = get_term( $r012_stato, 'stato' );
            $r012_name_term_stato = $term_stato->name;
            wp_set_object_terms($r012_post_progetto_id,$r012_name_term_stato, 'stato');

            update_post_meta($r012_post_progetto_id,'r012_regione_saved', $r012_regione);
            update_post_meta($r012_post_progetto_id,'r012_localita_saved', $r012_citta);
            update_post_meta($r012_post_progetto_id,'r012_provincia_saved', $r012_provincia);
            update_post_meta($r012_post_progetto_id,'r012_anno_saved', $r012_anno);
            update_post_meta($r012_post_progetto_id,'r012_committente_saved', $r012_committente);
            update_post_meta($r012_post_progetto_id,'r012_studio_saved', $r012_studio);


            update_post_meta($r012_post_progetto_id,'r012_collaborazioni_professionisti_saved', $r012_collaborazioni_professionisti);
            update_post_meta($r012_post_progetto_id,'r012_collaborazioni_aziende_saved', $r012_collaborazioni_aziende);
            update_post_meta($r012_post_progetto_id,'r012_collaborazioni_rivenditori_saved', $r012_collaborazioni_rivenditori);
            update_post_meta($r012_post_progetto_id,'r012_collaborazioni_operatori_saved', $r012_collaborazioni_operatori);


               // $uploaded_id = R012Utility::r012_upload_image($_FILES['r012_immagine_project'], $_POST['nome']);
            session_start();

            $r012_sessione_autore = (int) $_SESSION['user_id'];
            $r012_sessione_id_attachment = (int) $_SESSION['id_attachment'];

            if($r012_sessione_autore==$r012_autore){

                set_post_thumbnail($r012_post_progetto_id , $r012_sessione_id_attachment);
                unset($_SESSION['id_attachment']);
                unset($_SESSION['user_id']);
            }

            $immagine1 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_1'], $_POST['nome'] . '-1');
            if(intval($immagine1)>0){

                $post_gallery['ID'] = $immagine1;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_1'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_1'];
                wp_update_post( $post_gallery );
                $array_ids = $immagine1;
            }

            $immagine2 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_2'], $_POST['nome'] . '-2');
            if(intval($immagine2)>0){
                $post_gallery['ID'] = $immagine2;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_2'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_2'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine2;

            }

            $immagine3 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_3'], $_POST['nome'] . '-3');
            if(intval($immagine3)>0){
                $post_gallery['ID'] = $immagine3;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_3'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_3'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine3;
            }
            $immagine4 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_4'], $_POST['nome'] . '-4');
            if(intval($immagine4)>0){
                $post_gallery['ID'] = $immagine4;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_4'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_4'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine4;
            }
            $immagine5 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_5'], $_POST['nome'] . '-5');
            if(intval($immagine5)>0){
                $post_gallery['ID'] = $immagine5;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_5'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_5'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine5;
            }
            $immagine6 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_6'], $_POST['nome'] . '-6');
            if(intval($immagine6)>0){
                $post_gallery['ID'] = $immagine6;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_6'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_6'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine6;
            }
            $immagine7 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_7'], $_POST['nome'] . '-7');
            if(intval($immagine7)>0){
                $post_gallery['ID'] = $immagine7;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_7'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_7'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine7;
            }
            $immagine8 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_8'], $_POST['nome']. '-8');
            if(intval($immagine8)>0){
                $post_gallery['ID'] = $immagine8;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_8'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_8'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine8;
            }
            $immagine9 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_9'], $_POST['nome']. '-9');
            if(intval($immagine9)>0){
                $post_gallery['ID'] = $immagine9;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_9'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_9'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine9;
            }
            $immagine10 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_10'], $_POST['nome']. '-10');
            if(intval($immagine10)>0){
                $post_gallery['ID'] = $immagine10;
                $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_10'];
                $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_10'];
                wp_update_post( $post_gallery );
                $array_ids = $array_ids . ',' . $immagine10;
            }

            $gallery_progetto = '[gallery ids="'. $array_ids .'"]';
            update_post_meta($r012_post_progetto_id,'r012_galleria_saved', $gallery_progetto);

            $array_post_id = array('id_autore' => $r012_autore,
                $array_post_id[] = 'id_post' => $r012_post_progetto_id);
            return $array_post_id;
        }

   }


}


function modifica_progetto(){
    if($_POST){

        $r012_autore = (int) $_POST['r012_autore'];
        $r012_postid = (int) $_POST['r012_post'];
        $r012_nome = $_POST['r012_name_project'];
        $r012_oggetto = $_POST['r012_oggetto'];
        $r012_tipologia = $_POST['r012_tipologia'];
        $r012_attivita = $_POST['r012_attivita'];
        $r012_stato = $_POST['r012_stato'];
        $r012_citta = $_POST['r012_citta_project'];
        $r012_provincia = $_POST['r012_provincia_project'];
        $r012_regione = $_POST['r012_regione_project'];
        $r012_committente = $_POST['r012_committente_project'];
        $r012_concept = $_POST['r012_concept_project'];
        $r012_studio = $_POST['r012_studio_project'];
        $r012_anno = $_POST['r012_anno_project'];
        $r012_collaborazioni_professionisti = $_POST['r012_autocomplete_professionisti_item'];
        $r012_collaborazioni_aziende = $_POST['r012_autocomplete_aziende_item'];
        $r012_collaborazioni_rivenditori = $_POST['r012_autocomplete_rivenditori_item'];
        $r012_collaborazioni_operatori = $_POST['r012_autocomplete_operatori_item'];


        $r012_post_progetto = array();
        $r012_post_progetto['ID'] = $r012_postid;
        $r012_post_progetto['post_title'] = $r012_nome;
        $r012_post_progetto['post_content'] = $r012_concept;

        wp_update_post( $r012_post_progetto);


            $term_oggetto = get_term( $r012_oggetto, 'oggetto' );
            $r012_name_term_oggetto = $term_oggetto->name;
            wp_set_object_terms($r012_postid,$r012_name_term_oggetto,'oggetto');

            $term_attivita = get_term( $r012_attivita, 'attivita' );
            $r012_name_term_attivita = $term_attivita->name;
            wp_set_object_terms($r012_postid,$r012_name_term_attivita,'attivita');

            $term_tipologia = get_term( $r012_tipologia, 'tipologia' );
            $r012_name_term_tipologia = $term_tipologia->name;
            wp_set_object_terms($r012_postid,$r012_name_term_tipologia, 'tipologia');

            $term_stato = get_term( $r012_stato, 'stato' );
            $r012_name_term_stato = $term_stato->name;
            wp_set_object_terms($r012_postid,$r012_name_term_stato, 'stato');

            update_post_meta($r012_postid,'r012_regione_saved', $r012_regione);
            update_post_meta($r012_postid,'r012_localita_saved', $r012_citta);
            update_post_meta($r012_postid,'r012_provincia_saved', $r012_provincia);
            update_post_meta($r012_postid,'r012_anno_saved', $r012_anno);
            update_post_meta($r012_postid,'r012_committente_saved', $r012_committente);
            update_post_meta($r012_postid,'r012_studio_saved', $r012_studio);


            update_post_meta($r012_postid,'r012_collaborazioni_professionisti_saved', $r012_collaborazioni_professionisti);
            update_post_meta($r012_postid,'r012_collaborazioni_aziende_saved', $r012_collaborazioni_aziende);
            update_post_meta($r012_postid,'r012_collaborazioni_rivenditori_saved', $r012_collaborazioni_rivenditori);
            update_post_meta($r012_postid,'r012_collaborazioni_operatori_saved', $r012_collaborazioni_operatori);



        /*
        * salvo una galleria di immagini per il progetto
        */
        $post_gallery = array();
        $array_ids ='';

        $immagine_upload_1 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_1'], $_POST['nome'] . '-1');

        if(intval($immagine_upload_1)>0){

            $immagine1 = $immagine_upload_1;

        } elseif(intval($immagine_upload_1)==0 && $_POST['r012_immagine_esistente_1']>0){

            $immagine1 = $_POST['r012_immagine_esistente_1'];

        } else {
            $immagine1 = "";

        }

        if($immagine1 != ""){

            $post_gallery['ID'] = $immagine1;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_1'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_1'];
            wp_update_post( $post_gallery );
            $array_ids = $immagine1;

        }



        $immagine_upload_2 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_2'], $_POST['nome'] . '-2');

        if(intval($immagine_upload_2)>0){
            $immagine2 = $immagine_upload_2;
        } elseif(intval($immagine_upload_2)==0 && $_POST['r012_immagine_esistente_2']>0){
            $immagine2 = $_POST['r012_immagine_esistente_2'];
        } else {
            $immagine2 = "";
        }

        if($immagine2 != ""){

            $post_gallery['ID'] = $immagine2;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_2'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_2'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine2;
            } else {
                $array_ids = $immagine2;
            }
        }


        $immagine_upload_3 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_3'], $_POST['nome'] . '-3');

        if(intval($immagine_upload_3)>0){
            $immagine3 = $immagine_upload_3;
        } elseif(intval($immagine_upload_3)==0 && $_POST['r012_immagine_esistente_3']>0){
            $immagine3 = $_POST['r012_immagine_esistente_3'];
        } else {
            $immagine3 = "";
        }

        if($immagine3 != ""){

            $post_gallery['ID'] = $immagine3;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_3'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_3'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine3;
            } else {
                $array_ids = $immagine3;
            }

        }

        $immagine_upload_4 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_4'], $_POST['nome'] . '-4');

        if(intval($immagine_upload_4)>0){
            $immagine4 = $immagine_upload_4;
        } elseif(intval($immagine_upload_4)==0 && $_POST['r012_immagine_esistente_4']>0){
            $immagine4 = $_POST['r012_immagine_esistente_4'];
        } else {
            $immagine4 = "";
        }

        if($immagine4 != ""){

            $post_gallery['ID'] = $immagine4;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_4'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_4'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine4;
            } else {
                $array_ids = $immagine4;
            }

        }


        $immagine_upload_5 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_5'], $_POST['nome'] . '-5');

        if(intval($immagine_upload_5)>0){
            $immagine5 = $immagine_upload_5;
        } elseif(intval($immagine_upload_5)==0 && $_POST['r012_immagine_esistente_5']>0){
            $immagine5 = $_POST['r012_immagine_esistente_5'];
        } else {
            $immagine5 = "";
        }

        if($immagine5 != ""){

            $post_gallery['ID'] = $immagine5;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_5'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_5'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine5;
            } else {
                $array_ids = $immagine5;
            }

        }


        $immagine_upload_6 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_6'], $_POST['nome'] . '-6');

        if(intval($immagine_upload_6)>0){
            $immagine6 = $immagine_upload_6;
        } elseif(intval($immagine_upload_6)==0 && $_POST['r012_immagine_esistente_6']>0){
            $immagine6 = $_POST['r012_immagine_esistente_6'];
        } else {
            $immagine6 = "";
        }

        if($immagine6 != ""){

            $post_gallery['ID'] = $immagine6;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_6'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_6'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine6;
            } else {
                $array_ids = $immagine6;
            }

        }


        $immagine_upload_7 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_7'], $_POST['nome'] . '-7');

        if(intval($immagine_upload_7)>0){
            $immagine7 = $immagine_upload_7;
        } elseif(intval($immagine_upload_7)==0 && $_POST['r012_immagine_esistente_7']>0){
            $immagine7 = $_POST['r012_immagine_esistente_7'];
        } else {
            $immagine7 = "";
        }

        if($immagine7 != ""){

            $post_gallery['ID'] = $immagine7;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_7'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_7'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine7;
            } else {
                $array_ids = $immagine7;
            }

        }

        $immagine_upload_8 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_8'], $_POST['nome'] . '-8');

        if(intval($immagine_upload_8)>0){
            $immagine8 = $immagine_upload_8;
        } elseif(intval($immagine_upload_8)==0 && $_POST['r012_immagine_esistente_8']>0){
            $immagine8 = $_POST['r012_immagine_esistente_8'];
        } else {
            $immagine8 = "";
        }

        if($immagine8 != ""){

            $post_gallery['ID'] = $immagine8;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_8'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_8'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine8;
            } else {
                $array_ids = $immagine8;
            }

        }

        $immagine_upload_9 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_9'], $_POST['nome'] . '-9');

        if(intval($immagine_upload_9)>0){
            $immagine9 = $immagine_upload_9;
        } elseif(intval($immagine_upload_9)==0 && $_POST['r012_immagine_esistente_9']>0){
            $immagine9 = $_POST['r012_immagine_esistente_9'];
        } else {
            $immagine9 = "";
        }

        if($immagine9 != ""){

            $post_gallery['ID'] = $immagine9;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_9'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_9'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine9;
            } else {
                $array_ids = $immagine9;
            }

        }


        $immagine_upload_10 = R012Utility::r012_upload_image($_FILES['r012_immagine_project_10'], $_POST['nome'] . '-10');

        if(intval($immagine_upload_10)>0){
            $immagine10 = $immagine_upload_10;
        } elseif(intval($immagine_upload_10)==0 && $_POST['r012_immagine_esistente_10']>0){
            $immagine10 = $_POST['r012_immagine_esistente_10'];
        } else {
            $immagine10 = "";
        }

        if($immagine10 != ""){

            $post_gallery['ID'] = $immagine10;
            $post_gallery['post_excerpt'] = $_POST['r012_didascalia_project_10'];
            $post_gallery['post_title'] = $r012_nome . ' ' . $_POST['r012_didascalia_project_10'];
            wp_update_post( $post_gallery );
            if($array_ids){
                $array_ids = $array_ids . ',' . $immagine10;
            } else {
                $array_ids = $immagine10;
            }

        }

        $gallery_progetto = '[gallery ids="'. $array_ids .'"]';

        update_post_meta($r012_postid,'r012_galleria_saved', $gallery_progetto);
          $array_post_id = array('id_autore' => $r012_autore,
        $array_post_id[] = 'id_post' => $r012_postid);
        return $array_post_id;
        }




}