<?php
/**
 * Utilities functions
 */
add_action( 'init', 'r012_utility_setup');
function r012_utility_setup(){
    $utility = new R012Utility();
    $utility->r012_thumb_upload();
}

/**
 * Class R012Utility
 */
class R012Utility {


    /**
     * @param $form_name
     * @param $_POST
     *
     * Pubblica a video la form per creare la ricerca avanzata, parametrizzata sui vari casi
     */
    public static function r012_advanced_search_form($form_name, $_POST){


    ?>

    <form id="<?php echo $form_name . '_id' ?>" name="<?php echo $form_name ?>" method="post" enctype="multipart/form-data" novalidate="novalidate" class="form-horizontal advanced-search">
        <section class="row-fluid">
                <div class="span12  content-research">
                    <input type="hidden" name="r012_form_name" value="<?php echo $form_name;?>" />

                    <div class="nominativo"><!-- nominativo -->
                        <p class="title-research span3">
                         Inserisci il nominativo
                        </p>
                        <?php if ($form_name == 'r012_ricerca_professionisti') { ?>
                               <input type="text" class="span5" placeholder="inserisci il nome..." name="r012_name_search" value="<?php echo $_POST['r012_name_search'] ?>" />
                               <input type="text" class="span5" placeholder="inserisci il cognome..." name="r012_last_name_search" value="<?php echo $_POST['r012_last_name_search'] ?>" />
                        <?php } else { ?>
                              <input type="text" class="span9" placeholder="inserisci il nome..." name="r012_name_search" value="<?php echo $_POST['r012_name_search'] ?>" />

                        <?php } ?>
                        <div class="clear"></div>
                    </div><!-- ./nominativo -->


                    <?php
                    $terms = "";
                    $category = "";
                    $title_category = "";
                    switch ($form_name) {
                        case 'r012_ricerca_professionisti':
                            $title_category ='Professionista';
                            $terms = get_terms("categorie_professionisti");
                            $category = $_POST['r012_categorie_professionista'];
                            $name_input = 'r012_categorie_professionista[]';
                            echo '<div class="span3 clear">';
                            break;
                        case 'r012_ricerca_aziende':
                            $title_category ='Azienda';
                            $terms = get_terms("categoria_azienda");
                            $category = $_POST['r012_categorie_azienda'];
                            $name_input = 'r012_categorie_azienda[]';
                            echo '<div class="span6 clear">';
                            break;
                        case 'r012_ricerca_operatori':
                            $title_category = 'Operatore';
                            $terms = get_terms("categoria_operatore");
                            $category = $_POST['r012_categorie_operatore'];
                            $name_input = 'r012_categorie_operatore[]';
                            echo '<div class="span6 clear">';
                            break;
                        case 'r012_ricerca_rivenditori':
                            $title_category ='Rivenditori';
                            $terms = get_terms("categoria_rivenditore");
                            $category = $_POST['r012_categorie_rivenditore'];
                            $name_input = 'r012_categorie_rivenditore[]';
                            echo '<div class="span6 clear">';
                            break;
                        case 'r012_ricerca_enti':
                            $title_category ='Enti/Associazioni';
                            $terms = get_terms("categoria_ente");
                            $category = $_POST['r012_categorie_ente'];
                            $name_input = 'r012_categorie_ente[]';
                            echo '<div class="span6 clear">';
                            break;
                    } ?>

                        <header class="title-research"><!-- professionista -->

                            <?php echo $title_category; ?>

                            <span class="sprite-arrow"></span>
                        </header>

                        <div class="content-filter">

                            <ul>
                                <?php foreach ( $terms as $term ) { ?>
                                    <?php $checked = ""; ?>
                                    <li class="professioni-checklist">
                                        <?php
                                            if ( in_array($term->term_id, $category ) )
                                                $checked = 'checked="checked"'
                                        ?>
                                        <input <?php echo $checked ?> type="checkbox" value="<?php echo $term->term_id; ?>" name="<?php echo $name_input ?>">
                                        <?php echo $term->name; ?>

                                    </li>
                                <?php } ?>
                            </ul>
                        </div><!-- ./ content-filter professionisti -->

                    </div><!-- ./ span3 -->
                    <?php if($form_name == 'r012_ricerca_professionisti'){?>
                    <div class="span5">
                        <div class="content-filter">

                            <header class="title-research"><!-- attività -->
                                Settore di attività
                                <span class="sprite-arrow"></span>
                            </header>
                            <?php $args_all_terms = array(

                                'hide_empty'    => 0,
                                'fields'        => 'all',
                                'order'         => 'DESC',
                            );

                            $terms = get_terms('attivita_professionisti',$args_all_terms);


                            foreach ( $terms as $term ) {

                                $checked = "";

                                if($term->parent==0){ ?>
                                    <div class="content-checklist attivita">
                                        <?php
                                            if ( in_array($term->term_id, $_POST['r012_attivita_item'] ) )
                                                $checked = 'checked="checked"'
                                        ?>
                                        <input <?php echo $checked ?> type="checkbox" value="<?php echo $term->term_id; ?>" name="r012_attivita_item[]"  id="check_parent">
                                        <?php echo $term->name; ?>
                                    </div>

                                    <?php
                                    $args = array(
                                        'hide_empty'=> 0,
                                        'child_of'  => $term->term_id);

                                    $r012_termini_attivita = get_terms( 'attivita_professionisti', $args );
                                    echo '<ul class="sub-checklist">';
                                    foreach($r012_termini_attivita as $r012_termine_attivita){
                                        $checked = "";

                                        if ( in_array($r012_termine_attivita->term_id, $_POST['r012_attivita_item'] ) )
                                            $checked = 'checked="checked"'
                                        ?>


                                        <li>
                                            <input <?php echo $checked ?> type="checkbox" value="<?php echo $r012_termine_attivita->term_id; ?>" name="r012_attivita_item[]">
                                            <?php echo $r012_termine_attivita->name; ?>
                                        </li>


                                    <?php }
                                    echo '</ul>';
                                }
                            }?>
                        </div><!-- ./ content-filter attività -->
                    </div><!-- ./ span3 -->
                    <?php } ?>
                <?php if($form_name == 'r012_ricerca_professionisti'){?>
                    <div class="span3">
                <?php } else {?>
                    <div class="span5">
                <?php }?>

                        <header class="title-research"><!-- regione -->
                            Regione / Provincia
                            <span class="sprite-arrow"></span>
                        </header>

                        <div class="content-filter">

                            <?php global $regioni;
                            foreach ($regioni as $key_regione => $value_regione) {
                                $checked = "";
                                if($value_regione == 0){

                                } else {

                                    if ( in_array($value_regione, $_POST['r012_regioni_item'] ) )
                                        $checked = 'checked="checked"';
                                    ?>
                                    <div class="regioni-checklist">
                                        <input <?php echo $checked ?> type="checkbox" value="<?php echo $value_regione; ?>" name="r012_regioni_item[]"  id="check_parent">
                                        <?php echo $key_regione; ?>
                                    </div>

                                <?php
                                }
                                global $province;
                                global $regioni_province;

                                echo '<ul class="sub-checklist">';
                                foreach($regioni_province as $key_regione_provincia => $value_regione_provincia){
                                    if($value_regione == $value_regione_provincia) {

                                        foreach($province as $key_province => $value_provincia){
                                            if($key_province == $key_regione_provincia){
                                                $checked = "";

                                                if ( in_array($value_provincia, $_POST['r012_province_item'] ) )
                                                    $checked = 'checked="checked"';

                                                ?>
                                                <li>
                                                    <input <?php echo $checked ?> type="checkbox" value="<?php echo $value_provincia; ?>" name="r012_province_item[]">
                                                    <?php echo $key_province; ?>
                                                </li>

                                            <?php
                                            }
                                        }
                                    }
                                    ?>


                                <?php }
                                echo '</ul>';
                            } ?>

                        </div><!-- ./ content-filter regione -->
                    </div>

                    <div class="btn-research"><!-- cerca -->
                        <a class="ricerca-avanzata" title="Cerca il professionista nel sito Room012">Cerca</a>
                    </div><!-- ./cerca -->

                </div>
           </section>
    </form>
<?php
    }

