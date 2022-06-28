<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configure
{
	public function __construct()
	{
		$CI =& get_instance();
		
		require_once(BASEPATH.'database/DB'.EXT);
		$db =& DB();
		
		if ($db->table_exists('language')) {
			$CI->data['default_lang'] = default_lang();
			$CI->data['all_languages'] = all_languages();
			$CI->data['all_modules'] = array_values(array_diff(scandir(FCPATH."modules"), array('.', '..')));
			
			// Lang sessionu yoksa oluşturup içine default dili tanımlıyor
			if($CI->session->userdata('lang') == false){
				foreach($CI->data['all_languages'] as $item){
					if($item->default == 1){
						$CI->session->set_userdata(array('lang'  => $item->lang));
					}
				}
			}
			
			// Kullanıcı yönetim panelinde değil ise cache tut
			if(settings("page_cache") == 1 && $CI->uri->segment(1) != "admin" && $CI->uri->segment(2) != "admin"){
				$CI->output->cache(1440);
			}
		}
	}
}