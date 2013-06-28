<?php
	/**
	 * Testo sottostante lo slider
	 */
	dynamic_sidebar( 'Bottom Slide' );
?>

<section id="last-user" class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
	<h3 class="section-title"><a href="<?php echo get_permalink(R012_ID_PAGE_PROFESSIONISTI) ?>" title="<?php the_title(R012_ID_PAGE_PROFESSIONISTI); ?>">Guest book: i nostri Ospiti</a></h3>
        <!--<div id="users">-->
            <?php
            /**
             * loop per gli ultimi professionisti inseriti
             */

                $r012_args = array(
                    'order' => 'DESC',
                    'order_by'=> 'rand',
                    'posts_per_page' => '3',
                    'post_type' => 'professionisti'

                );

                 $r012_professionisti = get_posts( $r012_args );

            ?>

                <?php foreach( $r012_professionisti as $r012_professionista ) :
                    if(get_post_meta($r012_professionista->ID, "r012_approvato_saved", true)==1){?>
                        <figure class="span3 users">
                        <?php
                        $r012_nome = get_post_meta($r012_professionista->ID, "r012_nome_saved", true);
                        $r012_cognome = get_post_meta($r012_professionista->ID, "r012_cognome_saved", true);
                        $r012_img = $r012_nome . ' ' . $r012_cognome;

                        $default_attr = array(

                        'alt'	=> $r012_img,
                        'title'	=>  $r012_img
                        
                        );

                        echo '<a href="' . get_permalink( $r012_professionista->ID ) . '" title="' . esc_attr( $r012_professionista->ID ) . '" rel="popover">';
                        if ( has_post_thumbnail($r012_professionista->ID)) {
                        
                        echo get_the_post_thumbnail( $r012_professionista->ID, 'thumb-home-feature', $default_attr );
                        }else{?>
                        <img src="<?php bloginfo('template_url'); ?>/images/img-default.jpg" title="<?php the_title(); ?>" width="210" height="210" />
                       <?php }
                        echo '</a>';
                        ?>

                        <div class="info-user">
                            <a href="<?php echo get_permalink($r012_professionista->ID);?>" title="<?php echo $r012_nome; ?> <?php echo $r012_cognome; ?>"><h3 class="professioni"><?php echo $r012_nome; ?> <?php echo $r012_cognome; ?> </h3></a>
                            <span><?php $r012_term =  wp_get_post_terms($r012_professionista->ID, 'categorie_professionisti');
                                echo $r012_term[0]->name;?> | <?php echo get_post_meta($r012_professionista->ID,'r012_provincia_saved',true); ?></span>

                        </div>
                        </figure>

                <?php } endforeach;?>

        <!--</div>--><!--/#users -->

        <div id="claim-nl" class="span3 news">
            <?php
            /**
             * Claim unisciti e Plugin mailchimp
             */
            dynamic_sidebar( 'Home Middle' );  ?>
        </div><!--/#claim-nl -->
        <div class="clear"></div>
</section><!--/#utenti -->