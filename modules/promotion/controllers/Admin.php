<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('promotion/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("promotion")) { $this->migration->current(); }
		
		$this->data['page'] = (array) $this->Admin_model->page();

		$this->load->view('promotion/admin/admin', $this->data);
	}

	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "promotion") as $item){
			$this->Admin_model->change_active($item->id, $active);
		}
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect('/promotion/admin', 'refresh');
	}
	
	public function add_record()
	{
		if($_POST){
			// Dillere göre tüm formları ayırarak görsel yada video girildi ise eklemek üzere modele gönderiyor
			foreach(all_languages() as $item){
				if($this->input->post()[$item->lang]["title"] != NULL){
					$this->Admin_model->add_record($this->input->post()[$item->lang], $item->lang, md5(date('YmdHis')));
					if($item->default == 1){ $this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!"); }
				}else{
					if($item->default == 1){$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Boş alan bırakmayınız");}
				}
			}
			redirect('/promotion/admin/index/', 'refresh');
		}else{
			$this->load->view('promotion/admin/add_record');
		}
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "promotion") as $item){
			$this->Admin_model->delete_record($item->id);
		}
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/promotion/admin/index', 'refresh');
	}

	public function edit_record()
	{
		if($_POST){
			
			foreach(all_languages() as $item){
				if($this->input->post()[$item->lang]["id"] > 0) {
					// Dilin içeriği daha önce eklenmiş ise modele gönderip düzenletiyor
					$this->Admin_model->edit_record($this->input->post()[$item->lang]["id"],$this->input->post()[$item->lang], $item->lang);
					$this->session->set_flashdata("success_message", "Düzenleme işlemi başarılı!");
				}else{
					// Dilin içeriği daha önce eklenmemiş ise modele gönderip ekletiyor
					if($this->input->post()[$item->lang]["title"] != NULL){
						$this->Admin_model->add_record($this->input->post()[$item->lang], $item->lang, $this->input->post()["lang_id"]);
						$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
					}else{
						if($this->input->post($item->lang."[title]") != "") {
							$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Dil içeriği eklenemedi. Boş alan bırakmayınız");
						}
					}
				}
			}
			
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$id = (int)($this->uri->segment(4));
			
			// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
			foreach(get_lang_id_records($id, "promotion") as $item){
				$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
			}
			
			$this->load->view('promotion/admin/edit_record', $this->data);
		}
	}

}