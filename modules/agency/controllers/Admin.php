<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('agency/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("agency")) { $this->migration->current(); }
		
		$this->data['page'] = (array) $this->Admin_model->page();

		$this->load->view('agency/admin/admin', $this->data);
	}
	
	public function add_record()
	{
		if($_POST){
			if($this->input->post("title") != NULL){
				$this->Admin_model->add_record($this->input->post());
				$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			}else{
				$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Boş alan bırakmayınız");
			}
			redirect('/agency/admin/index/', 'refresh');
		}else{
			$this->load->view('agency/admin/add_record');
		}
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/agency/admin/index', 'refresh');
	}

	public function edit_record()
	{
		if($_POST){
			$this->Admin_model->edit_record($this->input->post("id"),$this->input->post());
			$this->session->set_flashdata("success_message", "Düzenleme işlemi başarılı!");
			
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$id = (int)($this->uri->segment(4));

			$this->data['page'] = (array) $this->Admin_model->record($id);

			$this->load->view('agency/admin/edit_record', $this->data);
		}

	}

}