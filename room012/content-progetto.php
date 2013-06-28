<?php
/**
 * Content Progetto
 */
?>

<?php
//nome autore progetto
$r012_value_autore = get_post_meta( $post->ID, 'r012_autore_saved', true);?>
<div class="breadcrumbs">
    <a href="/">Home</a> > <a href="/professionisti/">Scheda Professionista</a> > <a href="<?php echo get_permalink($r012_value_autore); ?>"><?php echo get_the_title($r012_value_autore);?></a> > <?php echo get_the_title($post->ID);?>
</div>
<div class="view-project">
    <div class="bio">
        <div class="thumb-sk">
            <?php $default_attr = array(
            'alt'	=> get_the_title(),
            'title'	=> get_the_title(),
            );
            the_post_thumbnail('thumb-single',$default_attr );
            ?>
        </div>
    </div>

    <div class="testobio">
        <h3 class="nome"><?php the_title(); ?></h3>
        <p class="professione">
            <strong class="designer">

                <a href="<?php echo get_permalink($r012_value_autore);?>"><?php echo get_the_title($r012_value_autore); ?></a>

            </strong>

        </p>

        <ul id="anagraficabase">
            <li class="big">
                <span class="big">
                    <?php $terms_oggetto = wp_get_post_terms( $post->ID, 'oggetto' );
                    if($terms_oggetto){
                            foreach ($terms_oggetto as $term_oggetto) {
                               echo $term_oggetto->name;
                            }
                    ?>
                </span> |
                 <?php }
                if(get_post_meta( $post->ID, 'r012_localita_saved', true) || get_post_meta( $post->ID, 'r012_provincia_saved', true)){?>
                <span>
                   <?php echo get_post_meta( $post->ID, 'r012_localita_saved', true) . ' '  . get_post_meta( $post->ID, 'r012_provincia_saved', true); ?>
                </span> |
                <?php }
                if(get_post_meta( $post->ID, 'r012_anno_saved', true)){ ?>
                <span>
                    <?php
                    echo get_post_meta( $post->ID, 'r012_anno_saved', true); ?>
                </span>
                <?php } ?>
                </li>
            <br/><br/>
            <li class="big">
                <?php echo __('dettagli del progetto: ', 'r012');?>
            </li>

            <li>
                <?php $terms_tipologia = wp_get_post_terms( $post->ID, 'tipologia' );
                if($terms_tipologia){
                echo __('tipologia: ', 'r012');?>
                <strong>
                    <?php
                    foreach ($terms_tipologia as $term_tipologia) {
                        echo $term_tipologia->name;
                    }
                    ?>
                </strong>
                <?php } ?>
            </li>

            <li>
                <?php $terms_attivita = wp_get_post_terms( $post->ID, 'attivita' );
                if($terms_attivita){
                echo __('attivita: ', 'r012');?>
                <strong>
                  <?php
                    foreach ($terms_attivita as $term_attivita) {

                            echo $term_attivita->name . ' ';
                     }

                    ?>
                </strong>
                <?php } ?>
            </li>
            <li>
                <?php $terms_stato = wp_get_post_terms( $post->ID, 'stato' );
                if($terms_stato){
                    echo __('stato: ', 'r012');?>
                    <strong>
                        <?php
                        foreach ($terms_stato as $term_stato) {

                            echo $term_stato->name . ' ';
                        }

                        ?>
                    </strong>
                <?php } ?>
            </li>
            <li>
                <?php
                if(get_post_meta( $post->ID, 'r012_committente_saved', true)){
                echo __('committente: ', 'r012');?>
                <strong>
                    <?php echo get_post_meta( $post->ID, 'r012_committente_saved', true); ?>
                </strong>
                <?php } ?>
            </li>

            <li>
                <?php
                if(get_post_meta( $post->ID, 'r012_regione_saved', true)){
                echo __('regione: ', 'r012');?>
                <strong>
                    <?php
                    global $regioni;
                    $r012_value_regione = get_post_meta( $post->ID, 'r012_regione_saved', true);
                    foreach ($regioni as $key => $value) {

                        if($value == $r012_value_regione){
                        echo  $key;
                        }

                    }?>
                </strong>
                <?php } ?>
            </li>
            <li>
                <?php
                if(get_post_meta( $post->ID, 'r012_studio_saved', true)){ ?>
                <span class="big"><?php echo __('studio: ', 'r012');?> </span>
                <strong><?php echo get_post_meta( $post->ID, 'r012_studio_saved', true); ?></strong>
                <?php } ?>
            </li>

            <br/>

        </ul>


        <br class="clear"/>
        <?php if(get_the_content()){?>
        <section class="bio">
            <h4 class="title-profile"><?php echo __('descrizione progetto: ', 'r012');?></h4>
            <div class="content"><?php the_content(); ?></div>
        </section>
        <?php } ?>
        <div class="clear"></div>
        <?php
        $r012_gallery_value = get_post_meta( $post->ID , 'r012_galleria_saved', true);
        if($r012_gallery_value){ ?>
        <section class="project gallery carousel">
            <header class="top-gallery">
                <h4 class="title-profile"><?php echo __('gallery', 'r012');?></h4><span><?php echo __('clicca le immagini per ingrandirle', 'r012');?></span>
            </header>

            <div id="slider-gallery" class="row-fluid carousel-inner">
                     <?php R012Gallery::r012_gallery( $post->ID );?>
             </div>

        </section>
        <?php } ?>
        <?php R012Professionista::r012_print_section_collaborazioni( $post->ID );?>

        <div class="clear"></div>

    </div><!--/.testobio-->
</div><!--/.view-project-->