<?php
if(! file_exists("../../../../../../../../upload"))			{ mkdir("../../../../../../../../upload", 0777); }
if(! file_exists("../../../../../../../../upload/article"))	{ mkdir("../../../../../../../../upload/article", 0777); }

$config['img_path'] = 'upload/article';
$config['upload_path'] = str_replace("\\", "/", realpath("../../../../../../../../".$config['img_path']));
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = 0;
$config['max_width'] = 0;
$config['max_height'] = 0;
$config['allow_resize'] = TRUE;
$config['encrypt_name'] = FALSE;
$config['overwrite'] = FALSE;
?>