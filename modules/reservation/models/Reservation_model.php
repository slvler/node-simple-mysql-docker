<?php
class Reservation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
		$this->load->helper('doc_upload');
	}
	
	public function get_seasons($start_date,$end_date)
	{
		$this->db->select('*');
		$records = $this->db->get('season');
		return $records->result();
	}

	public function get_seasons_price($date)
	{
		$this->db->select('*');
		$this->db->where("start_date <=", $date);
		$this->db->where("end_date >=", $date);
		$records = $this->db->get('season');
		return $records->row();
	}

	public function quota_control($title,$season_id)
	{
		$this->db->select('*');
		$this->db->where("title", $title);
		$this->db->where("season_id", $season_id);
		$records = $this->db->get('season_quota');
		return $records->row();
	}
	
	public function token_control($token)
	{
		$this->db->select('*');
		$this->db->where("token", $token);
		$this->db->where("status", 0);
		$records = $this->db->get('direct_payment');
		return $records->row();
	}

	public function card_control($bin_number)
	{
		$this->db->select('*');
		$this->db->where("bin_number", $bin_number);
		$records = $this->db->get('cc_bins');
		return $records->row();
	}

	public function agency_code_control($code)
	{
		$this->db->select('*');
		$this->db->where("code", $code);
		$records = $this->db->get('agency');
		return $records->row();
	}

	public function add_reservation($post,$reserve_no)
	{
		$guest_rooms = $this->session->userdata("room_information")['guest_rooms'];
		$rooms_count = count($this->session->userdata("room_information")['guest_rooms']);
		// indirim tipini belirliyoruz.
		if ($post['discount_type'] == 1) {
			$discount_type = "Erken Rezervasyon İndirimi";
		}else{
			$discount_type = "Peşin Ödeme İndirimi";
		}
		// ödeme tipini belirliyoruz.
		if (@$post['pay_hotel'] == 1) {
			$pay_hotel = "Otelde Ödeme";
		}else{
			$pay_hotel = "Peşin Ödeme";
		}
		$this->db->set('reserve_no', @$reserve_no);
		$this->db->set('name', @$post['name']);
		$this->db->set('surname', @$post['surname']);
		$this->db->set('email', @$post['email']);
		$this->db->set('phone', @$post['phone_code']." ".@$post['phone']);
		$this->db->set('country', @$post['country']);
		$this->db->set('address', @$post['address']);
		$this->db->set('idno', @$post['idno']);
		$this->db->set('start_date', @$this->session->userdata("room_information")['start_date']);
		$this->db->set('end_date', @$this->session->userdata("room_information")['end_date']);
		$this->db->set('rooms_count', @$rooms_count);
		$this->db->set('guest_rooms', @json_encode($guest_rooms));
		$this->db->set('invoice', @json_encode($post['invoice']));
		$this->db->set('total_amount', @$post['total_amount']);
		$this->db->set('agency_code', @$post['agency_code']);
		$this->db->set('agency_price', @$post['agency_price']);
		$this->db->set('total_tax', @$post['total_tax']);
		$this->db->set('total_insurance', @$post['total_insurance']);
		$this->db->set('total_discount', @$post['total_discount']);
		$this->db->set('discount_type', @$discount_type);
		$this->db->set('total_price', @$post['total_price']);
		$this->db->set('pay_price', @$post['deposit_total']);
		$this->db->set('honeymoon', @$post['honeymoon']);
		$this->db->set('visitor', @json_encode($post['visitor']));
		$this->db->set('special_requests', @$post['special_requests']);
		// $this->db->set('bed', @$post['bed']);
		$this->db->set('pay_hotel', @$pay_hotel);
		$this->db->set('card_info', @json_encode($post['card_info']));
		$this->db->set('installment', @$post['installment']);
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->set('type', $post['reservation_type']);
		$this->db->set('language', @$this->session->userdata('lang'));
		$this->db->set('currency', "TL");
		$this->db->set('package_name', @$post['package_name']);
		$this->db->set('status', 'Rezervasyon tamamlanmadı');
		$this->db->insert('reservation');
		return true;
	}

	public function update_reservation($reserve_no)
	{		
		$data = array('status' => 'Rezervasyon tamamlandı');
		$this->db->where('reserve_no',$reserve_no);
		$this->db->update('reservation',$data);
	}

	public function update_reserve_bank_error($post,$reserve_no)
	{		
		$data = array('bank_error' => json_encode($post));
		$this->db->where('reserve_no',$reserve_no);
		$this->db->update('reservation',$data);
	}

	public function update_direct_payment($token)
	{		
		$data = array('status' => 1);
		$this->db->where('token',$token);
		$this->db->update('direct_payment',$data);
	}

	public function get_direct_payment($token)
	{
		$this->db->select('*');
		$this->db->where("token", $token);
		$records = $this->db->get('direct_payment');
		return $records->row();
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
		$file_name = $cancellation['title'];

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

	public function send_mail_direct_payment($data)
	{
		// e-postada iptal iade politikası gönderme işlemlerini yapıyoruz.

		// $content = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		// <style>body { font-family: DejaVu Sans; } </style>
		// </head><body><p>"Denizatı Holiday Village" a yaptığınız '.$data->price.' tutarındaki ödemeniz alınmıştır. Teşekkür ederiz </p></body>';

		if ($data->language=="tr") {
			$result_text = '"Denizatı Holiday Village" a yaptığınız '.$data->price." ".$data->currency.' tutarındaki ödemeniz alınmıştır. Teşekkür ederiz';
		}else{
			$result_text = 'Your payment '.$data->price." ".$data->currency.' to “ Denizatı Holiday Village” is recieved successfully. Thank you very much';
		}

		$content = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
			<title>Denizatı Holiday Village</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="x-apple-disable-message-reformatting" />
			<meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Tell iOS not to automatically link certain text strings. -->

			<style>
				html,body {margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;line-height:20px;border:0 !important;background-color:#ffffff;}
	        * {-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}
				div[style*="margin: 16px 0"] {
					margin:0 !important;
				}
				table,td {mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border: 0;}
				table {border-spacing: 0 !important;
					border-collapse: collapse !important;
					table-layout: fixed !important;
					margin: 0 auto !important;}
					table table table {table-layout: auto;}
					img,a img{border:0; outline:none; text-decoration:none;}
					h1,h2,h3,h4,h5,h6{margin:0; padding:0;}
					p{margin:1em 0; padding:0;}
					a{word-wrap:break-word;}
					img{-ms-interpolation-mode:bicubic;}
					body,table,td,p,a,li,blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;font-family:"Trebuchet MS",sans-serif;font-size:12px;font-weight: normal;line-height:20px;color:#000000;}

					a[x-apple-data-detectors],  /* iOS */
					.unstyle-auto-detected-links a,
					.aBn {
						border-bottom: 0 !important;
						cursor: default !important;
						color: inherit !important;
						text-decoration: none !important;
						font-size: inherit !important;
						font-family: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
					}
				</style>
				<meta name="robots" content="noindex,nofollow" />
			</head>

			<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#ffffff;height:100% !important;width:100% !important;">
				<table align="left" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse:collapse;padding:0;margin:0;border:0;background-color:#ffffff;height:100% !important;width:100% !important;">
					<tbody>
						<tr>
							<td align="center" valign="top" id="bodyCell" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;border-top-width:0;height:100% !important;width:100% !important;">
								<table border="0" cellpadding="0" cellspacing="0" width="718" id="templateContainer" style="border:1px solid #D8D8D8;">
									<tbody>
										<tr>
											<td align="left" valign="top" style="padding:0;margin:0;border:0;">
												<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
													<tbody>
														<tr>
															<td valign="center" style="padding-right:15px;padding-left:15px;padding-top:10px;padding-bottom:10px;">
																<a href="https://www.denizati-hv.com/" title="Denizatı Holiday Village" target="_blank" style="word-wrap:break-word;">
																	<img align="left" alt="Denizatı Holiday Village" src="'.site_url("assets/img/mail_logo.png").'" width="115" height="90" class="mImg" style="max-width:1150px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
																</a>
															</td>
															<td>
																<table align="left" width="320" border="0" cellpadding="0" cellspacing="0" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;line-height:20px;color:#000000 !important;border-collapse:collapse;padding:0;margin:0;border:0;">
																	<tbody>
																		<tr>
																			<td colspan="2" height="36" valign="center" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
																				<a href="" target="_blank" style="font-family:"Trebuchet MS",sans-serif;font-size:18px;font-weight: bold;line-height:20px;color:#000000 !important;text-decoration: none;display:inline-block;">
																					<span style="color:#000000 !important;font-weight: bold;line-height:20px;">DENİZATI HOLIDAY VILLAGE</span>
																				</a>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;line-height:20px;color:#545454 !important;">
																				<span style="color:#545454 !important;font-size:14px;font-weight: normal;line-height:20px;">Meryemana Cad. No:19 - 35480 Gümüldür/İzmir</span>
																			</td>
																		</tr>
																		<tr>
																			<td style="color:#545454 !important;font-size:14px;font-weight: normal;line-height:20px;">
																				<span style="color:#545454 !important;font-size:14px;font-weight: normal;line-height:20px;">Tel:</span>
																				<a href="tel:+90 232 798 91 91" target="_blank" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;line-height:24px;color:#545454 !important;text-decoration: none;display:inline-block;">
																					<span style="color:#545454 !important;font-size:14px;font-weight: normal;line-height:20px;">+90 232 798 91 91</span>
																				</a>
																			</td>
																			<td>
																				<a href="http://www.denizati-hv.com" target="_blank" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;line-height:24px;color:#545454 !important;text-decoration: none;display:inline-block;">
																					<span style="color:#545454 !important;font-size:14px;font-weight: normal;line-height:20px;">www.denizati-hv.com</span>
																				</a>
																			</td>
																		</tr>
																	</tbody>
																</table>    
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" style="padding:0;margin:0;border:0;">
												<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
													<tbody>
														<tr>
															<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
																<a href="https://www.denizati-hv.com/" title="Denizatı Holiday Village" target="_blank" style="word-wrap:break-word;">
																	<img align="left" alt="Denizatı Holiday Village" src="'.site_url("assets/img/mail_gallery_1.jpg").'" width="236" height="128" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
																</a>
															</td>
															<td valign="top" align="center" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
																<a href="https://www.denizati-hv.com/" title="Denizatı Holiday Village" target="_blank" style="word-wrap:break-word;">
																	<img align="center" alt="Denizatı Holiday Village" src="'.site_url("assets/img/mail_gallery_2.jpg").'" width="236" height="128" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
																</a>
															</td>
															<td valign="top" align="right" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
																<a href="https://www.denizati-hv.com/" title="Denizatı Holiday Village" target="_blank" style="word-wrap:break-word;">
																	<img align="right" alt="Denizatı Holiday Village" src="'.site_url("assets/img/mail_gallery_3.jpg").'" width="236" height="128" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
																</a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" style="padding:0;margin:0;border:0;">
												<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
													<tbody>
														<tr>
															<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
																'.$result_text.'
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>	
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</body>';

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
		$this->email->to($data->email);
		$this->email->subject(settings("title")." - Rezervasyon Ödeme Bildirimi");
		$this->email->message($content);
		$send = $this->email->send();
		$this->email->clear(TRUE);
		return $send;
	}

	public function send_mail_admin($text,$type)
	{
		if ($type == "Rezervasyon") {
			$content = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<style>body { font-family: DejaVu Sans; } </style>
			</head><body><p>'.$text.' numaralı rezervasyon için ödeme yapılmıştır.</p></body>';
			$title_type = "Rezervasyon Ödeme Bildirimi";
		}else{
			$content = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<style>body { font-family: DejaVu Sans; } </style>
			</head><body><p>'.@$text->fullname.' isimli kişiye '.@$text->email.' e-posta adresi için gönderilen ödeme linki için ödeme yapılmıştır.</p></body>';
			$title_type = "Direkt Ödeme Bildirimi";
		}

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
		$this->email->to(settings("payment_email"));
		$this->email->subject(settings("title")." - ".$title_type);
		$this->email->message($content);
		$send = $this->email->send();
		$this->email->clear(TRUE);
		return $send;
	}

}