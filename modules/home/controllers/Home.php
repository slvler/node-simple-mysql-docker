<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home/Home_model');
	}
	
	public function index()
	{
		if($this->uri->segment(1)){
			foreach($this->data["all_languages"] as $languages){
				if($languages->lang == $this->uri->segment(1)){
					$this->session->set_userdata(array('lang' => $languages->lang));
				}
			}
		}
		$this->data['page'] = (array) $this->Home_model->page();
		$this->load->view('home/home', $this->data);
	}

	public function sitemap()
	{
		$this->load->model('Routes_model');
		$this->data['page'] = $this->Routes_model->all_routes();

		header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view("sitemap", $this->data);
	}

	public function robots()
	{
		header("Content-type: text/plain");
		$txt = "";
		$txt .= "User-Agent: *\n";
		$txt .= "Allow: \n";
		$txt .= "\n";
		$txt .= "Sitemap: ".site_url("sitemap.xml");
		echo $txt;
	}

	public function page_missing()
	{
		$this->data['page']["title"] = "Sayfa Bulunamadı!";
		$this->load->view('home/404', $this->data);
	}
}