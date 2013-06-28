<?php
    /*
    * The template for displaying section slider room012
    */
    ?>

<!-- start slider room012 -->
  <section id="slider" class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?> carousel slide">
      
          <?php


        if ( (is_home() || is_front_page() ) ){
            $r012_slider_arg = array(
                'post_type'=> 'r012_slider',
                'posts_per_page' => 5,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            // The Query slider room012
            query_posts( $r012_slider_arg );
            ?>

            <?php /* ?>
            <div id="nav-slider">
                <a id="prev" href="#">prev</a>
                <a id="next" href="#">next</a>
            </div>
            <?php */ ?>
            <div id="slider-gallery" class="span12 carousel-inner">
                <?php while ( have_posts() ) : the_post();?>
                <?php get_template_part( 'content', 'slider' ); ?>
                <?php endwhile;
                wp_reset_query(); ?>
            </div>
             <a class="carousel-control left" href="#slider" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#slider" data-slide="next">&rsaquo;</a>
        <?php } ?>

  </section>