<?php
/**
 Wp Room 012
 * Functions and definition page
 */

add_action( 'after_setup_theme', 'wp_room012_init' );
if ( ! function_exists( 'wp_room012_init' ) ):
    /**
     * costanti
     */
    include_once TEMPLATEPATH . "/inc/init.php";
    /**
     * CPT professionisti
     */
    include_once TEMPLATEPATH . "/inc/r012_scheda_professionista_cpt.php";
    /**
     * CPT azienda
     */
    include_once TEMPLATEPATH . "/inc/r012_scheda_azienda.php";
    /**
     * CPT operatore
     */
    include_once TEMPLATEPATH . "/inc/r012_scheda_operatore.php";
    /**
     * CPT rivenditore
     */
    include_once TEMPLATEPATH . "/inc/r012_scheda_rivenditore.php";
    /**
    * CPT rivenditore
    */
    include_once TEMPLATEPATH . "/inc/r012_scheda_ente.php";
    /**
     * CPT progetto
     */
    include_once TEMPLATEPATH . "/inc/r012_progetto_cpt.php";

    /**
     * CPT slider
     */
    include_once TEMPLATEPATH . "/inc/r012_slider_cpt.php";
    /**
     * Ajax Transactions
     */
    include_once TEMPLATEPATH . "/inc/r012_ajax.php";
    /**
     * Ajax Transactions
     */
    include_once TEMPLATEPATH . "/inc/r012_registration.php";
    /**
     * classe autocomplete
     */
    include_once TEMPLATEPATH . "/inc/r012_autocomplete.php";

    /**
     * classe gallery
     */
    include_once TEMPLATEPATH . "/inc/r012_gallery.php";
    /**
     * classe utilities
     */
    include_once TEMPLATEPATH . "/inc/r012_utilities.php";

     

    add_image_size( 'slider-feature', 940, 345, true);
    add_image_size( 'thumb-home-feature', 220, 220, true);
    add_image_size( 'thumb-single', 300, 300, true);
    add_image_size( 'thumb-single-gallery', 9999, 9999, true);

    add_image_size( 'thumb-prima-notizia-feature', 460, 220, true);
    add_image_size( 'single-thumb', 460, 999999);

    add_image_size( 'aziende-thumb', 285, 285, true);
    add_image_size( 'preview', 100, 100, true);

    function wp_room012_init() 
    {
        if ( ! isset( $content_width ) ) $content_width = 900;
        register_sidebar();

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
                require_once( $locale_file );

        add_theme_support( 'automatic-feed-links' );
        //if(has_post_format())
        //{
        add_theme_support( 'post-formats', array(
                    'link',
                    'video',
                    'image',
                    'gallery',
                    'quote'
        ) );
        //}
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );


	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'wp_room012_header_image_width', 960 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'wp_room012_header_image_height', 250 ) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

        add_option('wp_room012_responsive', 1);
        add_option('wp_room012_fluid', 1);
        add_option('wp_room012_show_top_bar', 1);
        add_option('wp_room012_show_social', 1);
        
        require_once( get_template_directory() . '/inc/theme-options.php' );
        
        if ( isset( $_REQUEST['customize'] ) AND 'on' == $_REQUEST['customize'] ) {
                require_once( get_template_directory() . '/inc/theme-customizer.php' );
        }
    }
endif;

/**
 * Sets the post excerpt length to 40 words.
 */
function room012_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'room012_excerpt_length' );

add_action('init','r012_init');

function r012_init(){

    //Disabilito accesso backend per i non admin e editor
    //Da attivare

    if ( is_admin() && ! (current_user_can( 'administrator' ) || current_user_can('editor')) && ($_SERVER['REQUEST_URI'] != '/wp-admin/admin-ajax.php')) {
        wp_redirect( home_url() );
        exit;
    }

    /**
     * Registro il menù
     */
    register_nav_menus(
        array( 'header-menu' => __( 'Header Menu' ) )
    );
}


add_action( 'widgets_init', 'room012_widgets_init' );

    /**
     * Init Widgets
     */
