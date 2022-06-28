<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('content/Content_model');
	}
	
	public function index()
	{
		$url = explode("/", get_real_url($this->uri->uri_string));
		$this->data['page'] = (array) $this->Content_model->record($url[2]);
		
		if(!empty ($this->data['page'])){
			// kayıt dilini aktif dil olarak belirliyor
			$this->session->set_userdata(array('lang'  => $this->data['page']['lang']));
			$default_lang_record_id = get_lang_id_record($this->data['page']['id'], "content", $this->data["default_lang"]->lang)->id;
			
			$this->data['page']['subCount'] = $this->Content_model->subCount($default_lang_record_id);
			$this->data['page']['child'] = $this->Content_model->child($default_lang_record_id);
			$this->data['page']['sibling'] = $this->Content_model->child($this->data['page']['parent']);
			$this->data['page']['gallery_images'] = $this->Content_model->gallery_images($this->data['page']['id']);
			// Dile ait galeri yoksa default dile ait sayfanın galerisi getiriliyor.
			if (!$this->data['page']['gallery_images']) {
				$this->data['page']['gallery_images'] = $this->Content_model->gallery_images(get_lang_id_record($this->data['page']['id'], "content", $this->data["default_lang"]->lang)->id);
			}
			
			// Üst içerikleri kontrol edip "parents" dizisine tanımlıyor
			$parent_id = $this->data['page']["id"];
			for ($i = 0; ; $i++) {
				$parent_id = @$this->Content_model->record($parent_id)->parent;
				if($parent_id > 0){
					// $parent = $this->Content_model->subrecord(get_lang_id_record($parent_id,'content',$this->session->userdata('lang'))->id);
					$parent = $this->Content_model->record($parent_id);
					$this->data['page']["parents"][$i]["id"] = $parent->id;
					$this->data['page']["parents"][$i]["title"] = $parent->title;
				}else{
					break;
				}
			}
			
			// Kontrol edip content/views/group klasöründe içeriğin sahip olduğu id ile dosya açılmış ise view olarak onu getiriyor yoksa standart olanı çağırıyor
			// id'si 5 olan bir içeriğin kullanım şekli:
			// - Bir içerik için: id5.php
			// - Tüm alt içerikleri için: parent5.php
			if (file_exists('modules/content/views/group/id'.$default_lang_record_id.'.php') == true){
				$this->load->view('content/group/id'.$default_lang_record_id, $this->data);
			}elseif (file_exists('modules/content/views/group/parent'.$this->data['page']['parent'].'.php') == true){
				$this->load->view('content/group/parent'.$this->data['page']['parent'], $this->data);
			}else{
				$this->load->view('content/index', $this->data);
			}
		}else{
			redirect('404_override', 'refresh');
		}
	}

	public function search(){
		
		$text = $this->input->get("text");
		$this->data['search'] = $this->Content_model->search($text);
		$this->data['page']['title'] = "Search: ".$text;
		$this->load->view('content/search', $this->data);

	}
}