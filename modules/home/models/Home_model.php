<?php
class Home_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function record($id)
	{
		$this->db->select('*');
		$this->db->where('module','home');
      	$this->db->where('id',$id);
		$sorgu = $this->db->get('page');
		return $sorgu->row();
    }
	
    public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('page');
		return $records->result();
    }
	
    public function page()
	{	  
  		$this->db->select('*');
  		$this->db->where('module','home');
    	$this->db->where('lang',$this->session->userdata('lang'));
  		$sorgu = $this->db->get('page');
  		return $sorgu->row();
    }
}