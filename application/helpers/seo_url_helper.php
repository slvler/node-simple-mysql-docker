<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'third_party/JTransliteration/JTransliteration.php';

if(!function_exists('do_url')){
    function do_url($real_url, $seo_url, $lang)
	{
		$seo_url = text_to_url($seo_url);
		
		global $CI;
		$CI->load->model('Routes_model');
		$all_routes = $CI->Routes_model->all_routes();
		
		// Tüm routes tablosunu kontrol ediyor aynı urlden daha önce varsa yanına sayı ekleyip deniyor
		$seo_url_check = url_check($all_routes, $seo_url);
		if($seo_url_check == 0){
			for ($i = 2; ; $i++) {
				$control = url_check($all_routes, $seo_url."-".$i);
				if($control == 1){ $seo_url = $seo_url."-".$i; break; }
			}
		}
		
		// Tüm routes tablosunu kontrol ediyor aynı kayıt daha önce varsa düzenliyor yoksa ekliyor
		$real_url_check = 1;
		foreach($all_routes as $item){
			if($item->real_url == $real_url){ $real_url_check = 0; }
		}
		if($real_url_check == 1){ $CI->Routes_model->add_record($real_url, $seo_url, $lang); }
		if($real_url_check == 0){ $CI->Routes_model->edit_record($real_url, $seo_url); }
		
		return TRUE;
    }
}

if(!function_exists('text_to_url')){
    function text_to_url($text)
	{
		// text değişkeni içerisindeki karakterleri temizleyip JTransliteration kullanarak url yapısına uygun hale getiriyor
		$text = JTransliteration::transliterate($text);
		
        $text = preg_replace("@[^a-z0-9/\//ig\-_şıüğçİŞĞÜÇ]+@i","-",$text);
        // $text = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i","-",$text);
        $text = str_replace(array("----","---","--"),"-",$text);
        $text = strtolower($text);
		$text = trim($text, "-");
		return $text;
    }
}

if(!function_exists('url_check')){
    function url_check($all_routes, $seo_url)
	{
		$seo_url_check = 1;
		foreach($all_routes as $item){
			if($item->seo_url == $seo_url){ $seo_url_check = 0; }
		}
		return $seo_url_check;
    }
}

if(!function_exists('delete_seo_url')){
	function delete_seo_url($real_url)
	{
		global $CI;
		$CI->load->model('Routes_model');
		return $CI->Routes_model->delete_seo_url_record($real_url);
	}
}

if(!function_exists('get_seo_url')){
	function get_seo_url($real_url)
	{
		global $CI;
		$CI->load->model('Routes_model');
		return $CI->Routes_model->get_seo_url_record($real_url)->seo_url;
	}
}

if(!function_exists('get_real_url')){
	function get_real_url($seo_url)
	{
		global $CI;
		$CI->load->model('Routes_model');
		return $CI->Routes_model->get_real_url_record($seo_url)->real_url;
	}
}