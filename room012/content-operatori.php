<?php
/**
 * content della scheda operatori
 */
get_header(); ?>
    <div class="bio span4 editable">
        <div class="thumb-sk">

                <div class="change clearfix">
                   <?php if ( has_post_thumbnail($post->ID)) {

                        echo get_the_post_thumbnail( $post->ID, 'thumb-single', $default_attr );


                    }else{
                        ?>
                        <img src="<?php bloginfo('template_url'); ?>/images/img-default.jpg" title="<?php get_the_title($post->ID); ?>" width="300" height="300" />
                    <?php } ?>

                </div>
        </div>
    </div>

    <div class="testobio span7 editable">
        <h3 class="nome">
            <?php echo get_post_meta($post->ID,'r012_nome_saved',true);?> <?php echo get_post_meta($post->ID,'r012_cognome_saved',true); ?>
        </h3>
        <p class="professione">
            <strong><?php $terms = get_the_terms($post->ID, 'categoria_operatore');
                foreach ( $terms as $term ) {
                    echo $term->name;
                } ?>
            </strong></p>


        <ul id="anagraficabase">

            <li>
                <?php if(get_post_meta( $post->ID, 'r012_piva_saved', true)) { ?>
                    p iva <strong><?php echo get_post_meta( $post->ID, 'r012_piva_saved', true);?></strong>
                <?php } ?>

            </li>

            <li>
                <?php if(get_post_meta( $post->ID, 'r012_citta_saved', true)) { ?>
                    città <strong><?php echo get_post_meta( $post->ID, 'r012_citta_saved', true); ?></strong>
                <?php } ?>
            </li>
            <li>
                <?php if(get_post_meta( $post->ID, 'r012_sito_saved', true)) { ?>
                    sito <a href="http://<?php echo get_post_meta($post->ID,'r012_sito_saved',true); ?>" target="_blank"><strong><?php echo get_post_meta($post->ID,'r012_sito_saved',true); ?></strong></a>
                <?php } ?>

            </li>

            <br/>

                <li>
            <?php if(get_post_meta( $post->ID, 'r012_email_saved', true)||get_post_meta( $post->ID, 'r012_mobile_saved', true)||get_post_meta( $post->ID, 'r012_fax_saved', true)|| get_post_meta($post->ID,'r012_skype_saved',true)||(get_post_meta( $post->ID, 'r012_telefono_saved', true))) { ?>

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
                    <?php }
            }?>

                </li>

                <li>
                    <?php if(get_post_meta( $post->ID, 'r012_citta_saved', true)||get_post_meta( $post->ID, 'r012_via_saved', true)||get_post_meta( $post->ID, 'r012_cap_saved', true)|| get_post_meta($post->ID,'r012_provincia_saved',true)) { ?>

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
                    <?php
                        }
                    } ?>

                </li>

                <li>
                    <?php if(get_post_meta( $post->ID, 'r012_linkedin_saved', true)||get_post_meta( $post->ID, 'r012_facebook_saved', true)||get_post_meta( $post->ID, 'r012_twitter_saved', true)) { ?>
                    <span class="big">social: </span>
                    <?php if(get_post_meta( $post->ID, 'r012_linkedin_saved', true)) { ?>
                        linkedin <strong><?php echo get_post_meta( $post->ID, 'r012_linkedin_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $post->ID, 'r012_facebook_saved', true)) { ?>
                        facebook <strong><?php echo get_post_meta( $post->ID, 'r012_facebook_saved', true); ?></strong>
                    <?php } ?>

                    <?php if(get_post_meta( $post->ID, 'r012_twitter_saved', true)) { ?>
                        twitter <strong><?php echo get_post_meta( $post->ID, 'r012_twitter_saved', true); ?></strong>
                    <?php }
                    }?>

                </li>

        </ul>
    </div>
    <br class="clear"/>
    <?php if(get_the_content()){?>
    <section class="bio row-fluid editable">
        <h4 class="title-profile">note biografiche</h4>
        <div class="content limited-height">
            <?php echo get_the_content($post->ID); ?>
        </div>
        <a class="no-limited-height clearfix" href="" title="Leggi tutto">scopri tutto ↓↓</a>
        <a class="yes-limited-height clearfix hidden" href="" title="Leggi tutto">nascondi ↑↑</a>
    </section>
    <?php } ?>
    <?php if(get_post_meta( $post_id, 'r012_galleria_saved', true)){ ?>
    <section class="project">
        <h4 class="title-profile"><?php echo __('Gallery (clicca per ingrandire)','r012'); ?></h4>


        <div class="row-fluid">
        <div id="slider-gallery" class="row-fluid carousel-inner">

            <?php R012Gallery::r012_gallery( $post->ID );?>
        </div>

    </section>
    <?php } ?>
<?php get_footer(); ?>