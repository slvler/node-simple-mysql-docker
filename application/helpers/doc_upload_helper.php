<?php
if(!function_exists('doc_upload')){
    function doc_upload($input_name, $file_name)
	{
		if(! file_exists("upload")){ mkdir("upload", 0777); }
		if(! file_exists("upload/files")){ mkdir("upload/files", 0777); }
		
		if(!empty($_FILES[$input_name]['tmp_name'])){
			get_instance()->load->helper('seo_url');
			$config['upload_path'] =	'./upload/files/';
			$config['allowed_types'] =	"jpg|jpeg|gif|png|pdf|doc|docx";
			$config['file_name'] =		text_to_url($file_name).'_'.date('Y-m-d_H-i-s');
			$config['overwrite'] =		FALSE;
			
			get_instance()->load->library('upload',$config);
			get_instance()->upload->initialize($config);
			get_instance()->upload->do_upload($input_name);
			get_instance()->file_inf = $name = get_instance()->upload->data();

			return 'upload/files/'.$name['file_name'];
		}else{
			return '';
		}
    }
}