    /**
     * @param $_POST
     * @param int $paged
     * @return array
     *
     * Logica di gestione della ricerca avanzata sulla piattaforma
     */
    public static function r012_advanced_search($_POST, $paged = 1){

        $meta_query = array();
        $title = "";


        switch ($_POST["r012_form_name"]) {
            case 'r012_ricerca_professionisti':
                $post_type = 'professionisti';

                if($_POST["r012_name_search"]){
                    $name = $_POST["r012_name_search"];

                    $meta_query_name = array(
                            'key' => 'r012_nome_saved',
                            'value' => $name,
                            'compare' => 'LIKE'
                        );

                }

                if($_POST["r012_last_name_search"]){
                    $last_name = $_POST["r012_last_name_search"];
                    $meta_query_last_name =  array(
                            'key' => 'r012_cognome_saved',
                            'value' => $last_name,
                            'compare' => 'LIKE'
                    );
                }

                $tax_query = array();

                if( $_POST["r012_categorie_professionista"] && $_POST["r012_attivita_item"]) {
                    $tax_query = array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'categorie_professionisti',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_professionista"],
                            'operator' => 'IN'

                        ),
                        array(
                            'taxonomy' => 'attivita_professionisti',
                            'field' => 'id',
                            'terms' => $_POST["r012_attivita_item"],
                            'operator' => 'IN'
                        )
                    );
                } elseif ($_POST["r012_categorie_professionista"]){
                    $tax_query = array(
                        array(
                            'taxonomy' => 'categorie_professionisti',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_professionista"],
                            'operator' => 'IN'

                        )
                    );
                } elseif ($_POST["r012_attivita_item"]) {
                    $tax_query = array(
                        array(
                            'taxonomy' => 'attivita_professionisti',
                            'field' => 'id',
                            'terms' => $_POST["r012_attivita_item"],
                            'operator' => 'IN'

                        )
                    );
                } else {

                }
                break;

