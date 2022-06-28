<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function search(){
		global $CI;
		$CI->load->model('search/Search_model');
		$data = (array) $CI->Search_model->page();
		return $data;
	}