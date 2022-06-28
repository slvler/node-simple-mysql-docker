<?php
class Promotion_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function lang_id_record($lang_id, $lang)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$this->db->where('lang',$lang);
		$records = $this->db->get('promotion');
		return $records->row();
	}

	public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('promotion');
		return $records->result();
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('promotion');
		return $records->row();
	}

	public function page()
	{  
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$this->db->order_by('start_date asc, id asc');
		$sorgu = $this->db->get('promotion');
		return $sorgu->result();
	}	
}
?>