<?php
class admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}

	public function all_records()
	{
		$this->db->select('*');
		$records = $this->db->get('slider');
		return $records->result();
	}
	
	public function page()
	{
		$this->db->select('*');
		$this->db->where('lang',$this->data["default_lang"]->lang);
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('slider');
		return $records->result();
	}

	public function add_record($post, $lang, $lang_id)
	{
		if($_FILES[$lang."_media"]["name"] != "" || $_FILES[$lang."_media_mobile"]["name"] != ""){
			if ($this->input->post($lang.'[type]') == 'image') {
				$this->db->set('media', img_upload($lang."_media", "slider"));
				$this->db->set('media_mobile', img_upload($lang."_media_mobile", "slider"));
			}
			else{
				$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Seçtiğiniz tip ve yüklediğiniz medya aynı değil.");
				redirect('/slider/admin/index/', 'refresh');
			}
		}else{
			if ($this->input->post($lang.'[type]') == 'video') {
				$this->db->set('media', $post['video']);
				$this->db->set('video_type', $post['video_type']);
			}else{
				$this->session->set_flashdata("error_message", "Kayıt işlemi başarısız! Seçtiğiniz tip ve yüklediğiniz medya aynı değil.");
				redirect('/slider/admin/index/', 'refresh');
			}
		}
		$this->db->set('type', $post['type']);
		$this->db->set('title', $post['title']);
		$this->db->set('description', $post['description']);
		$this->db->set('btn_name', $post['btn_name']);
		$this->db->set('link', $post['link']);
		$this->db->set('lang_id', $lang_id);
		$this->db->set('lang', $lang);
		$this->db->insert('slider');
		return true;
	}

	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('slider',$data);
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('slider');
		return $records->row();
	}

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('slider');
		
		return true;
	}

	public function edit_record($id, $post, $lang)
	{
		$data = array(
			'type' 			=>	  $post['type'],
			'title' 		=>	  $post['title'],
			'description' 	=>	  $post['description'],
			'btn_name' 		=>	  $post['btn_name'],
			'link' 			=>	  $post['link']
		);
		if($_FILES[$lang."_media"]["name"] != ""){
			if ($this->input->post($lang.'[type]') == 'image') {
				$data['media'] = img_upload($lang."_media", "slider");
			}
		}
		if($_FILES[$lang."_media_mobile"]["name"] != ""){
			if ($this->input->post($lang.'[type]') == 'image') {
				$data['media_mobile'] = img_upload($lang."_media_mobile", "slider");
			}
		}
		if ($post['type'] == 'video') {
			$data['media'] = $post['video'];
			$data['video_type'] = $post['video_type'];
		}

		$this->db->where('id',$id);
		$records = $this->db->update('slider',$data);
		return true;
	}

	public function update_order($id, $order)
	{
		$data = array( 'order' => $order );
		$this->db->where('id',$id);
		$records = $this->db->update('slider',$data);
	}
	
}