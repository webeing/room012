<?php

/**
 * Galleria immagini
 */
class R012Gallery{
    /**
     * prendere tutte le immagini della galleria
     */
    public function r012_gallery( $post_id ){


        preg_match('/\[gallery.*ids=.(.*).\]/', get_post_meta( $post_id, 'r012_galleria_saved', true) , $ids);

        $array_ids = explode(",", $ids[1]);



            $array_image_id = "";
                foreach($array_ids as $array_id):
                        $array_image_id = $array_image_id . $array_id . ',';
                endforeach;
                $r012_value_galleria= '[gallery link="file" columns="5" ids="'.$array_image_id.'"]';

                echo do_shortcode( $r012_value_galleria );
    }

    /**
     * prima immagine
     */
    public function r012_get_first_image($post_id){
        $args = array(
            'numberposts' => 1,
            'order' => 'ASC',
            'post_mime_type' => 'image',
            'post_parent' => $post_id,
            'post_type' => 'attachment',
        );

        $attachments = get_children( $args );
        if ( ! is_array($attachments) )
            return false;
        else
            return array_shift($attachments);
    }




}
?>