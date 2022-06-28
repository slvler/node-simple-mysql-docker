<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('slider/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("slider")) { $this->migration->current(); }
		
		$this->data['page'] = (array) $this->Admin_model->page();

		$this->load->view('slider/admin/admin', $this->data);
	}

	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "slider") as $item){
			$this->Admin_model->change_active($item->id, $active);
		}
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect('/slider/admin', 'refresh');
	}
	
	public function add_record()
	{
		if($_POST){
			// Dillere göre tüm formları ayırarak görsel yada video girildi ise eklemek üzere modele gönderiyor
			foreach(all_languages() as $item){
				if($_FILES[$item->lang."_media"]["name"] != "" || $this->input->post($item->lang."[video]") != ""){
					$this->Admin_model->add_record($this->input->post()[$item->lang], $item->lang, md5(date('YmdHis')));
					if($item->default == 1){ $this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!"); }
				}else{
					if($item->default == 1){$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Boş alan bırakmayınız");}
				}
			}
			
			redirect('/slider/admin/index/', 'refresh');
		}else{
			$this->load->view('slider/admin/add_record');
		}
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "slider") as $item){
			$this->Admin_model->delete_record($item->id);
			// Yüklenen görselleri siliyor
			if ($item->type == "image") { @unlink($item->media); }
		}
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/slider/admin/index', 'refresh');
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
					if($_FILES[$item->lang."_media"]["name"] != "" || $this->input->post($item->lang."[video]") != ""){
						$this->Admin_model->add_record($this->input->post()[$item->lang], $item->lang, $this->input->post()["lang_id"]);
						$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
					}else{
						if($this->input->post($item->lang."[title]") != "") {
							$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Dil içeriği eklenemedi. Boş alan bırakmayınız");
						}
					}
				}
			}	
			
			redirect('/slider/admin/index/', 'refresh');
		}else{
			$id = (int)($this->uri->segment(4));
			
			// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
			foreach(get_lang_id_records($id, "slider") as $item){
				$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
			}
			
			$this->load->view('slider/admin/edit_record', $this->data);
		}
	}

	public function update_list()
	{
		$i = 1;
		foreach ($_GET['listItem'] as $item2){
            // Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
			foreach(get_lang_id_records($item2, "slider") as $item){
				$this->Admin_model->update_order($item->id, $i);
			}
			$i++;
		}
		$this->session->set_flashdata("success_message", "Yeniden sıralama işlemi başarılı!");
		redirect($_SERVER['HTTP_REFERER']);
	}

}