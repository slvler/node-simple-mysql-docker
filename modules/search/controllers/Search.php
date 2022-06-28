<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('search/Search_model');
	}
	
	public function index()
	{
		
		if ($_GET) {

			$search_module = $this->Search_model->search_module()->search_module;

			$search_module = explode(",", $search_module);

			for ($i=0; $i < count($search_module) ; $i++) { 
				$this->data['search'][$i] = (array) $this->Search_model->search($this->input->get("search"),$search_module[$i]);
				$this->data['search'][$i]['module'] = $search_module[$i];
			}

			$this->load->view('search/search', $this->data);

		}else{

			redirect(base_url());

		}

	}

}