            case 'r012_ricerca_aziende':

                $post_type = 'aziende';
                //query per aziende
                if($_POST["r012_categorie_azienda"]){
                    $tax_query = array(
                        array(
                            'taxonomy' => 'categoria_azienda',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_azienda"],
                            'operator' => 'IN'

                        )
                    );
                }


                if($_POST["r012_name_search"]){
                    $title = $_POST["r012_name_search"];
                }


                break;
            case 'r012_ricerca_operatori':
                $post_type = 'operatori';

                //query per operatore
                if($_POST["r012_categorie_operatore"]){
                    $tax_query = array(
                        array(
                            'taxonomy' => 'categoria_operatore',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_operatore"],
                            'operator' => 'IN'

                        )
                    );
                }

                if($_POST["r012_name_search"]){
                    $title = $_POST["r012_name_search"];

                }

                break;

            case 'r012_ricerca_rivenditori':
                $post_type = 'rivenditori';

                //query per operatore
                if($_POST["r012_categorie_rivenditore"]){
                    $tax_query = array(
                        array(
                            'taxonomy' => 'categoria_rivenditore',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_rivenditore"],
                            'operator' => 'IN'

                        )
                    );
                }

                if($_POST["r012_name_search"]){
                    $title = $_POST["r012_name_search"];

                }

                break;

            case 'r012_ricerca_enti':
                $post_type = 'entieassociazioni';

                //query per operatore
                if($_POST["r012_categorie_ente"]){
                    $tax_query = array(
                        array(
                            'taxonomy' => 'categoria_ente',
                            'field' => 'id',
                            'terms' => $_POST["r012_categorie_ente"],
                            'operator' => 'IN'

                        )
                    );
                }

                if($_POST["r012_name_search"]){
                    $title = $_POST["r012_name_search"];

                }

