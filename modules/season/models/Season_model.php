<?php
class Season_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('season');
		return $records->result();
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('season');
		return $records->row();
	}

	public function page()
	{  
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$sorgu = $this->db->get('season');
		return $sorgu->result();
	}	
}
?>