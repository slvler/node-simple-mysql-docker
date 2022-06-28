<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('content/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("content")) { $this->migration->current(); }
		
		$id = (int)($this->uri->segment(4));
		
		$this->data['page'] = (array) $this->Admin_model->page($id);
		foreach ($this->data['page'] as $item){
			$item->child = $this->Admin_model->subCount($item->id, $item->lang);
		};
		$this->load->view('content/admin/admin', $this->data);
	}
	
	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "content") as $item){
			$this->Admin_model->change_active($item->id, $active);
		}
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function add_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			$new_lang_id = md5(date('YmdHis'));
			
			// Dillere göre tüm formları ayırarak başlık girildi ise eklemek üzere modele gönderiyor
			foreach(all_languages() as $item){
				if($this->input->post()[$item->lang]["title"] != NULL){					
					$add_id = $this->Admin_model->add_record($id, $this->input->post()[$item->lang], $item->lang, $new_lang_id);
					// Foto galeriye eklenen görselleri ekleme fonksiyonuna gönderiyor
					$this->add_gallery_image($add_id, $item->lang);
				}
			}
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/content/admin/index/'.$id, 'refresh');
		}else{
			$this->load->view('content/admin/add_record');
		}
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		$find_parent = (array) $this->Admin_model->find_parent($id);
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "content") as $item){
			// Content tablosundaki asıl veriyi siliyor
			$this->Admin_model->delete_record($item->id);
			// Routes tablosundaki linki siliyor
			delete_seo_url("content/index/".$item->id);
			// Yüklenen görselleri siliyor
			@unlink($item->header_img);
			@unlink($item->list_img);
			// Galerideki bağlı görselleri siliyor
			foreach($this->Admin_model->gallery_images($item->id) as $item){
				@unlink($item->url);
				$this->Admin_model->delete_gallery_image($item->id);
			}
		}
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/content/admin/index/'.$find_parent['parent'], 'refresh');
	}
	
	public function edit_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			
			// Dillere göre tüm formları ayırarak başlık girildi ise düzenlemek üzere modele gönderiyor
			foreach(all_languages() as $item){
				if($this->input->post()[$item->lang]["title"] != NULL){
					if($this->input->post()[$item->lang]["id"] > 0){
						// Dilin içeriği daha önce eklenmiş ise modele gönderip düzenletiyor
						$this->Admin_model->edit_record($this->input->post()[$item->lang]["id"], $this->input->post($item->lang, false), $item->lang);
						// Foto galeriye eklenen yeni görselleri ekleme fonksiyonuna gönderiyor
						$this->add_gallery_image($this->input->post()[$item->lang]["id"], $item->lang);
						// Foto galeride silinen görsel varsa silme fonksiyonuna gönderiyor
						if(@$this->input->post()["gallery_delete"]){
							foreach($this->input->post()["gallery_delete"] as $key => $value){
								@unlink($this->Admin_model->gallery_image($key)->url);
								$this->Admin_model->delete_gallery_image($key);
							}
						}
						// Foto galeri sıralamasını uyguluyor
						if(@$this->input->post()[$item->lang]["gallery_list_order"] != NULL){
							$this->gallery_update_list($this->input->post()[$item->lang]["gallery_list_order"]);
						}
					}else{
						// Dilin içeriği daha önce eklenmemiş ise modele gönderip ekletiyor
						$add_id = $this->Admin_model->add_record($this->input->post()["parent"], $this->input->post()[$item->lang], $item->lang, $this->input->post()["lang_id"]);
						// Foto galeriye eklenen görselleri ekleme fonksiyonuna gönderiyor
						$this->add_gallery_image($add_id, $item->lang);
					}
				}
			}
			
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('content/admin/edit_record/'.$id, 'refresh');
		}else{
			$id = (int)($this->uri->segment(4));
			
			// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
			foreach(get_lang_id_records($id, "content") as $item){				
				$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
				$this->data['page'][$item->lang]["gallery"] = (array) $this->Admin_model->gallery_images($item->id);
			}
			
			$this->load->view('content/admin/edit_record', $this->data);
		}
	}
	
	public function delete_record_img()
	{
		$id = (int)($this->uri->segment(5));
		$value = $this->uri->segment(4);
		@unlink($this->Admin_model->record($id)->$value);
		$this->Admin_model->delete_record_img($id, $value);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/content/admin/edit_record/'.$id, 'refresh');
	}

	public function update_list()
	{
		$i = 1;
		foreach ($_GET['listItem'] as $item2){
			// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
			foreach(get_lang_id_records($item2, "content") as $item){
				$this->Admin_model->update_order($item->id, $i);
			}
			$i++;
		}
		$this->session->set_flashdata("success_message", "Yeniden sıralama işlemi başarılı!");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function gallery_update_list($gallery_list_order)
	{
		$i = 1;
		parse_str($gallery_list_order, $gallery_list_order);
		foreach ($gallery_list_order["listItem"] as $item){
			$this->Admin_model->update_gallery_order($item, $i);
			$i++;
		}
		return true;
	}
	
	public function add_gallery_image($parent, $lang)
	{
	    $files = $_FILES;
	    $cpt = count(@$_FILES[$lang.'_gallery']['name']);
	    for($i=0; $i<$cpt; $i++){
	        $_FILES[$lang.'_gallery']['name']		= $files[$lang.'_gallery']['name'][$i];
	        $_FILES[$lang.'_gallery']['type']		= $files[$lang.'_gallery']['type'][$i];
	        $_FILES[$lang.'_gallery']['tmp_name']	= $files[$lang.'_gallery']['tmp_name'][$i];
	        $_FILES[$lang.'_gallery']['error']		= $files[$lang.'_gallery']['error'][$i];
	        $_FILES[$lang.'_gallery']['size']		= $files[$lang.'_gallery']['size'][$i];

			$this->Admin_model->add_gallery_image($parent, img_upload($lang.'_gallery', "gallery"));
	    }
	    
		return TRUE;
	}
}