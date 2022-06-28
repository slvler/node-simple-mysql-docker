<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('home/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("home")) { $this->migration->current(); }
		
		if($_POST){
			// Dillere göre tüm formları ayırarak başlık girildi ise düzenlemek üzere modele gönderiyor
			foreach(all_languages() as $item){
				if($this->input->post()[$item->lang]["title"] != NULL){
					if($this->input->post()[$item->lang]["id"] > 0){
						// Dilin içeriği daha önce eklenmiş ise modele gönderip düzenletiyor
						$this->Admin_model->page_update($this->input->post()[$item->lang], $item->lang);
					}else{
						// Dilin içeriği daha önce eklenmemiş ise modele gönderip ekletiyor
						$this->Admin_model->page_add($this->input->post()[$item->lang], $item->lang, $this->input->post()["lang_id"]);
					}
				}
			}
			
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/home/admin', 'refresh');
		}
		// Farklı dilleri bulabilmesi için idyi alıyor
		foreach(all_languages() as $item){ if($item->default == 1){ $id = $this->Admin_model->get_module_id("home", $item->lang)->id; } }
		
		// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
		foreach(get_lang_id_records($id, "home") as $item){
			$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
		}
		
		$this->load->view('home/admin/admin', $this->data);
	}
}