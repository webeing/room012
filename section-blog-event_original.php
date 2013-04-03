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

            $r012_notizie = get_posts( $r012_blog_args );
            $i = 0;
            foreach( $r012_notizie as $r012_notizia ) :

            if($i==0){
                $i = $i + 1; ?>
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
                    <li><i class="icon-time"></i> <code><?php the_date(); ?></code></li>
                </ul>
                <p class="testoblog"><?php echo get_the_excerpt($r012_notizia->ID);?> </p>

            </div>
             <?php

            } else { ?>
            <!-- Seconda notizia BLOG -->
            <div class="span3">-->

                <?php $default_attr = array(

                'alt'	=> get_the_title(),
                'title'	=> get_the_title()
            );
                echo '<a href="' . get_permalink( $r012_notizia->ID ) . '" title="' . esc_attr( $r012_notizia->ID ) . '">';
                echo get_the_post_thumbnail( $r012_notizia->ID, 'thumb-prima-notizia-feature', $default_attr );
                echo '</a>';?>
                <a href="<?php echo get_permalink($r012_notizia->ID);?>" title="<?php echo get_the_title($r012_notizia->ID);?>"><h2><?php echo get_the_title($r012_notizia->ID);?></h2></a>
                <ul class="post-info">
                    <li><i class="icon-time"></i> <code><?php the_date(); ?></code></li>
                </ul>
                
                <p class="testoblog"><?php echo get_the_excerpt($r012_notizia->ID);?> </p>

            </div>
            <?php }
            endforeach; ?>
        </div><!--/.fasciablog -->




        <!-- start eventi -->
        <div class="fasciaeventi span3">
            <h3 class="section-title">Eventi</h3>

            <?php
            $r012_event_args = array(
           'numberposts' => 5,
           'orderby' => 'eventend',
           'order' => 'ASC',
           'event_end_after' => 'now',
           'post_status' => 'publish'
            );
            $events = eo_get_events($r012_event_args);?>



            <ul class="list">
                <?php foreach ($events as $event): ?>

                   <li itemscope="evento" class="evento span12">
                    <div class="dataevento span3">
                    	<span class="date-day"><?php echo eo_get_the_start('j',$event->ID); ?></span>
                    	<span class="date-month"><?php echo eo_get_the_start('M',$event->ID); ?></span>
                    	<span class="date-year"><?php echo eo_get_the_start('Y',$event->ID); ?></span>
                    	
                    	<?php //echo eo_get_the_start('j M Y',$event->ID); ?>
                    </div>
                    <div class="bloccoevento span9">
                        <a href="<?php echo get_permalink($event->ID);?>"<h6 class="titoloevento"><?php echo get_the_title($event->ID);?></h6></a>
                            <p class="testoevento"><?php echo get_the_content($event->ID);?></p></a>
                    </div>
                   </li>
               <?php endforeach; ?>

            </ul>




        </div>

    </div>
</section><!--/#blog-eventi -->