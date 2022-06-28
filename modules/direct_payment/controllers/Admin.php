<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('direct_payment/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("direct_payment")) { $this->migration->current(); }
		
		$this->data['page'] = (array) $this->Admin_model->page();

		$this->load->view('direct_payment/admin/admin', $this->data);
	}
	
	public function add_record()
	{
		if($_POST){
			if($this->input->post("email") != NULL){
				$this->Admin_model->add_record($this->input->post());
				$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			}else{
				$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Boş alan bırakmayınız");
			}
			redirect('/direct_payment/admin/index/', 'refresh');
		}else{
			$this->load->view('direct_payment/admin/add_record');
		}
	}

	public function send_mail($id)
	{
		$record = $this->Admin_model->record($id);
		if ($record) {
			$this->Admin_model->send_mail($record);
			$this->session->set_flashdata("success_message", "E-posta başarılı şekilde gönderildi!");
		}else{
			$this->session->set_flashdata("error_message", "Kullanıcı bulunamadı. Lütfen tekrar deneyin.");
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/direct_payment/admin/index', 'refresh');
	}

	public function record_view()
	{
		$id = (int)($this->uri->segment(4));

		$this->data['page'] = (array) $this->Admin_model->record($id);

		$this->load->view('direct_payment/admin/record', $this->data);
	}

}