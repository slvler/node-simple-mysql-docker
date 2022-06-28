<?php
class Routes_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function all_routes()
	{
		$this->db->select('*');
		$query = $this->db->get('routes');
		return $query->result();
    }
	
    public function add_record($real_url, $seo_url, $lang)
	{
		$this->db->set('real_url', $real_url);
		$this->db->set('seo_url', $seo_url);
		$this->db->set('lang', $lang);
		$this->db->insert('routes');
		
		return true;
    }
	
    public function edit_record($real_url, $seo_url)
	{
		$data = array( 'seo_url' =>	$seo_url );
		$this->db->where('real_url',$real_url);
		$this->db->update('routes',$data);
		
		return true;
    }
	
    public function delete_seo_url_record($real_url)
	{
		$this->db->where('real_url', $real_url);
		$this->db->delete('routes');
		
		return true;
    }
	
    public function get_seo_url_record($real_url)
	{
		$this->db->select('*');
		$this->db->where('real_url',$real_url);
		$record = $this->db->get('routes');
		return $record->row();
    }
	
    public function get_real_url_record($seo_url)
	{
		$this->db->select('*');
		$this->db->where('seo_url',$seo_url);
		$record = $this->db->get('routes');
		return $record->row();
    }
}