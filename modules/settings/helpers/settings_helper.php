<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('settings')){
	function settings($value)
	{
		$CI =& get_instance();
		$CI->load->model('settings/Settings_model');
		$data = (array) $CI->Settings_model->settings();
		return $data[$value];
	}
}