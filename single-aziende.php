<?php
/**
 * Template for single azienda
 */


get_header();?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'azienda' ); ?>

    <?php endwhile; // end of the loop. ?>

    <div class="clear"></div>


<?php get_footer(); ?>


