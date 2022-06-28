<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('menu')){
	function menu($id)
	{
		global $CI;
		$CI->load->model('menu/Menu_model');
		$menu_data = (array) $CI->Menu_model->page($id);
		foreach ($menu_data as $item){
			$item->child = menu(get_lang_id_record($item->id, "menu", $CI->data["default_lang"]->lang)->id);
		}
		// görseli olmayan içerik için default dil görseli getiriliyor.
		foreach($menu_data as &$item5){
			$item5->page_default = (array) $CI->Menu_model->page_default($item5->lang_id, $CI->data["default_lang"]->lang);
		}
		return $menu_data;
	}
}

if(!function_exists('menu_record')){
	function menu_record($id)
	{
		global $CI;
		$CI->load->model('menu/Menu_model');
		$menu = (array) $CI->Menu_model->record(get_lang_id_record($id, "menu", $CI->session->userdata('lang'))->id);
		return $menu;
	}
}