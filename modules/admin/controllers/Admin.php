<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Admin_model');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("admin")) { $this->migration->current(); }
		// Lang sessionu oluşturup içine default dili tanımlıyor
		foreach(all_languages() as $item){
			if($item->default == 1){ $this->session->set_userdata(array('lang'  => $item->lang)); }
		}
		
		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('admin/home');
		}else{
			$this->load->view('admin/login');
		}
	}
	
	public function update_user()
	{
		if(isset($this->session->userdata['logged_in'])){
			if($this->session->userdata['logged_in']["power"] == "standart"){
				if($_POST){
					if($this->input->post("newpassword") == $this->input->post("newpassword2")){
						$user =			$this->session->userdata['logged_in']["user"];
						$oldpassword =	$this->input->post("oldpassword");
						$newpassword =	$this->input->post("newpassword");
						$newpassword2 =	$this->input->post("newpassword2");

						$users = $this->Admin_model->users();
						$control = 0;
						foreach ($users as $item){
							if(($item->user === $user) && ($item->password === md5($oldpassword))){
								$this->Admin_model->update_user($item->id, $newpassword);
								$control = 1;
							}
						}
						if ($control == 1){
							$sess_array = array(
								'username' => ''
							);
							$this->session->unset_userdata('logged_in', $sess_array);
							$this->session->set_flashdata("success_message", "Şifreniz başarı ile değiştirildi. Lütfen giriş yapınız.");
							redirect('/admin/login', 'refresh');
						}else{
							$this->session->set_flashdata("error_message", "Mevcut şifrenizi yanlış girdiniz.");
							redirect('/admin/update_user/', 'refresh');
						}
					}else{
						$this->session->set_flashdata("error_message", "Yeni şifrenizi kontrol ederek tekrar deneyiniz.");
						redirect('/admin/update_user/', 'refresh');
					}
				}else{
					$this->load->view('admin/update_user/update_user');
				}
			}elseif($this->session->userdata['logged_in']["power"] == "root"){
				$this->data['page'] = (array) $this->Admin_model->users();
				$this->load->view('admin/update_user/list', $this->data);
			}
		}else{
			redirect('/admin/login', 'refresh');
		}
	}

	public function add_user()
	{
		if($this->session->userdata['logged_in']["power"] == "root"){
			if($_POST){
				$update = $this->Admin_model->add_user($this->input->post());
				if($update){ $this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!"); }
				redirect('/admin/update_user/', 'refresh');
			}else{
				$this->load->view('admin/update_user/add_user');
			}
		}else{
			redirect('/admin/login', 'refresh');
		}
	}

	public function delete_user()
	{
		if($this->session->userdata['logged_in']["power"] == "root"){
			$id = (int)($this->uri->segment(3));
	
			$delete = $this->Admin_model->delete_user($id);
			if($delete){ $this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!"); }
			redirect('/admin/update_user/', 'refresh');
		}else{
			redirect('/admin/login', 'refresh');
		}
	}

	public function edit_user()
	{
		if($_POST){
			$id = (int)($this->uri->segment(3));
			$post = $this->input->post();
			
			$update = $this->Admin_model->edit_user($id, $post);
			if($update){ $this->session->set_flashdata("success_message", "Düzenleme başarılı!"); }
			redirect('/admin/update_user/', 'refresh');
		}else{
			$id = (int)($this->uri->segment(3));
			$this->data['page'] = (array) $this->Admin_model->user($id);
			
			$this->load->view('admin/update_user/edit_user', $this->data);
		}
	}

	public function clear_cache_files()
	{
		$this->load->helper('directory');
		foreach(directory_map('./application/cache/', FALSE, TRUE) as $cache_file){
			if($cache_file != "index.html"){
				unlink(APPPATH.'cache/'.$cache_file);
			}
		}
		
		delete_files('./_cache/', true);
		
		$this->session->set_flashdata("success_message", "Tüm cache dosyaları silindi.");
		redirect($_SERVER['HTTP_REFERER']);
	}
}