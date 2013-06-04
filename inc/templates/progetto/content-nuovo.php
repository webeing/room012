<?php /**
 * Content progetto nuovo
 */
global $user_ID;
global $wp;

$slug_user = str_replace("/progetto/nuovo","",$wp->request);

$postid = R012Utility::bwp_url_to_postid(get_bloginfo('home').'/'.$slug_user.'/');
//$email_admin = get_post_meta($postid,'r012_email_saved',true);

?>
<div class="breadcrumbs">

       <a href="/">Home</a> > <a href="/professionisti/">Scheda Professionista</a> > <a href="<?php echo get_permalink($postid); ?>"><?php echo get_the_title($postid);?></a> > Nuovo Progetto
</div>

<div class="new-project edit-project row-fluid">
    <h2>Aggiungi nuovo progetto</h2>

    <div id="preview-project" class="relative clear">
        <div class="control-group span6">
            <iframe name="frame" width="350" height="350"></iframe>
        </div>
        <div class="span6">
            <form id="upload_foto_nuovo" method="post" action="" enctype="multipart/form-data" target="frame" name="upload" novalidate="novalidate" class="form-horizontal">
                <div class="control-group">
                    <label>Immagine di copertina <small>[*]</small></label>
                    <input type="file" name="r012_immagine_project" id="r012_immagine_project_id" value="" />
                    <br/><br/>
                    <p>Salva immagine e visualizza anteprima.</p>
                    <input class="ui-button" type="submit" value="Salva immagine"/>
                    <input type="hidden" name="r012_autore" id="r012_autore_id" value="<?php echo $postid; ?>" />
                </div>
            </form>
        </div>
    </div><!--/#preview-project-->

    <div id="info-project" class="row clearfix">
        <form id="r012_form_progetto_id" name="r012_form_nuovo_progetto" method="post" enctype="multipart/form-data" novalidate="novalidate" class="form-horizontal">

                <?php
                //utente registrato o amministratore

                 if(current_user_can('administrator')){  ?>
                     <input type="hidden" name="r012_autore" id="r012_autore_id" value="<?php echo $postid ?>" />
                <?php }

                else {

                    $email = get_the_author_meta('user_email', $user_ID);
                    $result = R012Professionista::get_author($email);
                    ?>
                    <input type="hidden" name="r012_autore" id="r012_autore_id" value="<?php echo $result[0]->ID; ?>" />

                <?php } ?>

        <h2 class="control-group clear span12">
            <label>Nome del progetto <small>[*]</small></label>
            <input class="big-input" type="text" name="r012_name_project" id="r012_name_project_id" value=""/>
        </h2>
        <br class="clear"/>
        <p class="control-group span6">
            <label>Oggetto </label>
            <?php $r012_args_oggetto = array(
                'show_option_none'   => 'Seleziona un oggetto',
                'order'              => 'ASC',
                'orderby'            => 'Name',
                'name'               => 'r012_oggetto',
                'id'                 => 'r012_oggetto_id',
                'hide_empty'         => 0,
                'taxonomy'           => 'oggetto'
            );
            wp_dropdown_categories( $r012_args_oggetto ); ?>
        </p>
        <p class="control-group span6">
                <label>Stato dell'opera </label>
                <?php $r012_args_stato = array(
                    'show_option_none'   => 'Seleziona uno stato',
                    'order'              => 'ASC',
                    'orderby'            => 'Name',
                    'name'               => 'r012_stato',
                    'id'                 => 'r012_stato_id',
                    'hide_empty'         => 0,
                    'taxonomy'           => 'stato'
                );
                wp_dropdown_categories( $r012_args_stato ); ?>
        </p>
        <p class="control-group span6">
            <label>Anno <small>[*]</small></label>
            <input type="text" name="r012_anno_project" id="r012_anno_project_id" value=""/>
        </p>

        <p class="control-group span6">
            <label>Città <small>[*]</small></label>
            <input type="text" name="r012_citta_project" id="r012_citta_project_id" value=""/>
        </p>

        <p class="control-group span6">
            <label>Provincia <small>[*]</small></label>
            <?php global $province;

            echo '<select name="r012_provincia_project" id="r012_provincia_project_id">';

            foreach ($province as $key => $value) {
                echo '<option value='.$value.'>'.$key.'</option>';
            }

            echo '</select>'; ?>
        </p>

        <p class="control-group span6">
            <label>Regione </label>
            <?php
            global $regioni;

            echo '<select name="r012_regione_project" id="r012_regione_project_id">';
            foreach ($regioni as $key => $value) {
                if($key == $r012_value_regione){
                    echo '<option value='.$value.' selected>'. $key .'</option>';
                } else {
                    echo '<option value='.$value.'>'. $key .'</option>';
                }

            }
            echo '</select>';
            ?>
        </p>

        <p class="control-group span6">
            <label>Tipologia del progetto <small>[*]</small></label>
            <?php $r012_args_tipologia = array(
                'show_option_none'   => 'Seleziona una tipologia',
                'order'              => 'ASC',
                'orderby'            => 'Name',
                'name'               => 'r012_tipologia',
                'id'                 => 'r012_tipologia_id',
                'hide_empty'         => 0,
                'taxonomy'           => 'tipologia'
            );
            wp_dropdown_categories( $r012_args_tipologia ); ?>
        </p>

        <p class="control-group span6">
            <label>Stato del progetto </label>
            <?php $r012_args_attivita = array(
                        'show_option_none'   => 'Seleziona attivita',
                        'order'              => 'ASC',
                        'orderby'            => 'Name',
                        'name'               => 'r012_attivita',
                        'id'                 => 'r012_attivita_id',
                        'hide_empty'         => 0,
                        'taxonomy'           => 'attivita'
                    );
            wp_dropdown_categories( $r012_args_attivita ); ?>
        </p>
        <p class="control-group span6">
            <label>Committente </label>
            <input type="text" name="r012_committente_project" id="r012_committente_project_id" value="" />
        </p>

        <p class="control-group span6">
            <label>Studio</label>
            <input type="text" name="r012_studio_project" id="r012_studio_project_id" value="" />
        </p>
        <br class="clear"/>
        <p class="control-group span12 clear">
            <label>Concept di progetto</label>
           <textarea id="r012_concept_project_id" name="r012_concept_project" rows="3"></textarea>
        </p>

        <h2 class="clear">
            Galleria Immagini:
        </h2>

        <ul id="image-list">
            <li class="single-image span6">
                <p class="control-group">Inserisci immagine: <input type="file" name="r012_immagine_project_1" id="r012_immagine_project_id_1" value=""></p>
                <p class="control-group"><label>Didascalia </label><input type="text" value="" id="r012_didascalia_id_1" name="r012_didascalia_project_1"></p>
            </li>
        </ul>
        <br class="clear"/>
        <a class="button r012-button-aggiungi-image edit" class="add-image" href="">[+] Aggiungi immagine al progetto</a>
        <br class="clear"/>

        <h2 class="clear control-group title-profile">
            Collaborazioni:
        </h2>
        <div class="row-fluid collaborazioni">
            <article class="control-group c-professionals span3">
                <h3>Professionisti</h3>
                <?php
                $testo_professionisti = 'Inserisci il nome e il cognome del professionista';
                R012Autocomplete::print_input_autocomplete( 'professionisti', $testo_professionisti);
                ?>
            </article>

            <article class="control-group c-companies span3">
                <h3>Aziende</h3>
                <?php
                $testo_azienda = 'Inserisci il nome azienda';
                R012Autocomplete::print_input_autocomplete('aziende', $testo_azienda);
                ?>
            </article>

            <article class="control-group c-operators span3">
                <h3>Operatori Specializzati</h3>
                <?php
                $testo_operatori = 'Inserisci il nome operatore';
                R012Autocomplete::print_input_autocomplete( 'operatori', $testo_operatori);
                ?>
            </article>

            <article class="control-group c-retailers span3">
                <h3>Rivenditori</h3>
                <?php
                $testo_rivenditori = 'Inserisci il nome del rivenditore';
                R012Autocomplete::print_input_autocomplete('rivenditori', $testo_rivenditori);
                ?>
            </article>

        </div><!--/Collaborazioni-->

        <br class="clear"/>
        <div class="clearfix clear container-fluid action-btn">
            <input id="progettobtn" name="r012_nuovo_progetto" value="<?php _e('Crea Nuovo progetto', 'r012') ;?>" type="button" class="span12 ui-button"/>
        </div>

        <div id="result_progetto"></div>
        </form>
    </div><!--/#info-project-->
</div><!--/.new-project-->