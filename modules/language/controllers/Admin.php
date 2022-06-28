<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (@$this->session->userdata['logged_in']["power"] != "root") { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('language/Admin_model');
	}
	
	public function index()
	{
		if($_POST){
			// Static lang tablosunu boşaltıyor
			$this->Admin_model->truncate_static_lang();
			// Gelen verileri tek tek ekleme fonksiyonuna gönderiyor
			foreach($this->input->post("static_lang") as $item){
				$this->Admin_model->update_static_lang($item);
			}
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/language/admin', 'refresh');
		}
		$this->data['page'] = (array) $this->Admin_model->languages();
		$this->data['static_lang'] = (array) $this->Admin_model->static_lang();
		$this->load->view('language/admin/admin', $this->data);
	}
	
	public function add_record()
	{
		if($_POST){
			$update = $this->Admin_model->add_record($this->input->post());
			if($update){ $this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!"); }
			
			redirect('/language/admin', 'refresh');
		}else{		
			$this->load->view('language/admin/add_record');
		}
	}
	
	public function change_default()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->change_default($id);
		$this->session->set_flashdata("success_message", "Varsayılan dil değiştirildi!");
			
		redirect('/language/admin', 'refresh');
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		if($id > 0){
			$delete = $this->Admin_model->delete_record($id);
			if($delete){ $this->session->set_flashdata("success_message", "Silme işlemi başarılı!"); }
		}
		redirect('/language/admin', 'refresh');
	}
}