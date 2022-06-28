<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_products')){
	function get_products($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('product/Product_model');
		$data = (array) $CI->Product_model->child($id, $limit);
		return $data;
	}
}

if(!function_exists('get_product')){
	function get_product($id)
	{
		global $CI;
		$CI->load->model('product/Product_model');
		$data = (array) $CI->Product_model->subrecord($id);
		return $data;
	}
}

if(!function_exists('get_images')){
	function get_images($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('product/Product_model');
		$data = (array) $CI->Product_model->gallery_images($id, $limit);
		if (!$data) {
			$data = (array) $CI->Product_model->gallery_images(get_lang_id_record($id, "product", $CI->data["default_lang"]->lang)->id, $limit);
		}
		return $data;
	}
}

if(!function_exists('all_products_for_menu')){
	function all_products_for_menu($id, $lang)
	{
		global $CI;
		$CI->load->model('product/Product_model');
		if($id > 0){
			$data = (array) $CI->Product_model->records_for_menu(get_lang_id_record($id, 'product', $CI->session->userdata('lang'))->id, $lang);
		}else{
			$data = (array) $CI->Product_model->records_for_menu($id, $lang);
		}
		return $data;
	}
}