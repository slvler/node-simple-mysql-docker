<?php
class Language_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function all_languages()
	{
  		$this->db->select('*');
  		$sorgu = $this->db->get('language');
  		return $sorgu->result();
    }
	
    public function lang_transform($name)
	{
		$this->db->select('*');
		$this->db->where('name',$name);
		$record = $this->db->get('static_lang');
		return $record->row();
    }
}