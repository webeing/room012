<?php
/**
 * Created oggetto azienda
 */

add_action( 'init', 'r012_azienda_setup');
function r012_azienda_setup(){
    $azienda = new R012Azienda();
}


/**
 * Class R012Azienda
 */
class R012Azienda{

    public function R012Azienda(){



        add_action( 'add_meta_boxes', array('R012Azienda','r012_add_custom_box_scheda_azienda'));
        add_action( 'save_post', array('R012Azienda','r012_save_scheda_azienda'));
        add_action( 'add_meta_boxes', array('R012Azienda','r012_add_custom_box_progetti'));

        $this->r012_register_scheda_azienda();
        $this->r012_create_categories_azienda_taxonomies();

    }


    //registro il CPT azienda
    public function r012_register_scheda_azienda() {

        $r012_scheda_azienda_labels = array(
            'name'               => __('Scheda Azienda','r012'),
            'singular_name'      => __('Scheda Azienda','r012'),
            'add_new'            => __('Aggiungi Azienda','r012'),
            'add_new_item'       => __('Nuovo Azienda','r012'),
            'edit_item'          => __('Modifica Azienda','r012'),
            'new_item'           => __('Nuovo Azienda','r012'),
            'all_items'          => __('Elenco Aziende','r012'),
            'view_item'          => __('Visualizza Azienda','r012'),
            'search_items'       => __('Cerca Aziende','r012'),
            'not_found'          => __('Azienda non trovata','r012'),
            'not_found_in_trash' => __('Azienda non trovata nel cestino','r012'),
        );

        $r012_scheda_azienda_cpt = array(
            'labels'             => $r012_scheda_azienda_labels,
            'public'             => true,
            'rewrite'            => array('slug' => 'scheda-azienda', 'with_front' => false),
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'supports'           => array(
                'title',
                'editor',
                'thumbnail',
                'revisions'
            ),
        );

        register_post_type('aziende', $r012_scheda_azienda_cpt);


    }

    /**
     * Aggiungo il meta box link
     */
    public function r012_add_custom_box_scheda_azienda() {

        add_meta_box(
            'scheda_azienda_id',
            __( 'Scheda Azienda', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_scheda_azienda'),
            'aziende',
            'advanced',
            'high'
        );

        add_meta_box(
            'social_azienda_id',
            __( 'Social Azienda', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_social'),
            'aziende',
            'advanced',
            'high'
        );

        add_meta_box(
            'collaborazioni_aziende_id',
            __( 'Collaborazioni aziende', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_azienda_collaborazioni_aziende'),
            'aziende',
            'advanced',
            'high'
        );

         add_meta_box(
            'collaborazioni_id',
             __( 'Collaborazioni professionisti', 'r012' ),
             array(__CLASS__,'r012_print_custom_box_azienda_collaborazioni'),
             'aziende',
             'advanced',
             'high'
         );



         add_meta_box(
            'collaborazioni_rivenditori_id',
            __( 'Collaborazioni rivenditori', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_azienda_collaborazioni_rivenditori'),
            'aziende',
            'advanced',
            'high'
         );

         add_meta_box(
            'collaborazioni_operatori_id',
            __( 'Collaborazioni operatori', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_azienda_collaborazioni_operatori'),
            'aziende',
            'advanced',
            'high'
          );

         add_meta_box(
              'progetti_id',
              __( 'Progetti', 'r012' ),
              array(__CLASS__,'r012_print_custom_box_progetti'),
              'aziende',
              'advanced',
              'high'
            );

    }


    /**
     * Stampo il box per i social per gli operatori
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

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );


    }

    /**
     * box collaborazione aziende
     */
    public function r012_print_custom_box_azienda_collaborazioni( $post ) {
        /*
        * start class autocomplete
        */
        $testo_professionisti = 'Inserisci il nome e il cognome del professionista</br>';
        R012Autocomplete::print_input_autocomplete( 'professionisti', $testo_professionisti);

        $r012_values_autocomplete = get_post_meta( $post->ID, 'r012_collaborazioni_professionisti_saved', true);

        R012Autocomplete::print_result_autocomplete('professionisti', $r012_values_autocomplete);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );
    }

    public function r012_print_custom_box_azienda_collaborazioni_aziende( $post ) {

        $testo_azienda = 'Inserisci il nome azienda</br>';
        R012Autocomplete::print_input_autocomplete('aziende', $testo_azienda);

        $r012_values_autocomplete_aziende = get_post_meta( $post->ID, 'r012_collaborazioni_aziende_saved', true);

        R012Autocomplete::print_result_autocomplete('aziende', $r012_values_autocomplete_aziende);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );
    }

    public function r012_print_custom_box_azienda_collaborazioni_rivenditori( $post ) {

        $testo_rivenditori = 'Inserisci il nome del rivenditore</br>';
        R012Autocomplete::print_input_autocomplete('rivenditori', $testo_rivenditori);

        $r012_values_autocomplete_rivenditori = get_post_meta( $post->ID, 'r012_collaborazioni_rivenditori_saved', true);

        R012Autocomplete::print_result_autocomplete('rivenditori', $r012_values_autocomplete_rivenditori);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );

    }

    public function r012_print_custom_box_azienda_collaborazioni_operatori( $post ) {

        $testo_operatori = 'Inserisci il nome operatore</br>';
        R012Autocomplete::print_input_autocomplete( 'operatori', $testo_operatori);
        $r012_values_autocomplete_operatori = get_post_meta( $post->ID, 'r012_collaborazioni_operatori_saved', true);
        R012Autocomplete::print_result_autocomplete('operatori', $r012_values_autocomplete_operatori);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );

    }


    /**
     * custom box progetti
     */
    public function r012_print_custom_box_progetti( $post ) {

        $testo_progetti = 'Inserisci i progetti legati all azienda</br>';
        R012Autocomplete::print_input_autocomplete( 'progetto', $testo_progetti);
        $r012_values_autocomplete_progetti = get_post_meta( $post->ID, 'r012_progetti_aziende_saved', true);
        R012Autocomplete::print_result_autocomplete('progetto', $r012_values_autocomplete_progetti);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );
    }

