<?php
/*
 * Template name: Registrazione
 */
get_header();?>

    <?php if($_POST['r012_registration']):

        $registration = r012_registration();

        if( $registration ): ?>
            <h3 class="alert alert-success"><?php _e('Benvenuto in ROOM 012!','r012');?></br>
                <?php _e('Il tuo profilo sarà visibile non appena approvato dagli operatori.','r012');?></br>
                <?php _e('Riceverai una mail di conferma appena approvato. ','r012'); ?></br>
                <?php _e('A presto','r012'); ?>
            </h3>
            <?php
                $post = get_post($registration);
                echo '<h2 class="alignleft>'. $post->post_title .'</h2>';
                if (has_post_thumbnail($registration))
                    the_post_thumbnail('thumbnail', array('class'	=> "alignleft"), $registration);

            ?>
        <?php else: ?>
            <h3 class="alert alert-error"><?php _e('Errori durante il processo, ripetere la procedura di iscrizione','r012') ?></h3>
        <?php endif; ?>
        <br class="clear"/>

    <?php else: ?>
    <form id="r012_register_form" name="r012_register_form" method="post" enctype="multipart/form-data" novalidate="novalidate" class="form-horizontal">
    
        <fieldset>
            <legend><h2>Guest book ROOM 012: Registrati</h2></legend>
            <input id="r012_registration" name="r012_registration" value="1" type="hidden" />
            
            <p class="control-group span5">
                <label for="r012_nome_id"><?php _e("Nome", 'r012' ); ?> <small class="red">[*]</small></label>
                <input type="text" name="r012_nome" id="r012_nome_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_cognome_id"><?php _e("Cognome", 'r012' ); ?> <small class="red">[*]</small></label>
                <input type="text" name="r012_cognome" id="r012_cognome_id" value="" />
            </p>
            <p class="control-group span12">
                <label for="r012_biografia_id"><?php _e("Breve biografia", 'r012' ); ?> <small>max 2000 caratteri</small></label>
                 <textarea id="r012_biografia_id" name="r012_biografia" rows="3"></textarea>
            </p>
            <p class="control-group span5">
                <label for="r012_piva_id"><?php _e("P. IVA", 'r012' ); ?> </label>
                <input type="text" name="r012_piva" id="r012_piva_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_titolo_id"><?php _e("Titolo professionale", 'r012' ); ?>  <small class="red">[*]</small></label>
            <?php
                $r012_args = array(
                    'show_option_none'   => 'Seleziona un titolo',
                    'order'              => 'ASC',
                    'name'               => 'r012_titolo',
                    'id'                 => 'r012_titolo_id',
                    'hide_empty'         => 0,
                    'taxonomy'           => 'categorie_professionisti'
                );
                wp_dropdown_categories( $r012_args ); ?>
            </p>
            <p class="control-group span5">
                <label for="r012_ordine_id"><?php _e("Ordine iscrizione", 'r012' ); ?> </label>
                <input type="text" name="r012_ordine" id="r012_ordine_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_numero_id"><?php _e("Numero iscrizione", 'r012' ); ?> </label>
                <input type="text" name="r012_numero" id="r012_numero_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_nome_studio_id"><?php _e("Nome studio", 'r012' ); ?> </label>
                 <input type="text" name="r012_nome_studio" id="r012_nome_studio_id" value="" />
            </p>
            <p class="control-group span5">
                <span><?php _e("Registra utente come studio", 'r012' ); ?></span>
                <input value="1" type="checkbox" name="r012_studio" id="r012_studio_id"/>
            </p>
            <p class="control-group span5">
                <label for="r012_posizione_id"><?php _e("Posizione", 'r012' ); ?> </label>
                 <input type="text" name="r012_posizione" id="r012_posizione_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_telefono_id"><?php _e("Telefono", 'r012' ); ?> </label>
                <input type="text" name="r012_telefono" id="r012_telefono_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_mobile_id"><?php _e("Mobile", 'r012' ); ?></label>
               <input type="text" name="r012_mobile" id="r012_mobile_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_fax_id"><?php _e("Fax", 'r012' ); ?> </label>
                 <input type="text" name="r012_fax" id="r012_fax_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_mail_id"><?php _e("Email", 'r012' ); ?> <small class="red">[*]</small></label>
                <input type="email" name="r012_mail" id="r012_mail_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_sito_id"><?php _e("Sito web", 'r012' ); ?> </label>
                 <input type="text" name="r012_sito" id="r012_sito_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_citta_id"><?php _e("Città", 'r012' ); ?> </label>
                <input type="text" name="r012_citta" id="r012_citta_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_citta_id"><?php _e("Via", 'r012' ); ?> </label>
                <input type="text" name="r012_via" id="r012_via_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_cap_id"><?php _e("Cap", 'r012' ); ?> </label>
                 <input type="text" name="r012_cap" id="r012_cap_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_provincia_id"><?php _e("Provincia", 'r012' ); ?> </label>
               <input type="text" name="r012_provincia" id="r012_provincia_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_immagine_id"><?php _e("Immagine", 'r012' ); ?> <small>risoluzione 72dpi 500px per 500px</small></label>
                <input type="file" name="r012_immagine" id="r012_immagine_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_facebook_id"><?php _e("Account Facebook", 'r012' ); ?> </label>
                <input type="text" name="r012_facebook" id="r012_facebook_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_twitter_id"><?php _e("Account Twitter", 'r012' ); ?> </label>
                <input type="text" name="r012_twitter" id="r012_twitter_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_skype_id"><?php _e("Account Skype", 'r012' ); ?> </label>
                <input type="text" name="r012_skype" id="r012_skype_id" value="" />
            </p>
            <p class="control-group span5">
                <label for="r012_linkedin_id"><?php _e("Account Linkedin", 'r012' ); ?> </label>
                <input type="text" name="r012_linkedin" id="r012_linkedin_id" value="" />
            </p>
            <p class="control-group span5">
                <span><a href="<?php echo get_permalink(R012_ID_PAGE_TERMINI_CONDIZIONI); ?>" target="_blank">Accetta termini e condizioni</a> <small class="red">[*]</small></span>
                <input name="r012_licenza" id="r012_licenza" class="text" value="" type="checkbox"/>
            </p>

            <p class="control-group span9 p-captcha">

                <label>Codice di sicurezza:</label>
                <?php

                echo recaptcha_get_html(R012_CAPTCHA_PUBKEY, ""); ?>
                <input id="r012_remote_addr" name="r012_remote_addr" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>"/>
            </p>

        </fieldset>
        
            <?php/* echo do_shortcode('[fu-upload-form title="Upload your Photos"]
        [input type="text" name="name" id="ug_name" description="Your name"]
        [input type="file" name="photo" id="ug_photo" description="Your Photo"]
        [input type="submit" value="Submit"] [/fu-upload-form]') */ ?>
        <p><input id="registerbtn" name="r012_registrazione" value="<?php _e('Registrati', 'r012') ;?>" type="button" class="btn" /></p>
        
        <div class="alert span9">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <small>I campi contrassegnati con [*] sono obbligatori</small>
        	<div id="result_register"></div>
        </div>
        <div class="clear"></div>
        
    </form>

    <?php endif; ?>
<?php get_footer();?>