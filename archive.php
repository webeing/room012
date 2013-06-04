<?php
/**
 Wp Room 012
 * Archive page
 */

get_header();
?>

<!--<section class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
    <section class="span12">-->
    <section>
        <h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'r012' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'r012' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'r012' ) ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'r012' ), get_the_date( _x( 'Y', 'yearly archives date format', 'r012' ) ) ); ?>
<?php else : ?>
				<?php $r012_term =  wp_get_post_terms($post->ID, 'categorie_professionisti');
                echo $r012_term[0]->slug; ?>
<?php endif; ?>
			</h1>
			 <section class="row">
        <?php 

        if(have_posts())
        while(have_posts()) : the_post ();
        ?>

        <article class="span2">
                <div class="thumb-min">

                    <a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $r012_nome; ?> <?php echo $r012_cognome; ?>">
                    <?php if ( has_post_thumbnail()){ 
        	            the_post_thumbnail('thumbnail'); 
        	           }else{ ?>
                    	<img src="<?php bloginfo('template_url') ?>/images/img-default.jpg" alt="<?php $r012_nome = get_post_meta($post->ID, "r012_nome_saved", true);
                    	$r012_cognome = get_post_meta($post->ID, "r012_cognome_saved", true);?>" width="150" height="150" />
                     <?php } ?>
                      </a>
                    </div>
                <div class="info-user">
                    <?php $r012_nome = get_post_meta($post->ID, "r012_nome_saved", true);
                    $r012_cognome = get_post_meta($post->ID, "r012_cognome_saved", true);?>
                    <a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $r012_nome; ?> <?php echo $r012_cognome; ?>">
                        <h3 class="professioni"><?php echo $r012_nome; ?> <?php echo $r012_cognome; ?> </h3></a>
                    <span>
                        <?php $r012_term =  wp_get_post_terms($post->ID, 'categorie_professionisti');
                         echo $r012_term[0]->name;?> | <?php echo get_post_meta($post->ID,'r012_provincia_saved',true); ?>
                    </span>
                </div>
            </article>
        
        <?php endwhile;
         wp_pagenavi(  );
        
        wp_reset_query(); ?>
        </section>
        </section>
    <?php //get_sidebar(); ?>
<!--</section>-->

<?php get_footer(); ?>