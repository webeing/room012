<?php
/**
 * content single azienda
 */
?>

    <div class="bio span4">
        <div class="thumb-sk">
            <?php $default_attr = array(
                'alt'	=> get_the_title(),
                'title'	=> get_the_title(),
            );
            the_post_thumbnail('thumb-single',$default_attr );
            ?>
        </div>
    </div>

    <div class="testobio span7">
            <h3 class="nome"><?php the_title(); ?></h3>
            <ul id="anagraficabase">
                <?php  $terms = get_the_terms($post->ID, 'categoria_ente');
                if($terms){
                ?>
                <li>

                    settore <strong>
                        <?php
                        foreach ( $terms as $term ) {
                            echo $term->name;
                        }

                    ?>
                    </strong>
                </li>
                <?php }?>

                <?php if(get_post_meta( $post->ID, 'r012_piva_saved', true)) { ?>
                <li>
                        p. iva <strong><?php echo get_post_meta( $post->ID, 'r012_piva_saved', true);?></strong>

                </li>
                <?php } ?>

                <?php if(get_post_meta( $post->ID, 'r012_sito_saved', true)) { ?>
                <li>
                        sito <strong><a href="http://<?php echo get_post_meta($post->ID,'r012_sito_saved',true); ?>"><?php echo get_post_meta($post->ID,'r012_sito_saved',true); ?></a></strong>

                </li>
                <?php } ?>

                <br/>
                <?php if(get_post_meta( $post->ID, 'r012_sito_saved', true) || get_post_meta( $post->ID, 'r012_mobile_saved', true) || get_post_meta( $post->ID, 'r012_telefono_saved', true) || get_post_meta( $post->ID, 'r012_fax_saved', true)|| get_post_meta( $post->ID, 'r012_skype_saved', true)){ ?>
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
                        <?php }?>
                </li>
                <?php } ?>

                <?php if (get_post_meta( $post->ID, 'r012_citta_saved', true) || get_post_meta( $post->ID, 'r012_via_saved', true) || get_post_meta($post->ID,'r012_cap_saved',true) ||  get_post_meta($post->ID,'r012_provincia_saved',true)) { ?>
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
                <?php } ?>

                <?php if(get_post_meta( $post->ID, 'r012_linkedin_saved', true) || get_post_meta( $post->ID, 'r012_facebook_saved', true) || get_post_meta( $post->ID, 'r012_twitter_saved', true)) {?>
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
                <?php } ?>

            </ul>
    </div>
            <br class="clear"/>
        <?php if(get_post_meta( $post_id, 'r012_galleria_saved', true)){ ?>
        <section class="gallery row-fluid">
            <div class="span12">
                <h4 class="title-profile">Gallery</h4>

                    <?php R012Gallery::r012_gallery( $post->ID );?>
            </div>
        </section>
        <?php } ?>
        <?php if(get_the_content()){?>
            <section class="bio row-fluid">
              <div class="span12">
                    <h4 class="title-profile">su di noi</h4>
                    <div class="content limited-height"><?php the_content();?></div>
                  <a class="no-limited-height clearfix" href="" title="Leggi tutto">scopri tutto ↓↓</a>
                  <a class="yes-limited-height clearfix hidden" href="" title="Leggi tutto">nascondi ↑↑</a>
              </div>
            </section>
        <?php } ?>

            <div class="clear"></div>





<div class="clear"></div>



