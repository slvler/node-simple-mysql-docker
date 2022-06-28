<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('settings/Admin_model');
	}
	
	public function index()
	{
		if($_POST){
			// Dillere göre tüm formları ayırarak modele gönderiyor
			foreach($this->data["all_languages"] as $item){
				foreach($_POST["general"] as $generalkey => $generalvalue){
					$_POST[$item->lang][$generalkey] = $generalvalue;
				}
				$update = $this->Admin_model->page_update($_POST[$item->lang], $item->lang);
			}
			
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/settings/admin/', 'refresh');
		}else{
			// Dillere göre döngüye sokarak tüm dillerin verilerini listeliyor
			foreach($this->data["all_languages"] as $item){
				$this->data['page'][$item->lang] = (array) $this->Admin_model->page($item->lang);
			}
			
			$this->load->view('settings/admin/admin', $this->data);
		}
	}
	
	public function record()
	{
		if($_POST){
			// cevap maili gidecek
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['record'] = (array) $this->admin_model->record($id);
			$this->load->view('contact/admin/record', $this->data);
		}
	}
	
	public function delete_record()
	{
		$this->admin_model->delete_record((int)($this->uri->segment(4)));
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		
		$this->load->view('settings/admin/admin', $this->data);
	}
}