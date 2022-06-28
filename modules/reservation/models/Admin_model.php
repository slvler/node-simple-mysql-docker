<?php
class admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function page($per_page = 0, $page_number = 0,$status = "")
	{
		$this->db->select('*');
		$this->db->order_by('id desc');
		if($per_page > 0 || $page_number > 0){			
			$this->db->limit($per_page, $page_number);
		}
		if ($status != "") {
			$this->db->where("status",$status);
		}
		$records = $this->db->get('reservation');
		return $records->result();
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$records = $this->db->get('reservation');
		return $records->row();
	}
	
    public function record_filter($filters, $limit = 0)
	{
		if ($limit > 0){ $this->db->limit($limit); }

		$this->db->select('*');
		
		// filtreler
		if(@$filters["start_date"]){			
			$this->db->where("start_date >=", date("Y-m-d",strtotime(str_replace("/","-",$filters["start_date"]))));
		}
		if(@$filters["end_date"]){			
			$this->db->where("end_date <=", date("Y-m-d",strtotime(str_replace("/","-",$filters["end_date"]))));
		}
		
		if(@$filters["register_start_date"]){			
			$this->db->where("created_date >=", date("Y-m-d",strtotime(str_replace("/","-",$filters["register_start_date"])))." 00:00:00");
		}
		if(@$filters["register_end_date"]){			
			$this->db->where("created_date <=", date("Y-m-d",strtotime(str_replace("/","-",$filters["register_end_date"])))." 23:59:59");
		}

		$this->db->where("status !=","Rezervasyon tamamlanmadı");
		
		$this->db->order_by('id desc');
		$records = $this->db->get('reservation');
		return $records->result();
    }

	public function add_record($post)
	{
		$date = explode("-", $post['date']);
		$start_date = $date[0];
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = $date[1];
		$end_date = date("Y-m-d", strtotime($end_date));
		// Rezervasyon numarası oluşturuluyor.
		$reserve_no = "DEN".strtoupper(substr(md5(microtime()), 0,17));

		$this->db->set('reserve_no', @$reserve_no);
		$this->db->set('name', @$post['name']);
		$this->db->set('surname', @$post['surname']);
		$this->db->set('email', @$post['email']);
		$this->db->set('phone', @$post['phone']);
		$this->db->set('country', @$post['country']);
		$this->db->set('address', @$post['address']);
		$this->db->set('idno', @$post['idno']);
		$this->db->set('start_date', @$start_date);
		$this->db->set('end_date', @$end_date);
		$this->db->set('rooms_count', @count($post['guest_rooms']));
		$this->db->set('guest_rooms', @json_encode($post['guest_rooms']));
		$this->db->set('invoice', @json_encode($post['invoice']));
		$this->db->set('total_amount', @$post['total_amount']);
		$this->db->set('agency_code', @$post['agency_code']);
		$this->db->set('agency_price', @$post['agency_price']);
		$this->db->set('total_tax', @$post['total_tax']);
		$this->db->set('total_insurance', @$post['total_insurance']);
		$this->db->set('total_discount', @$post['total_discount']);
		$this->db->set('total_price', @$post['total_price']);
		$this->db->set('pay_price', @$post['pay_price']);
		$this->db->set('honeymoon', @$post['honeymoon']);
		$this->db->set('visitor', @json_encode($post['visitor']));
		$this->db->set('special_requests', @$post['special_requests']);
		// $this->db->set('bed', @$post['bed']);
		$this->db->set('voucher_not', @$post['voucher_not']);
		$this->db->set('voucher_footer_not', @$post['voucher_footer_not']);
		$this->db->set('pay_hotel', @$post['pay_hotel']);
		$this->db->set('card_info', @json_encode($post['card_info']));
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->set('type', $post['reservation_type']);
		$this->db->set('language', @$post['language']);
		$this->db->set('currency', @$post['currency']);
		$this->db->set('status', 'Panel rezervasyon');
		$this->db->insert('reservation');
		return true;
	}

	public function edit_record($id, $post)
	{
		$date = explode("-", $post['date']);
		$start_date = $date[0];
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = $date[1];
		$end_date = date("Y-m-d", strtotime($end_date));

		$data = array(
			'name' => @$post['name'],
			'surname' => @$post['surname'],
			'email' => @$post['email'],
			'phone' => @$post['phone'],
			'country' => @$post['country'],
			'address' => @$post['address'],
			'idno' => @$post['idno'],
			'start_date' => @$start_date,
			'end_date' => @$end_date,
			'rooms_count' => @count($post['guest_rooms']),
			'guest_rooms' => @json_encode($post['guest_rooms']),
			'invoice' => @json_encode($post['invoice']),
			'total_insurance' => @$post['total_insurance'],
			'total_price' => @$post['total_price'],
			'pay_price' => @$post['pay_price'],
			'honeymoon' => @$post['honeymoon'],
			'visitor' => @json_encode($post['visitor']),
			'special_requests' => @$post['special_requests'],
			'voucher_not' => @$post['voucher_not'],
			'voucher_footer_not' => @$post['voucher_footer_not'],
			'pay_hotel' => @$post['pay_hotel'],
			'language' => @$post['language'],
			'currency' => @$post['currency']
		);

		$this->db->where('id',$id);
		$records = $this->db->update('reservation',$data);
		return true;
	}

	public function send_mail_voucher($voucher,$email,$cancellation,$sales_contract,$reserve_no)
	{
		// e-postada iptal iade politikası gönderme işlemlerini yapıyoruz.
		$content = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style>body { font-family: DejaVu Sans; } </style>
		</head><body><h4 style="color: #a51a67;">'.$cancellation['title'].'</h4>';
		$content .= $cancellation['content'];
		// e-postada mesafeli satış sözleşmesi ilave ediyoruz.
		$content .= '<h4 style="color: #a51a67;">'.$sales_contract['title'].'</h4>';
		$content .= $sales_contract['content'];
		$content .= '</body></html>';
		$this->load->library('Pdf');
		$this->pdf->loadHtml($content);
		$this->pdf->setPaper('A4','portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		$file_name = get_seo_url("content/index/".$cancellation['id']);

		file_put_contents('upload/cancellation_pdf/'.$file_name.'_'.$reserve_no.'.pdf', $output);

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
		$this->email->from($config['smtp_user'], "Denizati Holiday Village - Voucher");
		$this->email->to($email);
		$this->email->subject("Denizati Holiday Village - Voucher");
		$this->email->message($voucher);
		$this->email->attach('upload/cancellation_pdf/'.$file_name.'_'.$reserve_no.'.pdf');
		$send = $this->email->send();
		$this->email->clear(TRUE);
		return $send;
	}

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('reservation');

		return true;
	}

	public function recCount($active = null)
	{
		$this->db->from('reservation');
		if(is_int($active)){
			$this->db->where('active', $active);
		}
		return $this->db->count_all_results();
	}

	public function search($text = null)
	{
		$this->db->select('*');
		$this->db->where("(name like '%".$text."%' OR surname like '%".$text."%' OR email like '%".$text."%' OR phone like '%".$text."%' OR address like '%".$text."%' OR reserve_no like '%".$text."%')");
		$this->db->order_by('id desc');
		$records = $this->db->get('reservation');
		return $records->result();
	}
}