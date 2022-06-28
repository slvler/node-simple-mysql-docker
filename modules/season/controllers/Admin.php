<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('season/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("season")) { $this->migration->current(); }
		
		$this->data['page'] = (array) $this->Admin_model->page();

		$this->load->view('season/admin/admin', $this->data);
	}

	public function quota()
	{
		if ($_POST) {
			$season_id = $this->input->post("season_id");
			foreach ($this->input->post("quota") as $key => $row) {
				$quota_control = $this->Admin_model->quota_control($key, $season_id);
				if ($row) {
					if ($quota_control) {
						$this->Admin_model->update_quota($key, $row, $season_id);
					}else{
						$this->Admin_model->add_quota($key, $row, $season_id);
					}
				}
			}
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['page'] = (array) $this->Admin_model->record($id);

			$this->data['quota'] = (array) $this->Admin_model->get_quota($id);
			$this->load->view('season/admin/quota', $this->data);
		}
	}

	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		$this->Admin_model->change_active($id, $active);

		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect('/season/admin', 'refresh');
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
			redirect('/season/admin/index/', 'refresh');
		}else{
			$this->load->view('season/admin/add_record');
		}
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->delete_record($id);
		// Sezona ait stok bilgileri de siliniyor.
		$this->Admin_model->delete_quota($id);

		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/season/admin/index', 'refresh');
	}

	public function edit_record()
	{
		if($_POST){
			// Tarihin değişip değişmediğini kontrol ediyoruz. Değişim yapıldıysa sezona bağlı stok bilgileri silinecek.
			$date_control = $this->Admin_model->record($this->input->post("id"));
			
			if (date("m/d/Y", strtotime($date_control->start_date))." - ".date("m/d/Y", strtotime($date_control->end_date)) != $this->input->post("date")) {
				// Sezona ait stok bilgileri de siliniyor.
				$this->Admin_model->delete_quota($this->input->post("id"));
			}
			$this->Admin_model->edit_record($this->input->post("id"),$this->input->post());
			$this->session->set_flashdata("success_message", "Düzenleme işlemi başarılı!");
			
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$id = (int)($this->uri->segment(4));
			
			$this->data['page'] = (array) $this->Admin_model->record($id);
			
			$this->load->view('season/admin/edit_record', $this->data);
		}
	}

}