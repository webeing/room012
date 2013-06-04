<?php
/**
 * upload file
 */
error_reporting(E_ALL);

include_once TEMPLATEPATH . "/inc/r012_utilities.php";
  $file = $_FILES['r012_immagine_modifica_project'];
  $name = $file["name"];


$file_handler = new R012Utility();

echo "entra";

  $uploaded_id = $file_handler->r012_upload_image($file, $name);
var_dump($uploaded_id);
  $image_attributes = wp_get_attachment_image_src( $uploaded_id );

var_dump($image_attributes);


?>
<html>
<head></head>
<body>Test</body>
</html>