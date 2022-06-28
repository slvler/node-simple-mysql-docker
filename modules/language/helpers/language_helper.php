<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('all_languages')){
	function all_languages()
	{
		$CI =& get_instance();
		$CI->load->model('language/Language_model');
		$data = (array) $CI->Language_model->all_languages();
		return $data;
	}
}

if(!function_exists('default_lang')){
	function default_lang()
	{
		$CI =& get_instance();
		$CI->load->model('language/Language_model');
		foreach($CI->Language_model->all_languages() as $item){
			if($item->default == 1) {
				return $item;
			}
		}
		return false;
	}
}

if(!function_exists('get_lang_id_records')){
	function get_lang_id_records($id, $module)
	{
		$CI =& get_instance();
		$model_name = "Glirs_".$module."_model";
		$CI->load->model($module."/".ucwords($module)."_model",$model_name);
		$lang_id = $CI->$model_name->record($id)->lang_id;
		return $CI->$model_name->lang_id_records($lang_id);
	}
}

if(!function_exists('get_lang_id_record')){
	function get_lang_id_record($id, $module, $lang)
	{
		$CI =& get_instance();
		$model_name = "Glir_".$module."_model";
		$CI->load->model($module."/".ucwords($module)."_model",$model_name);
		$lang_id = $CI->$model_name->record($id)->lang_id;
		return $CI->$model_name->lang_id_record($lang_id, $lang);
	}
}

if(!function_exists('lang_transform')){
	function lang_transform($name)
	{
		$CI =& get_instance();
		$CI->load->model('language/Language_model');
		$data = $CI->Language_model->lang_transform($name);
		$data->values = (array) json_decode($data->values);
		return $data->values[$CI->session->userdata('lang')];
	}
}

// Dil parametre olarak gönderilebiliyor.
if(!function_exists('lang_trans')){
	function lang_trans($name,$lang)
	{
		$CI =& get_instance();
		$CI->load->model('language/Language_model');
		$data = $CI->Language_model->lang_transform($name);
		$data->values = (array) json_decode($data->values);
		return $data->values[$lang];
	}
}