<?php
/**
 * Template for single enti e associazioni
 */


get_header();?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'enti' ); ?>

    <?php endwhile; // end of the loop. ?>

    <div class="clear"></div>


<?php get_footer(); ?>


