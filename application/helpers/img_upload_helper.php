<?php
if(!function_exists('img_upload')){
    function img_upload($input_name, $module_name)
	{
		if(@getimagesize($_FILES[$input_name]['tmp_name'])[0] > 2560 || @getimagesize($_FILES[$input_name]['tmp_name'])[1] > 2560){
			global $CI;
			$CI->session->set_flashdata("error_message", "Görsel boyutu nedeniyle yüklenmedi.");
			return NULL;
		}else{
			if(! file_exists("upload")){ mkdir("upload", 0777); }
			if(! file_exists("upload/".$module_name)){ mkdir("upload/".$module_name, 0777); }
			
			if(is_uploaded_file(@$_FILES[$input_name]['tmp_name'])){
				$config['upload_path'] =	'./upload/'.$module_name.'/';
				$config['allowed_types'] =	"jpg|jpeg|gif|png|svg";
				$config['file_name'] =		$module_name.'_'.date('Y-m-d_H-i-s');
				$config['overwrite'] =		FALSE;
				
				get_instance()->load->library('upload',$config);
				get_instance()->upload->do_upload($input_name);
				get_instance()->file_inf = $name = get_instance()->upload->data();

				return 'upload/'.$module_name.'/'.$name['file_name'];
			}else{
				return NULL;
			}
		}
    }
}