<?php
class Content_model extends CI_Model
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
		$records = $this->db->get('content');
		return $records->row();
	}
	
	public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('content');
		return $records->result();
	}
	
	public function child($id, $limit = 0)
	{
		if ($limit > 0){ $this->db->limit($limit); }
		$this->db->select('*');
		$this->db->order_by('order asc, id asc');
		$this->db->where('parent',$id);
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->result();
	}

	public function get_price_table($id, $lang)
	{
		$this->db->select('*');
		$this->db->order_by('order asc, id asc');
		$this->db->where('parent',$id);
		$this->db->where('lang',$lang);
		$this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->result();
	}
	
	public function subCount($parent)
	{
		$this->db->where('parent',$parent);
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$this->db->from('content');
		$child = $this->db->count_all_results();
		return $child;
	}
	
	public function gallery_images($id, $limit = 0)
	{
		if ($limit > 0){ $this->db->limit($limit); }
		$this->db->select('*');
		$this->db->order_by('order asc, id asc');
		$this->db->where('parent',$id);
		$sorgu = $this->db->get('content_gallery');
		return $sorgu->result();
	}
	
	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		// $this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->row();
	}
	
	public function subrecord($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->row();
	}
	
	public function allrecords()
	{
		$this->db->select('*');
		$this->db->order_by('id asc');
		$this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->result();
	}
	
	public function records_for_menu($id, $lang)
	{
		$this->db->select('id');
		$this->db->where('parent',$id);
		$this->db->where('lang',$this->data["default_lang"]->lang);
		$this->db->where('active',1);
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('content')->result();
		
		// Kayıt varsa eğer olan kayıtların alt kayıtlarını kontrol etmek için tekrar fonsksiyona sokuyor
		if(count($records) > 0){
			foreach($records as &$item){
				$item2 = get_lang_id_record($item->id, "content", $lang);
				$childrecord = $this->records_for_menu($item->id, $lang);
				if(@$item2->title != NULL){
					if(count($childrecord) > 0){ $item2->child = $childrecord; }
					$item = $item2;
				}
			}
		}
		return $records;
	}

	public function search($text)
	{
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('active',1);
		$this->db->where("(title like '%".$text."%' OR content like '%".$text."%' OR extra like '%".$text."%')");
		$this->db->order_by('order asc, id asc');
		$records = $this->db->get('content')->result();
		
		return $records;
	}

	public function get_banks($id)
	{
		$this->db->select('*');
		$this->db->order_by('order asc, id asc');
		$this->db->where('parent',$id);
		$this->db->where('lang',$this->data["default_lang"]->lang);
		$this->db->where('active',1);
		$sorgu = $this->db->get('content');
		return $sorgu->result();
	}

}