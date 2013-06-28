<?php
/*
* Template name: Operatori
*/
get_header();
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
            'post_type' => 'operatori',
            'paged' => $paged
        );

    }

    elseif($_GET['alfa']){
        $r012_term_args = array(
            'orderby'=> 'meta_value',
            'meta_key' => 'r012_cognome_saved',
            'order' => $_GET['alfa'],

            'posts_per_page' => 30,
            'post_type' => 'operatori',
            'paged' => $paged

        );

    }
    else{
        $r012_term_args = array(

            'order' => 'DESC',

            'posts_per_page' => 30,
            'post_type' => 'operatori',
            'paged' => $paged

        );
    }

$r012_query_args = $r012_term_args;
}

query_posts($r012_query_args);

R012Utility::r012_advanced_search_form('r012_ricerca_operatori', $_POST);
?>

<div class="filter">
    <div class="total-found">
        <strong><?php global $wp_query;
            echo $wp_query->found_posts;?></strong>
        <span>Operatori specializzati</span>
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

    <?php if($_POST){
        //hai ricercato per?>
        <div class="feedback-ricerca">
            <ul class="alert">
                <li>Hai cercato:</li>
                <?php if($_POST['r012_name_search']){
                    echo '<li>' . $_POST['r012_name_search'] . '</li>';
                } ?>

                <?php if($_POST["r012_categorie_operatore"]){
                    $categorie = $_POST['r012_categorie_operatore'];
                    foreach ($categorie as $categoria){
                        $nome_categoria = get_term_by('id', $categoria, 'categoria_operatore');
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


    <section class="row">
        <?php


        while ( have_posts() ) : the_post();?>
            <?php $r012_nome = get_post_meta($post->ID, "r012_nome_saved", true);
            $r012_cognome = get_post_meta($post->ID, "r012_cognome_saved", true);
            ?>
            <article class="span2">
                <div class="thumb-min">
                    <a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $r012_nome; ?> <?php echo $r012_cognome; ?>">
                        <?php if ( has_post_thumbnail()){
                            the_post_thumbnail('thumbnail');
                        }else{ ?>
                            <img src="<?php bloginfo('template_url') ?>/images/img-default.jpg" alt="<?php $r012_nome . ' ' . $r012_cognome;?>" width="150" height="150" />
                        <?php } ?>
                    </a>
                </div>
                <div class="info-user">
                    <a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $r012_nome; ?> <?php echo $r012_cognome; ?>">
                        <h3 class="professioni"><?php echo $r012_nome; ?> <?php echo $r012_cognome; ?> </h3></a>
            <span>
                <?php $r012_term =  wp_get_post_terms($post->ID, 'categoria_operatore');
                echo $r012_term[0]->name;?> | <?php echo get_post_meta($post->ID,'r012_provincia_saved',true); ?>
            </span>
                </div>
            </article>

        <?php endwhile; ?>
        <nav class="span12 social">
            <div class="label label-info share"><?php _e('Share'); ?></div>
            <br />
            <iframe src="http://www.facebook.com/plugins/like.php?app_id=162659317130181&amp;href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:107px; height:21px;" allowTransparency="true"></iframe>
            <a href="http://twitter.com/share7?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="twitter-share-button" data-count="horizontal" data-via="Mari0Bros" data-lang="it">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
            <g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
        </nav>
    </section>
</div>
<?php
wp_pagenavi();

wp_reset_query();

get_footer(); ?>







