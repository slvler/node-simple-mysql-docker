<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_promotions')){
	function get_promotions()
	{
		global $CI;
		$CI->load->model('promotion/Promotion_model');
		$data = (array) $CI->Promotion_model->page();
		return $data;
	}
}