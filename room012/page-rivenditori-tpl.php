<?php
/*
* Template name: Rivenditori
*/
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$r012_query_args = "";
$default_values = array();


if($_POST){

    $r012_query_args = R012Utility::r012_advanced_search( $_POST, $paged );

} else {

    if($_GET['recent']){
        $r012_term_args = array(
            'orderby' => 'id',
            'order' => $_GET['recent'],
            'posts_per_page' => 30,
            'post_type' => 'rivenditori',
            'paged' => $paged
        );

    }

    elseif($_GET['alfa']){
        $r012_term_args = array(
            'orderby' => 'title',
            'order' => $_GET['alfa'],

            'posts_per_page' => 30,
            'post_type' => 'rivenditori',
            'paged' => $paged

        );

    }
    else{
        $r012_term_args = array(

            'order' => 'DESC',

            'posts_per_page' => 30,
            'post_type' => 'rivenditori',
            'paged' => $paged

        );
    }

    $r012_query_args = $r012_term_args;
}

query_posts($r012_query_args);


R012Utility::r012_advanced_search_form('r012_ricerca_rivenditori', $_POST);

?>

<div class="content-aziende">
    <div class="total-found">
        <strong>
            <?php global $wp_query;
            echo $wp_query->found_posts;?>
        </strong>
        <span>Rivenditori</span>
    </div>

    <div class="filter-taxonomies">
        <?php if(empty($_POST)){ ?>
        <div class="sorting span4">
                <span data-filter="sort" data-filtervalue="recent" class="active">
                    <a href="<?php get_bloginfo('home') ?>/professionisti?recent=DESC">I più recenti</a>
                </span>
            <span>|</span>
                <span data-filter="sort" data-filtervalue="alfabet">
                    <a href="<?php echo get_bloginfo('home') ?>/professionisti?alfa=ASC">In ordine alfabetico</a>
                </span>
        </div>
        <?php } ?>
        <a class="ricerca-btn" title="Ricerca avanzata" href="#">
            Ricerca avanzata
            <span class="sprite-search"></span>
        </a>

        <div class="clear"></div>
    </div>

    <?php if($_POST){ ?>
    <div class="feedback-ricerca">
            <ul class="alert">
               <li>Hai cercato:</li>
            <?php if($_POST['r012_name_search']){
                        echo '<li>' . $_POST['r012_name_search'] . '</li>';
            } ?>

            <?php if($_POST["r012_categorie_rivenditore"]){
                    $categorie = $_POST['r012_categorie_rivenditore'];
                    foreach ($categorie as $categoria){
                        $nome_categoria = get_term_by('id', $categoria, 'categoria_rivenditore');
                        echo '<li>' . $nome_categoria->name . '</li>';
                    }
            } ?>

            <?php if($_POST["r012_regioni_item"]){
                    $regioni_post = $_POST['r012_regioni_item'];
                    global $regioni;
                    foreach ($regioni_post as $regione_post){
                        foreach ($regioni as $key => $value) {

                                if($value == $regione_post){
                                    echo '<li>' . $key . '</li>';
                                }
                        }
                    }
            } ?>
            <?php if($_POST["r012_province_item"]){
                    $province_post = $_POST['r012_province_item'];
                    global $province;
                    foreach ($province_post as $provincia_post){
                        foreach ($province as $key => $value) {

                            if($value == $provincia_post){
                                echo '<li>' . $key . '</li>';
                            }
                        }
                    }
            } ?>
            <div class="clear"></div>
            </ul>
    </div>
    <?php } ?>
    <!--<section class="row-fluid">
        <aside class="span4 advanced-search">
            <header>
                <span class="sprite-search"></span>
                <a href="" class="open-panel">Ricerca Avanzata</a>
            </header>
        </aside>
    </section>-->


        <?php $count = 0;
        while ( have_posts() ) : the_post();
        if (($count % 3 == 0)):
        /**
        * Ogni 3 chiudo apro la riga
        **/

        if($count == 0){
            ?>
            <section class="row-fluid archive-companies">
                <?php } else {?>
            </section>
            <section class="row-fluid archive-companies">
            <?php } ?>

        <?php endif;?>

        <article class="span4">
            <figure>
                <header class="logo-azienda">
                    <?php if ( has_post_thumbnail()){
                        $attr = array(
                            'alt'	=> get_the_title(),
                            'title'	=> get_the_title(),
                        );
                    the_post_thumbnail( 'thumb-single',$attr);

                    }
                    ?>
                </header>

                <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                   <?php

                    $r012_value_galleria_prodotti = get_post_meta( $post->ID, 'r012_galleria_saved', true);
                    if ($r012_value_galleria_prodotti){
                    preg_match('/\[gallery.*ids=.(.*).\]/', $r012_value_galleria_prodotti, $ids);
                    $array_id = explode(",", $ids[1]);

                    echo wp_get_attachment_image($array_id[0], 'aziende-thumb');
                    }else {?>

                        <img src="<?php bloginfo('template_url') ?>/images/img-default.jpg" alt="<?php echo get_the_title();?>" width="285" height="285" />

                    <?php }?>
                </a>
            </figure>

            <div class="info-azienda">
                <a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>">
                    <p class="name-azienda"><?php the_title(); ?></p>
                </a>

                <?php if(get_post_meta( $post->ID, 'r012_citta_saved', true)) {?>
                    <p class="luogo-azienda">

                    <?php echo get_post_meta( $post->ID, 'r012_citta_saved', true) . ' ' . get_post_meta( $post->ID, 'r012_provincia_saved', true) ;?>

                    </p>
                <?php } ?>

                <?php if(get_post_meta( $post->ID, 'r012_sito_saved', true)) {?>
                    Sito web:
                <a title="Scopri il sito <?php echo get_the_title(); ?>" href="http://<?php echo get_post_meta( $post->ID, 'r012_sito_saved', true); ?>" target="_blank">
                   <?php echo get_post_meta( $post->ID, 'r012_sito_saved', true);?>
                </a>
                <?php } ?>

            </div>
        </article>
        <?php $count++;?>
        <?php endwhile; ?>


</div>
<?php
wp_pagenavi();
wp_reset_query();
get_footer();
?>







