<?php
class admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}

	public function all_records()
	{
		$this->db->select('*');
		$records = $this->db->get('season');
		return $records->result();
	}
	
	public function page()
	{
		$this->db->select('*');
		$records = $this->db->get('season');
		return $records->result();
	}

	public function add_record($post)
	{
		$date = explode("-", $post['date']);
		$start_date = date("Y-m-d", strtotime(@$date[0]));
		$end_date = date("Y-m-d", strtotime(@$date[1]));
		$this->db->set('title', $post['title']);
		$this->db->set('start_date', @$start_date);
		$this->db->set('end_date', @$end_date);
		$this->db->set('price', @$post['price']);
		$this->db->insert('season');
		return true;
	}

	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('season',$data);
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('season');
		return $records->row();
	}

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('season');
		
		return true;
	}

	public function delete_quota($season_id)
	{		
		$this->db->where('season_id', $season_id);
		$this->db->delete('season_quota');
		
		return true;
	}

	public function edit_record($id, $post)
	{
		
		$date = explode("-", $post['date']);
		$start_date = date("Y-m-d", strtotime(@$date[0]));
		$end_date = date("Y-m-d", strtotime(@$date[1]));
		$data = array(
			'title' 		=>	  $post['title'],
			'start_date' 	=>	  $start_date,
			'end_date'		=>	  $end_date,
			'price'			=>	  $post['price']
		);

		$this->db->where('id',$id);
		$records = $this->db->update('season',$data);
		return true;
	}

	public function get_quota($season_id)
	{
		$this->db->select('*');
		$this->db->where('season_id',$season_id);
		$records = $this->db->get('season_quota');
		return $records->result();
	}

	public function quota_control($title, $season_id)
	{
		$this->db->select('*');
		$this->db->where('title',$title);
		$this->db->where('season_id',$season_id);
		$records = $this->db->get('season_quota');
		return $records->row();
	}

	public function add_quota($title, $quota, $season_id)
	{
		$this->db->set('title', $title);
		$this->db->set('quota', $quota);
		$this->db->set('season_id', $season_id);
		$this->db->insert('season_quota');
		return true;
	}

	public function update_quota($title, $quota, $season_id)
	{

		$data = array(
			'quota' 		=>	  $quota
		);

		$this->db->where('title',$title);
		$this->db->where('season_id',$season_id);
		$records = $this->db->update('season_quota',$data);
		return true;
	}
	
}