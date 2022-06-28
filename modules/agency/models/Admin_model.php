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
		$records = $this->db->get('agency');
		return $records->result();
	}
	
	public function page()
	{
		$this->db->select('*');
		$records = $this->db->get('agency');
		return $records->result();
	}

	public function add_record($post)
	{
		$this->db->set('title', @$post['title']);
		$this->db->set('discount', @$post['discount']);
		$this->db->set('code', @$post['code']);
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->insert('agency');
		return true;
	}

	public function edit_record($id, $post)
	{
		$data = array(
			'title' 		=>	  $post['title'],
			'discount' 		=>	  $post['discount'],
			'code' 		=>	  $post['code']
			);

		$this->db->where('id',$id);
		$records = $this->db->update('agency',$data);
		return true;
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('agency');
		return $records->row();
	}

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('agency');
		return true;
	}
	
}