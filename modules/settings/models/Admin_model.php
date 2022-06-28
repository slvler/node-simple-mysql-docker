<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}

	public function page($lang)
	{	  
		$this->db->select('*');
		$this->db->where('lang', $lang);
		$sorgu = $this->db->get('settings');
		return $sorgu->row();
	}

	public function page_update($post, $lang)
	{
		// Gelen dil ile settings tablosunda veri olup olmadığı kontrol ediliyor
		$control = $this->db->query("SELECT * FROM settings WHERE lang = '".$lang."'");
		if($control->num_rows() > 0){
			// Veri varsa düzenliyor
			$data = array(
				'title' =>					$post['title'],
				'description' =>			$post['description'],
				'keywords' =>				$post['keywords'],
				'google_analytics' =>		$post['google_analytics'],
				'yandex_metrica' =>			$post['yandex_metrica'],
				'social_facebook_url' =>	$post['social_facebook_url'],
				'social_instagram_url' =>	$post['social_instagram_url'],
				'social_twitter_url' =>		$post['social_twitter_url'],
				'social_youtube_url' =>		$post['social_youtube_url'],
				'social_googleplus_url' =>	$post['social_googleplus_url'],
				'social_linkedin_url' =>	$post['social_linkedin_url'],
				'social_pinterest_url' =>	$post['social_pinterest_url'],
				'page_cache' =>				(@$post['page_cache']) ? 1 : 0,
				'css_js_cache' =>			(@$post['css_js_cache']) ? 1 : 0,
				'footer_text' =>			$post['footer_text'],
				'room_limit' =>				$post['room_limit'],
				'booking_discount_rate' =>	$post['booking_discount_rate'],
				'promotion_booking_discount_rate' =>	$post['promotion_booking_discount_rate'],
				'advance_discount_rate' =>	$post['advance_discount_rate'],
				'currency' =>				$post['currency'],
				'tax' =>					$post['tax'],
				'insurance_price' =>		$post['insurance_price'],
				'deposit_percent' =>		$post['deposit_percent'],
				'number_of_installments' =>	$post['number_of_installments'],
				'payment_email' =>			$post['payment_email']
			);
			if(!empty($_FILES[$lang.'_logo']['tmp_name'])){ $data['logo'] = img_upload($lang.'_logo', "files"); }
			if(!empty($_FILES[$lang.'_logo2']['tmp_name'])){ $data['logo2'] = img_upload($lang.'_logo2', "files"); }
			if(@$post['smtp_host']){ $data['smtp_host'] = $post['smtp_host']; }
			if(@$post['smtp_port']){ $data['smtp_port'] = $post['smtp_port']; }
			if(@$post['smtp_user']){ $data['smtp_user'] = $post['smtp_user']; }
			if(@$post['smtp_pass']){ $data['smtp_pass'] = $post['smtp_pass']; }
			if(@$post['smtp_to']){ $data['smtp_to'] = $post['smtp_to']; }
			if(@$post['search_module']){ $data['search_module'] = json_encode(@$post['search_module']); }
			
			$this->db->where('lang',$lang);
			$this->db->update('settings',$data);
		}else{
			// Veri yoksa add fonksiyonuna gönderip ekletiyor
			$this->page_add($post, $lang);
		}
	}
	
    public function page_add($post, $lang)
	{
		$this->db->set('title', $post['title']);
		$this->db->set('description', $post['description']);
		$this->db->set('keywords', $post['keywords']);
		$this->db->set('google_analytics', $post['google_analytics']);
		$this->db->set('yandex_metrica', $post['yandex_metrica']);
		$this->db->set('smtp_host', $post['smtp_host']);
		$this->db->set('smtp_port', $post['smtp_port']);
		$this->db->set('smtp_user', $post['smtp_user']);
		$this->db->set('smtp_pass', $post['smtp_pass']);
		$this->db->set('smtp_to', $post['smtp_to']);
		$this->db->set('social_facebook_url', $post['social_facebook_url']);
		$this->db->set('social_instagram_url', $post['social_instagram_url']);
		$this->db->set('social_twitter_url', $post['social_twitter_url']);
		$this->db->set('social_youtube_url', $post['social_youtube_url']);
		$this->db->set('social_googleplus_url', $post['social_googleplus_url']);
		$this->db->set('social_linkedin_url', $post['social_linkedin_url']);
		$this->db->set('social_pinterest_url', $post['social_pinterest_url']);
		$this->db->set('footer_text', $post['footer_text']);
		$this->db->set('room_limit', $post['room_limit']);
		$this->db->set('booking_discount_rate', $post['booking_discount_rate']);
		$this->db->set('promotion_booking_discount_rate', $post['promotion_booking_discount_rate']);
		$this->db->set('advance_discount_rate', $post['advance_discount_rate']);
		$this->db->set('currency', $post['currency']);
		$this->db->set('tax', $post['tax']);
		$this->db->set('insurance_price', $post['insurance_price']);
		$this->db->set('deposit_percent', $post['deposit_percent']);
		$this->db->set('number_of_installments', $post['number_of_installments']);
		$this->db->set('payment_email', $post['payment_email']);
		$this->db->set('lang', $lang);
		
		if(!empty($_FILES['logo']['tmp_name'])){ $this->db->set('logo', img_upload('logo', "files")); }
		if(!empty($_FILES['logo2']['tmp_name'])){ $this->db->set('logo2', img_upload('logo2', "files")); }
		
		return $this->db->insert('settings');
    }
}
?>