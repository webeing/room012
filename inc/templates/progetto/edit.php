<?php
/**
 * Template modifica progetto
 */
if($_POST['r012_name_project']){

    //Gestisce l'upload delle immagini
    //var_dump($_POST);
    $result = modifica_progetto();

    $r012_link = get_permalink($result['id_autore']);
    $post_data = get_post($result['id_post'], ARRAY_A);
    $slug_progetto = $post_data['post_name'];

    wp_redirect($r012_link . '/progetto/'. $slug_progetto);
    exit();
    // echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$r012_link.'">';

}
get_header();


while ( have_posts() ) : the_post(); ?>


    <?php get_template_part( 'inc/templates/progetto/content', 'modifica' ); ?>

<?php endwhile; // end of the loop. ?>

    <div class="clear"></div>

<?php get_footer();


?>

