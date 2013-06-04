<?php
/*
* Template name: Professionisti
*/
get_header();


if($_GET['recent']){
    $r012_term_args = array(
        'orderby' => 'id',
        'order' => $_GET['recent'],
        'posts_per_page' => 30,
        'post_type' => 'professionisti',
        'paged' => $paged
    );

}

elseif($_GET['alfa']){
    $r012_term_args = array(
        'orderby'=> 'meta_value',
        'meta_key' => 'r012_cognome_saved',
        'order' => $_GET['alfa'],

        'posts_per_page' => 30,
        'post_type' => 'professionisti',
        'paged' => $paged

    );

}
else{
    $r012_term_args = array(

        'order' => 'DESC',

        'posts_per_page' => 30,
        'post_type' => 'professionisti',
        'paged' => $paged

    );
}

$paged = get_query_var('paged') ? get_query_var('paged') : 1;


query_posts($r012_term_args);
?>

<div class="filter">
    <div class="total-found">
        <strong><?php global $wp_query;
            echo $wp_query->found_posts;?></strong>
		<span>Professionisti</span>
    </div>
	<div class="filter-taxonomies">
		<div class="sorting span4">
			<span data-filter="sort" data-filtervalue="recent" class="active">
				<a href="<?php get_bloginfo('home') ?>/professionisti?recent=DESC">I più recenti</a>
			</span>
			<span>|</span>
			<span data-filter="sort" data-filtervalue="alfabet">
				<a href="<?php echo get_bloginfo('home') ?>/professionisti?alfa=ASC">In ordine alfabetico</a>
			</span>
		</div>
	<?php $terms = get_terms("categorie_professionisti"); ?>
        <ul class="span7">
        <?php foreach ( $terms as $term ) { ?>
            <li>
                <a href="<?php echo get_term_link($term->slug, 'categorie_professionisti' ); ?>"><?php echo $term->name; ?></a>
            </li>
        <?php } ?>
        </ul>
        <div class="clear"></div>
	</div>
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
                <?php $r012_term =  wp_get_post_terms($post->ID, 'categorie_professionisti');
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

