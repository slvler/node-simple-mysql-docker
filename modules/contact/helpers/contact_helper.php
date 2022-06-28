<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function contact_page(){
		global $CI;
		$CI->load->model('contact/contact_model');
		$data = (array) $CI->contact_model->page();
		return $data;
	}