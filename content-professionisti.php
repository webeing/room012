<?php
/**
 * content della scheda professionisti
 */
get_header();

?>

<?php if ( get_post_meta($post->ID,'r012_approvato_saved',true) == 1 ) { ?>
				
	<?php
	    $default_attr = array(
	        'alt' => get_the_title(),
	        'title' => get_the_title()
	    ); ?>
	    <div class="bio">
	    	<div class="thumb-sk">
	    		<?php if ( has_post_thumbnail($post->ID)) {
	    		 
	    		 echo get_the_post_thumbnail( $post->ID, 'sk-thumb', $default_attr );
	    		 }else{?>
	    		 <img src="<?php bloginfo('template_url'); ?>/images/img-default.jpg" title="<?php the_title(); ?>" width="300" height="300" />
	    		<?php } ?>
	    	</div>
	    </div>
	    
	    <div class="testobio">		    
            <h3 class="nome">
                <?php if( get_post_meta($post->ID,'r012_studio_saved',true) == 1 ) {
                    echo get_post_meta($post->ID,'r012_nome_studio_saved',true);
                 	} else {
                    echo get_post_meta($post->ID,'r012_nome_saved',true);?> <?php echo get_post_meta($post->ID,'r012_cognome_saved',true);
                } ?>
            </h3>
            <p class="professione">
                <strong><?php $terms = get_the_terms($post->ID, 'categorie_professionisti');
                foreach ( $terms as $term ) {
                   echo $term->name;
                } ?>
            </strong></p>       

               
          <ul id="anagraficabase">
                <li class="big">
                	<?php if(get_post_meta( $post->ID, 'r012_ordine_saved', true)) { ?>
                	<span class="big ordine"><?php echo get_post_meta( $post->ID, 'r012_ordine_saved', true);?></span> | <span class="ordine-num"><?php echo get_post_meta( $post->ID, 'r012_numero_saved', true);?></span>
                	<?php } ?>
                </li>

                <li>
                    <?php if(get_post_meta( $post->ID, 'r012_nome_studio_saved', true)) { ?>
                    studio <strong><?php echo get_post_meta( $post->ID, 'r012_nome_studio_saved', true);?> </strong>
                	<?php } ?>
                    
               </li>
                <li>
                    <?php if(get_post_meta( $post->ID, 'r012_piva_saved', true)) { ?>
                    p iva <strong><?php echo get_post_meta( $post->ID, 'r012_piva_saved', true);?></strong>
                	<?php } ?>
                    
                </li>
                <li>
                    <?php if(get_post_meta( $post->ID, 'r012_posizione_saved', true)) { ?>
                     posizione <strong><?php echo get_post_meta( $post->ID, 'r012_posizione_saved', true);?></strong>
                 	<?php } ?>
                     
                </li>
                <li>
                	<?php if(get_post_meta( $post->ID, 'r012_citta_saved', true)) { ?>
                	 città <strong><?php echo get_post_meta( $post->ID, 'r012_citta_saved', true); ?></strong>
                	<?php } ?>
                </li>
                <li>
                     <?php if(get_post_meta( $post->ID, 'r012_sito_saved', true)) { ?>
                      sito <strong><?php echo get_post_meta($post->ID,'r012_sito_saved',true); ?></strong>
                  	<?php } ?>
                      
                </li>

                <br/>
       <?php if ( $user_ID ) { ?>
                <li>
                	<span class="big">contatti: </span>
                	<?php if(get_post_meta($post->ID,'r012_email_saved',true)) { ?>
                	 email <strong><?php echo get_post_meta($post->ID,'r012_email_saved',true); ?>
                	</strong>
                	<?php } ?>
                	                	
                	<?php if(get_post_meta( $post->ID, 'r012_mobile_saved', true)) { ?>
                	 mobile <strong><?php echo get_post_meta( $post->ID, 'r012_mobile_saved', true); ?></strong>
                 	<?php } ?>
                	
                	<?php if(get_post_meta( $post->ID, 'r012_telefono_saved', true)) { ?>
                	 telefono <strong><?php echo get_post_meta($post->ID,'r012_telefono_saved',true); ?></strong>
                 	<?php } ?>
                	
                	<?php if(get_post_meta( $post->ID, 'r012_fax_saved', true)) { ?>
                	 fax <strong><?php echo get_post_meta($post->ID,'r012_fax_saved',true); ?></strong>
                 	<?php } ?>
                	
                	<?php if(get_post_meta( $post->ID, 'r012_skype_saved', true)) { ?>
                	 skype <strong><?php echo get_post_meta( $post->ID, 'r012_skype_saved', true); ?></strong>
                 	<?php } ?>
             	 
                </li>
                	
                <li>
                	<span class="big">indirizzo: </span>
                	<?php if(get_post_meta( $post->ID, 'r012_citta_saved', true)) { ?>
                	 città <strong><?php echo get_post_meta( $post->ID, 'r012_citta_saved', true); ?></strong>
                	<?php } ?>
                	
                	<?php if(get_post_meta( $post->ID, 'r012_via_saved', true)) { ?>
                	 via <strong><?php echo get_post_meta( $post->ID, 'r012_via_saved', true); ?></strong>
                	<?php } ?>
                	
                	<?php if( get_post_meta($post->ID,'r012_cap_saved',true)) { ?>
                	 cap <strong><?php echo get_post_meta($post->ID,'r012_cap_saved',true); ?></strong>
                 	<?php } ?>
                	
                	<?php if( get_post_meta($post->ID,'r012_provincia_saved',true)) { ?>
                	 provincia <strong><?php echo get_post_meta($post->ID,'r012_provincia_saved',true); ?></strong>
                	<?php } ?>
                	
                </li>
                
	            <li>
                	<span class="big">social: </span>
                	<?php if(get_post_meta( $post->ID, 'r012_linkedin_saved', true)) { ?>
                	 linkedin <strong><?php echo get_post_meta( $post->ID, 'r012_linkedin_saved', true); ?></strong>
                 	<?php } ?>
                	
                	<?php if(get_post_meta( $post->ID, 'r012_facebook_saved', true)) { ?>
                	 facebook <strong><?php echo get_post_meta( $post->ID, 'r012_facebook_saved', true); ?></strong>
                 	<?php } ?>
                	 
	            	 <?php if(get_post_meta( $post->ID, 'r012_twitter_saved', true)) { ?>
	            	  twitter <strong><?php echo get_post_meta( $post->ID, 'r012_twitter_saved', true); ?></strong>
                  	<?php } ?>
                
                </li>      
                <?php } else { // end $user_ID ?>
                	<li class="no-user alert">
                		<span class="big">
                		Per visualizzare le informazioni complete del professionista <br/>effettua la
                		<a id="register-user" href="<?php bloginfo('url'); ?>/registrazione" title="Registrazione a Room 012">Registrazione</a>
                		</span>
                	</li>
                <?php } // end $user_ID ?>           
           </ul>


    <br class="clear"/>
    
    <section class="bio">
	    <h4 class="title-profile">note biografiche</h4> 
	    <div class="content"><?php the_content(); ?></div>
    </section>
    
	<div class="clear"></div>
</div><!--/.testobio-->
<?php } // end r012_approvato ?>

<?php get_footer(); ?>