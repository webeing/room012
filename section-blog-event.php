<section id="blog-eventi" class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>"
         xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="span12">
    	<h3 class="section-title"><a href="<?php bloginfo('url'); ?>/category/blog/" title="Le news di ROOM 012">Le news di ROOM 012</a></h3>
        <!--<div class="fasciablog">-->
            <?php

            $r012_blog_args = array(
                'post_type' => 'post',
                'status' => 'publish',
                'category_name' => 'blog',
                'posts_per_page' => 2
            );
            
            query_posts($r012_blog_args);
            
            while ( have_posts() ) : the_post();
			 /*
            $r012_notizie = get_posts( $r012_blog_args );
            $i = 0;
            foreach( $r012_notizie as $r012_notizia ) :

            if($i==0){
                $i = $i + 1; ?>
                */ ?>
            <div class="span6">

                <?php $default_attr = array(

                'alt'	=> get_the_title(),
                'title'	=>  get_the_title()
                );
                echo '<a href="' . get_permalink( $r012_notizia->ID ) . '" title="' . esc_attr( $r012_notizia->ID ) . '">';
                echo get_the_post_thumbnail( $r012_notizia->ID, 'thumb-prima-notizia-feature', $default_attr );
                echo '</a>';?>
                <a href="<?php echo get_permalink($r012_notizia->ID);?>" title="<?php echo get_the_title($r012_notizia->ID);?>"><h2><?php echo get_the_title($r012_notizia->ID);?></h2></a>
                <ul class="post-info">
                    <li><i class="icon-time"></i> <?php the_date(); ?></li>
                </ul>
                <p class="testoblog"><?php echo get_the_excerpt($r012_notizia->ID);?> </p>

            </div>
             <?php

            endwhile;
            
            // Reset Query
            wp_reset_query(); ?>
        <!--</div>--><!--/.fasciablog -->

    </div>
</section><!--/#blog-eventi -->