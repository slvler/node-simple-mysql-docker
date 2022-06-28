<?php
class Direct_payment_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('direct_payment');
		return $records->row();
	}

	public function page()
	{  
		$this->db->select('*');
		$sorgu = $this->db->get('direct_payment');
		return $sorgu->result();
	}	
}
?>