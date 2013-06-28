<?php /**
 * Content progetto modifica
 */
global $user_ID;
?>
<div class="breadcrumbs">
    <?php $autore_id = get_post_meta( $post->ID, 'r012_autore_saved', true); ?>
    <a href="/">Home</a> > <a href="/professionisti/">Scheda Professionista</a> > <a href="<?php echo get_permalink($autore_id); ?>"><?php echo get_the_title($autore_id);?></a> > <a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID);?></a> > Modifica Progetto
</div>

<div class="row-fluid edit-project">
    <h2 class="span10">Modifica progetto</h2>
    <div class="span2">
        <i class="icon-remove"></i><a id="delete-project" title="Elimina progetto" href="#deleteprogettobtn">Elimina progetto</a>
    </div>
    <div id="preview-project" class="relative clear">
        <form id="upload_foto_modifica" method="post" action="" enctype="multipart/form-data" target="frame" name="upload" class="clearfix">
            <div class="control-group span6">

                <?php $default_attr = array(
                    'alt'	=> get_the_title(),
                    'title'	=> get_the_title(),
                );
                the_post_thumbnail('thumb-single',$default_attr );
                ?>
            </div>
            <div class="span6">

            <label>Immagine di copertina <small>[*]</small></label>

            <input type="file" name="r012_immagine_modifica_project" id="r012_immagine_modifica_project_id" value="" />
                <br/>
                <p>Salva immagine e visualizza anteprima del progetto.</p>
            <input type="submit" value="Salva immagine" class="ui-button" />
            <input type="hidden" name="r012_post" id="r012_post_id" value="<?php echo $post->ID; ?>" />
            </div>
        </form>

        <div class="control-group span6 preview">
             <iframe name="frame" width="350" height="350"></iframe>
        </div>
    </div><!--/#preview-project-->

    <div id="info-project" class="row clearfix">
        <form id="r012_form_progetto_id" name="r012_form_progetto" method="post" enctype="multipart/form-data" novalidate="novalidate" class="form-horizontal">

        <input type="hidden" name="r012_autore" id="r012_autore_id" value="<?php echo get_post_meta( $post->ID, 'r012_autore_saved', true); ?>" />
        <input type="hidden" name="r012_post" id="r012_post_id" value="<?php echo $post->ID; ?>" />
        <h2 class="control-group clear span12">
            <label>Nome del progetto <small>[*]</small></label>
            <input class="big-input" type="text" name="r012_name_project" id="r012_name_project_id" value="<?php the_title(); ?>"/>
        </h2>
        <br class="clear"/>
        <p class="control-group span6">
            <label for="r012_nome_id">Oggetto </label>
            <?php
            $terms_oggetto = wp_get_post_terms( $post->ID, 'oggetto' );
            if($terms_oggetto){

                foreach ($terms_oggetto as $term_oggetto) {

                    $r012_args_oggetto = array(
                        'show_option_none'   => 'Seleziona un oggetto',
                        'order'              => 'ASC',
                        'orderby'            => 'Name',
                        'name'               => 'r012_oggetto',
                        'id'                 => 'r012_oggetto_id',
                        'hide_empty'         => 0,
                        'taxonomy'           => 'oggetto',
                        'selected'           =>  $term_oggetto->term_id
                    );
                    wp_dropdown_categories( $r012_args_oggetto );
                }
            } else {
                $r012_args_oggetto = array(
                    'show_option_none'   => 'Seleziona oggetto',
                    'order'              => 'ASC',
                    'orderby'            => 'Name',
                    'name'               => 'r012_oggetto',
                    'id'                 => 'r012_oggetto_id',
                    'hide_empty'         => 0,
                    'taxonomy'           => 'oggetto',

                );
                wp_dropdown_categories( $r012_args_oggetto );
            }
            ?>
        </p>
        <p class="control-group span6">
            <label for="r012_nome_id">Stato dell'opera </label>
                <?php $terms_stato = wp_get_post_terms( $post->ID, 'stato' );

                if($terms_stato){

                    foreach ($terms_stato as $term_stato) {

                        $r012_args_stato = array(
                            'show_option_none'   => 'Seleziona stato',
                            'order'              => 'ASC',
                            'orderby'            => 'Name',
                            'name'               => 'r012_stato',
                            'id'                 => 'r012_stato_id',
                            'hide_empty'         => 0,
                            'taxonomy'           => 'stato',
                            'selected'           =>  $term_stato->term_id
                        );
                        wp_dropdown_categories( $r012_args_stato );
                    }
                } else {
                    $r012_args_stato = array(
                        'show_option_none'   => 'Seleziona stato',
                        'order'              => 'ASC',
                        'orderby'            => 'Name',
                        'name'               => 'r012_stato',
                        'id'                 => 'r012_stato_id',
                        'hide_empty'         => 0,
                        'taxonomy'           => 'stato',

                    );
                    wp_dropdown_categories( $r012_args_stato );
                }
                ?>
        </p>
        <p class="control-group span6">
            <label>Anno <small>[*]</small></label>
            <input type="text" name="r012_anno_project" id="r012_anno_project_id" value="<?php echo get_post_meta( $post->ID, 'r012_anno_saved', true); ?>"/>
        </p>

        <p class="control-group span6">
            <label>Città <small>[*]</small></label>
            <input type="text" name="r012_citta_project" id="r012_citta_project_id" value="<?php echo get_post_meta( $post->ID, 'r012_localita_saved', true); ?>"/>
        </p>

        <p class="control-group span6">
            <label>Provincia <small>[*]</small></label>
            <?php global $province;
            echo '<select name="r012_provincia_project" id="r012_provincia_project_id">';
            $r012_value_provincia = get_post_meta( $post->ID, 'r012_provincia_saved', true);
                foreach ($province as $key => $value) {
                if($value == $r012_value_provincia){
                echo '<option value='.$value.' selected>'.$key.'</option>';
                } else {
                echo '<option value='.$value.'>'.$key.'</option>';
                }

                }
                echo '</select>'; ?>
        </p>

        <p class="control-group span6">
            <label>Regione </label>
            <?php
            global $regioni;

            echo '<select name="r012_regione_project" id="r012_regione_project_id">';
            $r012_value_regione = get_post_meta( $post->ID, 'r012_regione_saved', true);
            foreach ($regioni as $key => $value) {
                if($value == $r012_value_regione){
                    echo '<option value='.$value.' selected>'.$key.'</option>';
                } else {
                    echo '<option value='.$value.'>'.$key.'</option>';
                }

            }
            echo '</select>'; ?>
        </p>

        <p class="control-group span6">
            <label>Tipologia del progetto <small>[*]</small></label>

            <?php $terms_tipologia = wp_get_post_terms( $post->ID, 'tipologia' );
            if($terms_tipologia){
                    foreach ($terms_tipologia as $term_tipologia) {
                        $r012_args_tipologia = array(
                            'show_option_none'   => 'Seleziona una tipologia',
                            'order'              => 'ASC',
                            'orderby'            => 'Name',
                            'name'               => 'r012_tipologia',
                            'id'                 => 'r012_tipologia_id',
                            'hide_empty'         => 0,
                            'taxonomy'           => 'tipologia',
                            'selected'           =>  $term_tipologia->term_id
                        );
                        wp_dropdown_categories( $r012_args_tipologia );
                    }
             }
            ?>
        </p>

        <p class="control-group span6">
            <label>Attività del progetto </label>
            <?php $terms_attivita = wp_get_post_terms( $post->ID, 'attivita' );

            if($terms_attivita){

                    foreach ($terms_attivita as $term_attivita) {

                        $r012_args_attivita = array(
                            'show_option_none'   => 'Seleziona attivita',
                            'order'              => 'ASC',
                            'orderby'            => 'Name',
                            'name'               => 'r012_attivita',
                            'id'                 => 'r012_attivita_id',
                            'hide_empty'         => 0,
                            'taxonomy'           => 'attivita',
                            'selected'           =>  $term_attivita->term_id
                        );
                        wp_dropdown_categories( $r012_args_attivita );
                    }
            } else {
                $r012_args_attivita = array(
                    'show_option_none'   => 'Seleziona attivita',
                    'order'              => 'ASC',
                    'orderby'            => 'Name',
                    'name'               => 'r012_attivita',
                    'id'                 => 'r012_attivita_id',
                    'hide_empty'         => 0,
                    'taxonomy'           => 'attivita',

                );
                wp_dropdown_categories( $r012_args_attivita );
            }
            ?>

        </p>
        <p class="control-group span6">
            <label>Committente </label>
            <input type="text" name="r012_committente_project" id="r012_committente_project_id" value="<?php echo get_post_meta( $post->ID, 'r012_committente_saved', true); ?>" />
        </p>

        <p class="control-group span6">
            <label>Studio</label>
            <input type="text" name="r012_studio_project" id="r012_studio_project_id" value="<?php echo get_post_meta( $post->ID, 'r012_studio_saved', true); ?>" />
        </p>
        <br class="clear"/>
        <p class="control-group span12 clearfix">
            <label>Concept di progetto</label>
            <textarea id="r012_concept_project_id" name="r012_concept_project" rows="3">
                <?php $concept = get_the_content();
                echo strip_tags($concept); ?></textarea>
        </p>


        <h2 class="clear">
            Galleria Immagini:
        </h2>
        <?php preg_match('/\[gallery.*ids=.(.*).\]/', get_post_meta( $post->ID, 'r012_galleria_saved', true) , $ids);

        $array_ids = explode(",", $ids[1]);?>

            <?php

            if( $array_ids[0] == "" ){ ?>
                <ul id="image-list">
                        <li class="single-image span6">
                            <p class="control-group">Inserisci immagine <input type="file" name="r012_immagine_project_1" id="r012_immagine_project_id_1" value=""></p>
                            <p class="control-group"><label>Didascalia </label><input type="text" value="" id="r012_didascalia_id_1" name="r012_didascalia_project_1"></p>
                        </li>
                </ul>
                <?php
            }

            else {
                $count_file = 1;?>
                <ul id="image-list" class="modifica">
                <?php foreach($array_ids as $array_id){ ?>

                    <li class="single-image span6">
                        <input type="hidden" name="r012_immagine_esistente_<?php echo $count_file; ?>" value="<?php echo $array_id;?>">
                        <p class="control-group"><?php echo wp_get_attachment_image($array_id, 'preview' );?></p>
                        <p class="control-group"><label>Didascalia </label><input type="text" id="r012_didascalia_id_<?php echo $count_file; ?>" name="r012_didascalia_project_<?php echo $count_file; ?>" value="<?php echo get_post_field('post_excerpt', $array_id);?>">

                            <a class="r012-button-modifica-image" href="" title="Modifica immagine">Modifica immagine</a>
                            <input type="file" name="r012_immagine_project_<?php echo $count_file; ?>" id="r012_immagine_project_id_<?php echo $count_file; ?>"  value="">

                        </p>
                        <br class="clear"/>
                        <a class="r012-button-rimuovi-image" href="" class="right">[-] Rimuovi</a>
                        <br class="clear"/>

                    </li>

                <?php
                    $count_file++;
            }?>
                </ul>
            <?php }?>

        <?php if( count($array_ids)<10 ){?>

                         <br class="clear"/>
                         <a class="button r012-button-aggiungi-image edit" href="" class="add-image">[+] Aggiungi una nuova immagine al progetto</a>
                         <br class="clear"/>
        <?php } ?>

        <h2 class="clear control-group title-profile">
            Collaborazioni:
        </h2>
        <div class="row-fluid collaborazioni">
            <article class="control-group c-professionals span3">
                <h3>Professionisti</h3>
                <?php
                $testo_professionisti = 'Inserisci il nome e il cognome del professionista';
                R012Autocomplete::print_input_autocomplete( 'professionisti', $testo_professionisti);

                $r012_values_autocomplete = get_post_meta( $post->ID, 'r012_collaborazioni_professionisti_saved', true);
                R012Autocomplete::print_result_autocomplete('professionisti', $r012_values_autocomplete);
                ?>
            </article>

            <article class="control-group c-companies span3">
                <h3>Aziende</h3>
                <?php
                $testo_azienda = 'Inserisci il nome azienda<br>';
                R012Autocomplete::print_input_autocomplete('aziende', $testo_azienda);

                $r012_values_autocomplete_aziende = get_post_meta( $post->ID, 'r012_collaborazioni_aziende_saved', true);
                R012Autocomplete::print_result_autocomplete('aziende', $r012_values_autocomplete_aziende);
                ?>
            </article>

            <article class="control-group c-operators span3">
                <h3>Operatori Specializzati</h3>
                <?php
                $testo_operatori = 'Inserisci il nome operatore';
                R012Autocomplete::print_input_autocomplete( 'operatori', $testo_operatori);

                $r012_values_autocomplete_operatori = get_post_meta( $post->ID, 'r012_collaborazioni_operatori_saved', true);
                R012Autocomplete::print_result_autocomplete('operatori', $r012_values_autocomplete_operatori);
                ?>
            </article>

            <article class="control-group c-retailers span3">
                <h3>Rivenditori</h3>
                <?php
                $testo_rivenditori = 'Inserisci il nome del rivenditore';
                R012Autocomplete::print_input_autocomplete('rivenditori', $testo_rivenditori);

                $r012_values_autocomplete_rivenditori = get_post_meta( $post->ID, 'r012_collaborazioni_rivenditori_saved', true);
                R012Autocomplete::print_result_autocomplete('rivenditori', $r012_values_autocomplete_rivenditori);
                ?>
            </article>


        </div><!--/Collaborazioni-->

        <br class="clear"/>

        <!--service message-->
        <small class="center alert block">Se nella scheda di progetto mancano delle informazioni utili fallo presente all'amministratore del sistema per provvedere ad aggiungerle.<br>
            <a href="mailto:info@room012.it" title="Invia una mail all'amministratore">Contatta amministratore del sistema</a></small>

        <div class="clearfix clear container-fluid action-btn">
            <input id="progettobtn" name="r012_modifica_progetto" value="<?php _e('Salva Modifiche', 'r012') ;?>" type="button" class="span3 ui-button right"/>
            <input id="deleteprogettobtn" name="r012_elimina_progetto" value="<?php _e('Elimina Progetto', 'r012') ;?>" type="button" class="delete-btn span2 ui-button right"/>
        </div>


        <div id="result_progetto"></div>
        </form>
    </div><!--/#info-project-->
</div><!--/.edit-project-->