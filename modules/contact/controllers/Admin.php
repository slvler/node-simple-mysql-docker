<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('contact/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("contact")) { $this->migration->current(); }
		
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
			redirect('/contact/admin', 'refresh');
		}
		// Farklı dilleri bulabilmesi için idyi alıyor
		foreach(all_languages() as $item){ if($item->default == 1){ $id = $this->Admin_model->get_module_id("contact", $item->lang)->id; } }
		
		// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
		foreach(get_lang_id_records($id, "contact") as $item){
			$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
		}
		
		$this->data['post_records'] = (array) $this->Admin_model->post_records();
		$this->load->view('contact/admin/admin', $this->data);
	}
	
	public function record()
	{
		if($_POST){
			// cevap maili gidecek
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['record'] = (array) $this->Admin_model->post_record($id);
			$this->load->view('contact/admin/record', $this->data);
		}
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$delete = $this->Admin_model->post_delete_record($id);
		if($delete){
			$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		}
		redirect('/contact/admin', 'refresh');
	}
}