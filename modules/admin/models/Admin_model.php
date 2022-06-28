<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function login($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("user", $data['user']);
		$this->db->where("password", md5($data['password']));
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row()->id;
		} else {
			return NULL;
		}
    }
	
    public function users()
	{
  		$this->db->select('*');
  		$sorgu = $this->db->get('users');
  		return $sorgu->result();
    }
  
    public function user($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('users');
		return $sorgu->row();
    }
  
    public function update_user($id, $newpassword)
	{
		$data = array( 'password' => md5($newpassword));
		$this->db->where('id',$id);
		$this->db->update('users',$data);
    }

    public function delete_user($id)
	{    
		$this->db->where('id', $id);
		$this->db->delete('users');
		return true;
    }

    public function add_user($post)
	{  
		$this->db->set('user',$post['user']);
		$this->db->set('password',md5($post['password']));

		$this->db->insert('users');
		return true;
    }

    public function edit_user($id, $post)
	{
		$data = array('password' => md5($post['password']));

		$this->db->where('id',$id);
		$this->db->update('users',$data);

		return true;
    }
}