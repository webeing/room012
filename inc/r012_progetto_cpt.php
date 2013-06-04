<?php
/**
 * Creazione Classe Progetto
 */


/**
 * Attivazione Oggetto
 */
add_action( 'init', 'r012_progetto_setup');
function r012_progetto_setup(){
    $progetto = new R012Progetto();
}

/**
 * Class R012Progetto
 */
class R012Progetto {

    public function R012Progetto(){
        //Aggiungo contenuti all'oggetto
        $this->r012_register_progetto();
        $this->r012_create_oggetto_taxonomies();
        $this->r012_create_tipologia_taxonomies();
        $this->r012_create_attivita_taxonomies();
        $this->r012_create_stato_opera_taxonomies();
        //Registrazione Action
        add_action( 'add_meta_boxes', array('R012Progetto','r012_add_custom_box_progetto' ));
        add_action( 'add_meta_boxes', array('R012Progetto','r012_add_custom_box_collaborazioni' ));
        add_action( 'save_post', array('R012Progetto','r012_save_progetto'));
        add_filter('post_type_link', array($this,'custom_post_link'),10,3);

        add_filter( 'generate_rewrite_rules', array('R012Progetto','create_rewrite_rules') );
        add_action('template_redirect', array('R012Progetto','template_redirect_intercept'), 1, 1);
        add_filter('query_vars', array('R012Progetto','add_query_vars'));

    }

