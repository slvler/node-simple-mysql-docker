<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact/Contact_model');
	}
	
	public function index()
	{
		if($_POST){
			$this->Contact_model->send_mail($this->input->post());
			$this->session->set_flashdata("success_message", "Mesajınız Gönderildi!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$url = explode("/", get_real_url($this->uri->segment(1)));
		$this->data['page'] = (array) $this->Contact_model->page($url[2]);
		$this->load->view('contact/index', $this->data);
	}

	public function newsletter()
	{
		if($_POST){
			$newsletter_control = $this->Contact_model->newsletter_control($this->input->post("email"));
			if ($newsletter_control) {
				$this->session->set_flashdata("error_message", "E-posta adresi ile daha önce kayıt olunmuş!");
			}else{
				$this->Contact_model->add_newsletter($this->input->post());
				$this->session->set_flashdata("success_message", "E-Bülten kaydınız başarıyla oluşturuldu!");
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function survey()
	{
		if($_POST){
			$this->Contact_model->add_survey($this->input->post());
			$this->session->set_flashdata("success_message", "Anketiniz başarıyla tamamlandı!");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}