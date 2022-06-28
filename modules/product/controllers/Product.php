<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product/Product_model');
	}
	
	public function index()
	{
		$url = explode("/", get_real_url($this->uri->uri_string));
		$this->data['page'] = (array) $this->Product_model->subrecord($url[2]);
		
		if(!empty ($this->data['page'])){
			// kayıt dilini aktif dil olarak belirliyor
			$this->session->set_userdata(array('lang'  => $this->data['page']['lang']));
			
			$default_lang_record = $this->Product_model->lang_id_record($this->data['page']["lang_id"], $this->data["default_lang"]->lang);
			
			$this->data['page']['subCount'] = $this->Product_model->subCount($this->data['page']['id']);
			$this->data['page']['sibling'] = $this->Product_model->child($default_lang_record->parent);
			$this->data['page']['gallery_images'] = $this->Product_model->gallery_images($this->data['page']['id']);
			
			
			$this->data['page']['child'] = $child = $this->Product_model->child($default_lang_record->id);;
			
			// Üst içerikleri kontrol edip "parents" dizisine tanımlıyor
			$parent_id = $default_lang_record->id;
			for ($i = 0; ; $i++) {
				$parent_id = @$this->Product_model->record($parent_id)->parent;
				if($parent_id > 0){
					// $parent = $this->Product_model->record(get_lang_id_record($parent_id,'product',$this->session->userdata('lang'))->id);
					$parent = $this->Product_model->record($parent_id);
					$parent = $this->Product_model->lang_id_record($parent->lang_id, $this->data['page']['lang']);
					$this->data['page']["parents"][$i]["id"] = @$parent->id;
					$this->data['page']["parents"][$i]["title"] = @$parent->title;
				}else{
					break;
				}
			}
			
			// Kontrol edip product/views/group klasöründe içeriğin sahip olduğu id ile dosya açılmış ise view olarak onu getiriyor yoksa standart olanı çağırıyor
			// id'si 5 olan bir içeriğin kullanım şekli:
			// - Bir içerik için: id5.php
			// - Tüm alt içerikleri için: parent5.php
			if (file_exists('modules/product/views/group/id'.$this->data['page']['id'].'.php') == true){
				$this->load->view('product/group/id'.$this->data['page']['id'], $this->data);
			}elseif (file_exists('modules/product/views/group/parent'.$this->data['page']['parent'].'.php') == true){
				$this->load->view('product/group/parent'.$this->data['page']['parent'], $this->data);
			}else{
				if($this->data['page']['page_type'] == "category"){
					$this->load->view('product/category', $this->data);
				}else{					
					$this->load->view('product/index', $this->data);
				}
			}
		}else{
			redirect('404_override', 'refresh');
		}
	}
	
}