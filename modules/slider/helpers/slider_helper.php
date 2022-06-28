<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function slider(){
		global $CI;
		$CI->load->model('slider/Slider_model');
		$data = (array) $CI->Slider_model->page();
		return $data;
	}