<?php
class Settings_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function settings()
	{
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$sorgu = $this->db->get('settings');
		return $sorgu->row();
    }
}
?>