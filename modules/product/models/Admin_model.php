<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
		$this->load->helper('doc_upload');
	}
	
	public function page($id)
	{
		$this->db->select('*');
		$this->db->where('parent',$id);
		$this->db->where('lang',$this->data["default_lang"]->lang);
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('product');
		return $records->result();
	}
	
	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('product',$data);
	}
	
	public function add_record($id, $post, $lang, $lang_id)
	{
		$this->db->set('parent', $id);
		$this->db->set('lang_id', $lang_id);
		$this->db->set('title', $post['title']);
		$this->db->set('header_img', img_upload($lang."_header_img", "product_gallery"));
		$this->db->set('list_img', img_upload($lang."_list_img", "product_gallery"));
		$this->db->set('summary', $post['summary']);
		$this->db->set('content', $post['content']);
		$this->db->set('description', $post['description']);
		$this->db->set('keywords', $post['keywords']);
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->set('lang', $lang);
		$this->db->insert('product');
		$insert_id = $this->db->insert_id();
		
		do_url("product/index/".$insert_id, $post['title'], $lang);
		
		return $insert_id;
	}
	
	public function delete_record($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('product');
		
		return true;
	}

	public function lang_id_record($lang_id, $lang)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$this->db->where('lang',$lang);
		$records = $this->db->get('product');
		return $records->row();
	}
	
	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$record = $this->db->get('product');
		return $record->row();
	}
	
	public function edit_record($id, $post, $lang)
	{
		// Url boş gelmiş ise başlığı al
		if($post['url'] == NULL){ $url = do_url("product/index/".$id, $post['title'], $lang); }
		// Url değiştirilmiş ise yeni urlyi al
		elseif($post['url'] != $post['oldurl']){ $url = do_url("product/index/".$id, $post['url'], $lang); }
		
		$data = array(
			'title' =>			$post['title'],
			'summary' =>		$post['summary'],
			'content' =>		$post['content'],
			'extra' =>			json_encode($post["extra"]),
			'description' =>	$post['description'],
			'keywords' =>		$post['keywords'],
			'updated_date' =>	date("Y-m-d H-i-s")
			);
		if(!empty($_FILES[$lang.'_header_img']['tmp_name'])){ $data['header_img'] = img_upload($lang.'_header_img', "product_gallery"); }
		if(!empty($_FILES[$lang.'_list_img']['tmp_name'])){ $data['list_img'] = img_upload($lang.'_list_img', "product_gallery"); }
		
		$this->db->where('id',$id);
		$records = $this->db->update('product',$data);
		return true;
	}
	
	public function subCount($parent, $lang)
	{
		$this->db->where('parent',$parent);
		$this->db->where('lang',$lang);
		$this->db->from('product');
		$child = $this->db->count_all_results();
		return $child;
	}
	
	public function find_parent($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('product');
		return $records->row();
	}
	
	public function delete_record_img($id, $value)
	{
		$data = array($value => '');
		$this->db->where('id',$id);
		$records = $this->db->update('product',$data);
		return true;
	}
	
	public function update_order($id, $order)
	{
		$data = array( 'order' => $order );
		$this->db->where('id',$id);
		$this->db->update('product',$data);
		return true;
	}
	
	public function update_gallery_order($id, $order)
	{
		$data = array( 'order' => $order );
		$this->db->where('id',$id);
		$this->db->update('product_gallery',$data);
		return true;
	}
	
	public function gallery_images($id)
	{
		$this->db->select('*');
		$this->db->where('parent',$id);
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('product_gallery');
		return $records->result();
	}
	
	public function gallery_image($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$records = $this->db->get('product_gallery');
		return $records->row();
	}
	
	public function add_gallery_image($parent, $url)
	{
		if($url != NULL){
			$this->db->set('title', 'img_'.$parent);
			$this->db->set('content', '');
			$this->db->set('url', $url);
			$this->db->set('parent', $parent);
			$this->db->insert('product_gallery');
			return true;
		}else{
			return false;
		}
	}
	
	public function delete_gallery_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('product_gallery');
		return true;
	}
}