<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Webeing.net
 * Date: 15/11/12
 * Time: 14:15
 */

/**
 * Ricevo i dati creo un nuovo cpt e invio mail
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
        $uploaded_id = r012_upload_image($_FILES['r012_immagine'],$r012_nome. '-' .$r012_cognome);

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

function r012_upload_image($file, $file_title) {

    if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

    if(isset($file) && ($file['size'] > 0)) {

        // Get the type of the uploaded file. This is returned as "type/extension"
        $arr_file_type = wp_check_filetype(basename($file['name']));
        $uploaded_file_type = $arr_file_type['type'];

        // Set an array containing a list of acceptable formats
        $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');

        $attach_id = 0;

        // If the uploaded file is the right format
        if(in_array($uploaded_file_type, $allowed_file_types)) {

            // Options array for the wp_handle_upload function. 'test_upload' => false
            $upload_overrides = array( 'test_form' => false );

            // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
            $uploaded_file = wp_handle_upload($file, $upload_overrides);


            // If the wp_handle_upload call returned a local path for the image
            if(isset($uploaded_file['file'])) {

                // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                $file_name_and_location = $uploaded_file['file'];

                // Generate a title for the image that'll be used in the media library
                $file_title_for_media_library = $file_title;

                // Set up options array to add this file as an attachment
                $attachment = array(
                    'post_mime_type' => $uploaded_file_type,
                    'post_title' => addslashes($file_title_for_media_library),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );



                // Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
                $attach_id = wp_insert_attachment( $attachment, $file_name_and_location );
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
                wp_update_attachment_metadata($attach_id,  $attach_data);

                return $attach_id;

            } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.

                return  __('Errors while managing files. Ask Administrators.','r012');
            }

        } else { // wrong file type

            return  __('Please upload only image files (jpg, gif or png).','r012');

        }

    } else { // No file was passed

        return  __('No file attached','r012');

    }

}
