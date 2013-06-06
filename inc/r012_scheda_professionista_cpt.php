<?php
/**
 * Funzioni Webeing.net per il sito room 012
 */

/**
 * Crea l'oggetto professionista
 */
add_action( 'init', 'r012_professionista_setup');
function r012_professionista_setup(){
    $professionista = new R012Professionista();
}


/**
 * Class R012Progetto
 */
class R012Professionista{

    public function R012Professionista(){



        add_action( 'add_meta_boxes', array('R012Professionista','r012_add_custom_box_scheda'));
        add_action( 'add_meta_boxes', array('R012Professionista', 'r012_add_custom_box_social'));
        add_action( 'add_meta_boxes', array('R012Professionista','r012_add_custom_box_collaborazioni'));
        add_action( 'add_meta_boxes', array('R012Professionista','r012_add_custom_box_progetti'));
        add_action( 'save_post', array('R012Professionista','r012_save_scheda'));


        $this->r012_register_scheda();
        $this->r012_create_categories_professionisti_taxonomies();
        $this->r012_create_categories_attivita_taxonomies();
        $this->r012_create_ordine_taxonomies();

        add_filter('query_vars', array('R012Professionista','add_query_vars'));
    }

    //registro il CPT progetto
    public function r012_register_scheda() {

            $r012_scheda_labels = array(
                'name'               => __('Scheda Professionisti','r012'),
                'singular_name'      => __('Scheda Professionista','r012'),
                'add_new'            => __('Aggiungi Professionista','r012'),
                'add_new_item'       => __('Nuovo Professionista','r012'),
                'edit_item'          => __('Modifica Professionista','r012'),
                'new_item'           => __('Nuovo Professionista','r012'),
                'all_items'          => __('Elenco Professionisti','r012'),
                'view_item'          => __('Visualizza Professionista','r012'),
                'search_items'       => __('Cerca Professionisti','r012'),
                'not_found'          => __('Professionista non trovato','r012'),
                'not_found_in_trash' => __('Professionista non trovato nel cestino','r012'),
            );

            $r012_scheda_cpt = array(
                'labels'             => $r012_scheda_labels,
                'public'             => true,
                'rewrite'            => array('slug' => 'scheda-professionista', 'with_front' => false),
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 5,
                'supports'           => array(
                    'title',
                    'editor',
                    'thumbnail'
                ),
            );

            register_post_type('professionisti', $r012_scheda_cpt);

        $this->flush_rewrite_rules();
        }


