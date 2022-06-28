<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function languages()
	{
  		$this->db->select('*');
  		$sorgu = $this->db->get('language');
  		return $sorgu->result();
    }
	
    public function static_lang()
	{
  		$this->db->select('*');
  		$sorgu = $this->db->get('static_lang');
  		return $sorgu->result();
    }
	
    public function truncate_static_lang()
	{
  		$this->db->truncate('static_lang');
  		return true;
    }
	
    public function update_static_lang($item)
	{
		$this->db->set('name', text_to_url($item["name"]));
		$this->db->set('values', json_encode($item["values"]));
		$this->db->insert('static_lang');
		return true;
    }

    public function add_record($post)
	{  
		$this->db->set('lang',strtolower($post['lang']));
		$this->db->set('language',$post['language']);

		$this->db->insert('language');
		return true;
    }
	
    public function change_default($id)
	{
		$data = array('default' => 0);
		$this->db->update('language',$data);
		$this->set_default($id);
    }
	
    public function set_default($id)
	{		
		$data = array('default' => 1);
		$this->db->where('id',$id);
		$this->db->update('language',$data);
    }
	
    public function delete_record($id)
	{    
		$this->db->where('id', $id);
		$this->db->delete('language');
		return true;
    }
}
?>