                break;
        }


        if($_POST["r012_regioni_item"]){
            $regioni = $_POST["r012_regioni_item"];
            $meta_query_regione = array(
                'key' => 'r012_regione_saved',
                'value' => $regioni,
                'compare' => 'IN'
            );

        }

        if($_POST["r012_province_item"]){
            $province = $_POST["r012_province_item"];
            $meta_query_province = array(
                'key' => 'r012_provincia_saved',
                'value' => $province,
                'compare' => 'IN'
            );

        }



        if($meta_query_name){
            $meta_query[] = $meta_query_name;
        }
        if($meta_query_last_name){
            $meta_query[] = $meta_query_last_name;
        }
        if($meta_query_regione){
            $meta_query[] = $meta_query_regione;
        }
        if($meta_query_province){
            $meta_query[] = $meta_query_province;
        }
        if(!empty($meta_query)){
            $meta_query['relation'] =  'AND';
        }
        else $meta_query = "";


        if(empty($tax_query)){
            $tax_query = "";
        }

        $r012_term_args = array(
            'order' => 'DESC',
            'posts_per_page' => 30,
            'post_status' => 'publish',
            'post_type' => $post_type,
            'name' => strtolower($title),
            'paged' => $paged,
            'meta_query' =>$meta_query,
            'tax_query' => $tax_query

        );


        return $r012_term_args;
    }

    //my dump
    public function r012_mydump($dump){
        echo '<pre>';
        var_dump($dump);
        echo '</pre>';
    }



    //group by
    public function r012_group_by_array($array){

        if($array){
            foreach ($array as $data) {
                $id = $data['c'];
                if (isset($results[$id])) {
                    $results[$id][] = $data;
                } else {
                    $results[$id] = array($data);
                }
            }
        }
        return $results;
    }

    //check user logged
    public function r012_check_user($post, $label, $id_form){
        global $user_ID;

        $user_id = email_exists(get_post_meta($post,'r012_email_saved',true));

        /* var_dump($user_id);
         var_dump($user_ID);
         var_dump(current_user_can('administrator'));*/
        if(($user_ID == $user_id) || current_user_can('administrator')){
            ?>

            <a id="<?php echo $id_form;?>" title="<?php echo $label; ?>" href=""><?php echo $label; ?></a>

        <?php }
    }


    public function print_attivita_padre_figlio($terms_attivita_professionista){


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
    }

    //upload images get id attachment
    public function r012_upload_image($file, $file_title,$id_post) {
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
                    $attach_id = wp_insert_attachment( $attachment, $file_name_and_location, $id_post );

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

    //preview immagine e salvataggio
    public function r012_thumb_upload(){
        if ( $_FILES['r012_immagine_modifica_project'] ){
            $file = $_FILES['r012_immagine_modifica_project'];
            $name = $file["name"];
            $r012_postid = (int) $_POST['r012_post'];
            $uploaded_id = $this->r012_upload_image($file, $name, $r012_postid);


            if($uploaded_id){
                set_post_thumbnail($r012_postid , $uploaded_id );
            }
            $image_attributes = wp_get_attachment_image_src( $uploaded_id ,'thumb-single');
            $path = $image_attributes[0];
            #echo '<img class="r012_thumb_uploaded" src='. $image_attributes[0] .'>';

            $html = <<<HTML
<html>
    <head>
        <script>
        </script>
    </head>
    <body>
    <a href="#"><img class="r012_thumb_uploaded" src="$path" /></a>
    </body>
</html>
HTML;
            echo $html;
            die();
        }

        if ( $_FILES['r012_immagine_project'] ){
            $file = $_FILES['r012_immagine_project'];
            $name = $file["name"];
            $uploaded_id = $this->r012_upload_image($file, $name,'');
            $image_attributes = wp_get_attachment_image_src( $uploaded_id , 'thumb-single');
            $path = $image_attributes[0];
            session_start();
            $_SESSION['id_attachment'] = $uploaded_id;
            $_SESSION['user_id'] = $_POST['r012_autore'];
            $html = <<<HTML
<html>
    <head>
        <script>
        </script>
    </head>
    <body>
        <a href="#"><img class="r012_thumb_uploaded" src="$path" /></a>
    </body>
</html>
HTML;
            echo $html;
            die();
        }
        if ( $_FILES['r012_immagine_edit_profilo'] ){
            $file = $_FILES['r012_immagine_edit_profilo'];
            $name = $file["name"];
            $r012_postid = (int) $_POST['r012_post'];
            $uploaded_id = $this->r012_upload_image($file, $name, $r012_postid);


            if($uploaded_id){
                set_post_thumbnail($r012_postid , $uploaded_id );
            }
            $image_attributes = wp_get_attachment_image_src( $uploaded_id ,'thumb-single');
            $path = $image_attributes[0];

            /*  $R012Professionista = new R012Professionista();
              $R012Professionista->r012_load_foto($r012_postid,'');
  */
            $html = <<<HTML
<html>
    <head>
        <script>
        </script>
    </head>
    <body>
        <a href="#"><img class="r012_thumb_uploaded" src="$path" /></a>
    </body>
</html>
HTML;
            echo $html;
            die();
        }


    }

    /* Post URLs to IDs function, supports custom post types - borrowed and modified from url_to_postid() in wp-includes/rewrite.php */
    public function bwp_url_to_postid($url) {
        global $wp_rewrite;

        $url = apply_filters('url_to_postid', $url);

        // First, check to see if there is a 'p=N' or 'page_id=N' to match against
        if ( preg_match('#[?&](p|page_id|attachment_id)=(\d+)#', $url, $values) )   {
            $id = absint($values[2]);
            if ( $id )
                return $id;
        }

        // Check to see if we are using rewrite rules
        $rewrite = $wp_rewrite->wp_rewrite_rules();

        // Not using rewrite rules, and 'p=N' and 'page_id=N' methods failed, so we're out of options
        if ( empty($rewrite) )
            return 0;

        // Get rid of the #anchor
        $url_split = explode('#', $url);
        $url = $url_split[0];

        // Get rid of URL ?query=string
        $url_split = explode('?', $url);
        $url = $url_split[0];

        // Add 'www.' if it is absent and should be there
        if ( false !== strpos(home_url(), '://www.') && false === strpos($url, '://www.') )
            $url = str_replace('://', '://www.', $url);

        // Strip 'www.' if it is present and shouldn't be
        if ( false === strpos(home_url(), '://www.') )
            $url = str_replace('://www.', '://', $url);

        // Strip 'index.php/' if we're not using path info permalinks
        if ( !$wp_rewrite->using_index_permalinks() )
            $url = str_replace('index.php/', '', $url);

        if ( false !== strpos($url, home_url()) ) {
            // Chop off http://domain.com
            $url = str_replace(home_url(), '', $url);
        } else {
            // Chop off /path/to/blog
            $home_path = parse_url(home_url());
            $home_path = isset( $home_path['path'] ) ? $home_path['path'] : '' ;
            $url = str_replace($home_path, '', $url);
        }

        // Trim leading and lagging slashes
        $url = trim($url, '/');

        $request = $url;
        // Look for matches.
        $request_match = $request;
        foreach ( (array)$rewrite as $match => $query) {
            // If the requesting file is the anchor of the match, prepend it
            // to the path info.
            if ( !empty($url) && ($url != $request) && (strpos($match, $url) === 0) )
                $request_match = $url . '/' . $request;

            if ( preg_match("!^$match!", $request_match, $matches) ) {
                // Got a match.
                // Trim the query of everything up to the '?'.
                $query = preg_replace("!^.+\?!", '', $query);

                // Substitute the substring matches into the query.
                $query = addslashes(WP_MatchesMapRegex::apply($query, $matches));

                // Filter out non-public query vars
                global $wp;
                parse_str($query, $query_vars);
                $query = array();
                foreach ( (array) $query_vars as $key => $value ) {
                    if ( in_array($key, $wp->public_query_vars) )
                        $query[$key] = $value;
                }

                // Taken from class-wp.php
                foreach ( $GLOBALS['wp_post_types'] as $post_type => $t )
                    if ( $t->query_var )
                        $post_type_query_vars[$t->query_var] = $post_type;

                foreach ( $wp->public_query_vars as $wpvar ) {
                    if ( isset( $wp->extra_query_vars[$wpvar] ) )
                        $query[$wpvar] = $wp->extra_query_vars[$wpvar];
                    elseif ( isset( $_POST[$wpvar] ) )
                        $query[$wpvar] = $_POST[$wpvar];
                    elseif ( isset( $_GET[$wpvar] ) )
                        $query[$wpvar] = $_GET[$wpvar];
                    elseif ( isset( $query_vars[$wpvar] ) )
                        $query[$wpvar] = $query_vars[$wpvar];

                    if ( !empty( $query[$wpvar] ) ) {
                        if ( ! is_array( $query[$wpvar] ) ) {
                            $query[$wpvar] = (string) $query[$wpvar];
                        } else {
                            foreach ( $query[$wpvar] as $vkey => $v ) {
                                if ( !is_object( $v ) ) {
                                    $query[$wpvar][$vkey] = (string) $v;
                                }
                            }
                        }

                        if ( isset($post_type_query_vars[$wpvar] ) ) {
                            $query['post_type'] = $post_type_query_vars[$wpvar];
                            $query['name'] = $query[$wpvar];
                        }
                    }
                }

                // Do the query
                $query = new WP_Query($query);
                if ( !empty($query->posts) && $query->is_singular )
                    return $query->post->ID;
                else
                    return 0;
            }
        }
        return 0;
    }

}
?>