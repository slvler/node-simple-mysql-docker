<?php class menu_model extends CI_Model
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
		$records = $this->db->get('menu');
		return $records->row();
	}
	
	public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('menu');
		return $records->result();
	}

	public function page($id = 0)
	{
		$this->db->select('*');
		$this->db->where('parent',$id);
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$this->db->order_by('order asc, id asc');
		$sorgu = $this->db->get('menu');
		return $sorgu->result();
	}

	public function page_default($lang_id,$lang)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$this->db->where('lang',$lang);
		$this->db->where('active',1);
		$sorgu = $this->db->get('menu');
		return $sorgu->row();
	}

	public function record($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('menu');
		return $sorgu->row();
	}
}