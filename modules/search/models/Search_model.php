<?php
class Search_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function search($text,$search_module)
	{  
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$this->db->where("(title like '%".$text."%' OR content like '%".$text."%' OR extra like '%".$text."%')");
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get($search_module)->result();
		
		return $records;
	}

	public function search_module()
	{
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$records = $this->db->get('settings');
		return $records->row();
	}
}
?>