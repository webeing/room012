<?php /**
 * Template nuovo progetto
 */
// sistema per upload immagini. Al submit ottengo l'id della foto
if($_POST['r012_name_project']){

    //Gestisce l'upload delle immagini
    //var_dump($_POST);
    $result = register_nuovo_progetto();
    $r012_link = get_permalink($result);


    $r012_link = get_permalink($result['id_autore']);
    $post_data = get_post($result['id_post'], ARRAY_A);
    $slug_progetto = $post_data['post_name'];

    wp_redirect($r012_link . '/progetto/'. $slug_progetto);
    exit();
}
get_header();

    get_template_part( 'inc/templates/progetto/content', 'nuovo' );

get_footer(); ?>