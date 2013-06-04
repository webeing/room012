<?php
/**
 * content della scheda professionisti
 */
get_header();
global $user_ID;
?>

<?php if ( get_post_meta($post->ID,'r012_approvato_saved',true) == 1 ) { ?>
    <?php //blocco del modifica foto ?>
    <div class="bio span4 editable">

        <?php R012Professionista::r012_load_foto($post->ID, $user_ID);?>

    </div>


    <?php //blocco del modifica profilo ?>
    <div class="testobio span7 editable">

        <?php R012Professionista::r012_load_dati_bio($post->ID, $user_ID);?>

    </div><!--/.testobio-->
    <br class="clear"/>


    <?php //blocco del note biografiche ?>
    <section class="bio row-fluid editable">

        <?php R012Professionista::r012_load_dati_bionote($post->ID, $user_ID);?>

    </section>


    <?php

    //blocco delle attività ?>
    <?php if($user_ID){?>
    <section class="busyness row-fluid editable">

         <?php R012Professionista::r012_load_attivita($post->ID, $user_ID);?>

    </section>
    <?php } ?>

    <?php //if($user_ID){?>
            <section class="project">
                <h4 class="title-profile"><?php echo __('progetti','r012'); ?></h4>


                <div class="row-fluid">

                        <?php R012Professionista::r012_print_progetti_professionista($post->ID , $user_ID); ?>

                </div>

            </section>
    <?php // } ?>
    <?php //blocco delle collaborazioni ?>

    <?php if($user_ID){?>
     <section class="collaborazioni editable">

            <?php  R012Professionista::r012_load_collaborazioni($post->ID, $user_ID); ?>
     </section>
     <?php }?>
   <div class="clear"></div>



<input class="span2" type="hidden" name="r012_post" value="<?php echo $post->ID;?>">
<input class="span2" type="hidden" name="r012_user_id" value="<?php echo $user_ID;?>">

<?php /* ?>
<div id="modal-change-foto" class="dialog">
    <form id='edit-change-foto' class="modifica">
        <div class="thumb-sk">
            <?php $default_attr = array(
            'alt' => get_the_title($postid),
            'title' => get_the_title($postid)
            );
            if ( has_post_thumbnail($postid)) {

                echo get_the_post_thumbnail( $postid, 'thumb-single', $default_attr );

            }else{
                ?>
                <img src="<?php bloginfo('template_url'); ?>/images/img-default.jpg" title="<?php get_the_title($postid); ?>" width="300" height="300" />

            <?php } ?>
        </div>
        <label for="r012_immagine_id"><?php _e("Immagine", 'r012' ); ?> <small>risoluzione 72dpi 500px per 500px</small></label>
        <input type="file" name="r012_immagine" id="r012_immagine_id" value="" />
   </form>
</div>


<div id="modal-change-testobio" class="dialog">
   <form id='edit-change-testobio' class="modifica">

       <div>

           <h3 class="nome"><?php echo get_post_meta($post->ID,'r012_nome_saved',true);?> <?php echo get_post_meta($post->ID,'r012_cognome_saved',true);?></h3>
           <input type="text" placeholder="P.IVA" name="r012_piva_saved" class="span3" value="<?php echo get_post_meta($post->ID,'r012_piva_saved',true);?>">
           <div class="control-group">
           <?php $terms = get_the_terms($post->ID, 'categorie_professionisti');
           foreach ( $terms as $term ) {


           $r012_args = array(
               'selected'           => $term->term_id,
               'show_option_none'   => 'Seleziona un titolo',
               'order'              => 'ASC',
               'name'               => 'r012_titolo_saved',
               'id'                 => 'r012_titolo_id',
               'hide_empty'         => 0,
               'taxonomy'           => 'categorie_professionisti'
           );
           }
           wp_dropdown_categories( $r012_args ); ?>
           </div>


           <ul id="anagraficabase">
               <li class="big">
                   <input type="text" class="span2" placeholder="Ordine iscrizione" name="r012_ordine_saved" value="<?php echo get_post_meta($post->ID,'r012_ordine_saved',true);?>"> | <input class="span2" type="text" name="r012_numero_saved" placeholder="Numero Ordine" value="<?php echo get_post_meta($post->ID,'r012_numero_saved',true);?>">
               </li>

               <li>
                   <input class="span2" placeholder="Nome Studio" type="text" name="r012_nome_studio_saved" value="<?php echo get_post_meta($post->ID,'r012_nome_studio_saved',true);?>">
                   <span><?php echo __('Registra utente come studio','r012'); ?></span>
                <?php
                   $r012_value_studio = get_post_meta( $post->ID, 'r012_studio_saved', true);
                   $checked_studio ='';
                   if ($r012_value_studio == 1){
                   $checked_studio = ' checked="checked"';
                   }
                ?>

                   <input name="r012_studio_saved" type="checkbox"<?php echo $checked_studio; ?>' />
               </li>

               <li>
                   <input class="span2" type="text" name="r012_posizione_saved" placeholder="Posizione" value ="<?php echo get_post_meta( $post->ID, 'r012_posizione_saved', true);?>">
               </li>
               <li>
                   <input class="span2" type="text" name="r012_sito_saved" placeholder="Sito web" value="<?php echo get_post_meta( $post->ID, 'r012_sito_saved', true);?>">
               </li>

               <li>
                   <div class="control-group">
                   <input class="span2" type="text" name="r012_citta_saved" placeholder="Città" value="<?php echo get_post_meta( $post->ID, 'r012_citta_saved', true)?>">
                   </div>
               </li>

               <br/>
               <li>
                   <span class="big">contatti: </span>
                   email <?php echo get_post_meta($post->ID,'r012_email_saved',true);?>

                   mobile <input class="span2" type="text" name="r012_mobile_saved" placeholder="Mobile" value="<?php echo get_post_meta( $post->ID, 'r012_mobile_saved', true);?>">

                   telefono <input class="span2" type="text" name="r012_telefono_saved" placeholder="Telefono" value="<?php echo get_post_meta( $post->ID, 'r012_telefono_saved', true); ?>">

                   fax <input class="span2" type="text" name="r012_fax_saved" placeholder="Fax" value="<?php echo get_post_meta($post->ID,'r012_fax_saved',true); ?>">

                   skype <input class="span2" type="text" name="r012_skype_saved" placeholder="Skype" value="<?php echo get_post_meta( $post->ID, 'r012_skype_saved', true); ?>">

               </li>

               <li>
                   <span class="big">indirizzo: </span>
                   città <input class="span2" type="text" name="r012_citta_saved" placeholder="Città" value="<?php echo get_post_meta( $post->ID, 'r012_citta_saved', true);?>">

                   via <input class="span2" type="text" name="r012_via_saved" placeholder="Via" value="<?php echo get_post_meta( $post->ID, 'r012_via_saved', true);?>">

                   cap <input class="span2" type="text" name="r012_cap_saved" placeholder="Cap" value="<?php echo get_post_meta( $post->ID, 'r012_cap_saved', true);?>">
                   <div class="control-group">
                   provincia <input class="span2" type="text" name="r012_provincia_saved" placeholder="Provincia" value="<?php echo get_post_meta( $post->ID, 'r012_provincia_saved', true);?>">
                   </div>
               </li>

               <li>
                   <span class="big">social: </span>
                   <input class="span2" type="text" name="r012_facebook_saved" placeholder="Facebook" value="<?php echo get_post_meta( $post->ID, 'r012_facebook_saved', true);?>">
                   <input class="span2" type="text" name="r012_twitter_saved" placeholder="Twitter" value="<?php echo get_post_meta( $post->ID, 'r012_twitter_saved', true);?>">
                   <input class="span2" type="text" name="r012_linkedin_saved" placeholder="Linkedin" value="<?php echo get_post_meta( $post->ID, 'r012_linkedin_saved', true);?>">
               </li>

           </ul>

       </div>
     </form>
</div><!--dialog-->
<?php */ ?>
<?php /* ?>
<div id="modal-change-notebio" class="dialog">
        <form id='edit-change-notebio' class="modifica">
                <textarea class="" rows="10" cols="40" name="r012_content_saved"><?php
                    $note = get_the_content($post->ID);
                    echo strip_tags($note);
                ?></textarea>
        </form>
</div>


<div id="modal-change-attivita" class="dialog">
    <form id='edit-change-attivita' class="modifica">
            <div class="span5">
                <h4 class="span2">attività</h4>
            </div>

            <div class="row-fluid">
                <div class="span12 add">
                    <h3>Spunta le attività per inserirle nella tua scheda profilo</h3>
                    <?php
                    $args_all_terms = array(

                        'hide_empty'    => 0,
                        'fields'        => 'all',
                        'order'         => 'DESC',
                       );

                    $terms = get_terms('attivita_professionisti',$args_all_terms);

                    $terms_attivita_professionista = wp_get_object_terms( $post->ID, 'attivita_professionisti');

                    echo "<ul>";

                        foreach ( $terms as $term ) {

                            if($term->parent==0){

                                echo "<strong>" . $term->name;

                                //l'attività è checked la somma dei controlli è pari a 1
                                $found = 0;
                                foreach( $terms_attivita_professionista as $term_professionista){

                                     if ($term->term_id == $term_professionista->term_id){
                                         $found = $found + 1;
                                     }
                                     else{
                                         $found = $found + 0;
                                     }
                                }


                                if($found==0){
                                    $cheked ="";

                                } else{
                                    $cheked = "checked='checked'";

                                }
                                echo "<input type='checkbox' name='r012_attivita_item[]' value='".$term->term_id ."' " . $cheked . ">";


                                echo "</strong>";
                                $args = array(
                                    'hide_empty'=> 0,
                                    'child_of'  => $term->term_id);

                                $r012_termini_attivita = get_terms( 'attivita_professionisti', $args );
                                    foreach($r012_termini_attivita as $r012_termine_attivita){

                                        echo "<li>";
                                        echo "<span>" . $r012_termine_attivita->name;
                                        $found_child = 0;
                                        foreach( $terms_attivita_professionista as $term_professionista){

                                            if ($r012_termine_attivita->term_id == $term_professionista->term_id){
                                                $found_child = $found_child + 1;
                                            }
                                            else{
                                                $found_child = $found_child + 0;
                                            }
                                        }


                                        if($found_child==0){
                                            $cheked_child ="";

                                        } else{
                                            $cheked_child = "checked='checked'";

                                        }
                                        echo "<input type='checkbox' name='r012_attivita_item[]' value='".$r012_termine_attivita->term_id ."' " . $cheked_child . ">";
                                        echo "</span>";
                                        echo "</li>";
                                    }


                            }
                        }
                    echo "</ul>";
                    ?>


                 </div>
            </div>
    </form>
</div>
<?php */ ?>

<?php /* ?>
<div id="modal-change-collaborazioni" class="dialog">
  <form id='edit-change-collaborazioni' class="modifica">
        <h4 class="title-profile">collaborazioni</h4>

        <div class="row-fluid">
            <article class="c-professionals span3">

                <div class="span12">
                    <h3>Professionisti</h3>
                </div>

                <div class="row-fluid">
                   <?php

                    $cpt = 'professionisti';
                    R012Autocomplete::print_input_autocomplete( $cpt ,''); ?>
                </div>
            </article>

            <article class="c-companies span3">
                <h3>Aziende</h3>

                <div class="row-fluid">
                    <div class="span12">
                        <input type="text" placeholder="Aggiungi azienda">
                        <ul>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="change"><a href="" title="Aggiungi alle attività">Aggiungi alle aziende</a></div>
                </div>

            </article>

            <article class="c-operators span3">
                <h3>Operatori Specializzati</h3>

                <div class="row-fluid">
                    <div class="span12">
                        <input type="text" placeholder="Aggiungi operatore">
                        <ul>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="change"><a href="" title="Aggiungi alle attività">Aggiunggi agli operatori</a></div>
                </div>
            </article>

            <article class="c-retailers span3">
                <h3>Rivenditori</h3>

                <div class="row-fluid">
                    <div class="span12">
                        <input type="text" placeholder="Aggiungi rivenditore">
                        <ul>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                            <li>
                                <input type="checkbox" value="1" checked="checked"> Nome Cognome
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="change"><a href="" title="Aggiungi alle attività">Aggiungi ai rivenditori</a></div>
                </div>
            </article>
        </div>

  </form>
</div>
 <?php */ ?>
<?php } // end r012_approvato ?>

<?php get_footer(); ?>