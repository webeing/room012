<?php
/*
Template Name: Scheda Professionisti
*/

get_header();?>


<!--<section id="container" class="row">
	<div class="span12">-->
	
	    <?php while ( have_posts() ) : the_post(); ?>
	
	    <?php get_template_part( 'content', 'professionisti' ); ?>
	
	    <?php endwhile; // end of the loop. ?>
	
	    <div class="clear"></div>
	<!--</div>
</section>--><!-- #container -->

<?php get_footer(); ?>