<?php
/**
 * Template progetto
*/

get_header();?>

	
	    <?php while ( have_posts() ) : the_post();?>
	
	    <?php get_template_part( 'content', 'progetto' ); ?>
	
	    <?php endwhile; // end of the loop. ?>
	
	    <div class="clear"></div>


<?php get_footer(); ?>