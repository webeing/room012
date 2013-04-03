<?php
/**
 Wp Room 012
 * Page
 */

get_header(); ?>

<div class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
<section class="span12">
    <?php
    if(have_posts()) :
        while(have_posts()) : the_post ();
        ?>
        <?php /* ?>
        <nav class="row-fluid">
                <div class="span5"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link' ) . '</span> %title' ); ?></div>
                <div class="span5 right"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link' ) . '</span>' ); ?></div>
        </nav>
    	<?php */ ?>
        <section class="row-fluid">
            <article class="span12" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              
              <header class="span5 thumb-single">
              	<?php if ( has_post_thumbnail()){ 
              	    the_post_thumbnail('single-thumb'); 
              	   }else{ ?>
              	   <img src="<?php bloginfo('template_url') ?>/images/img-default.jpg" alt="<?php the_title(); ?>" />
              	<?php } ?>
              </header>
              <div class="content">  
              <?php the_title('<h2 class="title">', '</h2>'); ?>
              <?php the_content(); ?>
              </div>
            </article>
            
            <?php wp_room012_share(); ?>
        </section>
        <?php
    endwhile;
    ?>
    
</section>

<?php endif; ?>
<?php //get_sidebar(); ?>
</div>

<?php get_footer(); ?>
