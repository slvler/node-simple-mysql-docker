<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function voucher($post,$room_information,$reserve_no)
{
	$start_date = $room_information['start_date'];
	$end_date = $room_information['end_date'];
	$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
	$start_date = explode("-", $start_date);
	$end_date = explode("-", $end_date);
	$start_date = $start_date[2]." ".$tr_months[$start_date[1]-1]." ".$start_date[0];
	$end_date = $end_date[2]." ".$tr_months[$end_date[1]-1]." ".$end_date[0];
	$deposit_total = str_replace(",", "", $post['total_price']) - str_replace(",", "", $post['deposit_total']);
	// Fatura bilgileri ayrı girilmediyse kişi bilgilri
	if ($post['invoice']['name']=="") {
		$post['invoice']['name'] = $post['name'];
		$post['invoice']['surname'] = $post['surname'];
		$post['invoice']['phone'] = $post['phone_code']." ".$post['phone'];
		$post['invoice']['email'] = $post['email'];
		$post['invoice']['country'] = $post['country'];
		$post['invoice']['idno'] = $post['idno'];
		$post['invoice']['address'] = $post['address'];
	}
	if (@$post['return_insurance']) {
		$insurance_text = "İade Edilebilir";
	}else{
		$insurance_text = "İade Edilemez";
	}
	// Toplam kişi sayısı alınıyor.
	$guest_count = 0;
	foreach ($room_information['guest_rooms'] as $item) {
		$guest_count += $item['adult_count'];
		$guest_count += $item['child_count'];
	}
	
	$voucher = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
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
		<td align="center" valign="top" style="padding:15px;margin:0;border:0;">
		<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
		<tbody>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_transform("your_reservation_number").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$reserve_no.'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_transform("check_in_date").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$start_date.'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("check_out_date").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$end_date.'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("reservation_date").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.date("Y-m-d H-i-s").'</span>
		</td>
		</tr>';
		if (@$post['package_name']) {
			$voucher .= '
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("package_name").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['package_name'].'</span>
			</td>
			</tr>';
		}
		$voucher .= '</tbody>
		</table>    
		</td>
		<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("subtotal").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_amount'].' TL</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("total_discount").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_discount'].' TL</span>
		</td>
		</tr>';
		if (@$post['total_tax'] != "0.00") {
			$voucher .= '<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("accommodation_tax").' :</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_tax'].' TL</span>
			</td>
			</tr>';
		}
		$voucher .= '<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("insurance").' :</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_insurance'].' TL</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("total").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_price'].' TL</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("payment_type").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.(@$post['pay_hotel'] == 1 ? lang_transform("payment_at_the_hotel") : lang_transform("advance_payment")).'</span>
		</td>
		</tr>';
		if (@$post['pay_hotel']==1) {
			$voucher .= '
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("amount_paid").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format((str_replace(",", "", $post['total_price']) / 100) * settings("deposit_percent"),2).'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("amount_payable_at_he_hotel").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
			</td>
			</tr>';
		}
		$voucher .= '</tbody>
		</table>    
		</td>
		</tr>
		</tbody>
		</table>    
		</td>    
		</tr>
		<tr>
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("reservation_contact_information").'
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("name")." ".lang_transform("surname").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['name']." ".$post['surname'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("phone").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['phone_code']." ".$post['phone'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("email").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['email'].'</span>
		</td>
		</tr>
		</tbody>
		</table>    
		</td>
		<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("address").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['address'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("country").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['country'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("identification_number").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['idno'].'</span>
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
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("guest_information").'
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
		foreach ($post['visitor'] as $row) {
			$voucher .= '
			<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("name").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row['name'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("surname").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row['surname'].'</span>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>
			<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("gender").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row['gender'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("date_of_birth").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row['birthday'].'</span>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>
			</tr>
			</tbody>
			</table>';
		}
		$voucher .= '</td>    
		</tr>
		<tr>
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("invoice_information").'
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("name")." ".lang_transform("surname").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['name']." ".$post['invoice']['surname'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("phone").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['phone'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("email").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['email'].'</span>
		</td>
		</tr>
		</tbody>
		</table>    
		</td>
		<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("address").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['address'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("country").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['country'].'</span>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("identification_number").':</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['idno'].'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;font-weight: bold;line-height:20px;color:#000000;padding-right:0;padding-left:0;padding-top:15px;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.lang_transform("payment_information").'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:12px;font-weight: bold;padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.lang_transform("payment_method").': '.lang_transform("credit_card").'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:12px;padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("card_name").':</strong> '.$post['card_info']['cardname'].'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:12px;font-weight: bold;padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['card_info']['cardno'].'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:12px;font-weight: bold;padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.lang_transform("installment").': '.$post['installment'].'</span>
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
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("standart_room").' ('.$insurance_text.')
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style=";padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" width="240" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<img src="'.site_url("assets/img/mail_gallery_4.jpg").'" alt=""  width="239" height="171" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
		</td>
		<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
		<tbody>
		<tr>
		<td valign="top" align="left" width="120" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("number_of_guests").': '.$guest_count.'</strong></span>
		</td>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
		$i=1; foreach ($room_information['guest_rooms'] as $value) {
			$voucher .= '<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$i.'. Oda '.$value['adult_count'].' Yetişkin </span>';
			if ($value['child_count']>0) {
				$voucher .= '<span>+ '.$value['child_count'].'</span>';
				$j=0; foreach ($value['child_ages'] as $value2) {
					if ($j==0) {
						$voucher .= '<span> Çocuk '.$value2.' ve</span>';
					}else{
						$voucher .= '<span> '.$value2.' yaşında</span>';
					}
					$j++;
				}
			}
			$voucher .= '<br>';
			$i++;
		}
		$voucher .= '</td>
		</tr>
		<tr>
		<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("check_in_date").':</strong> '.$start_date.'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("check_out_date").' :</strong> '.$end_date.'</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("total").' :</strong> '.$post['total_price'].' TL</span>
		</td>
		</tr>
		<tr>
		<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("payment_type").' :</strong> '.(@$post['pay_hotel'] == 1 ? lang_transform("payment_at_the_hotel") : lang_transform("advance_payment")).'</span>
		</td>
		</tr>';
		if (@$post['pay_hotel']==1) {
			$voucher .= '
			<tr>
			<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("amount_paid").' :</strong> '.number_format((str_replace(",", "", $post['total_price']) / 100) * settings("deposit_percent"),2).'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_transform("amount_payable_at_he_hotel").':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
			</td>
			</tr>';
		}
		$voucher .= '</tbody>
		</table>    
		</td>
		</tr>
		</tbody>
		</table>    
		</td>    
		</tr>
		<tr>
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("special_requests").':
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<p style="line-height: 20px;">
		'.$post["special_requests"].'
		</p>
		</td>
		</tr>
		</tbody>
		</table>    
		</td>    
		</tr>
		<tr>
		<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
		'.lang_transform("explanation").':
		</div>
		</td>
		</tr>
		<tr>
		<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
		<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
		<tbody>
		<tr>
		<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
		<p style="line-height: 20px;">
		<strong>'.lang_transform("voucher_cancellation_title").':</strong>
		</p>
		<p style="line-height: 20px;">
		'.lang_transform("voucher_cancellation_text").'
		</p>
		<p style="line-height: 20px;">
		'.lang_transform("voucher_footer_text").'
		</p>
		<p style="line-height: 20px;">
		'.lang_transform("voucher_footer_text_2").'
		</p>
		<p style="line-height: 20px;">
		'.lang_transform("voucher_footer_text_3").'
		</p>
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
		</td>
		</tr>
		</tbody>
		</table>
		</body>  
		</html>
		';
		return $voucher;
	}

	function voucher_panel($post)
	{
		$start_date = $post['start_date'];
		$end_date = $post['end_date'];
		if (@$post['language'] == "tr") {
			$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		}else{
			$tr_months = array("January","February","March","April","May","June","July","August","September","October","November","December");
		}
		$start_date = explode("-", $start_date);
		$end_date = explode("-", $end_date);
		$start_date = $start_date[2]." ".$tr_months[$start_date[1]-1]." ".$start_date[0];
		$end_date = $end_date[2]." ".$tr_months[$end_date[1]-1]." ".$end_date[0];
		$post['guest_rooms'] = json_decode($post['guest_rooms']);
		$post['invoice'] = (array) json_decode($post['invoice']);
		$post['visitor'] = (array) json_decode($post['visitor']);
		$post['card_info'] = (array) json_decode($post['card_info']);
		$deposit_total = str_replace(",", "", $post['total_price']) - str_replace(",", "", $post['pay_price']);
		// Fatura bilgileri ayrı girilmediyse kişi bilgilri
		if ($post['invoice']['name']=="") {
			$post['invoice']['name'] = $post['name'];
			$post['invoice']['surname'] = $post['surname'];
			$post['invoice']['phone'] = $post['phone'];
			$post['invoice']['email'] = $post['email'];
			$post['invoice']['country'] = $post['country'];
			$post['invoice']['idno'] = $post['idno'];
			$post['invoice']['address'] = $post['address'];
		}
		// sigorta durumuna göre yazısı ayarlanıyor.
		if (@$post['return_insurance']) {
			$insurance_text = lang_trans("returnable",$post["language"]);
		}else{
			$insurance_text = lang_trans("irrevocable",$post["language"]);
		}
		// yatak tipine göre yazı dile çeviriliyor.
		if (@$post['bed'] == "Tekli") {
			$bed_text = lang_trans("singles",$post["language"]);
		}else{
			$bed_text = lang_trans("double_room",$post["language"]);
		}
		// Toplam kişi sayısı alınıyor.
		$guest_count = 0;
		foreach ($post['guest_rooms'] as $item) {
			$guest_count += $item->adult_count;
			$guest_count += $item->child_count;
		}
		$voucher = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
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
			<table style="display:block;margin-top: 50px !important;margin-bottom: 50px !important;">
			<tr>
			<td>'.@$post["voucher_not"].'</td>
			</tr>
			</table>
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
			<td align="center" valign="top" style="padding:15px;margin:0;border:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
			<tbody>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_trans("your_reservation_number",$post["language"]).' :</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$post['reserve_no'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_trans("check_in_date",$post["language"]).' :</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$start_date.'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_out_date",$post["language"]).' :</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$end_date.'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("reservation_date",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['created_date'].'</span>
			</td>
			</tr>';
			if (@$post['package_name']) {
				$voucher .= '
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("package_name",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['package_name'].'</span>
				</td>
				</tr>';
			}
			$voucher .= '</tbody>
			</table>    
			</td>
			<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>';
			if ($post['total_amount']) {
				$voucher.= '<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("subtotal",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_amount']." ".$post["currency"].'</span>
				</td>
				</tr>';
			}
			if ($post['total_discount']) {
				$voucher .='<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total_discount",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_discount']." ".$post["currency"].'</span>
				</td>
				</tr>';
			}
			if ($post['total_tax']) {
				$voucher .= '<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("accommodation_tax",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_tax']." ".$post["currency"].'</span>
				</td>
				</tr>';
			}
			if ($post['total_insurance']) {
				$voucher .= '<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("insurance",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_insurance']." ".$post["currency"].'</span>
				</td>
				</tr>';
			}
			$voucher .= '<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_price']." ".$post["currency"].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("payment_type",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.(@$post['pay_hotel'] == "Otelde Ödeme" ? lang_trans("payment_at_the_hotel",$post["language"]) : lang_trans("advance_payment",$post["language"])).'</span>
			</td>
			</tr>';
			if (@$post['pay_hotel']=="Otelde Ödeme") {
				$voucher .= '
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_paid",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post["pay_price"].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_payable_at_he_hotel",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
				</td>
				</tr>';
			}
			$voucher .= '</tbody>
			</table>    
			</td>
			</tr>
			</tbody>
			</table>    
			</td>    
			</tr>
			<tr>
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("reservation_contact_information",$post["language"]).'
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"])." ".lang_trans("surname",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['name']." ".$post['surname'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("phone",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['phone'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("email",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['email'].'</span>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>
			<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("address",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['address'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("country",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['country'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("identification_number",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['idno'].'</span>
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
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("guest_information",$post["language"]).'
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
			foreach ($post['visitor'] as $row) {
				// cinsiyete göre yazı dile çeviriliyor.
				if (@$row->gender == "Kadın") {
					$gender_text = lang_trans("woman",$post["language"]);
				}elseif(@$row->gender == "Erkek"){
					$gender_text = lang_trans("man",$post["language"]);
				}else{
					$gender_text = lang_trans("unspecified",$post["language"]);
				}
				$voucher .= '
				<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->name.'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("surname",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->surname.'</span>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>
				<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("gender",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$gender_text.'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("date_of_birth",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->birthday.'</span>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>
				</tr>
				</tbody>
				</table>';
			}
			$voucher .= '</td>    
			</tr>
			<tr>
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("invoice_information",$post["language"]).'
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"])." ".lang_trans("surname",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['name']." ".$post['invoice']['surname'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("phone",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['phone'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("email",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['email'].'</span>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>
			<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("address",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['address'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("country",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['country'].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("identification_number",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['idno'].'</span>
			</td>
			</tr>
			<tr>
			<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;font-weight: bold;line-height:20px;color:#000000;padding-right:0;padding-left:0;padding-top:15px;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.lang_trans("payment_information",$post["language"]).'</span>
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
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("standart_room",$post["language"]).' ('.$insurance_text.')
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style=";padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" width="240" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<img src="'.site_url("assets/img/mail_gallery_4.jpg").'" alt=""  width="239" height="171" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
			</td>
			<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
			<tbody>
			<tr>
			<td valign="top" align="left" width="120" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("number_of_guests",$post["language"]).': '.$guest_count.'</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
			$i=1; foreach ($post['guest_rooms'] as $value) {
				$voucher .= '<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$i.'. '.lang_trans("room",$post["language"]).' '.$value->adult_count.' '.lang_trans("adult",$post["language"]).' </span>';
				if ($value->child_count>0) {
					$voucher .= '<span>+ '.$value->child_count.'</span>';
					$j=0; foreach ($value->child_ages as $value2) {
						if ($j==0) {
							$voucher .= '<span> '.lang_trans("child",$post["language"]).' '.$value2.' ve</span>';
						}else{
							$voucher .= '<span> '.$value2.' yaşında</span>';
						}
						$j++;
					}
				}
				$voucher .= '<br>';
				$i++;
			}
			$voucher .= '</td>
			</tr>
			<tr>
			<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_in_date",$post["language"]).':</strong> '.$start_date.'</span>
			</td>
			</tr>
			<tr>
			<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_out_date",$post["language"]).' :</strong> '.$end_date.'</span>
			</td>
			</tr>
			<tr>
			<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total",$post["language"]).' :</strong> '.$post['total_price']." ".$post["currency"].'</span>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("payment_type",$post["language"]).':</strong></span>
			</td>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.(@$post['pay_hotel'] == "Otelde Ödeme" ? lang_trans("payment_at_the_hotel",$post["language"]) : lang_trans("advance_payment",$post["language"])).'</span>
			</td>
			</tr>';
			if (@$post['pay_hotel']=="Otelde Ödeme") {
				$voucher .= '
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_paid",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post["pay_price"].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_payable_at_he_hotel",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
				</td>
				</tr>';
			}
			$voucher .= '</tbody>
			</table>    
			</td>
			</tr>
			</tbody>
			</table>    
			</td>    
			</tr>
			<tr>
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("special_requests",$post["language"]).':
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<p style="line-height: 20px;">
			'.$post["special_requests"].'
			</p>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>    
			</tr>
			<tr>
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("explanation",$post["language"]).':
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<p style="line-height: 20px;">
			<strong>'.lang_trans("voucher_cancellation_title",$post["language"]).':</strong>
			</p>
			<p style="line-height: 20px;">
			'.lang_trans("voucher_cancellation_text",$post["language"]).'
			</p>
			<p style="line-height: 20px;">
			'.lang_trans("voucher_footer_text",$post["language"]).'
			</p>
			<p style="line-height: 20px;">
			'.lang_trans("voucher_footer_text_2",$post["language"]).'
			</p>
			<p style="line-height: 20px;">
			'.lang_trans("voucher_footer_text_3",$post["language"]).'
			</p>
			</td>
			</tr>
			</tbody>
			</table>    
			</td>    
			</tr>
			<tr>
			<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
			'.lang_trans("voucher_not",$post["language"]).':
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
			<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
			<tbody>
			<tr>
			<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
			<p style="line-height: 20px;">
			'.$post["voucher_footer_not"].'
			</p>
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
			</td>
			</tr>
			</tbody>
			</table>
			</body>
			</html>
			';
			return $voucher;
		}


		function voucher_print($post)
		{
			$start_date = $post['start_date'];
			$end_date = $post['end_date'];
			if (@$post['language'] == "tr") {
				$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
			}else{
				$tr_months = array("January","February","March","April","May","June","July","August","September","October","November","December");
			}
			$start_date = explode("-", $start_date);
			$end_date = explode("-", $end_date);
			$start_date = $start_date[2]." ".$tr_months[$start_date[1]-1]." ".$start_date[0];
			$end_date = $end_date[2]." ".$tr_months[$end_date[1]-1]." ".$end_date[0];
			$post['guest_rooms'] = json_decode($post['guest_rooms']);
			$post['invoice'] = (array) json_decode($post['invoice']);
			$post['visitor'] = (array) json_decode($post['visitor']);
			$post['card_info'] = (array) json_decode($post['card_info']);
		// Fatura bilgileri ayrı girilmediyse kişi bilgilri
			if ($post['invoice']['name']=="") {
				$post['invoice']['name'] = $post['name'];
				$post['invoice']['surname'] = $post['surname'];
				$post['invoice']['phone'] = $post['phone'];
				$post['invoice']['email'] = $post['email'];
				$post['invoice']['country'] = $post['country'];
				$post['invoice']['idno'] = $post['idno'];
				$post['invoice']['address'] = $post['address'];
			}
		// sigorta durumuna göre yazısı ayarlanıyor.
			if (@$post['return_insurance']) {
				$insurance_text = lang_trans("returnable",$post["language"]);
			}else{
				$insurance_text = lang_trans("irrevocable",$post["language"]);
			}
		// yatak tipine göre yazı dile çeviriliyor.
			if (@$post['bed'] == "Tekli") {
				$bed_text = lang_trans("singles",$post["language"]);
			}else{
				$bed_text = lang_trans("double_room",$post["language"]);
			}
		// Toplam kişi sayısı alınıyor.
			$guest_count = 0;
			foreach ($post['guest_rooms'] as $item) {
				$guest_count += $item->adult_count;
				$guest_count += $item->child_count;
			}
			$voucher = '<html lang="tr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
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
				<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
				<script>
				$(document).ready(function () { window.print(); });
				</script>
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
				<td align="center" valign="top" style="padding:15px;margin:0;border:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0;">
				<tbody>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_trans("your_reservation_number",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$post['reserve_no'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;"><strong>'.lang_trans("check_in_date",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$start_date.'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="160" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_out_date",$post["language"]).' :</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;font-weight: normal;line-height:20px;">'.$end_date.'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("reservation_date",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['created_date'].'</span>
				</td>
				</tr>';
				if (@$post['package_name']) {
					$voucher .= '
					<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("package_name",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['package_name'].'</span>
					</td>
					</tr>';
				}
				$voucher .= '</tbody>
				</table>    
				</td>
				<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>';
				if ($post['total_amount']) {
					$voucher.= '<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("subtotal",$post["language"]).' :</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_amount']." ".$post["currency"].'</span>
					</td>
					</tr>';
				}
				if ($post['total_discount']) {
					$voucher .='<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total_discount",$post["language"]).' :</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_discount']." ".$post["currency"].'</span>
					</td>
					</tr>';
				}
				if ($post['total_tax']) {
					$voucher .= '<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("accommodation_tax",$post["language"]).' :</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_tax']." ".$post["currency"].'</span>
					</td>
					</tr>';
				}
				if ($post['total_insurance']) {
					$voucher .= '<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("insurance",$post["language"]).' :</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_insurance']." ".$post["currency"].'</span>
					</td>
					</tr>';
				}
				$voucher .= '<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['total_price']." ".$post["currency"].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("payment_type",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.(@$post['pay_hotel'] == "Otelde Ödeme" ? lang_trans("payment_at_the_hotel",$post["language"]) : lang_trans("advance_payment",$post["language"])).'</span>
				</td>
				</tr>';
				if (@$post['pay_hotel']=="Otelde Ödeme") {
					$voucher .= '
					<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_paid",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post["pay_price"].'</span>
					</td>
					</tr>
					<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_payable_at_he_hotel",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
					</td>
					</tr>';
				}
				$voucher .= '</tbody>
				</table>    
				</td>
				</tr>
				</tbody>
				</table>    
				</td>    
				</tr>
				<tr>
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("reservation_contact_information",$post["language"]).'
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"])." ".lang_trans("surname",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['name']." ".$post['surname'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("phone",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['phone'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("email",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['email'].'</span>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>
				<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("address",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['address'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("country",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['country'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("identification_number",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['idno'].'</span>
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
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("guest_information",$post["language"]).'
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
				foreach ($post['visitor'] as $row) {
				// cinsiyete göre yazı dile çeviriliyor.
					if (@$row->gender == "Kadın") {
						$gender_text = lang_trans("woman",$post["language"]);
					}elseif(@$row->gender == "Erkek"){
						$gender_text = lang_trans("man",$post["language"]);
					}else{
						$gender_text = lang_trans("unspecified",$post["language"]);
					}
					$voucher .= '
					<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
					<tbody>
					<tr>
					<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
					<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
					<tbody>
					<tr>
					<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->name.'</span>
					</td>
					</tr>
					<tr>
					<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("surname",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->surname.'</span>
					</td>
					</tr>
					</tbody>
					</table>    
					</td>
					<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
					<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
					<tbody>
					<tr>
					<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("gender",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$gender_text.'</span>
					</td>
					</tr>
					<tr>
					<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("date_of_birth",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$row->birthday.'</span>
					</td>
					</tr>
					</tbody>
					</table>    
					</td>
					</tr>
					</tbody>
					</table>';
				}
				$voucher .= '</td>    
				</tr>
				<tr>
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("invoice_information",$post["language"]).'
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="1" bordercolor="#D8D8D8" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" width="300" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="300" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("name",$post["language"])." ".lang_trans("surname",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['name']." ".$post['invoice']['surname'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("phone",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['phone'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="80" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("email",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['email'].'</span>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>
				<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("address",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['address'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("country",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['country'].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="70" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("identification_number",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post['invoice']['idno'].'</span>
				</td>
				</tr>
				<tr>
				<td colspan="2" style="font-family:"Trebuchet MS",sans-serif;font-size:14px;font-weight: bold;line-height:20px;color:#000000;padding-right:0;padding-left:0;padding-top:15px;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.lang_trans("payment_information",$post["language"]).'</span>
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
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("standart_room",$post["language"]).' ('.$insurance_text.')
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style=";padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" width="240" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<img src="'.site_url("assets/img/mail_gallery_4.jpg").'" alt=""  width="239" height="171" class="mImg" style="max-width:236px;padding-bottom:0;display: block;vertical-align:bottom;border-width:0;outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;" />
				</td>
				<td valign="top" align="left" style="padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<table align="center" width="340" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;padding:0;margin:0;border:0">
				<tbody>
				<tr>
				<td valign="top" align="left" width="120" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("number_of_guests",$post["language"]).': '.$guest_count.'</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">';
				$i=1; foreach ($post['guest_rooms'] as $value) {
					$voucher .= '<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$i.'. '.lang_trans("room",$post["language"]).' '.$value->adult_count.' '.lang_trans("adult",$post["language"]).' </span>';
					if ($value->child_count>0) {
						$voucher .= '<span>+ '.$value->child_count.'</span>';
						$j=0; foreach ($value->child_ages as $value2) {
							if ($j==0) {
								$voucher .= '<span> '.lang_trans("child",$post["language"]).' '.$value2.' ve</span>';
							}else{
								$voucher .= '<span> '.$value2.' yaşında</span>';
							}
							$j++;
						}
					}
					$voucher .= '<br>';
					$i++;
				}
				$voucher .= '</td>
				</tr>
				<tr>
				<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_in_date",$post["language"]).':</strong> '.$start_date.'</span>
				</td>
				</tr>
				<tr>
				<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("check_out_date",$post["language"]).' :</strong> '.$end_date.'</span>
				</td>
				</tr>
				<tr>
				<td colspan="2" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("total",$post["language"]).' :</strong> '.$post['total_price']." ".$post["currency"].'</span>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("payment_type",$post["language"]).':</strong></span>
				</td>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.(@$post['pay_hotel'] == "Otelde Ödeme" ? lang_trans("payment_at_the_hotel",$post["language"]) : lang_trans("advance_payment",$post["language"])).'</span>
				</td>
				</tr>';
				if (@$post['pay_hotel']=="Otelde Ödeme") {
					$voucher .= '
					<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_paid",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.$post["pay_price"].'</span>
					</td>
					</tr>
					<tr>
					<td valign="top" align="left" width="130" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;"><strong>'.lang_trans("amount_payable_at_he_hotel",$post["language"]).':</strong></span>
					</td>
					<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
					<span style="color:#000000 !important;font-size:12px;line-height:20px;">'.number_format($deposit_total,2).'</span>
					</td>
					</tr>';
				}
				$voucher .= '</tbody>
				</table>    
				</td>
				</tr>
				</tbody>
				</table>    
				</td>    
				</tr>
				<tr>
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("special_requests",$post["language"]).':
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<p style="line-height: 20px;">
				'.$post["special_requests"].'
				</p>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>    
				</tr>
				<tr>
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("explanation",$post["language"]).':
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<p style="line-height: 20px;">
				<strong>'.lang_trans("voucher_cancellation_title",$post["language"]).':</strong>
				</p>
				<p style="line-height: 20px;">
				'.lang_trans("voucher_cancellation_text",$post["language"]).'
				</p>
				<p style="line-height: 20px;">
				'.lang_trans("voucher_footer_text",$post["language"]).'
				</p>
				<p style="line-height: 20px;">
				'.lang_trans("voucher_footer_text_2",$post["language"]).'
				</p>
				<p style="line-height: 20px;">
				'.lang_trans("voucher_footer_text_3",$post["language"]).'
				</p>
				</td>
				</tr>
				</tbody>
				</table>    
				</td>    
				</tr>
				<tr>
				<td height="46" valign="bottom" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<div style="font-family:"Trebuchet MS",sans-serif;font-size:16px;font-weight: bold;line-height:36px;color:#000000;">
				'.lang_trans("voucher_not",$post["language"]).':
				</div>
				</td>
				</tr>
				<tr>
				<td valign="top" align="left" style="padding-right:0;padding-left:0;padding-top:0;padding-bottom:0;">
				<table align="center" width="690" border="0" cellpadding="0" cellspacing="0" style="padding:0;margin:0;border:1px solid #D8D8D8;">
				<tbody>
				<tr>
				<td valign="top" align="left" style="line-height: 20px;padding-right:15px;padding-left:15px;padding-top:15px;padding-bottom:15px;">
				<p style="line-height: 20px;">
				'.$post["voucher_footer_not"].'
				</p>
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
				</td>
				</tr>
				</tbody>
				</table>
				</body>
				</html>
				';
				return $voucher;
			}