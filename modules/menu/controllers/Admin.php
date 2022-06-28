<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('menu/Admin_model');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("menu")) { $this->migration->current(); }
		
		$id = (int)($this->uri->segment(4));
		
		$this->data['page'] = (array) $this->Admin_model->page($id);
		foreach ($this->data['page'] as $item){
			$item->child = $this->Admin_model->subCount($item->id, $item->lang);
		};
		$this->load->view('menu/admin/admin', $this->data);
	}
	
	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "menu") as $item){
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
				}
			}
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/menu/admin/index/'.$id, 'refresh');
		}else{
			// Modüllerden gelen içerik listesini ekliyor
			$this->load->helper("content/content");
			foreach(all_languages() as $item){
				$this->data['modules']["content"][$item->lang] = $this->build_tree(all_contents_for_menu(0, $item->lang), "content");
			}
			
			$this->load->view('menu/admin/add_record', $this->data);
		}
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
						$this->Admin_model->edit_record($this->input->post()[$item->lang]["id"], $this->input->post()[$item->lang], $item->lang);
					}else{
						// Dilin içeriği daha önce eklenmemiş ise modele gönderip ekletiyor
						$add_id = $this->Admin_model->add_record($this->input->post()["parent"], $this->input->post()[$item->lang], $item->lang, $this->input->post()["lang_id"]);
					}
				}
			}
			
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('menu/admin/edit_record/'.$id, 'refresh');
		}else{
			$id = (int)($this->uri->segment(4));
			
			// Modüllerden gelen içerik listesini ekliyor
			$this->load->helper("content/content");
			foreach(all_languages() as $item){
				$this->data['modules']["content"][$item->lang] = $this->build_tree(all_contents_for_menu(0, $item->lang), "content");
			}
			
			// Seçilen kaydın farklı dillerini bulup onların bilgilerini de getiriyor
			foreach(get_lang_id_records($id, "menu") as $item){			
				$this->data['page'][$item->lang] = (array) $this->Admin_model->record($item->id);
			}
			
			$this->load->view('menu/admin/edit_record', $this->data);
		}
	}
	
	public function delete_record_img()
	{
		$id = (int)($this->uri->segment(5));
		$value = $this->uri->segment(4);
		@unlink($this->Admin_model->record($id)->$value);
		$this->Admin_model->delete_record_img($id, $value);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/menu/admin/edit_record/'.$id, 'refresh');
	}
	
	public function build_tree($array, $module, $i = 0)
	{
		$export = "";
		foreach($array as $item){
			$tree = "";
			for($k=1; $k<=$i; $k++){
				$tree .= "- ";
			}
			if(@$item->title != NULL){				
				$export .= '<option value="'.@get_seo_url($module."/index/".$item->id).'">'.$tree." ".$item->title.'</option>';
			}
			
			if(count(@$item->child) > 0){
				$j = $i + 1;
				$export .= $this->build_tree($item->child, $module, $j);
			}
		}
		return $export;
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		$find_parent = (array) $this->Admin_model->find_parent($id);
		
		// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
		foreach(get_lang_id_records($id, "menu") as $item){
			$this->Admin_model->delete_record($item->id);
			// Yüklenen görselleri siliyor
			@unlink($item->list_img);
		}
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/menu/admin/index/'.$find_parent['parent'], 'refresh');
	}

	public function update_list()
	{
		$i = 1;
		foreach ($_GET['listItem'] as $item2){
			// Seçilen kaydın farklı dillerini bulup aynı işlemi onlar için de uyguluyor
			foreach(get_lang_id_records($item2, "menu") as $item){
				$this->Admin_model->update_order($item->id, $i);
			}
			$i++;
		}
		$this->session->set_flashdata("success_message", "Yeniden sıralama işlemi başarılı!");
		redirect($_SERVER['HTTP_REFERER']);
	}
}