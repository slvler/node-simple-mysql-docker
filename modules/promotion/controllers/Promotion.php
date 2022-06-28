<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('promotion/Promotion_model');
		$this->load->model('content/Content_model');
	}
	
	public function index()
	{
		$url = explode("/", get_real_url($this->uri->uri_string));
		$this->data['page'] = (array) $this->Promotion_model->record($url[2]);
		$data = $this->Content_model->record(get_lang_id_record(18, "content", $this->session->userdata('lang'))->id);
		
		if(!empty ($this->data['page'])){
			// kayıt dilini aktif dil olarak belirliyor
			$this->session->set_userdata(array('lang'  => $this->data['page']['lang']));
			// $default_lang_record_id = get_lang_id_record($this->data['page']['id'], "promotion", $this->data["default_lang"]->lang)->id;
			
			$this->data['page']['parent'] = $data->parent;
			$this->data['page']['child'] = $this->Content_model->child(get_lang_id_record(18, "content", $this->session->userdata('lang'))->id);

			$this->load->view('promotion/index', $this->data);
		}else{
			redirect('404_override', 'refresh');
		}
	}

}