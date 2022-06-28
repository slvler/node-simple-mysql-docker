<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('all_members')){
	function all_members()
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_members();
		return $data;
	}
}