function room012_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Bottom Slide', 'r012' ),
        'id' => 'bottom-slider-home',
        'description' => __( 'Sidebar per area sottostante lo slider', 'r012' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s left">',
        'after_widget' => "</section>",
        'before_title' => '<h3 class="widget-title title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Home Top', 'r012' ),
        'id' => 'evidence-top-home',
        'description' => __( 'Sidebar per area top home claim registrazione', 'r012' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s left">',
        'after_widget' => "</section>",
        'before_title' => '<h3 class="widget-title title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Home Middle', 'r012' ),
        'id' => 'evidence-middle-home',
        'description' => __( 'Sidebar per mail chimp', 'r012' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer', 'r012' ),
        'id' => 'footer-sidebar',
        'description' => __( 'Sidebar per area footer', 'r012' ),
        'before_widget' => '<section id="%1$s" class="widget span3 %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title title">',
        'after_title' => '</h3>',
    ) );

}
/**
 * @return string
 * Rimuove riferimenti a Wordpress in meta-informazioni
 */
function r012_remove_version() {
    return '';
}
add_filter('the_generator', 'r012_remove_version');

/**
 * @param $content
 * @return bool
 * Rimuove la barra admin per gli utenti non amministratori
 */

function r012_remove_admin_bar($content) {
    return false; //( (current_user_can('administrator')) && !is_admin() ) ? $content : false;
}
add_filter( 'show_admin_bar' , 'r012_remove_admin_bar');


function wp_room012_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <div class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?> single-comment">
            <div class="span1" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>"><?php echo get_avatar($comment,$size='60',$default='<path_to_url>' ); ?></div>
            <div class="span11">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
                </a>
                 
                <?php edit_comment_link(__('(Edit)'),'  ','') ?>

                <?php comment_text() ?>
                
                
                    <a class="btn" data-toggle="modal" href="#myModal<?php comment_ID() ?>" ><?php _e('Details'); ?></a>
                    <div class="modal fade" id="myModal<?php comment_ID() ?>">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3><?php _e('Reply to'); the_title(); ?></h3>
                    </div>
                    <div class="modal-body">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                            <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
                        </a>
                        <p><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></p>
                        <?php comment_text() ?>
                    </div>
                    </div>
                
                
                
                <div class="btn btn-info">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

                    <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.') ?></em>
                    <br />
                <?php endif; ?>
                </div>
            </div>
    </div>
<hr />
<?php
}

add_action('wp_enqueue_scripts', 'r012_scripts');
add_action('admin_enqueue_scripts', 'r012_admin_scripts');