        /**
         * Aggiungo il meta box link
         */
        public function r012_add_custom_box_scheda() {

            add_meta_box(
                'scheda_id',
                __( 'Scheda Professionista', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_scheda'),
                'professionisti',
                'advanced',
                'high'
            );

        }

        /**
         * aggiungo meta box social
         */

        public function r012_add_custom_box_social() {

            add_meta_box(
                'social_id',
                __( 'Account Social', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_social'),
                'professionisti',
                'advanced',
                'high'
            );

        }

        /**
         * aggiungo collaborazioni professionisti
         */

        public function r012_add_custom_box_collaborazioni() {

            add_meta_box(
                'collaborazioni_id',
                __( 'Collaborazioni professionisti', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_collaborazioni'),
                'professionisti',
                'advanced',
                'high'
            );


            add_meta_box(
                'collaborazioni_aziende_id',
                __( 'Collaborazioni aziende', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_collaborazioni_aziende'),
                'professionisti',
                'advanced',
                'high'
            );

            add_meta_box(
                'collaborazioni_rivenditori_id',
                __( 'Collaborazioni rivenditori', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_collaborazioni_rivenditori'),
                'professionisti',
                'advanced',
                'high'
            );

            add_meta_box(
                'collaborazioni_operatori_id',
                __( 'Collaborazioni operatori', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_collaborazioni_operatori'),
                'professionisti',
                'advanced',
                'high'
            );

        }





        public function r012_add_custom_box_progetti() {

            add_meta_box(
                'progetti_id',
                __( 'Progetti', 'r012' ),
                array(__CLASS__,'r012_print_custom_box_progetti'),
                'professionisti',
                'advanced',
                'high'
            );

        }

    /**
     * box collaborazione professionista
     */
    public function r012_print_custom_box_collaborazioni( $post ) {
             /*
             * start class autocomplete
             */
            $testo_professionisti = 'Inserisci il nome e il cognome del professionista</br>';
            R012Autocomplete::print_input_autocomplete( 'professionisti', $testo_professionisti);

            $r012_values_autocomplete = get_post_meta( $post->ID, 'r012_collaborazioni_professionisti_saved', true);

            R012Autocomplete::print_result_autocomplete('professionisti', $r012_values_autocomplete);

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );
        }

    public function r012_print_custom_box_collaborazioni_aziende( $post ) {

            $testo_azienda = 'Inserisci il nome azienda</br>';
            R012Autocomplete::print_input_autocomplete('aziende', $testo_azienda);

            $r012_values_autocomplete_aziende = get_post_meta( $post->ID, 'r012_collaborazioni_aziende_saved', true);

            R012Autocomplete::print_result_autocomplete('aziende', $r012_values_autocomplete_aziende);

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );
    }

    public function r012_print_custom_box_collaborazioni_rivenditori( $post ) {

            $testo_rivenditori = 'Inserisci il nome del rivenditore</br>';
            R012Autocomplete::print_input_autocomplete('rivenditori', $testo_rivenditori);

            $r012_values_autocomplete_rivenditori = get_post_meta( $post->ID, 'r012_collaborazioni_rivenditori_saved', true);

            R012Autocomplete::print_result_autocomplete('rivenditori', $r012_values_autocomplete_rivenditori);

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

    }

    public function r012_print_custom_box_collaborazioni_operatori( $post ) {

            $testo_operatori = 'Inserisci il nome operatore</br>';
            R012Autocomplete::print_input_autocomplete( 'operatori', $testo_operatori);
            $r012_values_autocomplete_operatori = get_post_meta( $post->ID, 'r012_collaborazioni_operatori_saved', true);
            R012Autocomplete::print_result_autocomplete('operatori', $r012_values_autocomplete_operatori);

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

    }


    /**
     * custom box progetti
     */
    public function r012_print_custom_box_progetti( $post ) {
        /*
        $testo_progetti = 'Inserisci i progetti legati al professionista</br>';
        R012Autocomplete::print_input_autocomplete( 'progetto', $testo_progetti);
        */
        echo 'Progetti legati al professionista: </br>';

        $r012_values_progetti = get_post_meta( $post->ID, 'r012_progetti_professionisti_saved', true);

        foreach($r012_values_progetti as $r012_value_progetti ){
            echo get_the_title($r012_value_progetti) . '</br>';

        }
        //R012Autocomplete::print_result_autocomplete('progetto', $r012_values_autocomplete_progetti);

        wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );
    }



    /**
         * Stampo il box per i dati della scheda professionista
         */
        public function r012_print_custom_box_social( $post ) {
            $r012_value_facebook = get_post_meta( $post->ID, 'r012_facebook_saved', true);
            $r012_value_twitter = get_post_meta( $post->ID, 'r012_twitter_saved', true);
            $r012_value_linkedin = get_post_meta( $post->ID, 'r012_linkedin_saved', true);
            $r012_value_skype = get_post_meta( $post->ID, 'r012_skype_saved', true);

            echo '<p><label for="r012_facebook">';
            _e("Account Facebook", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_facebook" id="r012_facebook_id" value="'.$r012_value_facebook.'"></p>';

            echo '<p><label for="r012_twitter">';
            _e("Account Twitter", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_twitter" id="r012_twitter_id" value="'.$r012_value_twitter.'"></p>';

            echo '<p><label for="r012_linkedin">';
            _e("Account Linkedin", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_linkedin" id="r012_linkedin_id" value="'.$r012_value_linkedin.'"></p>';

            echo '<p><label for="r012_skype_saved">';
            _e("Account Skype", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_skype" id="r012_skype_id" value="'.$r012_value_skype.'"></p>';

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

            //var_dump(get_post_meta($post->ID,'_wp_geo_marker',true));
        }

        public function r012_print_custom_box_scheda( $post ) {

            $r012_value_nome = get_post_meta( $post->ID, 'r012_nome_saved', true);
            $r012_value_cognome = get_post_meta( $post->ID, 'r012_cognome_saved', true);
            $r012_value_telefono = get_post_meta( $post->ID, 'r012_telefono_saved', true);
            $r012_value_fax = get_post_meta( $post->ID, 'r012_fax_saved', true);
            $r012_value_email = get_post_meta( $post->ID, 'r012_email_saved', true);
            $r012_value_sito = get_post_meta( $post->ID, 'r012_sito_saved', true);
            $r012_value_citta = get_post_meta( $post->ID, 'r012_citta_saved', true);
            $r012_value_via = get_post_meta( $post->ID, 'r012_via_saved', true);
            $r012_value_cap = get_post_meta( $post->ID, 'r012_cap_saved', true);
            $r012_value_provincia = get_post_meta( $post->ID, 'r012_provincia_saved', true);
            $r012_value_ordine = get_post_meta( $post->ID, 'r012_ordine_saved', true);
            $r012_value_numero = get_post_meta( $post->ID, 'r012_numero_saved', true);
            $r012_value_nome_studio = get_post_meta( $post->ID, 'r012_nome_studio_saved', true);
            $r012_value_posizione = get_post_meta( $post->ID, 'r012_posizione_saved', true);
            $r012_value_mobile = get_post_meta( $post->ID, 'r012_mobile_saved', true);
            $r012_value_piva = get_post_meta( $post->ID, 'r012_piva_saved', true);
            $r012_value_approvato = get_post_meta( $post->ID, 'r012_approvato_saved', true);
            $r012_value_studio = get_post_meta( $post->ID, 'r012_studio_saved', true);
            //$r012_value_img= get_post_meta( $post->ID, 'r012_img_saved', true);
            $r012_value_junior = get_post_meta( $post->ID, 'r012_junior_saved', true);

            wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

            $checked_studio ='';
            if ($r012_value_studio == 1){
                $checked_studio = ' checked="checked"';
            }

            echo '<p><input name="r012_studio" id="r012_studio_id" value="1" type="checkbox" '.$checked_studio.' />';
            echo '<label for="r012_studio">';
            _e("Registra utente come studio", 'r012' );
            echo '</label></p>';

            $checked_approvazione ='';
            if ($r012_value_approvato == 1){
                $checked_approvazione = ' checked="checked"';
            }

            echo '<p><input name="r012_approvato" id="r012_approvato_id" value="1" type="checkbox" '.$checked_approvazione.' />';
            echo '<label for="r012_approvato">';
            _e("Approva utente", 'r012' );
            echo '</label></p>';

            echo '<p><label for="r012_nome">';
            _e("Nome", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_nome" id="r012_nome_id" value="'.$r012_value_nome.'" /></p>';

            echo '<p><label for="r012_cognome">';
            _e("Cognome", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_cognome" id="r012_cognome_id" value="'.$r012_value_cognome.'" /></p>';

            echo '<p><label for="r012_piva">';
            _e("P. IVA", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_piva" id="r012_piva_id" value="'.$r012_value_piva.'" /></p>';

            echo '<p><label for="r012_ordine">';
            _e("Ordine iscrizione", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_ordine" id="r012_ordine_id" value="'.$r012_value_ordine.'" /></p>';

            echo '<p><label for="r012_numero">';
            _e("Numero iscrizione", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_numero" id="r012_numero_id" value="'.$r012_value_numero.'" /></p>';

            echo '<p><label for="r012_nome_studio">';
            _e("Nome studio", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_nome_studio" id="r012_nome_studio_id" value="'.$r012_value_nome_studio.'" /></p>';

            echo '<p><label for="r012_posizione">';
            _e("Posizione", 'r012' );
            echo '</label> ';
            echo '<input type="text" name="r012_posizione" id="r012_posizione_id" value="'.$r012_value_posizione.'" /></p>';

            echo '<p><label for="r012_telefono">';
            _e("Telefono", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_telefono" id="r012_telefono_id" value="'.$r012_value_telefono.'" /></p>';

            echo '<p><label for="r012_mobile">';
            _e("Mobile", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_mobile" id="r012_mobile_id" value="'.$r012_value_mobile.'" /></p>';

            echo '<p><label for="r012_fax">';
            _e("Fax", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_fax" id="r012_fax_id" value="'.$r012_value_fax.'" /></p>';

            echo '<p><label for="r012_email">';
            _e("Email", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_email" id="r012_email_id" value="'.$r012_value_email.'" /></p>';

            echo '<p><label for="r012_sito">';
            _e("Sito web", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_sito" id="r012_sito_id" value="'.$r012_value_sito.'" /></p>';

            echo '<p><label for="r012_citta">';
            _e("Città", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_citta" id="r012_citta_id" value="'.$r012_value_citta.'" /></p>';

            echo '<p><label for="r012_via">';
            _e("Via", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_via" id="r012_via_id" value="'.$r012_value_via.'" /></p>';

            echo '<p><label for="r012_cap">';
            _e("Cap", 'r012' );
            echo '</label>';
            echo '<input type="text" name="r012_cap" id="r012_cap_id" value="'.$r012_value_cap.'" /></p>';

            echo '<p><label for="r012_provincia">';
            _e("Provincia", 'r012' );
            echo '</label>';

            global $province;
            echo '<select name="r012_provincia" id="r012_provincia_id">';
                foreach ($province as $key => $value) {
                    if($value == $r012_value_provincia){
                        echo '<option value='.$value.' selected>'.$key.'</option>';
                    } else {
                        echo '<option value='.$value.'>'.$key.'</option>';
                    }

                }
            echo '</select>';

            $checked_junior ='';
            if ($r012_value_junior == 1){
                $checked_junior = ' checked="checked"';
            }


            echo '<p><label for="r012_junior">';
            _e("Competenza professionista: ", 'r012' );
            echo '</label></p>';
            echo '<p><label for="r012_junior">';
            _e("Junior ", 'r012' );
            echo '<input name="r012_junior" id="r012_junior_id" value="1" type="checkbox" '.$checked_junior.' /></p>';

        }
        /**
         * Salvataggio ctp scheda professionista
         */
        public function r012_save_scheda( $post_id ) {

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return;


            if ( ! wp_verify_nonce( $_POST['nonce_professionisti'], 'r012_professionisti_nonce' ))
                return;

            if (isset($_POST['r012_nome'])) {
            $r012_nome = $_POST['r012_nome'];
            }
            if (isset($_POST['r012_cognome'])) {
            $r012_cognome = $_POST['r012_cognome'];
            }
            if (isset($_POST['r012_telefono'])) {
            $r012_telefono = $_POST['r012_telefono'];
            }
            if (isset($_POST['r012_fax'])) {
            $r012_fax = $_POST['r012_fax'];
            }
            if (isset($_POST['r012_sito'])) {
            $r012_sito = $_POST['r012_sito'];
            }
            if (isset($_POST['r012_email'])) {
            $r012_email = $_POST['r012_email'];
            }
            if (isset($_POST['r012_citta'])){
            $r012_citta = $_POST['r012_citta'];
            }
            if (isset($_POST['r012_via'])){
            $r012_via = $_POST['r012_via'];
            }
            if (isset($_POST['r012_cap'])){
            $r012_cap = $_POST['r012_cap'];
            }
            if (isset($_POST['r012_provincia'])){
            $r012_provincia = $_POST['r012_provincia'];
            }
            if (isset($_POST['r012_ordine'])){
            $r012_ordine = $_POST['r012_ordine'];
            }
            if (isset($_POST['r012_numero'])){
            $r012_numero = $_POST['r012_numero'];
            }
            if (isset($_POST['r012_nome_studio'])){
            $r012_nome_studio = $_POST['r012_nome_studio'];
            }
            if (isset($_POST['r012_posizione'])){
            $r012_posizione = $_POST['r012_posizione'];
            }
            if (isset($_POST['r012_mobile'])){
            $r012_mobile = $_POST['r012_mobile'];
            }
            if (isset($_POST['r012_piva'])){
            $r012_piva = $_POST['r012_piva'];
            }
            if (isset($_POST['r012_approvato'])){
            $r012_approvato = $_POST['r012_approvato'];
            }

            if (isset($_POST['r012_junior'])){
                $r012_junior = $_POST['r012_junior'];
            }

            if (isset($_POST['r012_studio'])){
                $r012_studio = $_POST['r012_studio'];
            }
            /*
             * salvataggio dati social
             */
            if (isset($_POST['r012_facebook'])){
                $r012_facebook = $_POST['r012_facebook'];
            }
            if (isset($_POST['r012_twitter'])){
               $r012_twitter = $_POST['r012_twitter'];
            }
            if (isset($_POST['r012_linkedin'])){
                $r012_linkedin = $_POST['r012_linkedin'];
            }
            if (isset($_POST['r012_skype'])){
                $r012_skype = $_POST['r012_skype'];
            }

            /*
             * salvataggio collaborazioni
             */
            if (isset($_POST['r012_autocomplete_professionisti_item'])) {

                $r012_collaborazioni_professionisti = $_POST['r012_autocomplete_professionisti_item'];
            }

            if (isset($_POST['r012_autocomplete_aziende_item'])) {

                $r012_collaborazioni_aziende = $_POST['r012_autocomplete_aziende_item'];
            }

            if (isset($_POST['r012_autocomplete_operatori_item'])) {
                $r012_collaborazioni_operatori = $_POST['r012_autocomplete_operatori_item'];
            }

            if (isset($_POST['r012_autocomplete_rivenditori_item'])) {
                $r012_collaborazioni_rivenditori = $_POST['r012_autocomplete_rivenditori_item'];
            }

            /*
            * salvataggio progetti

            if (isset($_POST['r012_autocomplete_progetto_item'])) {
                $r012_progetti_professionisti = $_POST['r012_autocomplete_progetto_item'];
            }*/

            if ($r012_approvato == 1){
                $user_id = email_exists($r012_email);

                if(!$user_id){


                    $random_password = wp_generate_password( 12, false );

                    $user_id = wp_create_user( $r012_email, $random_password, $r012_email );
                    update_post_meta($post_id,'r012_autore_saved', $user_id);

                    $from = R012_ADMIN_MAIL;
                    $headers = 'From: '.$from . "\r\n";
                    $headers .= 'Content-Type: text/html; charset="UTF-8"';

                    $subject = R012_OGGETTO_MAIL_REGISTRAZIONE;
                    $msg = r012_register_email(array(
                        'nome' =>$r012_nome,
                        'cognome' =>$r012_cognome,
                        'mail' =>$r012_email,
                        'username' =>$r012_email,
                        'password' => $random_password
                    ));
                    wp_mail( $r012_email, $subject, $msg, $headers );
                }
            }



            update_post_meta($post_id,'r012_studio_saved', $r012_studio);
            update_post_meta($post_id,'r012_approvato_saved', $r012_approvato);
            update_post_meta($post_id,'r012_nome_saved', $r012_nome);
            update_post_meta($post_id,'r012_cognome_saved', $r012_cognome);
            update_post_meta($post_id,'r012_telefono_saved', $r012_telefono);
            update_post_meta($post_id,'r012_fax_saved', $r012_fax);
            update_post_meta($post_id,'r012_email_saved', $r012_email);
            update_post_meta($post_id,'r012_sito_saved', $r012_sito);
            update_post_meta($post_id,'r012_citta_saved', $r012_citta);
            update_post_meta($post_id,'r012_via_saved', $r012_via);
            update_post_meta($post_id,'r012_cap_saved', $r012_cap);
            update_post_meta($post_id,'r012_provincia_saved', $r012_provincia);
            update_post_meta($post_id,'r012_ordine_saved', $r012_ordine);
            update_post_meta($post_id,'r012_numero_saved', $r012_numero);
            update_post_meta($post_id,'r012_nome_studio_saved', $r012_nome_studio);
            update_post_meta($post_id,'r012_posizione_saved', $r012_posizione);
            update_post_meta($post_id,'r012_mobile_saved', $r012_mobile);
            update_post_meta($post_id,'r012_piva_saved', $r012_piva);
            update_post_meta($post_id,'r012_junior_saved', $r012_junior);
            /*
             * salvataggio dati social
             */
            update_post_meta($post_id,'r012_facebook_saved', $r012_facebook);
            update_post_meta($post_id,'r012_twitter_saved', $r012_twitter);
            update_post_meta($post_id,'r012_linkedin_saved', $r012_linkedin);
            update_post_meta($post_id,'r012_skype_saved', $r012_skype);

            /*
             * salvataggio collaborazioni
             */


            update_post_meta($post_id,'r012_collaborazioni_professionisti_saved', $r012_collaborazioni_professionisti);
            update_post_meta($post_id,'r012_collaborazioni_aziende_saved', $r012_collaborazioni_aziende);
            update_post_meta($post_id,'r012_collaborazioni_rivenditori_saved', $r012_collaborazioni_rivenditori);
            update_post_meta($post_id,'r012_collaborazioni_operatori_saved', $r012_collaborazioni_operatori);


            /*
            * salvataggio progetti
            */
           // update_post_meta($post_id,'r012_progetti_professionisti_saved', $r012_progetti_professionisti);
        }



        //creo una tassonomia per il CTP scheda professionisti
        public function r012_create_categories_professionisti_taxonomies()
        {

            // tassonomia categorie professionisti

            $labels = array(
                'name' => 'Categorie Professionista',
                'singular_name' => 'Categoria Professionista',
                'search_items' => 'Cerca Categoria Professionista',
                'popular_items' => 'Popular Categorie Professionista',
                'all_items' => 'Tutte le Categorie Professionista' ,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Categoria Professionista',
                'update_item' => 'Aggiorna Categoria Professionista',
                'add_new_item' => 'Aggiungi Nuova Categoria Professionista',
                'new_item_name' => 'Nome Nuova Categoria Professionista',
                'separate_items_with_commas' => 'Separa Categorie Professionista con le virgole',
                'add_or_remove_items' => 'Aggiungi e Rimuovi Categorie Professionista',
                'choose_from_most_used' => 'Scegli dalle Categorie Professionista più usate',
                'menu_name' => 'Categorie Professionista',
            );

            register_taxonomy('categorie_professionisti','professionisti',array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array( 'slug' => 'categoria-professionisti' ),
            ));
            $this->flush_rewrite_rules();
        }



        //creo una tassonomia attività per il CTP scheda professionisti
        public function r012_create_categories_attivita_taxonomies()
        {

            // tassonomia attivita professionisti

            $labels = array(
                'name' => 'Attività Professionista',
                'singular_name' => 'Attività Professionista',
                'search_items' => 'Cerca Attività Professionista',
                'popular_items' => 'Popular Attività Professionista',
                'all_items' => 'Tutte le Attività Professionista' ,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Attività Professionista',
                'update_item' => 'Aggiorna Attività Professionista',
                'add_new_item' => 'Aggiungi Nuova Attività Professionista',
                'new_item_name' => 'Nome Nuova Attività Professionista',
                'separate_items_with_commas' => 'Separa Attività Professionista con le virgole',
                'add_or_remove_items' => 'Aggiungi e Rimuovi Attività Professionista',
                'choose_from_most_used' => 'Scegli dalle Attività Professionista più usate',
                'menu_name' => 'Categorie Attività',
            );

            register_taxonomy('attivita_professionisti','professionisti',array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array( 'slug' => 'attivita-professionisti' ),
            ));
            $this->flush_rewrite_rules();
        }


        //creo una tassonomia ordine per il CTP scheda professionisti
        public function r012_create_ordine_taxonomies()
        {

            // tassonomia attivita professionisti

            $labels = array(
                'name' => 'Ordine Professionista',
                'singular_name' => 'Ordine Professionista',
                'search_items' => 'Cerca Ordini Professionista',
                'popular_items' => 'Popular Ordini Professionista',
                'all_items' => 'Tutte le Ordini Professionista' ,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Ordine Professionista',
                'update_item' => 'Aggiorna Ordine Professionista',
                'add_new_item' => 'Aggiungi Nuovo Ordine Professionista',
                'new_item_name' => 'Nome Nuovo Ordine Professionista',
                'separate_items_with_commas' => 'Separa Ordine Professionista con le virgole',
                'add_or_remove_items' => 'Aggiungi e Rimuovi Ordine Professionista',
                'choose_from_most_used' => 'Scegli dalle Ordine Professionista più usato',
                'menu_name' => 'Acronomi Ordini',
            );

            register_taxonomy('ordini_professionisti','professionisti',array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array( 'slug' => 'ordini-professionisti' ),
            ));

            $this->flush_rewrite_rules();
        }

    function flush_rewrite_rules() {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
    }


    function add_query_vars($qvars) {
        $qvars[] = 'action';
        return $qvars;
    }


    //funzione che stampa la tassonomia attività professionisti in frontend
    public function r012_print_attivita_professionisti($post_id){
        $args = array('fields' => 'all');

        $terms_attivita_professionista = wp_get_object_terms( $post_id, 'attivita_professionisti',$args);

        $args_exclude = array();
        foreach ($terms_attivita_professionista as $term_attivita_professionista) {

            if($term_attivita_professionista->parent==0){

                array_push($args_exclude, intval($term_attivita_professionista->term_id));

                echo '<span class="title-busyness">' . strtoupper($term_attivita_professionista->name) .' | </span>';

                $args = array(
                    'child_of'  => $term_attivita_professionista->term_id);

                $r012_termini_attivita = get_terms( 'attivita_professionisti', $args );

                foreach ($terms_attivita_professionista as $term_attivita_professionista) {

                    foreach($r012_termini_attivita as $r012_termine_attivita){

                        if ($r012_termine_attivita->name == $term_attivita_professionista->name){

                            array_push($args_exclude, intval($r012_termine_attivita->term_id));

                            echo '<span>' .strtolower($term_attivita_professionista->name). '</span>';


                        }
                    }
                }
            }

        }

        $args_wp = array(

            'exclude' => $args_exclude);

        $r012_termini_senza_padre = get_terms( 'attivita_professionisti', $args_wp );

        foreach ($terms_attivita_professionista as $term_attivita_professionista) {

            foreach($r012_termini_senza_padre as $r012_termine_senza_padre){

                if($term_attivita_professionista->term_id == $r012_termine_senza_padre->term_id){
                    /**
                     * array padre figlio
                     * echo '<span class="title-busyness">' . strtoupper($term_attivita_professionista->parent) .' | </span>';
                    */
                    echo '<span>' .strtolower($term_attivita_professionista->name). '</span>';


                }
            }
        }

    }


    /**
     * Stampa front end Ultimi progetti inseriti
     */
    function r012_print_progetti_professionista($post_id, $user_ID){

        global $user_ID;

        $email =  get_post_meta($post_id,'r012_email_saved',true);
        $user_id = email_exists($email);

            $countprogetti = 0;
            $r012_values_progetti = get_post_meta( $post_id, 'r012_progetti_professionisti_saved', true);
            if($r012_values_progetti){

                $args = array(
                    'post_type' => 'progetto',
                    'include' => $r012_values_progetti,
                    'showposts' => 3,

                );

                $r012_posts_progetti = get_posts( $args );
                $countprogetti = sizeof($r012_posts_progetti);

                    foreach($r012_posts_progetti as $r012_posts_progetto){
                            /*if($user_ID == $user_id || current_user_can('administrator')){ ?>
                                <a href="<?php echo get_permalink($r012_posts_progetto->ID); ?>modifica/">
                            <?php }*/ ?>

                                    <article class="span4">
                                        <figure>
                                       <?php
                                        $default_attr = array(
                                        'alt'	=> get_the_title($r012_posts_progetto->ID),
                                        'title'	=> get_the_title($r012_posts_progetto->ID),
                                        );
                                            echo get_the_post_thumbnail($r012_posts_progetto->ID,'thumb-single',$default_attr );
                                        ?>

                                            <div class="dati-project opacity">
                                                <a title="<?php echo get_the_title($r012_posts_progetto->ID); ?>" href="<?php echo get_permalink($r012_posts_progetto->ID); ?>">Visualizza
                                                </a>
                                                <?php if($user_ID == $user_id || current_user_can('administrator')){ ?>
                                                    <a href="<?php echo get_permalink($r012_posts_progetto->ID); ?>modifica/">Modifica</a>
                                                <?php } ?>
                                            </div>
                                        </figure>
                                        <div class="clearfix"></div>
                                        <h2><?php echo get_the_title($r012_posts_progetto->ID); ?></h2>
                                        <h3 class="oggetto">
                                            <?php $terms_tipologia = wp_get_post_terms( $r012_posts_progetto->ID, 'tipologia' );
                                            foreach ($terms_tipologia as $term_tipologia) {
                                                echo $term_tipologia->name;
                                            }
                                            ?>
                                        </h3>
                                        <p class="luogo"><?php echo get_post_meta( $r012_posts_progetto->ID, 'r012_localita_saved', true); ?><span class="prov-anno"><?php echo get_post_meta( $r012_posts_progetto->ID, 'r012_provincia_saved', true) . ' ' . get_post_meta( $r012_posts_progetto->ID, 'r012_anno_saved', true);?></span></p>

                                    </article>

                            <?php /*if($user_ID == $user_id || current_user_can('administrator')){ ?>
                            </a>
                            <?php } */ ?>
                    <?php }
            }
            for ($i = $countprogetti; $i < 3; $i++) {?>

                <article class="span4">
                    <figure>
                        <img src="<?php bloginfo('template_url'); ?>/images/no-img.png" title="Aggiungi progetto" width="300" height="300" />

                        <?php
                        //se l'utente è amministratore o professionista può aggiungere un nuovo progetto
                        if($user_ID == $user_id || current_user_can('administrator')){ ?>
                        <div class="dati-project opacity">
                            <a class="add-project" href="<?php echo get_permalink($post_id); ?>progetto/nuovo/" title="Aggiungi nuovo progetto">
                                Aggiungi progetto
                            </a>
                        </div>
                        <?php } ?>

                    </figure>
                </article>


            <?php
            }
        }


    public function r012_print_collaborazioni($results){
        foreach ($results as $key => $values){
            if($key){
                echo '<span class="title-busyness">' . strtoupper($key) .' | </span>';
            }
            foreach ($values as $value ){
                if($value==0){

                }
                elseif (is_numeric($value["p"])){
                    echo '<span><a href="'.get_permalink($value["p"]).'" title="'.get_the_title($value["p"]).'">'.strtolower(get_the_title($value["p"])).'</a></span>';
                }else {
                    echo '<span>'.strtolower($value["p"]).'</span>';
                }
            }

        }
    }

    public function r012_create_array_collaboratori($r012_values_collaborazioni, $tassonomia){
            foreach ( $r012_values_collaborazioni as $collaboratore ) {

            if(is_numeric($collaboratore)){
            $terms_attivita_professionista = wp_get_object_terms( $collaboratore, $tassonomia);

                    foreach ( $terms_attivita_professionista as $term ) {


                        $el['c'] = $term->name;
                        $el['p'] = $collaboratore;
                    }


            }

            else {

                $el['c'] = 'altro';
                $el['p'] = $collaboratore;

            }

        $a[] = $el;

        }
    return $a;
    }

    public function r012_load_foto($postid, $user_ID){


        $default_attr = array(
        'alt' => get_the_title($postid),
        'title' => get_the_title($postid),
        'id' => 'bio-photo'
        ); ?>

         <div class="thumb-sk">

             <div class="change clearfix">
                <?php R012Utility::r012_check_user($postid, 'Modifica foto profilo', 'change-foto');?>
                 <iframe id="photo-edit" class="hidden" name="frame" width="320" height="320"></iframe>
                <?php if ( has_post_thumbnail($postid)) {

                echo get_the_post_thumbnail( $postid, 'thumb-single', $default_attr );


                }else{
                    ?>
                    <img src="<?php bloginfo('template_url'); ?>/images/img-default.jpg" title="<?php get_the_title($postid); ?>" width="300" height="300" />
                <?php } ?>


                        <?php //edit photo profile ?>
                             <div id="slide-change-foto" class="hidden editable-profile slidedown">
                                <form method="post" action="" enctype="multipart/form-data" target="frame" name="upload">

                                        <?php /*$default_attr = array(
                                            'alt'	=> get_the_title(),
                                            'title'	=> get_the_title(),
                                        );
                                        the_post_thumbnail('preview',$default_attr );
                                        */ ?>

                                        <h3>Carica una nuova immagine del profilo</h3>

                                        <input type="hidden" name="r012_post" id="r012_post_id" value="<?php echo $postid; ?>" />

                                        <input type="file" name="r012_immagine_edit_profilo" id="r012_immagine_edit_profilo_id" value="" />
                                        <br/>
                                        <p>Salva per visualizzare l'anteprima</p>

                                        <div class="clearfix container-fluid action-btn">
                                            <input id="cancel-foto" class="cancel-btn ui-button" type="button" title="Annulla aggiornamento" value="Annulla"/>
                                            <input type="submit" class="upload-btn ui-button" value="Salva"/>
                                        </div>

                                </form>

                            </div>



             </div>


        </div>

<?php }


    public function r012_load_dati_bio($postid, $user_ID){
    ?>

        <div class="change">
            <?php R012Utility::r012_check_user($postid, 'Aggiungi/Modifica profilo', 'change-testobio'); ?>

            <?php /* box edit testobio */ ?>

            <div id="slide-change-testobio" class="hidden editable-profile slidedown">
                <form id='edit-change-testobio' class="modifica">

                    <div class="container-fluid">

                        <?php /*<h3 class="nome"><?php echo get_post_meta($postid,'r012_nome_saved',true);?> <?php echo get_post_meta($postid,'r012_cognome_saved',true);?></h3>*/ ?>
                        <label for="r012_piva_saved" class="span3">P.IVA
                        <input type="text" placeholder="P.IVA" name="r012_piva_saved" value="<?php echo get_post_meta($postid,'r012_piva_saved',true);?>">
                        </label>

                            <div class="control-group span3">
                                <?php $terms = get_the_terms($postid, 'categorie_professionisti');
                                foreach ( $terms as $term ) {
                                    $r012_args = array(
                                        'selected'           => $term->term_id,
                                        'show_option_none'   => 'Seleziona un titolo',
                                        'order'              => 'ASC',
                                        'name'               => 'r012_titolo_saved',
                                        'id'                 => 'r012_titolo_id',
                                        'hide_empty'         => 0,
                                        'taxonomy'           => 'categorie_professionisti'
                                    );
                                } ?>
                                <label for="control-group">categoria
                                    <?php wp_dropdown_categories( $r012_args ); ?>
                                </label>
                            </div>


                        <ul class="anagraficabase">
                            <li>
                                <?php $terms = get_the_terms($postid, 'ordini_professionisti');
                               if($terms){
                                foreach ( $terms as $term ) {
                                    $r012_args = array(
                                        'selected'           => $term->term_id,
                                        'show_option_none'   => 'Seleziona un ordine',
                                        'order'              => 'ASC',
                                        'name'               => 'r012_ordine_saved',
                                        'id'                 => 'r012_ordine_id',
                                        'hide_empty'         => 0,
                                        'taxonomy'           => 'ordini_professionisti'
                                    );
                                }
                               }else{
                                   $r012_args = array(
                                       'show_option_none'   => 'Seleziona un ordine',
                                       'order'              => 'ASC',
                                       'name'               => 'r012_ordine_saved',
                                       'id'                 => 'r012_ordine_id',
                                       'hide_empty'         => 0,
                                       'taxonomy'           => 'ordini_professionisti'
                                   );
                               }?>
                                <label for="r012_ordine_saved-group"class="span3">ordine professionale
                                    <?php wp_dropdown_categories( $r012_args ); ?>
                                </label>

                                <label for="r012_numero_saved" class="span3">numero iscrizione
                                    <input type="text" name="r012_numero_saved" placeholder="Numero Ordine" value="<?php echo get_post_meta($postid,'r012_numero_saved',true);?>">
                                </label>
                            </li>

                            <li>
                                <label for="r012_nome_studio_saved" class="span3">nome studio
                                <input placeholder="Nome Studio" type="text" name="r012_nome_studio_saved" value="<?php echo get_post_meta($postid,'r012_nome_studio_saved',true);?>">
                                </label>

                                <label for="r012_studio_saved" class="span3">
                                <span><?php echo __('Registra utente come studio','r012'); ?></span>
                                <?php
                                $r012_value_studio = get_post_meta( $postid, 'r012_studio_saved', true);
                                $checked_studio ='';
                                if ($r012_value_studio == 1){
                                    $checked_studio = ' checked="checked"';
                                }
                                ?>

                                <input name="r012_studio_saved" type="checkbox"<?php echo $checked_studio; ?>' />
                                </label>
                            </li>
                            <br class="clear"/>

                            <li>
                                <label for="r012_posizione_saved" class="span3">posizione occupata
                                <input type="text" name="r012_posizione_saved" placeholder="Posizione" value ="<?php echo get_post_meta( $postid, 'r012_posizione_saved', true);?>">
                                </label>
                            </li>
                            <li>
                                <label for="r012_sito_saved" class="span3">sito web
                                <input type="text" name="r012_sito_saved" placeholder="Sito web" value="<?php echo get_post_meta( $postid, 'r012_sito_saved', true);?>">
                                </label>
                            </li>

                            <!--<li>
                                <div class="control-group">
                                    <label for="r012_citta_saved" class="span3">
                                        <input type="text" name="r012_citta_saved" placeholder="Città" value="<?php //echo get_post_meta( $postid, 'r012_citta_saved', true)?>">
                                    </label>
                                </div>
                            </li>-->

                            <br class="clear"/>
                            <li>
                                <span class="big">contatti: </span>
                               <!-- <label for="r012_email_saved" class="span3">e-mail -->
                                    <input type="hidden" name="r012_email_saved" placeholder="Mail" value="<?php echo get_post_meta($postid,'r012_email_saved',true);?>">
                                <!--</label> -->
                                <label for="r012_email2_saved" class="span3">email2
                                    <input type="text" name="r012_email2_saved" placeholder="Email 2" value="<?php echo get_post_meta( $postid, 'r012_email2_saved', true); ?>">
                                </label>

                                <label for="r012_mobile_saved" class="span3">mobile
                                    <input type="text" name="r012_mobile_saved" placeholder="Mobile" value="<?php echo get_post_meta( $postid, 'r012_mobile_saved', true);?>">
                                </label>

                                <label for="r012_telefono_saved" class="span3">telefono
                                    <input type="text" name="r012_telefono_saved" placeholder="Telefono" value="<?php echo get_post_meta( $postid, 'r012_telefono_saved', true); ?>">
                                </label>

                                <label for="r012_fax_saved" class="span3">fax
                                    <input type="text" name="r012_fax_saved" placeholder="Fax" value="<?php echo get_post_meta($postid,'r012_fax_saved',true); ?>">
                                </label>

                                <label for="r012_skype_saved" class="span3">skype
                                    <input type="text" name="r012_skype_saved" placeholder="Skype" value="<?php echo get_post_meta( $postid, 'r012_skype_saved', true); ?>">
                                </label>

                            </li>

                            <br class="clear"/>

                            <li>
                                <span class="big">indirizzo: </span>
                                <label for="r012_citta_saved" class="span3">città
                                    <input type="text" name="r012_citta_saved" placeholder="Città" value="<?php echo get_post_meta( $postid, 'r012_citta_saved', true);?>">
                                </label>

                                <label for="r012_via_saved" class="span3">via
                                    <input type="text" name="r012_via_saved" placeholder="Via" value="<?php echo get_post_meta( $postid, 'r012_via_saved', true);?>">
                                </label>

                                <label for="r012_cap_saved" class="span3"> cap
                                    <input type="text" name="r012_cap_saved" placeholder="Cap" value="<?php echo get_post_meta( $postid, 'r012_cap_saved', true);?>">
                                </label>
                                <div class="control-group">
                                    <label for="r012_provincia_saved" class="span3">provincia
                                       <?php $r012_value_provincia = get_post_meta( $postid, 'r012_provincia_saved', true);
                                        global $province;
                                        echo '<select name="r012_provincia_saved" name="r012_provincia_saved" placeholder="Provincia">';
                                            foreach ($province as $key => $value) {
                                            if($value == $r012_value_provincia){
                                            echo '<option value='.$value.' selected>'.$key.'</option>';
                                            } else {
                                            echo '<option value='.$value.'>'.$key.'</option>';
                                            }

                                            }
                                            echo '</select>'; ?>
                                    </label>
                                </div>
                            </li>
                            <br class="clear"/>

                            <li>
                                <span class="big">social: </span>
                                <label for="r012_facebook_saved" class="span3">facebook
                                    <input type="text" name="r012_facebook_saved" placeholder="Facebook" value="<?php echo get_post_meta( $postid, 'r012_facebook_saved', true);?>">
                                </label>
                                <label for="r012_twitter_saved" class="span3">twitter
                                    <input type="text" name="r012_twitter_saved" placeholder="Twitter" value="<?php echo get_post_meta( $postid, 'r012_twitter_saved', true);?>">
                                </label>
                                <label for="r012_linkedin_saved" class="span3">linkedin
                                    <input type="text" name="r012_linkedin_saved" placeholder="Linkedin" value="<?php echo get_post_meta( $postid, 'r012_linkedin_saved', true);?>">
                                </label>
                            </li>

                        </ul>

                    </div>
                        <div class="clearfix container-fluid action-btn">
                            <input id="cancel-testobio" class="cancel-btn span2 ui-button" type="button" title="Annulla aggiornamento" value="Annulla"/>
                            <input id="save-testobio" class="edit-submit span2 ui-button" type="button" title="Salva" value="Salva"/>
                        </div>


                </form>
            </div>

            <?php /* end box edit testobio */ ?>

        </div>


        <h3 class="nome">
        <?php if( get_post_meta($postid,'r012_studio_saved',true) == 1 ) {
        echo get_post_meta($postid,'r012_nome_studio_saved',true);
        } else {
            echo get_post_meta($postid,'r012_nome_saved',true);?> <?php echo get_post_meta($postid,'r012_cognome_saved',true);
        } ?>
        </h3>
        <p class="professione">
            <strong><?php $terms = get_the_terms($postid, 'categorie_professionisti');
                foreach ( $terms as $term ) {
                    echo $term->name;
                } ?>
            </strong></p>


        <ul id="anagraficabase">
            <li class="big">

                    <span class="big ordine"><?php $terms = get_the_terms($postid, 'ordini_professionisti');
                        if($terms) {
                        foreach ( $terms as $term ) {
                            echo $term->name;
                        } ?></span> | <span class="ordine-num"><?php echo get_post_meta( $postid, 'r012_numero_saved', true);?></span>
                <?php } ?>
            </li>

            <li>
                <?php if(get_post_meta( $postid, 'r012_nome_studio_saved', true)) { ?>
                    studio <strong><?php echo get_post_meta( $postid, 'r012_nome_studio_saved', true);?> </strong>
                <?php } ?>

            </li>
            <li>
                <?php if(get_post_meta( $postid, 'r012_piva_saved', true)) { ?>
                    p iva <strong><?php echo get_post_meta( $postid, 'r012_piva_saved', true);?></strong>
                <?php } ?>

            </li>
            <li>
                <?php if(get_post_meta( $postid, 'r012_posizione_saved', true)) { ?>
                    posizione <strong><?php echo get_post_meta( $postid, 'r012_posizione_saved', true);?></strong>
                <?php } ?>

            </li>
            <li>
                <?php if(get_post_meta( $postid, 'r012_citta_saved', true)) { ?>
                    città <strong><?php echo get_post_meta( $postid, 'r012_citta_saved', true); ?></strong>
                <?php } ?>
            </li>
            <li>
                <?php if(get_post_meta( $postid, 'r012_sito_saved', true)) { ?>
                    sito <a href="http://<?php echo get_post_meta($postid,'r012_sito_saved',true); ?>" target="_blank"><strong><?php echo get_post_meta($postid,'r012_sito_saved',true); ?></strong></a>
                <?php } ?>

            </li>

            <br/>
            <?php if ( $user_ID ) { ?>
                <li>
                    <span class="big">contatti: </span>
                    <?php if(get_post_meta($postid,'r012_email_saved',true)) { ?>
                        email <strong><?php echo get_post_meta($postid,'r012_email_saved',true); ?>
                        </strong>
                    <?php } ?>
                    <?php if(get_post_meta( $postid, 'r012_email2_saved', true)) { ?>
                        email 2 <strong><?php echo get_post_meta( $postid, 'r012_email2_saved', true); ?></strong>
                    <?php } ?>
                    <?php if(get_post_meta( $postid, 'r012_mobile_saved', true)) { ?>
                        mobile <strong><?php echo get_post_meta( $postid, 'r012_mobile_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_telefono_saved', true)) { ?>
                        telefono <strong><?php echo get_post_meta($postid,'r012_telefono_saved',true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_fax_saved', true)) { ?>
                        fax <strong><?php echo get_post_meta($postid,'r012_fax_saved',true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_skype_saved', true)) { ?>
                        skype <strong><?php echo get_post_meta( $postid, 'r012_skype_saved', true); ?></strong>
                    <?php } ?>

                </li>

                <li>
                    <span class="big">indirizzo: </span>
                    <?php if(get_post_meta( $postid, 'r012_citta_saved', true)) { ?>
                        città <strong><?php echo get_post_meta( $postid, 'r012_citta_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_via_saved', true)) { ?>
                        via <strong><?php echo get_post_meta( $postid, 'r012_via_saved', true); ?></strong>
                    <?php } ?>

                    <?php if( get_post_meta($postid,'r012_cap_saved',true)) { ?>
                        cap <strong><?php echo get_post_meta($postid,'r012_cap_saved',true); ?></strong>
                    <?php } ?>

                    <?php if( get_post_meta($postid,'r012_provincia_saved',true)) { ?>
                        provincia <strong><?php echo get_post_meta($postid,'r012_provincia_saved',true); ?></strong>
                    <?php } ?>

                </li>

                <li>
                    <span class="big">social: </span>
                    <?php if(get_post_meta( $postid, 'r012_linkedin_saved', true)) { ?>
                        linkedin <strong><?php echo get_post_meta( $postid, 'r012_linkedin_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_facebook_saved', true)) { ?>
                        facebook <strong><?php echo get_post_meta( $postid, 'r012_facebook_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $postid, 'r012_twitter_saved', true)) { ?>
                        twitter <strong><?php echo get_post_meta( $postid, 'r012_twitter_saved', true); ?></strong>
                    <?php } ?>

                </li>
            <?php } else { // end $user_ID ?>
                <li class="no-user alert">
                                <span class="big">
                                Per visualizzare le informazioni complete del professionista <br/>effettua la
                                <a id="register-user" href="<?php bloginfo('url'); ?>/registrazione" title="Registrazione a Room 012">Registrazione</a>
                                </span>
                </li>
            <?php } // end $user_ID ?>
        </ul>


    <?php
    }


    public function r012_load_dati_bionote($postid, $user_ID){?>

            <div class="span12">
                <?php //change profile ?>
                <div class="change">
                    <?php R012Utility::r012_check_user($postid, 'Modifica biografia','change-notebio'); ?>
                    <?php // edit Notebio ?>
                    <div id="slide-change-notebio" class="hidden editable-profile slidedown">
                        <form id='edit-change-notebio' class="modifica">
                            <h4 class="title-profile">note biografiche</h4>
                            <textarea class="" rows="10" cols="40" name="r012_content_saved"><?php
                                $note = get_the_content($postid);
                                echo strip_tags($note);
                                ?></textarea>

                            <div class="clearfix container-fluid action-btn">
                                <input id="save-notebio" class="edit-submit span2 ui-button right" type="button" title="Salva" value="Salva"/>
                                <input id="cancel-notebio" class="cancel-btn span2 ui-button right" type="button" title="Annulla aggiornamento" value="Annulla"/>
                            </div>

                        </form>
                    </div>
                </div><!--/change-->
                <h4 class="title-profile">note biografiche</h4>
                <div class="content limited-height">
                    <?php echo get_post_field('post_content', $postid); ?>
                </div>

                <a class="no-limited-height clearfix" href="" title="Leggi tutto">scopri tutto ↓↓</a>
                <a class="yes-limited-height clearfix hidden" href="" title="Leggi tutto">nascondi ↑↑</a>
            </div>

    <?php }

    public function r012_load_attivita($postid, $user_ID){?>

        <div class="change">
            <?php R012Utility::r012_check_user($postid, 'Aggiungi/Rimuovi Attività','change-attivita'); ?>

            <?php //Edit activity of profile ?>
            <div id="slide-change-attivita" class="hidden editable-profile slidedown">
                <form id='edit-change-attivita' class="modifica">
                    <div class="span5">
                        <h4 class="span2">attività</h4>
                    </div>

                    <div class="row-fluid">
                        <div class="span12 add">
                            <h3>Spunta le attività per inserirle nella tua scheda profilo</h3>
                            <?php
                            $args_all_terms = array(

                                'hide_empty'    => 0,
                                'fields'        => 'all',
                                'order'         => 'DESC',
                            );

                            $terms = get_terms('attivita_professionisti',$args_all_terms);

                            $terms_attivita_professionista = wp_get_object_terms( $postid, 'attivita_professionisti');



                            foreach ( $terms as $term ) {

                                if($term->parent==0){

                                    echo "<ul><strong>" . $term->name;

                                    //l'attività è checked la somma dei controlli è pari a 1
                                    $found = 0;
                                    foreach( $terms_attivita_professionista as $term_professionista){

                                        if ($term->term_id == $term_professionista->term_id){
                                            $found = $found + 1;
                                        }
                                        else{
                                            $found = $found + 0;
                                        }
                                    }


                                    if($found==0){
                                        $cheked ="";

                                    } else{
                                        $cheked = "checked='checked'";

                                    }
                                    echo "<input type='checkbox' name='r012_attivita_item[]' value='".$term->term_id ."' " . $cheked . ">";


                                    echo "</strong>";
                                    $args = array(
                                        'hide_empty'=> 0,
                                        'child_of'  => $term->term_id);

                                    $r012_termini_attivita = get_terms( 'attivita_professionisti', $args );
                                    foreach($r012_termini_attivita as $r012_termine_attivita){

                                        echo "<li>";
                                        echo "<span>" . $r012_termine_attivita->name;
                                        $found_child = 0;
                                        foreach( $terms_attivita_professionista as $term_professionista){

                                            if ($r012_termine_attivita->term_id == $term_professionista->term_id){
                                                $found_child = $found_child + 1;
                                            }
                                            else{
                                                $found_child = $found_child + 0;
                                            }
                                        }


                                        if($found_child==0){
                                            $cheked_child ="";

                                        } else{
                                            $cheked_child = "checked='checked'";

                                        }
                                        echo "<input type='checkbox' name='r012_attivita_item[]' value='".$r012_termine_attivita->term_id ."' " . $cheked_child . ">";
                                        echo "</span>";
                                        echo "</li>";
                                    }

                                    echo '</ul>';
                                }
                            }

                            ?>
                            <br/>
                            <!--service message-->
                            <small class="center alert block">Se nella lista sopra mancano delle attività che ti riguardano fallo presente all'amministratore del sistema per provvedere ad aggiungerle.<br>
                                <a href="mailto:info@room012.it" title="Invia una mail all'amministratore">Contatta amministratore del sistema</a></small>

                        </div>
                    </div>

                    <div class="clearfix container-fluid action-btn">
                        <input id="save-attivita" class="edit-submit span2 right ui-button" type="button" title="Salva" value="Salva"/>
                        <input id="cancel-attivita" class="cancel-btn span2 ui-button right" type="button" title="Annulla aggiornamento" value="Annulla"/>
                    </div>

                </form>
            </div>

        <div><!--/change-->



        <div class="span12">
            <h4 class="title-profile"><?php echo __('attività','r012'); ?></h4>
            <div class="content">
                <ul class="busyness-card">
                    <li>
                        <?php

                        R012Professionista::r012_print_attivita_professionisti($postid);
                        ?>
                    </li>
                </ul>
            </div>
        </div>


    <div class="clear"></div>

    <?php

    }


    public function r012_load_collaborazioni($postid, $user_ID){?>

            <?php
            $r012_values_collaborazioni = get_post_meta( $postid, 'r012_collaborazioni_professionisti_saved', true);
            $r012_values_collaborazioni_aziende = get_post_meta( $postid, 'r012_collaborazioni_aziende_saved', true);
            $r012_values_collaborazioni_operatori = get_post_meta( $postid, 'r012_collaborazioni_operatori_saved', true);
            $r012_values_collaborazioni_rivenditori = get_post_meta( $postid, 'r012_collaborazioni_rivenditori_saved', true);
            ?>
            <div class="change">
            <?php R012Utility::r012_check_user($postid, 'Aggiungi/Rimuovi Collaborazioni','change-collaborazioni'); ?>

                <?php // slide box editable ?>
                <div id="slide-change-collaborazioni" class="hidden editable-profile slidedown span12 clearfix">
                    <form id='edit-change-collaborazioni' class="modifica">
                        <h4 class="title-profile">collaborazioni</h4>

                        <div class="row-fluid">
                            <article class="c-professionals span3">

                                <div class="span12">
                                    <h3>Professionisti</h3>
                                </div>

                                <div class="row-fluid">
                                    <?php

                                    $cpt = 'professionisti';
                                    R012Autocomplete::print_input_autocomplete( $cpt ,'');
                                    R012Autocomplete::print_result_autocomplete($cpt, $r012_values_collaborazioni);?>
                                </div>
                            </article>

                            <article class="c-companies span3">
                                <h3>Aziende</h3>


                                <div class="row-fluid">
                                    <?php

                                    $cpt = 'aziende';
                                    R012Autocomplete::print_input_autocomplete( $cpt ,'');
                                    R012Autocomplete::print_result_autocomplete($cpt, $r012_values_collaborazioni_aziende);?>
                                </div>

                            </article>

                            <article class="c-operators span3">
                                <h3>Operatori Specializzati</h3>

                                <div class="row-fluid">
                                    <?php

                                    $cpt = 'operatori';
                                    R012Autocomplete::print_input_autocomplete( $cpt ,'');
                                    R012Autocomplete::print_result_autocomplete($cpt, $r012_values_collaborazioni_operatori);?>
                                </div>
                            </article>

                            <article class="c-retailers span3">
                                <h3>Rivenditori</h3>

                                <div class="row-fluid">
                                    <?php

                                    $cpt = 'rivenditori';
                                    R012Autocomplete::print_input_autocomplete( $cpt ,'');
                                    R012Autocomplete::print_result_autocomplete($cpt, $r012_values_collaborazioni_rivenditori);?>
                                </div>
                            </article>
                        </div>

                        <div class="clearfix container-fluid action-btn">
                            <input id="cancel-collaborazioni" class="cancel-btn span2 ui-button right" type="button" title="Annulla" value="Annulla"/>
                            <input id="save-collaborazioni" class="edit-submit span2 right ui-button" type="button" title="Salva" value="Salva"/>
                        </div>

                    </form>
                </div>

                <?php // end box editable ?>

            </div>

            <h4 class="title-profile">
                <?php echo __('collaborazioni', 'r012');?>
            </h4>


            <?php

            //id professionisti e creo array professionisti
            $a = array();
            $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni, 'categorie_professionisti');

            //raggruppo per professioni
            $results = array();
            $results =  R012Utility::r012_group_by_array($a);

            if($results){
            ?>

            <article class="c-professionals collaborations">
                <h3><?php echo __('Professionisti', 'r012');?></h3>

                <div class="content">
                    <div class="busyness-card">
                        <?php

                        //stampo l'array nella forma professione->professionisti
                        R012Professionista::r012_print_collaborazioni($results);
                        ?>

                    </div>
                </div>
            </article>
            <?php } ?>

        <?php

        //id aziende e creo array aziende
        $a = array();

        $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_aziende, 'categoria_azienda');



        //raggruppo per settore
        $results = array();
        $results =  R012Utility::r012_group_by_array($a);

        if($results){
        ?>
        <article class="c-companies collaborations">
            <h3>Aziende</h3>

            <div class="content">
                <div class="busyness-card">
                    <?php

                    //stampo l'array nella forma settore->azienda
                    R012Professionista::r012_print_collaborazioni($results);
                    ?>
                </div>
            </div>
        </article>
        <?php } ?>

        <?php

        //id operatore e creo array operatori
        $a = array();

        $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_operatori, 'categoria_operatore');



        //raggruppo per settore
        $results = array();
        $results =  R012Utility::r012_group_by_array($a);

        if($results){
        ?>

        <article class="c-operators collaborations">
            <h3>Operatori Specializzati</h3>

            <div class="content">
                <div class="busyness-card">
                    <?php

                    //id operatore e creo array operatori
                    $a = array();
                    $r012_values_collaborazioni_operatori = get_post_meta( $postid, 'r012_collaborazioni_operatori_saved', true);
                    $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_operatori, 'categoria_operatore');



                    //raggruppo per settore
                    $results = array();
                    $results =  R012Utility::r012_group_by_array($a);

                    //stampo l'array nella forma categoria->operatori
                    R012Professionista::r012_print_collaborazioni($results);
                    ?>
                </div>
            </div>
        </article>
        <?php } ?>
        <?php

        //id rivenditori e creo array rivenditori
        $a = array();

        $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_rivenditori, 'categoria_rivenditore');



        //raggruppo per settore
        $results = array();
        $results =  R012Utility::r012_group_by_array($a);

        if($results){
        ?>

        <article class="c-retailers collaborations">
            <h3>Rivenditori</h3>

            <div class="content">
                <div class="busyness-card">
                    <?php

                    //stampo l'array nella forma categoria->rivenditori
                    R012Professionista::r012_print_collaborazioni($results);
                    ?>
                </div>
            </div>
        </article>
        <?php } ?>
<?php }





function r012_load(){

        if($_POST){

            $userid = $_POST[userid];
            $postid = $_POST[idpost];

            switch ( $_POST['area']){
                case 'slide-change-testobio':{

                  R012Professionista::r012_load_dati_bio($postid, $userid);
                  exit();

                break;
                }

                case 'slide-change-notebio':{

                  R012Professionista::r012_load_dati_bionote($postid, $userid);
                  exit();

                break;
                }
                case 'slide-change-attivita':{

                  R012Professionista::r012_load_attivita($postid, $userid);
                  exit();

                break;
                }
                case 'slide-change-foto':{

                    R012Professionista::r012_load_foto($postid, $userid);
                    exit();

                    break;
                }
                case 'slide-change-collaborazioni':

                  R012Professionista::r012_load_collaborazioni($postid, $userid);
                exit();

                break;

            }

        }
    }

    //get author name
    public function get_author ($email){
        $r012_autore_args = array(
            'orderby'=> 'ASC',

            'post_type' => 'professionisti',
            'meta_query' => array(
                array(
                    'key' => 'r012_email_saved',
                    'value' => $email)
            )
        );

        $posts_array = get_posts( $r012_autore_args );
        return $posts_array;

    }


    //stampa a video delle collaborazioni
    public function r012_print_section_collaborazioni($postid){

        $r012_values_collaborazioni = get_post_meta( $postid, 'r012_collaborazioni_professionisti_saved', true);
        $r012_values_collaborazioni_aziende = get_post_meta( $postid, 'r012_collaborazioni_aziende_saved', true);
        $r012_values_collaborazioni_operatori = get_post_meta( $postid, 'r012_collaborazioni_operatori_saved', true);
        $r012_values_collaborazioni_rivenditori = get_post_meta( $postid, 'r012_collaborazioni_rivenditori_saved', true);

        if($r012_values_collaborazioni || $r012_values_collaborazioni_aziende || $r012_values_collaborazioni_operatori || $r012_values_collaborazioni_rivenditori){
            ?>
            <section class="project">
                <?php if(is_singular('progetto')){ ?>
                    <h4 class="title-profile">hanno collaborato</h4>
                <?php } else {?>
                    <h4 class="title-profile">collaborazioni</h4>
                <?php } ?>

                <?php

                //id professionisti e creo array professionisti
               // $a = array();

                $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni, 'categorie_professionisti');



                //raggruppo per professioni
                //$results = array();
                $results = R012Utility::r012_group_by_array($a);

                if($results){
                    ?>
                    <article class="c-professionals">
                        <h3><?php echo __('Professionisti', 'r012');?></h3>

                        <div class="content">
                            <div class="busyness-card">
                                <?php


                                //stampo l'array nella forma professione->professionisti
                                R012Professionista::r012_print_collaborazioni($results);
                                ?>

                            </div>
                        </div>
                    </article>
                <?php }

                //id aziende e creo array aziende
               // $a = array();

                $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_aziende, 'categoria_azienda');



                //raggruppo per settore
               //$results = array();
                $results =  R012Utility::r012_group_by_array($a);

                if($results){

                    ?>
                    <article class="c-companies">
                        <h3>Aziende</h3>

                        <div class="content">
                            <div class="busyness-card">
                                <?php

                                //stampo l'array nella forma settore->azienda
                                R012Professionista::r012_print_collaborazioni($results);
                                ?>
                            </div>
                        </div>
                    </article>
                <?php }

                //id operatore e creo array operatori
                //$a = array();

                $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_operatori, 'categoria_operatore');



                //raggruppo per settore
                //$results = array();
                $results =  R012Utility::r012_group_by_array($a);

                if($results){
                    ?>
                    <article class="c-operators">
                        <h3>Operatori Specializzati</h3>

                        <div class="content">
                            <div class="busyness-card">
                                <?php

                                //stampo l'array nella forma categoria->operatori
                                R012Professionista::r012_print_collaborazioni($results);
                                ?>
                            </div>
                        </div>
                    </article>
                <?php }

                //id rivenditori e creo array rivenditori
                //$a = array();

                $a = R012Professionista::r012_create_array_collaboratori($r012_values_collaborazioni_rivenditori, 'categoria_rivenditore');



                //raggruppo per settore
                //$results = array();
                $results =  R012Utility::r012_group_by_array($a);

                if($results){
                    ?>
                    <article class="c-retailers">
                        <h3>Rivenditori</h3>

                        <div class="content">
                            <div class="busyness-card">
                                <?php

                                //stampo l'array nella forma categoria->rivenditori
                                R012Professionista::r012_print_collaborazioni($results);
                                ?>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            </section>
        <?php
        }
    }


}
?>