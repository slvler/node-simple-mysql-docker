<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_contents')){
	function get_contents($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->child($id, $limit);
		return $data;
	}
}

if(!function_exists('get_content')){
	function get_content($id)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->subrecord($id);
		return $data;
	}
}

if(!function_exists('get_content_admin')){
	function get_content_admin($id)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->record($id);
		return $data;
	}
}

if(!function_exists('get_price_table')){
	function get_price_table($id, $lang)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->get_price_table($id, $lang);
		return $data;
	}
}

if(!function_exists('get_images')){
	function get_images($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->gallery_images($id, $limit);
		if (!$data) {
			$data = (array) $CI->Content_model->gallery_images(get_lang_id_record($id, "content", $CI->data["default_lang"]->lang)->id, $limit);
		}
		return $data;
	}
}

if(!function_exists('all_contents_for_menu')){
	function all_contents_for_menu($id, $lang)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		if($id > 0){
			$data = (array) $CI->Content_model->records_for_menu(get_lang_id_record($id, 'content', $CI->session->userdata('lang'))->id, $lang);
		}else{
			$data = (array) $CI->Content_model->records_for_menu($id, $lang);
		}
		return $data;
	}
}