<?php
/*
* Template name: Login
*/


get_header(); ?>

<div class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
<section class="span12">
    <?php
    if(have_posts()) :
        while(have_posts()) : the_post ();
        ?>
        <?php

             $args = array(
                 'echo' => true,
                 'redirect' => site_url('/professionisti/ '),
                 'form_id' => 'loginform',
                 'label_username' => __( 'Indirizzo email di registrazione' ),
                 'label_password' => __( 'Password' ),
                 'label_remember' => __( 'Remember Me' ),
                 'label_log_in' => __( 'Log In' ),
                 'id_username' => 'user_login',
                 'id_password' => 'user_pass',
                 'id_remember' => 'rememberme',
                 'id_submit' => 'wp-submit',
                 'remember' => true,
                 'value_username' => NULL,
                 'value_remember' => false );

            ?>
        <section class="row-fluid">
            <article class="span12" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              
              <header class="span5 thumb-single">
              	<?php if ( has_post_thumbnail()){ 
              	    the_post_thumbnail('single-thumb'); 
              	   }else{ ?>
              	   <img src="<?php bloginfo('template_url') ?>/images/img-default.jpg" alt="<?php the_title(); ?>" />
              	<?php } ?>
              </header>
              <div class="content">  
              <?php the_title('<h2 class="title">', '</h2>'); ?>
              <?php the_content();
                    wp_login_form( $args ); ?>
                  <a href="<?php echo wp_lostpassword_url(); ?>" id="lost-password" title="Lost Password">Password dimenticata?</a>
              </div>


            </article>
            
            <?php //wp_room012_share(); ?>
        </section>
        <?php
    endwhile;
    ?>
    
</section>

<?php endif; ?>
<?php //get_sidebar(); ?>
</div>

<?php get_footer(); ?>
