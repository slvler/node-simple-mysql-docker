<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}
	
    public function get_module_id($module)
	{
		$this->db->select('*');
		$this->db->where('module',$module);
		$sorgu = $this->db->get('page');
		return $sorgu->row();
    }
	
    public function record($id)
	{
		$this->db->select('*');
		$this->db->where('module','contact');
      	$this->db->where('id',$id);
		$sorgu = $this->db->get('page');
		return $sorgu->row();
    }
	
    public function post_records()
	{
		$this->db->select('*');
		$this->db->order_by("id desc");
		$sorgu = $this->db->get('contact');
		return $sorgu->result();
    }
	
    public function post_record($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$sorgu = $this->db->get('contact');
		return $sorgu->row();
    }

    public function post_delete_record($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('contact');
		
		return true;
    }
	
    public function page_add($post, $lang, $lang_id)
	{
		$this->db->set('module', "contact");
		$this->db->set('lang_id', $lang_id);
		$this->db->set('title', $post['title']);
		$this->db->set('header_img', img_upload($lang."_header_img", "page"));
		$this->db->set('list_img', img_upload($lang."_list_img", "page"));
		$this->db->set('summary', $post['summary']);
		$this->db->set('content', $post['content']);
		$this->db->set('description', $post['description']);
		$this->db->set('keywords', $post['keywords']);
		$this->db->set('updated_date', date("Y-m-d H-i-s"));
		$this->db->set('extra', json_encode($post["extra"]));
		$this->db->set('lang', $lang);
		$this->db->insert('page');
		
		do_url("contact/index/".$this->db->insert_id(), $post['title'], $lang);
		
		return $this->db->insert_id();
    }
	
    public function page_update($post, $lang)
	{
		// Url boş gelmiş ise başlığı al
		if($post['url'] == NULL){ $url = do_url("contact/index/".$post['id'], $post['title'], $lang); }
		// Url değiştirilmiş ise yeni urlyi al
		elseif($post['url'] != $post['oldurl']){ $url = do_url("contact/index/".$post['id'], $post['url'], $lang); }
		
		$data = array(
			'title' =>			$post['title'],
			'summary' =>		$post['summary'],
			'content' =>		$post['content'],
			'description' =>	$post['description'],
			'keywords' =>		$post['keywords'],
			'extra' =>			json_encode($post["extra"]),
			'updated_date' =>	date("Y-m-d H-i-s")
		);
		if(!empty($_FILES[$lang.'_header_img']['tmp_name'])){ $data['header_img'] = img_upload($lang.'_header_img', "page"); }
		if(!empty($_FILES[$lang.'_list_img']['tmp_name'])){ $data['list_img'] = img_upload($lang.'_list_img', "page"); }
			
		$this->db->where('module','contact');
		$this->db->where('lang',$lang);
		$records = $this->db->update('page',$data);
		return true;
    }
	
    public function delete_slider()
	{
		$data = array( 'slider' => '' );
		$this->db->where('module','contact');
      	$this->db->where('lang',$this->session->userdata('lang'));
		$records = $this->db->update('page',$data);
		return true;
    }
}