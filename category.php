<?php
/**
 Wp Room 012
 * Category Page
 */

get_header(); ?>

<section class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
    <section class="span12">
        <h1 class="page-title"><?php printf( __( 'Archivio: %s', 'wpbootstrap' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
        <?php 
         if(have_posts())
        while(have_posts()) : the_post ();
        ?>
        <article class="span4">
	        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	            <?php the_post_thumbnail('thumb-prima-notizia-feature'); ?>
	        </a>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title('<h2>', '</h2>'); ?>
            </a>
            <ul class="post-info">
                <li><i class="icon-time"></i> <code><?php the_date(); ?></code></li>
            </ul>
            <p class="testoblog"><?php the_excerpt(); ?></p>
            <footer class="meta-info">
	            <a href="<?php the_permalink(); ?>#comments" class="btn btn-large">
	                <i class="icon-comment"></i>
	                <?php printf( _n( '%1', get_comments_number(), 'wpbootstrap' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
	            </a>
                <a href="<?php the_permalink(); ?>" class="btn btn-info btn-large"><?php _e('Continue'); ?> &raquo;</a>
            </footer>
        </article>
        <?php endwhile; ?>
    </section>
    <?php //get_sidebar(); ?>
</section>

<?php get_footer(); ?>
