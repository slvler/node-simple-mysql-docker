<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}
	
    public function page($id)
	{
		$this->db->select('*');
		$this->db->where('parent',$id);
      	$this->db->where('lang',$this->data["default_lang"]->lang);
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('menu');
		return $records->result();
    }
	
    public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('menu',$data);
    }
	
    public function add_record($id, $post, $lang, $lang_id)
	{
		$this->db->set('parent', $id);
		$this->db->set('lang_id', $lang_id);
		$this->db->set('list_img', img_upload($lang."_list_img", "menu"));
		$this->db->set('icon', $post['icon']);
		$this->db->set('title', $post['title']);
		$this->db->set('content', $post['content']);
		$this->db->set('url', $post['url']);
		$this->db->set('target', $post['target']);
		$this->db->set('lang', $lang);
		$this->db->insert('menu');
		
		return $this->db->insert_id();
    }
	
    public function delete_record($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('menu');
		
		return true;
    }
	
    public function delete_record_img($id, $value)
	{
		$data = array($value => '');
		$this->db->where('id',$id);
		$records = $this->db->update('menu',$data);
		return true;
    }
	
    public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$record = $this->db->get('menu');
		return $record->row();
    }
	
    public function edit_record($id, $post, $lang)
	{
		
		$data = array(
			'icon' =>			$post['icon'],
			'title' =>			$post['title'],
			'content' =>		$post['content'],
			'url' =>			$post['url'],
			'target' =>			$post['target']
		);
		if(!empty($_FILES[$lang.'_list_img']['tmp_name'])){ $data['list_img'] = img_upload($lang.'_list_img', "menu"); }
			
		$this->db->where('id',$id);
		$records = $this->db->update('menu',$data);
		return true;
    }
	
	public function subCount($parent, $lang)
	{
		$this->db->where('parent',$parent);
		$this->db->where('lang',$lang);
		$this->db->from('menu');
		$child = $this->db->count_all_results();
		return $child;
    }
	
    public function find_parent($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('menu');
		return $records->row();
    }
	
	public function update_order($id, $order)
	{
		$data = array( 'order' => $order );
		$this->db->where('id',$id);
		$records = $this->db->update('menu',$data);
	}
}