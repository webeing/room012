<?php
/**
 * Funzioni Webeing.net per il sito room 012
 */
add_action('init', 'r012_register_scheda');
/**
 * Crea il CPT per la scheda professionista
 */

function r012_register_scheda() {

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
            'thumbnail',
            'revisions'
        ),
    );

    register_post_type('professionisti', $r012_scheda_cpt);


}

/**
 * Inizio creazione meta box
 */

add_action( 'add_meta_boxes', 'r012_add_custom_box_scheda' );
add_action( 'add_meta_boxes', 'r012_add_custom_box_social' );
add_action( 'save_post', 'r012_save_scheda');
/**
 * Aggiungo il meta box link
 */
function r012_add_custom_box_scheda() {

    add_meta_box(
        'scheda_id',
        __( 'Scheda Professionista', 'r012' ),
        'r012_print_custom_box_scheda',
        'professionisti',
        'advanced',
        'high'
    );

}

/**
 * aggiungo meta box social
 */

function r012_add_custom_box_social() {

    add_meta_box(
        'social_id',
        __( 'Account Social', 'r012' ),
        'r012_print_custom_box_social',
        'professionisti',
        'advanced',
        'high'
    );

}

/**
 * Stampo il box per i dati della scheda professionista
 */
function r012_print_custom_box_social( $post ) {
    $r012_value_facebook = get_post_meta( $post->ID, 'r012_facebook_saved', true);
    $r012_value_twitter = get_post_meta( $post->ID, 'r012_twitter_saved', true);
    $r012_value_linkedin = get_post_meta( $post->ID, 'r012_linkedin_saved', true);
    $r012_value_skype = get_post_meta( $post->ID, 'r012_skype_saved', true);

    echo '<p><label for="r012_facebook">';
    _e("Account Facebook", 'rp' );
    echo '</label> ';
    echo '<input type="text" name="r012_facebook" id="r012_facebook_id" value="'.$r012_value_facebook.'"></p>';

    echo '<p><label for="r012_twitter">';
    _e("Account Twitter", 'rp' );
    echo '</label> ';
    echo '<input type="text" name="r012_twitter" id="r012_twitter_id" value="'.$r012_value_twitter.'"></p>';

    echo '<p><label for="r012_linkedin">';
    _e("Account Linkedin", 'rp' );
    echo '</label> ';
    echo '<input type="text" name="r012_linkedin" id="r012_linkedin_id" value="'.$r012_value_linkedin.'"></p>';

    echo '<p><label for="r012_skype_saved">';
    _e("Account Skype", 'rp' );
    echo '</label> ';
    echo '<input type="text" name="r012_skype" id="r012_skype_id" value="'.$r012_value_skype.'"></p>';

    wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

    //var_dump(get_post_meta($post->ID,'_wp_geo_marker',true));
}

