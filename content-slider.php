<?php
/**
 * The template for displaying content in the section-slider.php template room012
 **/
?>

<div class="item">
   <?php the_post_thumbnail( 'slider-feature', $default_attr );?>

	<div class="carousel-caption">
    <?php $r012_spunta = get_post_meta(get_the_ID(), "r012_slider_check", true); ?>

        <?php the_content(); ?>
        <!-- <br class="clear"/>
       <a class="btn" href="<?php echo get_post_meta(get_the_ID(), "r012_slider_link", true);?>"><?php echo get_post_meta(get_the_ID(), "r012_slider_label_link", true);?></a>-->

    </div>
</div>