<?php
/**
 * Slider per room 012
 */

add_action('init', 'r012_register_slider');

/**
 * Crea il CPT slider
 */
function r012_register_slider() {

    $r012_slider_labels = array(
        'name'               => __('Slider','r012'),
        'singular_name'      => __('Slider','r012'),
        'add_new'            => __('Aggiungi Slider','r012'),
        'add_new_item'       => __('Nuova Slider','r012'),
        'edit_item'          => __('Modifica Slider','r012'),
        'new_item'           => __('Nuova Slider','r012'),
        'all_items'          => __('Elenco Slider','r012'),
        'view_item'          => __('Visualizza Slider','r012'),
        'search_items'       => __('Cerca Slider','r012'),
        'not_found'          => __('Slider non trovata','r012'),
        'not_found_in_trash' => __('Slider non trovata nel cestino','r012'


        ),
    );

    $r012_slider_cpt = array(
        'labels'             => $r012_slider_labels,
        'public'             => true,
        'rewrite'            => array('slug' => 'slider'),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'page-attributes'
        ),
    );

    register_post_type('r012_slider', $r012_slider_cpt);

    flush_rewrite_rules();
}
?>
<?php
/**
 * Inizio creazione meta box
 */

add_action( 'add_meta_boxes', 'r012_add_custom_box_link' );



add_action( 'save_post', 'r012_save_slider' );

/**
 * Aggiungo il meta box link
 */
function r012_add_custom_box_link() {
    add_meta_box(
        'slider_link_id',
        __( 'Link slider', 'r012' ),
        'r012_print_custom_box',
        'r012_slider'
    );

}

/**
 * Stampo il box link dello slider
 */
function r012_print_custom_box( $post ) {

    $r012_value_link_slider = get_post_meta( $post->ID, 'r012_slider_link', true);

    $r012_check_slider = get_post_meta( $post->ID, 'r012_slider_check', true);

    $r012_value_label_link_slider = get_post_meta( $post->ID, 'r012_slider_label_link', true);

    $r012_value_align = get_post_meta( $post->ID, 'r012_align', true);

    wp_nonce_field( 'r012_slider_nonce', 'nonce_slider' );
    $checked ='';
    if ($r012_check_slider == 1){
        $checked = ' checked="checked"';
    }


    echo '<p><label for="r012_label_spunta">';
    _e("Inserisci link", 'r012_label_spunta' );
    echo '</label>';
    echo '<input name="slider_check" id="slider_check" value="1" type="checkbox" '.$checked.'></p>';
    echo '<p><label for="r012_link_slider_name">';
    _e("Link slider content", 'r012_link_slider' );
    echo '</label> ';
    echo '<input type="text" id="r012_link_slider_id" name="r012_link_slider_name" value="'.$r012_value_link_slider.'" size="25" /></p>';
    echo '<p><label for="r012_label_link_slider">';
    _e("Label per il link nello slider", 'r012_label_link_slider' );
    echo '</label> ';
    echo '<input type="text" id="r012_label_link_slider_id" name="r012_label_link_slider" value="'.$r012_value_label_link_slider.'" size="25" /></p>';
    echo '<p><label for="r012_align">';
    _e("Allinea testo", 'r012_align' );
    echo '</label>';
    if ($r012_value_align=='left'){

        echo '<select name="r012_align" id="r012_align"><option value="left" selected = "selected">Sinistra</option><option value="right">Destra</option></p>';
    }
    if($r012_value_align=='right'){
        echo '<select name="r012_align" id="r012_align"><option value="left">Sinistra</option><option value="right" selected = "selected">Destra</option></p>';

    }
    else {
        echo '<select name="r012_align" id="r012_align"><option value="left" selected = "selected">Sinistra</option><option value="right">Destra</option></p>';

    }
    echo '</select>';
}

/**
 * Salvataggio slider
 */
function r012_save_slider( $post_id ) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;


    if ( !wp_verify_nonce( $_POST['nonce_slider'], 'r012_slider_nonce' ))
        return;

    if(isset($_POST['slider_check'])){
        $r012_slider_check = $_POST['slider_check'];
    }
    if(isset($_POST['r012_link_slider_name'])){
        $r012_slider_link_name = $_POST['r012_link_slider_name'];
    }
    if(isset($_POST['r012_label_link_slider'])){
        $r012_label_link_slider = $_POST['r012_label_link_slider'];
    }
    if(isset($_POST['r012_align'])){
        $r012_align = $_POST['r012_align'];
    }
    update_post_meta($post_id,'r012_slider_check', $r012_slider_check);

    update_post_meta($post_id,'r012_slider_link', $r012_slider_link_name);

    update_post_meta($post_id,'r012_slider_label_link', $r012_label_link_slider);

    update_post_meta($post_id,'r012_align', $r012_align);
}
?>