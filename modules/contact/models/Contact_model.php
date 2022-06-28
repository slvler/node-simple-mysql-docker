<?php
class Contact_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function page()
	{
		$this->db->select('*');
		$this->db->where('lang',$this->session->userdata('lang'));
		$this->db->where('module','contact');
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
	
	public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('page');
		return $records->result();
	}

	public function send_mail($post)
	{
		$this->db->set('form',@$post['form']);
		$this->db->set('fullname',@$post['fullname']);
		$this->db->set('email',@$post['email']);
		$this->db->set('phone',@$post['phone_code']." ".@$post['phone']);
		$this->db->set('subject',@$post['subject']);
		$this->db->set('address',@$post['address']);
		$this->db->set('message',@$post['message']);
		$this->db->set('created_date', date("Y-m-d H:i:s"));
		$this->db->insert('contact');

		$eb = 'Aşağıdaki form '.date("d.m.Y").' tarihinde ve '.date("H:i").' saatinde site üzerinden '.$_SERVER['REMOTE_ADDR'].' IP adresindeki makineden gönderilmiştir.
		<table width="500" border="0" cellpadding="5" cellspacing="0">';
			if(isset($post['fullname'])){ $eb = $eb.
				'<tr>
				<td width="100px"><div align="left"><strong>Ad Soyad</strong></div></td>
				<td><div align="left">'.$post['fullname'].'</div></td>
			</tr>'; }
			if(isset($post['email'])){ $eb = $eb.
				'<tr>
				<td><div align="left"><strong>E-Mail</strong></div></td>
				<td><div align="left">'.$post['email'].'</div></td>
			</tr>'; }
			if(isset($post['phone'])){ $eb = $eb.
				'<tr>
				<td><div align="left"><strong>Telefon</strong></div></td>
				<td><div align="left">'.$post['phone_code']." ".$post['phone'].'</div></td>
			</tr>'; }
			if(isset($post['subject'])){ $eb = $eb.
				'<tr>
				<td><div align="left"><strong>Şehir</strong></div></td>
				<td><div align="left">'.$post['subject'].'</div></td>
			</tr>'; }
			if(isset($post['address'])){ $eb = $eb.
				'<tr>
				<td><div align="left"><strong>Adres</strong></div></td>
				<td><div align="left">'.$post['address'].'</div></td>
			</tr>'; }
			if(isset($post['message'])){ $eb = $eb.
				'<tr>
				<td valign="top"><div align="left"><strong>Mesaj</strong></div></td>
				<td><div align="left">'.$post['message'].'</div></td>
			</tr>'; }
			$eb = $eb.
			'</table>';
			
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => settings("smtp_host"),
				'smtp_port' => settings("smtp_port"),
				'smtp_user' => settings("smtp_user"),
				'smtp_pass' => settings("smtp_pass"),
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'wordwrap'  => TRUE
				);
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->initialize($config);
			$this->email->from($config['smtp_user'], settings("title"));
			$this->email->to(settings("smtp_to"));
			$this->email->subject(settings("title")." - İletişim formu");
			$this->email->message($eb);
			
			return $this->email->send();
		}

		public function newsletter_control($email)
		{
			$this->db->select('*');
			$this->db->where('form','E-bülten Formu');
			$this->db->where('email',$email);
			$sorgu = $this->db->get('contact');
			return $sorgu->row();
		}
		
		public function add_newsletter($post)
		{
			$this->db->set('form',@$post['form']);
			$this->db->set('email',@$post['email']);
			$this->db->set('created_date', date("Y-m-d H:i:s"));
			return $this->db->insert('contact');
		}

		public function add_survey($post)
		{
			$this->db->set('form',@$post['form']);
			$this->db->set('message',@json_encode($post));
			$this->db->set('created_date', date("Y-m-d H:i:s"));
			return $this->db->insert('contact');
		}
	}