    public function r012_print_custom_box_scheda_azienda( $post ) {



        $r012_value_telefono = get_post_meta( $post->ID, 'r012_telefono_saved', true);
        $r012_value_fax = get_post_meta( $post->ID, 'r012_fax_saved', true);
        $r012_value_email = get_post_meta( $post->ID, 'r012_email_saved', true);
        $r012_value_sito = get_post_meta( $post->ID, 'r012_sito_saved', true);
        $r012_value_citta = get_post_meta( $post->ID, 'r012_citta_saved', true);
        $r012_value_via = get_post_meta( $post->ID, 'r012_via_saved', true);
        $r012_value_cap = get_post_meta( $post->ID, 'r012_cap_saved', true);
        $r012_value_provincia = get_post_meta( $post->ID, 'r012_provincia_saved', true);
        $r012_value_mobile = get_post_meta( $post->ID, 'r012_mobile_saved', true);
        $r012_value_piva = get_post_meta( $post->ID, 'r012_piva_saved', true);
        $r012_value_galleria_prodotti = get_post_meta( $post->ID, 'r012_galleria_saved', true);

        wp_nonce_field( 'r012_aziende_nonce', 'nonce_aziende' );

        echo '<p><label for="r012_piva">';
        _e("P. IVA", 'r012' );
        echo '</label>';
        echo '<input type="text" name="r012_piva" id="r012_piva_id" value="'.$r012_value_piva.'" /></p>';


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

        echo '<p><b><label for="r012_galleria_prodotti">';
        _e("Galleria ", 'r012' );
        echo '</label></b> ';

        wp_editor( $r012_value_galleria_prodotti, 'r012_galleria_prodotti', array('textarea_rows' =>10));
        echo '<br class="clear" /></p>';
    }

    /**
     * Salvataggio scheda azienda
     */
    public function r012_save_scheda_azienda( $post_id ) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;


        if ( ! wp_verify_nonce( $_POST['nonce_aziende'], 'r012_aziende_nonce' ))
            return;

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
        if (isset($_POST['r012_mobile'])){
            $r012_mobile = $_POST['r012_mobile'];
        }
        if (isset($_POST['r012_piva'])){
            $r012_piva = $_POST['r012_piva'];
        }
        if (isset($_POST['r012_provincia'])){
            $r012_provincia = $_POST['r012_provincia'];
        }

        if (isset($_POST['r012_galleria_prodotti'])){
            $r012_galleria_prodotti = $_POST['r012_galleria_prodotti'];
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
        * salvataggio progetto
        */
        if (isset($_POST['r012_autocomplete_progetto_item'])) {
            $r012_progetti_aziende= $_POST['r012_autocomplete_progetto_item'];
        }


        update_post_meta($post_id,'r012_telefono_saved', $r012_telefono);
        update_post_meta($post_id,'r012_fax_saved', $r012_fax);
        update_post_meta($post_id,'r012_email_saved', $r012_email);
        update_post_meta($post_id,'r012_sito_saved', $r012_sito);
        update_post_meta($post_id,'r012_citta_saved', $r012_citta);
        update_post_meta($post_id,'r012_via_saved', $r012_via);
        update_post_meta($post_id,'r012_cap_saved', $r012_cap);
        update_post_meta($post_id,'r012_provincia_saved', $r012_provincia);
        update_post_meta($post_id,'r012_mobile_saved', $r012_mobile);
        update_post_meta($post_id,'r012_piva_saved', $r012_piva);
        update_post_meta($post_id,'r012_galleria_saved', $r012_galleria_prodotti);

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
        update_post_meta($post_id,'r012_progetti_aziende_saved', $r012_progetti_aziende);
    }

    //creo una tassonomia categoria azienda per il CTP scheda azienda
    public function r012_create_categories_azienda_taxonomies()
    {

        // tassonomia azienda

        $labels = array(
            'name' => 'Categoria Azienda',
            'singular_name' => 'Categoria Azienda',
            'search_items' => 'Cerca categoria Aziende',
            'popular_items' => 'Categorie aziende più usate',
            'all_items' => 'Tutte le categorie aziende' ,
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit categorie aziende',
            'update_item' => 'Aggiorna categoria azienda',
            'add_new_item' => 'Aggiungi nuova categoria azienda',
            'new_item_name' => 'Nome nuova categoria azienda',
            'separate_items_with_commas' => 'Separa categorie aziende con le virgole',
            'add_or_remove_items' => 'Aggiungi e Rimuovi categorie aziende',
            'choose_from_most_used' => 'Scegli le categorie aziende più usate',
            'menu_name' => 'Categorie Aziende',
        );

        register_taxonomy('categoria_azienda','aziende',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'categoria-azienda' ),
        ));

    }

}