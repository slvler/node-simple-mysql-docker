<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('language/Language_model');
	}

	public function index()
	{
		// Domaini çıkartıp linkin uzantısını modül ismini bulmak üzere fonksiyona gönderiyor
		$url = @get_real_url(str_replace(base_url(), "", $_SERVER['HTTP_REFERER']));
		$new_lang = @$this->input->get("lang");
		
		if($url != NULL){
			// Gelen değeri modül adı, fonksiyon adı ve id olarak bölmek üzere parçalıyor
			$url = explode("/", $url);

			// Id ve modül adını fonksiyona göndererek farklı dildeki versiyonlarını çekiyor
			$languages = get_lang_id_records($url[2], $url[0]);
			foreach($languages as $item){
				// Tüm dildeki içerikleri çeviriyor ve istenilen dil ile eşleştiğinde
				// - Sitenin genel dilini değiştiriyor
				// - Gelen adresin istenilen dildeki versiyonuna geri yönlendiriyor
				if($item->lang == $new_lang){
					$this->session->set_userdata(array('lang'  => $item->lang));
					redirect(get_seo_url($url[0]."/".$url[1]."/".$item->id), 'refresh');
				}
			}
			// Gelen içeriğin istenilen dilde karşılığı yok ise ana sayfaya yönlendiriyor
			$this->session->set_userdata(array('lang' => $new_lang));
			redirect("/".$new_lang, 'refresh');
		}else{
			$this->session->set_userdata(array('lang' => $new_lang));
			redirect("/".$new_lang, 'refresh');
		}
	}
}