<?php
/**
 Wp Room 012
 * Index Page, display first post in the hero-unit block!
 */

get_header(); ?>

<?php
/**
* Qui inseriamo la sezione per il loop dello slider
*/
get_template_part( 'section','slider');

/**
 * Qui inseriamo la sezione per il claim della registrazione
 */
//get_template_part( 'section','claim');
//rimossa in seguito a riunione del 23.11.2012
/**
 * Qui inseriamo la sezione per gli ultimi utenti e mail chimp
 */
get_template_part( 'section','last-user');

/**
 * Qui inseriamo la sezione per il claim della registrazione
 */
get_template_part( 'section','claim');

/**
 * Sezione per il blog e gli eventi
 */

get_template_part( 'section','blog-event');
?>
<?php get_footer(); ?>