    //registro il CPT progetto
    public function r012_register_progetto() {

        $r012_progetto_labels = array(
            'name'               => __('Scheda Progetto','r012'),
            'singular_name'      => __('Scheda Progetto','r012'),
            'add_new'            => __('Aggiungi Progetto','r012'),
            'add_new_item'       => __('Nuovo Progetto','r012'),
            'edit_item'          => __('Modifica Progetto','r012'),
            'new_item'           => __('Nuovo Progetto','r012'),
            'all_items'          => __('Elenco Progetti','r012'),
            'view_item'          => __('Visualizza Progetto','r012'),
            'search_items'       => __('Cerca Progetti','r012'),
            'not_found'          => __('Progetto non trovato','r012'),
            'not_found_in_trash' => __('Progetto non trovato nel cestino','r012'),
        );

        $r012_progetto_cpt = array(
            'labels'             => $r012_progetto_labels,
            'public'             => true,
            'rewrite'            => array('slug' => 'scheda-professionista/%professionista%/progetto', 'with_front' => false),
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

        register_post_type('progetto', $r012_progetto_cpt);

        $this->flush_rewrite_rules();

    }

    //creazione metabox dettagli progetto
    public function r012_add_custom_box_progetto() {

        add_meta_box(
            'progetto_id',
            __( 'Dettagli Progetto', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_progetto'),
            'progetto',
            'advanced',
            'high'
        );

    }

    /**
     * aggiungo collaborazioni progetti
     */

    public function r012_add_custom_box_collaborazioni() {

        add_meta_box(
            'collaborazioni_id',
            __( 'Collaborazioni professionisti', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_collaborazioni'),
            'progetto',
            'advanced',
            'high'
        );


        add_meta_box(
            'collaborazioni_aziende_id',
            __( 'Collaborazioni aziende', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_collaborazioni_aziende'),
            'progetto',
            'advanced',
            'high'
        );

        add_meta_box(
            'collaborazioni_rivenditori_id',
            __( 'Collaborazioni rivenditori', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_collaborazioni_rivenditori'),
            'progetto',
            'advanced',
            'high'
        );

        add_meta_box(
            'collaborazioni_operatori_id',
            __( 'Collaborazioni operatori', 'r012' ),
            array(__CLASS__,'r012_print_custom_box_collaborazioni_operatori'),
            'progetto',
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

        wp_nonce_field( 'r012_progetto_nonce', 'nonce_progetto' );
    }

    public function r012_print_custom_box_collaborazioni_aziende( $post ) {

        $testo_azienda = 'Inserisci il nome azienda</br>';
        R012Autocomplete::print_input_autocomplete('aziende', $testo_azienda);

        $r012_values_autocomplete_aziende = get_post_meta( $post->ID, 'r012_collaborazioni_aziende_saved', true);

        R012Autocomplete::print_result_autocomplete('aziende', $r012_values_autocomplete_aziende);
        wp_nonce_field( 'r012_progetto_nonce', 'nonce_progetto' );
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

        wp_nonce_field( 'r012_progetto_nonce', 'nonce_progetto' );

    }




    //stampa del metabox dettagli progetto
    public function r012_print_custom_box_progetto( $post) {

        $r012_value_regione = get_post_meta( $post->ID, 'r012_regione_saved', true);
        $r012_value_provincia = get_post_meta( $post->ID, 'r012_provincia_saved', true);
        $r012_value_localita = get_post_meta( $post->ID, 'r012_localita_saved', true);
        $r012_value_anno = get_post_meta( $post->ID, 'r012_anno_saved', true);
        $r012_value_committente = get_post_meta( $post->ID, 'r012_committente_saved', true);
        $r012_value_galleria_progetto = get_post_meta( $post->ID, 'r012_galleria_saved', true);
        $r012_value_autore = get_post_meta( $post->ID, 'r012_autore_saved', true);
        $r012_value_studio = get_post_meta( $post->ID, 'r012_studio_saved', true);

        wp_nonce_field( 'r012_progetto_nonce', 'nonce_progetto' );


        echo '<p><label for="r012_professionista">';
        _e("Creato da: ", 'r012' );
        echo '</label>';

        echo get_the_title($r012_value_autore) .'</p>';


        echo '<p><label for="r012_committente">';
        _e("Committente", 'r012' );
        echo '</label>';

        //mettere query aziende

        echo '<input type="text" name="r012_committente" id="r012_committente_id" value="'.$r012_value_committente.'" /></p>';


        echo '<p><label for="r012_anno">';
        _e("Anno", 'r012' );
        echo '</label>';
        echo '<input type="text" name="r012_anno" id="r012_anno_id" value="'.$r012_value_anno.'" /></p>';


        echo '<p><label for="r012_regione">';
        _e("Regione", 'r012' );
        echo '</label>';

        global $regioni;

        echo '<select name="r012_regione" id="r012_regione_id">';
        foreach ($regioni as $key => $value) {
            if($value == $r012_value_regione){
                echo '<option value='.$value.' selected>'. $key .'</option>';
            } else {
                echo '<option value='.$value.'>'. $key .'</option>';
            }

        }
        echo '</select>';


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

        echo '<p><label for="r012_localita">';
        _e("Località", 'r012' );
        echo '</label>';
        echo '<input type="text" name="r012_localita" id="r012_localita_id" value="'.$r012_value_localita.'" /></p>';

        echo '<p><label for="r012_studio">';
        _e("Nome studio", 'r012' );
        echo '</label>';
        echo '<input type="text" name="r012_studio" id="r012_studio_id" value="'.$r012_value_studio.'" /></p>';

        echo '<p><b><label for="r012_galleria_progetto">';
        _e("Galleria Progetti", 'r012' );
        echo '</label></b> ';

        wp_editor( $r012_value_galleria_progetto, 'r012_galleria_progetto', array('textarea_rows' =>10));
        echo '<br class="clear" /></p>';

    }
    /**
     * Salvataggio ctp scheda progetto
     */
    public function r012_save_progetto( $post_id ) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;


        if ( ! wp_verify_nonce( $_POST['nonce_progetto'], 'r012_progetto_nonce' ))
            return;

        if (isset($_POST['r012_regione'])){
            $r012_regione = $_POST['r012_regione'];
        }
        if (isset($_POST['r012_localita'])){
            $r012_localita = $_POST['r012_localita'];
        }
        if (isset($_POST['r012_provincia'])){
            $r012_provincia = $_POST['r012_provincia'];
        }
        if (isset($_POST['r012_anno'])){
            $r012_anno = $_POST['r012_anno'];
        }

        if (isset($_POST['r012_committente'])){
            $r012_committente = $_POST['r012_committente'];
        }

        if (isset($_POST['r012_galleria_progetto'])){
            $r012_galleria_progetto = $_POST['r012_galleria_progetto'];
        }

        if (isset($_POST['r012_studio'])){
            $r012_studio = $_POST['r012_studio'];
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

        update_post_meta($post_id,'r012_regione_saved', $r012_regione);
        update_post_meta($post_id,'r012_localita_saved', $r012_localita);
        update_post_meta($post_id,'r012_provincia_saved', $r012_provincia);
        update_post_meta($post_id,'r012_anno_saved', $r012_anno);
        update_post_meta($post_id,'r012_committente_saved', $r012_committente);
        update_post_meta($post_id,'r012_galleria_saved', $r012_galleria_progetto);
        update_post_meta($post_id,'r012_studio_saved', $r012_studio);

        /*
            * salvataggio collaborazioni
            */


        update_post_meta($post_id,'r012_collaborazioni_professionisti_saved', $r012_collaborazioni_professionisti);
        update_post_meta($post_id,'r012_collaborazioni_aziende_saved', $r012_collaborazioni_aziende);
        update_post_meta($post_id,'r012_collaborazioni_rivenditori_saved', $r012_collaborazioni_rivenditori);
        update_post_meta($post_id,'r012_collaborazioni_operatori_saved', $r012_collaborazioni_operatori);

    }



    //creo una tassonomia per il CTP progetto
    public function r012_create_oggetto_taxonomies(){

        // tassonomia oggetto

        $labels = array(
            'name' => 'Oggetto',
            'singular_name' => 'Oggetto',
            'search_items' => 'Oggetti',
            'popular_items' => 'Popular oggetti',
            'all_items' => 'Tutte gli oggetti' ,
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit ',
            'update_item' => 'Aggiorna oggetto',
            'add_new_item' => 'Aggiungi oggetto',
            'new_item_name' => 'Nome nuovo oggetto',
            'separate_items_with_commas' => 'Separa oggetto con le virgole',
            'add_or_remove_items' => 'Aggiungi e Rimuovi oggetti',
            'choose_from_most_used' => 'Scegli dagli oggetti più usati',
            'menu_name' => 'Oggetto',
        );

        register_taxonomy('oggetto','progetto',array(
            'hierarchical'            => true,
            'labels'                  => $labels,
            'show_ui'                 => true,
            'show_admin_column'       => true,
            'update_count_callback'   => '_update_post_term_count',
            'query_var'               => true,
            'rewrite'                 => array( 'slug' => 'oggetto' )
        ));

        $this->flush_rewrite_rules();

    }

//creo una tassonomia per il CTP progetto
    public function r012_create_stato_opera_taxonomies(){

        // tassonomia oggetto

        $labels = array(
            'name' => 'Stato opera',
            'singular_name' => 'Stato opera',
            'search_items' => 'Stati opera',
            'popular_items' => 'Popular Stati opera',
            'all_items' => 'Tutte gli Stati opera' ,
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit ',
            'update_item' => 'Aggiorna Stato opera',
            'add_new_item' => 'Aggiungi Stato opera',
            'new_item_name' => 'Nome nuovo Stato opera',
            'separate_items_with_commas' => 'Separa Stati opera con le virgole',
            'add_or_remove_items' => 'Aggiungi e Rimuovi Stati opera',
            'choose_from_most_used' => 'Scegli dagli Stati opera più usati',
            'menu_name' => 'Stato opera',
        );

        register_taxonomy('stato','progetto',array(
            'hierarchical'            => true,
            'labels'                  => $labels,
            'show_ui'                 => true,
            'show_admin_column'       => true,
            'update_count_callback'   => '_update_post_term_count',
            'query_var'               => true,
            'rewrite'                 => array( 'slug' => 'stato-opera' )
        ));

        $this->flush_rewrite_rules();

    }
    //creo una tassonomia per il CTP tipologia
    public function r012_create_tipologia_taxonomies(){

        // tassonomia oggetto

        $labels = array(
            'name' => 'Tipologia',
            'singular_name' => 'Tipologia',
            'search_items' => 'Tipologie',
            'popular_items' => 'Tipologie più popolari',
            'all_items' => 'Tutte le tipologie' ,
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit ',
            'update_item' => 'Aggiorna tipologia',
            'add_new_item' => 'Aggiungi tipologia',
            'new_item_name' => 'Nome nuova tipologia',
            'separate_items_with_commas' => 'Separa tipologia con le virgole',
            'add_or_remove_items' => 'Aggiungi e Rimuovi tipologie',
            'choose_from_most_used' => 'Scegli tre le tipologie più usate',
            'menu_name' => 'Tipologia',
        );

        register_taxonomy('tipologia','progetto',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'tipologie' ),
        ));

        $this->flush_rewrite_rules();


    }


    public function r012_create_attivita_taxonomies()
    {

        // tassonomia attivita professionisti

        $labels = array(
            'name' => 'Attività Progetto',
            'singular_name' => 'Attività Progetto',
            'search_items' => 'Cerca Attività Progetti',
            'popular_items' => 'Popular Attività Progetti',
            'all_items' => 'Tutte le Attività Progetto' ,
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit Attività Progetto',
            'update_item' => 'Aggiorna Attività Progetto',
            'add_new_item' => 'Aggiungi Nuova Attività Progetto',
            'new_item_name' => 'Nome Nuova Attività Progetto',
            'separate_items_with_commas' => 'Separa Attività Progetto con le virgole',
            'add_or_remove_items' => 'Aggiungi e Rimuovi Attività Progetti',
            'choose_from_most_used' => 'Scegli dalle Attività Progetto più usate',
            'menu_name' => 'Categorie Attività',
        );

        register_taxonomy('attivita','progetto',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'attivita-progetto' ),
        ));
        $this->flush_rewrite_rules();
    }

    /**
     * Rewrite
     */
    //riscrittura regola per i permalink dei progetti



    function activate() {
        global $wp_rewrite;
        $this->flush_rewrite_rules();
    }

    function create_rewrite_rules($rules) {
        global $wp_rewrite;

        $newRule = array('(.+)/progetto/(.+)' => 'index.php?progetto='.$wp_rewrite->preg_index(2));

        $newRule2 = array('(.+)/progetto/(.+)/(.+)' => 'index.php?progetto='.$wp_rewrite->preg_index(2).'&action='.$wp_rewrite->preg_index(3));


       $newRule3 = array('(.+)/progetto/nuovo' => 'index.php?action=nuovo');


        $wp_rewrite->rules = $newRule3 + $newRule2  + $newRule + $wp_rewrite->rules;

    }

    function custom_post_link( $post_link, $id = 0 )
    {

        $post = get_post($id);
        if ( is_object($post) && $post->post_type == 'progetto' )
        {
            $post_id = get_post_meta( $post->ID, 'r012_professionista_saved', true);
            $professionista = get_post($post_id);
            $post_name = $professionista->post_name;
            $post_link = str_replace("%professionista%", $post_name, $post_link);


        }
        $this->flush_rewrite_rules();
        return $post_link;

    }
    function add_query_vars($qvars) {
        $qvars[] = 'action';
        return $qvars;
    }


    function flush_rewrite_rules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    function template_redirect_intercept($template) {


        global $wp_query;

        if ($wp_query->get('action') ) {


            switch($wp_query->get('action')){


                case 'nuovo':

                    require_once (TEMPLATEPATH . R012_TEMPLATES_DIRECTORY . 'progetto/new.php');
                    exit();
                    break;
                case 'modifica':


                    if ($wp_query->is_singular('progetto')){
                        require_once (TEMPLATEPATH . R012_TEMPLATES_DIRECTORY . 'progetto/edit.php');
                    }
                    exit();
                    break;
            }
        }

      return $template;
    }



}
?>