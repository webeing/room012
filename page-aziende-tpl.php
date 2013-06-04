<?php
/*
* Template name: Aziende
*/
get_header();


if($_GET['recent']){
    $r012_term_args = array(
        'orderby' => 'id',
        'order' => $_GET['recent'],
        'posts_per_page' => 30,
        'post_type' => 'aziende',
        'paged' => $paged
    );

}

elseif($_GET['alfa']){
    $r012_term_args = array(
        'orderby' => 'title',
        'order' => $_GET['alfa'],

        'posts_per_page' => 30,
        'post_type' => 'aziende',
        'paged' => $paged

    );

}
else{
    $r012_term_args = array(

        'order' => 'DESC',

        'posts_per_page' => 30,
        'post_type' => 'aziende',
        'paged' => $paged

    );
}

$paged = get_query_var('paged') ? get_query_var('paged') : 1;


query_posts($r012_term_args);
?>

<div class="content-aziende">
    <div class="total-found">
        <strong>
            <?php global $wp_query;
            echo $wp_query->found_posts;?>
        </strong>
        <span>Aziende</span>
    </div>

    <nav class="menu-aziende">

        <a href="<?php get_bloginfo('home') ?>/aziende?recent=DESC">Le più recenti</a> |
        <a href="<?php get_bloginfo('home') ?>/aziende?alfa=ASC">In ordine alfabetico</a> |

    </nav>

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







