<?php
/**
 Wp Room 012
 * Footer Page
 */
?>

    
    </div><!--.row -->
    
    <div class="facebook-room span12">
    	<a class="btn-fb" title="Segui Room 012 su Facebook" href="https://www.facebook.com/room012">Segui ROOM 012 Su<br/><img src="<?php bloginfo('template_url'); ?>/images/facebook-image.png" alt="segui ROOM 012 su Facebook" /></a>
    </div>
    
</div><!--.container -->

<footer id="footer" class="clear <?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">

	<div class="container footer-sidebar">
		<?php dynamic_sidebar( 'Footer' ); ?>
	</div>

	<div class="container credits">          
        <section class="span4">
                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                </a>
        </section><!-- #site-info -->

        <section class="span7 right">
            <p align="right">
                Webdesign & development by                                         
                <a href="http://webeing.net">Webeing.net</a>                                        
             </p>
        </section><!-- #site-generator -->
      </div>
</footer><!-- #footer -->


<?php wp_footer(); ?>
</body>
</html>
