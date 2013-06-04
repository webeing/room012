<?php
/**
 Wp Room 012
 * Header Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php
	global $page, $paged, $wp_query;

	wp_title( '|', true, 'right' );
	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page()))
        if($wp_query->query_vars['action'] == "nuovo" ){
        echo " | Nuovo Progetto";
        } else {
		echo " | $site_description";
        }
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'wpbootstrap' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );

        wp_enqueue_style('bootstrap', get_bloginfo('template_directory') . '/bootstrap/css/bootstrap.css');
        if(get_option('wp_room012_responsive') == 1) wp_enqueue_style('bootstrapresp', get_bloginfo('template_directory') . '/bootstrap/css/bootstrap-responsive.min.css');
        wp_enqueue_script('wp-bootstrap', get_bloginfo('template_directory') . '/bootstrap/js/bootstrap.js', array('jquery'));
        wp_head();
?>

<script type="text/javascript">
jQuery(function(){
    jQuery("#example").popover();
    
    jQuery('#myTab a').click(function (e) {
      e.preventDefault();
      jQuery(this).tab('show');
    });
});
</script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-37888589-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</head>

<body <?php body_class(); ?>>
<?php if(get_option('wp_room012_show_top_bar') == 1): ?>
<script type="text/javascript">
  jQuery(function(){
         jQuery('div.nav-collapse ul').attr('class', 'nav');
        jQuery('div.nav-collapse ul > li > ul').attr('class', 'dropdown-menu');
       // jQuery('div.nav-collapse ul > li > ul').parent().attr('class', 'dropdown');
        jQuery('div.nav-collapse ul > li > ul').parent().attr('class', 'dropd');
        jQuery('li.dropdown > a').attr({'class':'dropdown-toggle', 'data-toggle':'dropdown'});
        /*jQuery('li.dropdown > a').each(function(){
        var content = jQuery(this).html();
        jQuery(this).html(content + '<b class="caret"></b>');
        });
		*/
        jQuery('.dropdown-menu > li > a').click(function(){
        return true;
        });
        
        jQuery('li.dropd > a').each(function(){
        var content = jQuery(this).html();
        jQuery(this).html(content + '<b class="caret"></b>');
        });
  })  
</script>
 <nav class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      <?php
      if(is_user_logged_in()){
          global $current_user;
          ?>

          <div class="btn-group pull-right">

            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo $current_user->display_name; ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="divider"></li>
              <li><a href="<?php echo wp_logout_url( home_url()  ); ?>"><?php _e('Logout'); ?></a></li>
            </ul>
          </div>

          <?php if(current_user_can( 'administrator' ) || current_user_can('editor')){ ?>
              <a id="admin-area" href="<?php echo admin_url();?>" target="_blank">
                  <?php echo 'Amministrazione'; ?>
              </a>
         <?php } ?>
      <?php } ?>
     </div>
  </div>
 </nav>
<div class="container"> 
<div class="square"></div>
 <section id="header" class="row">
 	<div class="span12">
 		<div id="brand" class="span3">
	 		<h1>
	 			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
		 			<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Room012 logo" />
	 			</a>
	 		</h1>
 		</div><!--/#brand-->
	 	<div class="nav-collapse span8">
            <form class="navbar-search right" id="searchform" method="get" action="<?php bloginfo('siteurl'); ?>">
             <input type="text" name="s" id="s" class="search-query" placeholder="<?php _e('Search'); ?>" />
            </form>
            <a id="fb-link" class="left" href="https://www.facebook.com/room012" title="" target="_blank">
             <img src="<?php bloginfo('template_url'); ?>/images/facebook-menu-top.png" alt="Segui ROOM 012 su facebook" />
            </a>
            <br class="clear"/>

	 	<?php wp_nav_menu(); ?>


	 	<br class="clear"/>
	 	<?php if (is_home()||is_front_page()){
            if($wp_query->query_vars['action'] == "nuovo" ){

            } else {?>
		 	<div id="claim-header" class="clear">
		 		<h3><?php bloginfo('description'); ?></h3>
		 	</div>
	 	<?php }
        } ?>
	 	</div><!--/.nav-collapse-->

 	</div>
 </section> <!--/#header -->
 
 <?php else: ?>
<style type="text/css">
    body {
        padding-top:20px !important;
    }
</style>
<?php endif; ?>
    
<div class="content <?php echo (get_option('wp_room012_fluid') == 0) ? 'container' : 'container-fluid'; ?>">
    
 <?php if(get_option('wp_room012_show_top_bar') == 0): ?>
  <div class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
      <script type="text/javascript">
        jQuery(function(){
                jQuery('div.nav-collapse > div').attr('class', 'subnav');
                
                jQuery('div.subnav > ul').attr('class', 'nav nav-pills');
                
                jQuery('div.subnav ul li ul').each(function(){
                    if(jQuery(this).length > 0)
                    {

                        jQuery('div.subnav ul > li').attr('class', 'dropdown');
                        jQuery('div.subnav ul > li > a').attr({
                            'class': 'drop-down-toggle',
                            'data-toggle': 'dropdown'
                        });
                        
                        jQuery('.dropdown-menu > li > a').removeAttr('data-toggle');

                        jQuery('ul.submenu > li').attr('class', 'dropdown');
                        jQuery('ul.sub-menu').attr('class', 'dropdown-menu');
                        jQuery(this).attr('class', 'dropdown-menu');
                    }
              });
        })  
      </script>

    <div class="span3">
      <h2><a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
    </div>
    <div class="span9 nav-menu">
        <div class="nav-collapse">
            <?php wp_nav_menu(); ?>
        </div>
    </div>
  </div>
    <?php endif; ?>
    <?php
    if (!(is_home() || is_front_page()|| is_singular('progetto'))){?>
    <div class="breadcrumbs">
         <?php

             if(function_exists('bcn_display'))
                    {
                        bcn_display();
                    }
         ?>
    </div>
                <?php
    } ?>
    <?php /* ?>
    <div class="<?php echo (get_option('wp_room012_fluid') == 0) ? 'row' : 'row-fluid'; ?>">
        <div class="span12 img_header">
             <?php
                // Check if this is a post or page, if it has a thumbnail, and if it's a big one
                if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
                                has_post_thumbnail( $post->ID ) &&
                                ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
                                $image[1] >= HEADER_IMAGE_WIDTH ) :
                        // Houston, we have a new header image!
                        echo get_the_post_thumbnail( $post->ID );
                elseif ( get_header_image() ) : ?>
                        <img src="<?php header_image(); ?>" alt="" />
                <?php endif; ?>
        </div>
    </div>
    <?php */ ?>
