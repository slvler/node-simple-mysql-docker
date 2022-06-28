<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
	}
	
	public function index()
	{
		// Kullanıcı girişi kontrol ediliyor
		if(isset($this->session->userdata['logged_in'])){
			// Giriş yapılmış ise paneli kullanmaya devam ediyor
			redirect('/admin', 'refresh');
		}else{
			// Giriş yapılmamış ise post kontrol edilip login işlemleri yapılıyor
			if($_POST){
				$data = array(
					'user' =>		$this->input->post('user'),
					'password' =>	$this->input->post('password')
				);
				$result = $this->admin_model->login($data);
				if ($result != NULL) {
					$result = $this->admin_model->user($result);
					if ($result != false) {
						$session_data = array(
							'user' => $result->user,
							'power' => $result->power,
						);
						
						$this->session->set_userdata('logged_in', $session_data);
						redirect('/admin', 'refresh');
					}
				} else {
					$this->session->set_flashdata("error_message", "Hatalı kullanıcı adı & şifre kombinasyonu!");
					redirect('/admin/login', 'refresh');
				}
			}else{
				$this->load->view('admin/login');
			}
		}
	}
	
	public function logout()
	{
		$sess_array = array(
			'user' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		redirect('/admin', 'refresh');
	}
}