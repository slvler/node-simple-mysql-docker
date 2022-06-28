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
		$records = $this->db->get('promotion');
		return $records->result();
	}
	
	public function page()
	{
		$this->db->select('*');
		$this->db->where('lang',$this->data["default_lang"]->lang);
		$records = $this->db->get('promotion');
		return $records->result();
	}

	public function add_record($post, $lang, $lang_id)
	{
		$date = explode("-", $post['date']);
		$start_date = date("Y-m-d", strtotime(@$date[0]));
		$end_date = date("Y-m-d", strtotime(@$date[1]));
		$this->db->set('title', $post['title']);
		$this->db->set('price', $post['price']);
		$this->db->set('list_img', img_upload($lang."_list_img", "promotion"));
		$this->db->set('start_date', @$start_date);
		$this->db->set('end_date', @$end_date);
		$this->db->set('price', @$post['price']);
		$this->db->set('content', @$post['content']);
		$this->db->set('lang_id', $lang_id);
		$this->db->set('lang', $lang);
		$this->db->insert('promotion');
		$insert_id = $this->db->insert_id();
		
		do_url("promotion/index/".$this->db->insert_id(), $post['title'], $lang);

		return $insert_id;
	}

	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('promotion',$data);
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('promotion');
		return $records->row();
	}

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('promotion');
		
		return true;
	}

	public function edit_record($id, $post, $lang)
	{
		// Url boş gelmiş ise başlığı al
		if($post['url'] == NULL){ $url = do_url("promotion/index/".$id, $post['title'], $lang); }
		// Url değiştirilmiş ise yeni urlyi al
		elseif($post['url'] != $post['oldurl']){ $url = do_url("promotion/index/".$id, $post['url'], $lang); }
		
		$date = explode("-", $post['date']);
		$start_date = date("Y-m-d", strtotime(@$date[0]));
		$end_date = date("Y-m-d", strtotime(@$date[1]));
		$data = array(
			'title' 		=>	  $post['title'],
			'price' 		=>	  $post['price'],
			'start_date' 	=>	  $start_date,
			'end_date'		=>	  $end_date,
			'price'			=>	  $post['price'],
			'content'		=>	  $post['content']
			);
		if(!empty($_FILES[$lang.'_list_img']['tmp_name'])){ $data['list_img'] = img_upload($lang.'_list_img', "promotion"); }

		$this->db->where('id',$id);
		$records = $this->db->update('promotion',$data);
		return true;
	}
	
}