<?php

/**
 * classe gestione autocomplete
 */
global $r012_search;
class R012Autocomplete {
    public static function print_input_autocomplete( $post_type , $testo){

             echo '<label>' . $testo . '</label>';
             echo '<input class="r012_autocomplete" name="' . $post_type .'" id="r012_autocomplete_'.$post_type.'_id" value=""/>';
             echo '<a class="button r012-button-aggiungi" href="">[+] Aggiungi</a>';


    }

    public static function register_scripts(){
/*
        wp_register_script( 'r012-jquery-ui','http://code.jquery.com/ui/1.10.2/jquery-ui.js', array('jquery'),'','true');
        wp_enqueue_script( 'r012-jquery-ui' );
*/
        /*
        wp_register_script( 'r012-autocomplete', get_template_directory_uri() . '/js/r012_autocomplete.js', array('jquery', 'r012-jquery-ui'),'','true');
        wp_enqueue_script( 'r012-autocomplete' );

        wp_localize_script( 'r012-autocomplete', 'r012_autocomplete_data', array(
            'adminurl' => admin_url('admin-ajax.php')
            //'nonce' => wp_create_nonce('r012_professionisti_nonce')

        ));

*/
    }

    public static function register_ajax(){

        global $r012_search;

        if($_POST){
            $r012_search = $_POST['search'];
            $r012_cpt = $_POST['posttype'];

            add_filter( 'posts_where', array('R012Autocomplete','where_search' ) );

            $title_post = get_posts( array(
                'post_type' => $r012_cpt,
                'suppress_filters' => false )
            );
            remove_filter( 'posts_where', array('R012Autocomplete','where_search' ) );

        }

        // generate the response

        $response = json_encode( $title_post);

        echo $response;

        exit();

    }


    public static function register_new_user(){

        if($_POST){
            $r012_nome = $_POST['nome'];

        }

        // generate the response

        $response = json_encode( $r012_nome);

        echo $response;

        exit();

    }


    public static function where_search( $where = '') {

        global $r012_search;

        $where = $where .  " AND wp_posts.post_title LIKE '%". $r012_search ."%'" ;

        return $where;
    }


    //stampa le checkbox risultato dell'autocomplete
    public function print_result_autocomplete($cpt, $r012_values_autocomplete){
        if($r012_values_autocomplete){
            $args = array(
                'post_type' => $cpt,
                'include' => $r012_values_autocomplete,
            );

            $r012_posts = get_posts( $args );


            echo '<ul class="element-collaborazioni">';


               echo '<li><input type="checkbox" style="display:none;" name="r012_autocomplete_'.$cpt.'_item[]" checked="checked" value="0" /></li>';


            foreach($r012_posts as $r012_post){

                echo '<li><input type="checkbox" name="r012_autocomplete_'.$cpt.'_item[]" checked="checked" value="'.$r012_post->ID.'" /><label>' .$r012_post->post_title. '</label></li>';
            }
            foreach($r012_values_autocomplete as $value){

                if (!is_numeric($value)){

                    echo '<li><input type="checkbox" name="r012_autocomplete_'.$cpt.'_item[]" checked="checked" value="'.$value.'" /><label>' .$value. '</label></li>';
                }

            }
            echo '</ul>';
        }
    }

}


add_action('admin_enqueue_scripts', array('R012Autocomplete','register_scripts') );

add_action('wp_ajax_r012_autocomplete', array( 'R012Autocomplete', 'register_ajax') );
add_action('wp_ajax_nopriv_r012_autocomplete', array( 'R012Autocomplete' , 'register_ajax') );
add_action('wp_ajax_r012_add', array( 'R012Autocomplete', 'register_new_user') );
add_action('wp_ajax_nopriv_r012_add', array( 'R012Autocomplete' , 'register_new_user') );
?>