function r012_admin_scripts() {
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script( 'r012-ajax', get_template_directory_uri() . '/js/r012_ajax.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script( 'r012-ajax' );

    //wp_deregister_script('jquery-ui-core');
    wp_register_script( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('jquery-ui');

/*
        wp_register_style( 'r012-admin-style', get_template_directory_uri() . '/inc/admin_style.css');
        wp_enqueue_style( 'r012-admin-style' );
*/
   wp_localize_script( 'r012-ajax', 'r012_ajax_data', array(
        'adminurl' => admin_url()
        //'nonce' => wp_create_nonce('r012_professionisti_nonce')

    ));

    wp_register_script( 'r012-autocomplete', get_template_directory_uri() . '/js/r012_autocomplete.js', array('jquery', 'jquery-ui'),'','true');
    wp_enqueue_script( 'r012-autocomplete' );

    wp_localize_script( 'r012-autocomplete', 'r012_autocomplete_data', array(
        'adminurl' => admin_url('admin-ajax.php')
        //'nonce' => wp_create_nonce('r012_professionisti_nonce')

    ));


}

function r012_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    wp_deregister_script('jquery-ui-core');
    wp_register_script( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('jquery-ui');


    wp_register_style( 'jquery-ui-style', get_template_directory_uri() . '/inc/jquery-ui.css');
    wp_enqueue_style( 'jquery-ui-style' );

    //add script for cycle gallery
    #wp_register_script( 'cycle', get_template_directory_uri() . '/js/cycle.js', array('jquery'));
    #wp_enqueue_script( 'cycle' );

    wp_register_script( 'r012-ajax', get_template_directory_uri() . '/js/r012_ajax.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script( 'r012-ajax' );
    wp_register_script( 'r012-script', get_template_directory_uri() . '/js/r012_script.js', array('jquery'),'','true');
    wp_enqueue_script( 'r012-script' );

    wp_register_script( 'r012-validate-min', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script( 'r012-validate-min' );
    wp_register_script( 'r012-validate-additional-min', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/additional-methods.min.js', array('jquery','r012-validate-min'));
    wp_enqueue_script( 'r012-validate-additional-min' );



    wp_localize_script( 'r012-ajax', 'r012_ajax_data', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'template_url' => get_bloginfo('template_url'),
        'url' => get_bloginfo('url'),

        //'nonce' => wp_create_nonce('r012_professionisti_nonce')
    ));

    wp_register_script( 'r012-autocomplete', get_template_directory_uri() . '/js/r012_autocomplete.js', array('jquery', 'jquery-ui'),'','true');
    wp_enqueue_script( 'r012-autocomplete' );

    wp_localize_script( 'r012-autocomplete', 'r012_autocomplete_data', array(
        'adminurl' => admin_url('admin-ajax.php')
        //'nonce' => wp_create_nonce('r012_professionisti_nonce')

    ));
    wp_register_script( 'r012-ricerca-avanzata', get_template_directory_uri() . '/js/r012_ricerca-avanzata.js', array('jquery', 'jquery-ui'),'','true');
    wp_enqueue_script( 'r012-ricerca-avanzata' );

    wp_localize_script( 'r012-ricerca-avanzata', 'r012_ricerca_data', array(
        'adminurl' => admin_url('admin-ajax.php')
        //'nonce' => wp_create_nonce('r012_professionisti_nonce')

    ));
}

function wp_room012_share()
{
    if(get_option('wp_room012_show_social') == 1){
    ?>
    <nav class="span12 social">
        <div class="label label-info share"><?php _e('Share'); ?></div>
        <br />
        <iframe src="http://www.facebook.com/plugins/like.php?app_id=162659317130181&amp;href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:107px; height:21px;" allowTransparency="true"></iframe>
        <a href="http://twitter.com/share7?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="twitter-share-button" data-count="horizontal" data-via="Mari0Bros" data-lang="it">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
    </nav>
    <?php
    }
}
add_action('trashed_post', 'r012_delete_user');
function r012_delete_user($post_id) {
    $r012_value_autore = get_post_meta( $post_id, 'r012_autore_saved', true);

    wp_delete_user( $r012_value_autore);
}


function remove_media_library_tab($tabs) {
    if(is_page(ID_PAGE_REGISTRAZIONE)){

        unset($tabs['library']);
        unset($tabs['type_url']);
    }
    return $tabs;
}
add_filter('media_upload_tabs', 'remove_media_library_tab');

add_action('add_attachment','redirect_uploader_flow');
function redirect_uploader_flow($attachment_id){
    if(is_page(ID_PAGE_REGISTRAZIONE))
        $_SESSION['uploaded_image'] = $attachment_id;
}

add_action( 'pre_get_posts', 'rp_date_archive' );
    function rp_date_archive($query){
        if(is_search()){
            //$query->query_vars['post_type'] = get_post_types( array( 'public' => true ) );
            $query->set('post_type', array('post','attachment','nav_menu_item','event','professionisti'));
            //array(9) { ["post"]=> string(4) "post" ["page"]=> string(4) "page" ["attachment"]=> string(10) "attachment" ["revision"]=> string(8) "revision" ["nav_menu_item"]=> string(13) "nav_menu_item" ["wpcf7_contact_form"]=> string(18) "wpcf7_contact_form" ["event"]=> string(5) "event" ["professionisti"]=> string(14) "professionisti" ["r012_slider"]=> string(11) "r012_slider" } array(9) { ["post"]=> string(4) "post" ["page"]=> string(4) "page" ["attachment"]=> string(10) "attachment" ["revision"]=> string(8) "revision" ["nav_menu_item"]=> string(13) "nav_menu_item" ["wpcf7_contact_form"]=> string(18) "wpcf7_contact_form" ["event"]=> string(5) "event" ["professionisti"]=> string(14) "professionisti" ["r012_slider"]=> string(11) "r012_slider" }

        }

    }

add_filter('wp_mail_from_name','r012_wp_mail_from_name');
function r012_wp_mail_from_name($name) {
    return 'ROOM012';
}


add_action('login_form','r012_possibly_redirect');
function r012_possibly_redirect(){
    global $pagenow;

        if( ('wp-login.php' == $pagenow) && (is_user_logged_in()) && !( isset($_GET['action']) || isset($_GET['checkemail'] )) )  {
            wp_redirect('/login');
            exit();
        }

}

/**
 * Codice analytics
 */
function r012_add_analytics(){
?>
<!-- Google Analytics -->
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-37888589-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<?php
}
add_action('wp_head','r012_add_analytics',999);




?>
