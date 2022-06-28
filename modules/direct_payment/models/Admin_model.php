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
		$this->db->order_by('id desc');
		$records = $this->db->get('direct_payment');
		return $records->result();
	}
	
	public function page()
	{
		$this->db->select('*');
		$this->db->order_by('id desc');
		$records = $this->db->get('direct_payment');
		return $records->result();
	}

	public function add_record($post)
	{
		$token = substr(md5(microtime()), 0,20);
		$this->db->set('price', @$post['price']);
		$this->db->set('fullname', @$post['fullname']);
		$this->db->set('email', @$post['email']);
		$this->db->set('installment', @$post['installment']);
		$this->db->set('language', @$post['language']);
		$this->db->set('currency', @$post['currency']);
		$this->db->set('description', @$post['description']);
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->set('token', $token);
		$this->db->insert('direct_payment');
		
		// $eb = 'Ödeme yapabilmek için aşağıdaki linke tıklayın. <br><br>'.site_url("reservation/direct_payment?token=".$token);

		if ($post['language']=="tr") {
			$payment_form = 'Ödeme Formu';
			$result_text = '<p>Merhaba,</p>

			<p>Rezervasyonunuz için teşekkür ederiz.</p>

			<p>Tesisimize yapmış olduğunuz rezervasyon ödemesini yapabilmek için lütfen aşağıdaki linke tıklayınız.</p>

			<p>İyi günler dileriz.</p>

			<a href="'.site_url("reservation/direct_payment?token=".$token).'"><strong>Ödeme Yapmak İçin Tıklayın</strong></a>';
		}else{
			$payment_form = 'Payment Form';
			$result_text = '<p>Hello,</p>

			<p>Thank you for your reservation.</p>

			<p>To make your reservation payment, please click on the link below.</p>

			<p>Best Regards.</p>

			<a href="'.site_url("reservation/direct_payment?token=".$token).'"><strong>Click to Pay</strong></a>';
		}

		$eb = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
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
			$this->email->to(@$post['email']);
			$this->email->subject(settings("title")." - ".$payment_form);
			$this->email->message($eb);
			
			return $this->email->send();
		}

		public function send_mail($post)
		{

			if ($post->language=="tr") {
				$payment_form = 'Ödeme Formu';
				$result_text = '<p>Merhaba,</p>

				<p>Rezervasyonunuz için teşekkür ederiz.</p>

				<p>Tesisimize yapmış olduğunuz rezervasyon ödemesini yapabilmek için lütfen aşağıdaki linke tıklayınız.</p>

				<p>İyi günler dileriz.</p>

				<a href="'.site_url("reservation/direct_payment?token=".$post->token).'"><strong>Ödeme Yapmak İçin Tıklayın</strong></a>';
			}else{
				$payment_form = 'Payment Form';
				$result_text = '<p>Hello,</p>

				<p>Thank you for your reservation.</p>

				<p>To make your reservation payment, please click on the link below.</p>

				<p>Best Regards.</p>

				<a href="'.site_url("reservation/direct_payment?token=".$post->token).'"><strong>Click to Pay</strong></a>';
			}

			$eb = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
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
				$this->email->to(@$post->email);
				$this->email->subject(settings("title")." - ".$payment_form);
				$this->email->message($eb);

				return $this->email->send();
			}

			public function record($id)
			{
				$this->db->select('*');
				$this->db->where('id',$id);
				$records = $this->db->get('direct_payment');
				return $records->row();
			}

			public function delete_record($id)
			{		
				$this->db->where('id', $id);
				$this->db->delete('direct_payment');
				return true;
			}

		}