function r012_print_custom_box_scheda( $post ) {

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

    wp_nonce_field( 'r012_professionisti_nonce', 'nonce_professionisti' );

    $checked_studio ='';
    if ($r012_value_studio == 1){
        $checked_studio = ' checked="checked"';
    }

    echo '<input name="r012_studio" id="r012_studio_id" value="1" type="checkbox" '.$checked_studio.' />';
    echo '<label for="r012_studio">';
    _e("Registra utente come studio", 'r012' );
    echo '</label></p>';

    $checked_approvazione ='';
    if ($r012_value_approvato == 1){
        $checked_approvazione = ' checked="checked"';
    }

    echo '<input name="r012_approvato" id="r012_approvato_id" value="1" type="checkbox" '.$checked_approvazione.' />';
    echo '<label for="r012_approvato">';
    _e("Approva utente", 'r012' );
    echo '</label></p>';

    echo '<p><label for="r012_nome">';
    _e("Nome", 'r012' );
    echo '</label> ';
    echo '<input type="text" name="r012_nome" id="r012_nome_id" value="'.$r012_value_nome.'" />';

    echo '<p><label for="r012_cognome">';
    _e("Cognome", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_cognome" id="r012_cognome_id" value="'.$r012_value_cognome.'" />';

    echo '<p><label for="r012_piva">';
    _e("P. IVA", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_piva" id="r012_piva_id" value="'.$r012_value_piva.'" />';

    echo '<p><label for="r012_ordine">';
    _e("Ordine iscrizione", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_ordine" id="r012_ordine_id" value="'.$r012_value_ordine.'" />';

    echo '<p><label for="r012_numero">';
    _e("Numero iscrizione", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_numero" id="r012_numero_id" value="'.$r012_value_numero.'" />';

    echo '<p><label for="r012_nome_studio">';
    _e("Nome studio", 'r012' );
    echo '</label> ';
    echo '<input type="text" name="r012_nome_studio" id="r012_nome_studio_id" value="'.$r012_value_nome_studio.'" />';

    echo '<p><label for="r012_posizione">';
    _e("Posizione", 'r012' );
    echo '</label> ';
    echo '<input type="text" name="r012_posizione" id="r012_posizione_id" value="'.$r012_value_posizione.'" />';

    echo '<p><label for="r012_telefono">';
    _e("Telefono", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_telefono" id="r012_telefono_id" value="'.$r012_value_telefono.'" />';

    echo '<p><label for="r012_mobile">';
    _e("Mobile", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_mobile" id="r012_mobile_id" value="'.$r012_value_mobile.'" />';

    echo '<p><label for="r012_fax">';
    _e("Fax", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_fax" id="r012_fax_id" value="'.$r012_value_fax.'" />';

    echo '<p><label for="r012_email">';
    _e("Email", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_email" id="r012_email_id" value="'.$r012_value_email.'" />';

    echo '<p><label for="r012_sito">';
    _e("Sito web", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_sito" id="r012_sito_id" value="'.$r012_value_sito.'" />';

    echo '<p><label for="r012_citta">';
    _e("Città", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_citta" id="r012_citta_id" value="'.$r012_value_citta.'" />';

    echo '<p><label for="r012_via">';
    _e("Via", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_via" id="r012_via_id" value="'.$r012_value_via.'" />';

    echo '<p><label for="r012_cap">';
    _e("Cap", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_cap" id="r012_cap_id" value="'.$r012_value_cap.'" />';

    echo '<p><label for="r012_provincia">';
    _e("Provincia", 'r012' );
    echo '</label>';
    echo '<input type="text" name="r012_provincia" id="r012_provincia_id" value="'.$r012_value_provincia.'" />';

/*
    echo '<p><tr valign="top">';
    echo '<th scope="row">Upload Image</th>';
    echo '<td><label for="upload_image">';
    echo '<input id="upload_image" type="text" size="36" name="upload_image" value="'.$r012_value_img.'" />';
    echo '<input id="upload_image_button" type="button" value="Upload Image" />';
    echo '<br />Enter an URL or upload an image for the banner.';
    echo '</label></td>';
    echo '</tr></p>';
*/
}
/**
 * Salvataggio ctp scheda professionista
 */
function r012_save_scheda( $post_id ) {

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
    /*
     * salvataggio dati social
     */
    update_post_meta($post_id,'r012_facebook_saved', $r012_facebook);
    update_post_meta($post_id,'r012_twitter_saved', $r012_twitter);
    update_post_meta($post_id,'r012_linkedin_saved', $r012_linkedin);
    update_post_meta($post_id,'r012_skype_saved', $r012_skype);
}


add_action( 'init', 'create_categories_professionisti_taxonomies', 0 );
//creo una tassonomia per il CTP scheda professionisti
function create_categories_professionisti_taxonomies()
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

}



/**
 * Colonne da mostrare
 */
add_filter( 'manage_edit-professionisti_columns', 'r012_edit_scheda_columns' ) ;
function r012_edit_scheda_columns( $columns ) {

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' =>__('Titolo'),
        'nome' => __( 'Nome' ),
        'cognome' => __( 'Cognome' ),
        'professione' => __( 'Professione' ),
        'provincia' => __( 'Provincia' )
    );

    return $columns;

}

/**
 * Aggiungo contenuto alle colonne
 */
add_action( 'manage_professionisti_posts_custom_column', 'r012_manage_scheda_columns', 10, 2 );
function r012_manage_scheda_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        case 'nome' :

            $r012_nome = get_post_meta($post_id,'r012_nome_saved', true);

            if ( empty( $r012_nome ) )
                echo __( 'Non assegnato' );

            else
                echo $r012_nome;

            break;

        case 'cognome' :

            $r012_cognome = get_post_meta($post_id,'r012_cognome_saved', true);

            if ( empty( $r012_cognome ) )
                echo __( 'Non assegnato' );

            else
                echo $r012_cognome;

            break;

        case 'professione' :

            /* Get the genres for the post. */
            $terms = get_the_terms( $post_id, 'categorie_professionisti');

            /* If terms were found. */
            if ( !empty( $terms ) ) {

                $out = array();

                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        //Costruisco la URL del link sulla colonna per filtrare per categoria (e.g. tutte le pizzerie, etc...)
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'categorie_professionisti' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'categorie_professionisti', 'display' ) )
                    );
                }

                echo join( ', ', $out );
            }

            else {
                _e( 'Nessuna categoria' );
            }

            break;

        case 'provincia' :

            /* Get the post meta. */
            $r012_provincia = get_post_meta($post_id,'r012_provincia_saved', true);

            if ( empty( $r012_provincia ) )
                echo __( 'Non assegnato' );

            else
                echo $r012_provincia;

            break;

        default :
            break;
    }
}


/**
 * Imposto quali colonne sono Ordinabili
 */
add_filter( 'manage_edit-professionisti_sortable_columns', 'r012_professionisti_sortable_columns' );
function r012_professionisti_sortable_columns( $columns ) {

    $columns['professione'] = 'professione';

    return $columns;
}

/**
 * Imposto i criteri di ordinameto
 */
add_action( 'load-edit.php', 'r012_sort_professionisti' );
function r012_sort_professionisti() {
    add_filter( 'request', 'r012_sort_r012_scheda' );
}

function r012_sort_r012_scheda( $vars ) {

    if ( isset( $vars['post_type'] ) && 'professionisti' == $vars['post_type'] ) {

        if ( isset( $vars['orderby'] ) && 'professione' == $vars['orderby'] ) {

            /* Merge the query vars with our custom variables. */
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => 'r012_professione_saved',
                    'orderby' => 'ASC'
                )
            );
        }
    }

    return $vars;
}
?>