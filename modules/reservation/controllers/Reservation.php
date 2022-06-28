<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('reservation/Reservation_model');
		$this->load->model('content/Content_model');
	}
	
	public function index()
	{
		if ($_POST) {
			// Seçilen tarih aralığındaki sezonlar ve sezonlara ait kotalar kontrol edilecek.
			// Tarih formatları uygun hale getiriliyor.
			$date = explode("-", $this->input->post("daterange"));
			$start_date = explode(",", $date[0])[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = explode(",", $date[1])[0];
			$end_date = date("Y-m-d", strtotime($end_date));
			$days = date_between($start_date,$end_date);
			// giriş ve çıkış günleri aynı ise uyarı veriyoruz.
			if ($start_date == $end_date) {
				$this->session->set_flashdata("error_message", lang_transform("check_in_check_out_date_text"));
				redirect('/', 'refresh');
			}
			$this->data['room_information'] = $this->input->post();
			// Oda bilgileri sessionda tutuluyor.
			$this->data['room_information']['start_date'] = $start_date;
			$this->data['room_information']['end_date'] = $end_date;
			$this->session->set_userdata('room_information',$this->data['room_information']);
			$this->data["insurance_status"] = 0;
			$this->data['price'] = 0;
			$this->data['total_price'] = 0;
			$this->data['adult_count'] = 0;
			$this->data['child_count'] = 0;
			$this->data['full_day'] = array();
			$season_days = array();
			foreach ($days as $row) {
				$season = $this->Reservation_model->get_seasons_price($row);
				if ($season) {
					// kullanıcı sayısına ve oda sayısına göre hesaplama yapıyoruz.
					$guest_rooms = $this->data['room_information']['guest_rooms'];
					
					foreach ($guest_rooms as $value) {
						$adult = $value['adult_count'];
						$child_count = $value['child_count'];
						// 6 yaş üzeri çocuklar ücretli.
						// 1 yetişkin ve 2 ücretli çocuk varsa fiyatın 2 katı yazılıyor.
						if ($adult == 1 && @$value['child_ages'][1] > 6 && @$value['child_ages'][2] > 6) {
							$this->data['price'] += $season->price * 2;
						}else{
							// 1 odada tek kişi kalıyorsa günlük fiyatın 1 buçuk katı yazılıyor.
							if ($adult==1) {
								$this->data['price'] += $season->price * 1.5;
							}else{
								for ($k=1; $k <= $adult; $k++) { 
									// 1 odada 3. kişi için %30 indirimli fiyat ekleniyor.
									if ($k==3) {
										$this->data['price'] += $season->price * 0.7;
									}else{
										$this->data['price'] += $season->price;
									}
								}
							}
							if (@$value['child_ages']) {
								foreach ($value['child_ages'] as $child_row) {
									// çocukların yaşı 6dan büyükse günlük fiyatın yarısı ekleniyor.
									if ($child_row > 6) {
										$this->data['price'] += $season->price * 0.5;
									}
								}
							}
						}
					}
					
					// stok kontrolü yapılıyor. stokta olmayan tarihler uyarıda gösterilmek üzere diziye aktarılıyor.
					$quota_control = $this->Reservation_model->quota_control(date("d-m", strtotime($row)),$season->id);
					if ($quota_control && $quota_control->quota == "-") {
						array_push($this->data['full_day'], $quota_control->title."-".date("Y", strtotime($row)));
					}elseif ($this->input->post("rooms")["count"] > $quota_control->quota) {
						array_push($this->data['full_day'], $quota_control->title."-".date("Y", strtotime($row)));
					}else{
						// seçilen sezon günleri rezervasyon tamamlandığında kotadan düşürülmek için değişkene alınıyor.
						array_push($season_days, $quota_control->id);
					}
				}
			}
			foreach ($this->data['room_information']['guest_rooms'] as $row2) {
				$this->data['adult_count'] += $row2['adult_count'];
				$this->data['child_count'] += $row2['child_count'];
			}
			// Stokta olmayan bir gün varsa rezervasyon sayfasına yönlendirmiyoruz kullanıcıyı anasayfaya yönlendirerek uyarı veriyoruz.
			if (count($this->data['full_day'])>0) {
				$error_text = lang_transform("full_room_text")." <br>";
				foreach ($this->data['full_day'] as $item) {
					$error_text .= '<p>'.$item.'</p>';
				}
				$this->session->set_flashdata("error_message", $error_text);
				redirect('/', 'refresh');
			}
			if (@$season_days) {
				$this->session->set_userdata('season_days',$season_days);
			}
			// Fiyat gelmediyse seçilen tarihe ait sezon olmadığından kullanıcıya uyarı veriyoruz.
			if ($this->data['price'] == 0) {
				$this->session->set_flashdata("error_message", lang_transform("not_service_text"));
				redirect('/', 'refresh');
			}else{
				$this->data['total_price'] = $this->data['price'];
				// Erken rezervasyon indirimi tanımlanmışsa fiyattan düşülüyor.
				if (settings("booking_discount_rate")>0) {
					$this->data['booking_discount_price'] = number_format(($this->data['price'] / 100) * settings("booking_discount_rate"),2);
					// Toplam fiyattan erken rezervasyon indirim ücreti çıkarılıyor.
					$this->data['total_price'] = $this->data['total_price'] - $this->data['booking_discount_price'];
				}
				// vergi ücreti tanımlanmışsa fiyata ekleniyor.
				if (settings("tax") > 0) {
					$this->data['tax_price'] = ($this->data['total_price']/100) * settings("tax");
					$this->data['total_price'] = $this->data['total_price'] + $this->data['tax_price'];
				}
				// Peşinat ödeme indirimini kullanıcı tek taksit ödeme seçtiğinde kullanmak üzere değişkene alıyoruz.
				if (settings("advance_discount_rate")>0) {
					$this->data['advance_discount_rate'] = number_format(($this->data['price'] / 100) * settings("advance_discount_rate"),2);
				}
				// Sigorta bedelini alıyoruz.
				$this->data['insurance_price'] = number_format(($this->data['total_price'] / 100) * settings("insurance_price"),2);
				// Sigortanın seçilebilmesi için min 3 günlük rezervasyon ve rezervasyon tarihinin 30 gün önceden yapılıyor olması gerektiği için kontrol ekliyoruz.
				$between = date_between(date('Y-m-d'),$start_date);
				if (count($days)>=3 && count($between) >= 30) {
					$this->data["insurance_status"] = 1;
				}
			}
			$this->data['total_price'] = number_format($this->data['total_price'],2);
			// Tüm bankaların taksit tablosu için banka görsellerini sadece default dilden alıyoruz.
			$this->data['page']['banks'] = $this->Content_model->get_banks(227);
			$this->data['page']['title'] = "Rezervasyon";
			$this->load->view('reservation/index', $this->data);
		}else{
			$this->session->set_flashdata("error_message", lang_transform("reservation_info_text"));
			redirect('/', 'refresh');
		}
	}

	public function promotion()
	{
		if ($_POST) {
			// Seçilen tarih aralığındaki sezonlar ve sezonlara ait kotalar kontrol edilecek.
			// Tarih formatları uygun hale getiriliyor.
			$start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
			$end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
			$days = date_between($start_date,$end_date);
			// giriş ve çıkış günleri aynı ise uyarı veriyoruz.
			if ($start_date == $end_date) {
				$this->session->set_flashdata("error_message", lang_transform("check_in_check_out_date_text"));
				redirect('/', 'refresh');
			}
			$this->data['room_information'] = $this->input->post();
			// Oda bilgileri sessionda tutuluyor.
			$this->data['room_information']['start_date'] = $start_date;
			$this->data['room_information']['end_date'] = $end_date;
			$this->session->set_userdata('room_information',$this->data['room_information']);
			$this->data["insurance_status"] = 0;
			$this->data['price'] = 0;
			$this->data['total_price'] = 0;
			$this->data['adult_count'] = 0;
			$this->data['child_count'] = 0;
			$this->data['full_day'] = array();
			$season_days = array();
			foreach ($days as $row) {
				$season = $this->Reservation_model->get_seasons_price($row);
				if ($season) {
					// stok kontrolü yapılıyor. stokta olmayan tarihler uyarıda gösterilmek üzere diziye aktarılıyor.
					$quota_control = $this->Reservation_model->quota_control(date("d-m", strtotime($row)),$season->id);
					if ($quota_control && $quota_control->quota == 0) {
						array_push($this->data['full_day'], $quota_control->title."-".date("Y", strtotime($row)));
					}elseif ($this->input->post("rooms")["count"] > $quota_control->quota) {
						array_push($this->data['full_day'], $quota_control->title."-".date("Y", strtotime($row)));
					}else{
						// seçilen sezon günleri rezervasyon tamamlandığında kotadan düşürülmek için değişkene alınıyor.
						array_push($season_days, $quota_control->id);
					}
				}
			}

			// kullanıcı sayısına ve oda sayısına göre hesaplama yapıyoruz.
			$guest_rooms = $this->data['room_information']['guest_rooms'];
			$promotion_price = str_replace(",", "", $this->input->post("price"));
			$this->data['child_ages'] = array();
			foreach ($guest_rooms as $value) {
				$adult = $value['adult_count'];
				$child_count = $value['child_count'];
				if ($adult == 1 && @$value['child_ages'][1] > 6 && @$value['child_ages'][2] > 6) {
					$this->data['price'] += $promotion_price * 2;
				}else{
					// 1 odada tek kişi kalıyorsa günlük fiyatın 1 buçuk katı yazılıyor.
					if ($adult==1) {
						$this->data['price'] += $promotion_price * 1.5;
					}else{
						for ($k=1; $k <= $adult; $k++) { 
							// 1 odada 3. kişi için %30 indirimli fiyat ekleniyor.
							if ($k==3) {
								$this->data['price'] += $promotion_price * 0.7;
							}else{
								$this->data['price'] += $promotion_price;
							}
						}
					}
					if (@$value['child_ages']) {
						foreach ($value['child_ages'] as $child_row) {
							array_push($this->data['child_ages'], $child_row);
							// çocukların yaşı 6dan büyükse günlük fiyatın yarısı ekleniyor.
							if ($child_row > 6) {
								$this->data['price'] += $promotion_price * 0.5;
							}
						}
					}
				}
			}


			foreach ($this->data['room_information']['guest_rooms'] as $row2) {
				$this->data['adult_count'] += $row2['adult_count'];
				$this->data['child_count'] += $row2['child_count'];
			}
			// Stokta olmayan bir gün varsa rezervasyon sayfasına yönlendirmiyoruz kullanıcıyı anasayfaya yönlendirerek uyarı veriyoruz.
			if (count($this->data['full_day'])>0) {
				$error_text = lang_transform("full_room_text")." <br>";
				foreach ($this->data['full_day'] as $item) {
					$error_text .= '<p>'.$item.'</p>';
				}
				$this->session->set_flashdata("error_message", $error_text);
				redirect('/', 'refresh');
			}
			if (@$season_days) {
				$this->session->set_userdata('season_days',$season_days);
			}
			// Fiyat gelmediyse seçilen tarihe ait sezon olmadığından kullanıcıya uyarı veriyoruz.
			if ($this->data['price'] == 0) {
				$this->session->set_flashdata("error_message", lang_transform("not_service_text"));
				redirect('/', 'refresh');
			}else{
				$this->data['total_price'] = $this->data['price'];
				// Erken rezervasyon indirimi tanımlanmışsa fiyattan düşülüyor.
				if (settings("promotion_booking_discount_rate")>0) {
					$this->data['booking_discount_price'] = number_format(($this->data['price'] / 100) * settings("promotion_booking_discount_rate"),2);
					// Toplam fiyattan erken rezervasyon indirim ücreti çıkarılıyor.
					$this->data['total_price'] = $this->data['total_price'] - $this->data['booking_discount_price'];
				}
				// vergi ücreti tanımlanmışsa fiyata ekleniyor.
				if (settings("tax") > 0) {
					$this->data['tax_price'] = ($this->data['total_price']/100) * settings("tax");
					$this->data['total_price'] = $this->data['total_price'] + $this->data['tax_price'];
				}
				// Peşinat ödeme indirimini kullanıcı tek taksit ödeme seçtiğinde kullanmak üzere değişkene alıyoruz.
				if (settings("advance_discount_rate")>0) {
					$this->data['advance_discount_rate'] = number_format(($this->data['price'] / 100) * settings("advance_discount_rate"),2);
				}
				// Sigorta bedelini alıyoruz.
				$this->data['insurance_price'] = number_format(($this->data['total_price'] / 100) * settings("insurance_price"),2);
				// Sigortanın seçilebilmesi için min 3 günlük rezervasyon ve rezervasyon tarihinin 30 gün önceden yapılıyor olması gerektiği için kontrol ekliyoruz.
				$between = date_between(date('Y-m-d'),$start_date);
				if (count($days)>=3 && count($between) >= 30) {
					$this->data["insurance_status"] = 1;
				}
			}
			$this->data['total_price'] = number_format($this->data['total_price'],2);
			// Tüm bankaların taksit tablosu için banka görsellerini sadece default dilden alıyoruz.
			$this->data['page']['banks'] = $this->Content_model->get_banks(227);
			$this->data['page']['title'] = "Rezervasyon";
			$this->load->view('reservation/index', $this->data);
		}else{
			$this->session->set_flashdata("error_message", lang_transform("reservation_info_text"));
			redirect('/', 'refresh');
		}
	}

	public function direct_payment(){
		if ($_GET) {
			$token_control = $this->Reservation_model->token_control($this->input->get("token"));
			if ($token_control) {
				$this->session->set_userdata(array('lang'  => $token_control->language));
				$this->data['payment'] = $token_control;
				$this->data['page']['title'] = 'Direkt Ödeme';
				$this->load->view('reservation/direct_payment', $this->data);
			}else{
				redirect('/', 'refresh');
			}
		}else{
			redirect('/', 'refresh');
		}
	}

	public function card_control(){
		// Kredi kartı numarası girilirken hangi bankaya ait olduğunu sorguluyoruz.
		if ($_POST) {
			$bin_number = str_replace(" ", "", $this->input->post("bin_number"));
			$bin_number = substr($bin_number, 0,6);
			$card_control = $this->Reservation_model->card_control($bin_number);
			if ($card_control) {
				print_r(json_encode($card_control));exit;
			}else{
				$arr = array("bank_name" => "Other");
				print_r(json_encode($arr));exit;
			}
		}
	}

	public function agency_code_control(){
		// Acente kodu kontrolü yapılıyor. Girilen kod doğru ise geriye indirim yapılacak fiyat döndürülüyor.
		if ($_POST) {
			$agency_code_control = $this->Reservation_model->agency_code_control($this->input->post("agency_code"));
			if ($agency_code_control) {
				$agency_discount_price = (str_replace(",", "", $this->input->post("total_price")) / 100) * $agency_code_control->discount;
				echo "-".number_format($agency_discount_price,2);exit;
			}else{
				echo "empty";exit;
			}
		}
	}

	public function payment(){
		if ($_POST) {
			// Rezervasyondan gelen işlemleri banka işlemlerinde kullanmak üzere session atıyoruz.
			$this->session->set_userdata("reservation_info", $this->input->post());
			if ($this->input->post("reservation_type") != "Direkt Ödeme") {
				// Rezervasyon numarası oluşturuluyor.
				$reserve_no = "DEN".strtoupper(substr(md5(microtime()), 0,17));
				$this->session->set_userdata("reserve_no", $reserve_no);
				// Rezervasyonu veritabanına ekliyoruz. Ödeme tamamlanınca güncelleme yapılacak.
				$add_reservation = $this->Reservation_model->add_reservation($this->input->post(),$reserve_no);
				if ($add_reservation == 1) {
					$amount = str_replace(",","",$this->input->post("total_price"));
					if (@$this->input->post("pay_hotel") == 1) {
						$amount = ($amount / 100) * settings("deposit_percent");
					}
					$amount = number_format($amount,2);
					$amount = str_replace(",","",$amount);
					if ($this->input->post("card_info")['bank_name'] == "Yapıkredi Bankası") {
						$this->yapikredi($this->input->post(),$amount,$reserve_no);
					}elseif ($this->input->post("card_info")['bank_name'] == "Finansbank") {
						$this->finansbank($this->input->post(),$amount,$reserve_no);
					}elseif ($this->input->post("card_info")['bank_name'] == "Halk Bankası") {
						$this->halkbank($this->input->post(),$amount,$reserve_no);
					}elseif ($this->input->post("card_info")['bank_name'] == "İş Bankası") {
						$this->isbank($this->input->post(),$amount,$reserve_no);
					}elseif ($this->input->post("card_info")['bank_name'] == "Akbank") {
						$this->akbank($this->input->post(),$amount,$reserve_no);
					}else{
						$this->ziraat($this->input->post(),$amount,$reserve_no);
					}
				}else{
					$this->session->set_flashdata("error_message", lang_transform("reservation_error_text"));
					redirect('/', 'refresh');
				}
			}else{
				$amount = str_replace(",","",$this->input->post("total_price"));
				$this->session->set_userdata("reserve_no", $this->input->post("token"));
				$add_reservation = $this->Reservation_model->add_reservation($this->input->post(),$this->input->post("token"));
				if ($add_reservation == 1) {
					if ($this->input->post("card_info")['bank_name'] == "Yapıkredi Bankası") {
						$this->yapikredi($this->input->post(),$amount,$this->input->post("token"));
					}elseif ($this->input->post("card_info")['bank_name'] == "Finansbank") {
						$this->finansbank($this->input->post(),$amount,$this->input->post("token"));
					}elseif ($this->input->post("card_info")['bank_name'] == "Halk Bankası") {
						$this->halkbank($this->input->post(),$amount,$this->input->post("token"));
					}elseif ($this->input->post("card_info")['bank_name'] == "İş Bankası") {
						$this->isbank($this->input->post(),$amount,$this->input->post("token"));
					}elseif ($this->input->post("card_info")['bank_name'] == "Akbank") {
						$this->akbank($this->input->post(),$amount,$this->input->post("token"));
					}else{
						$this->ziraat($this->input->post(),$amount,$this->input->post("token"));
					}
				}else{
					$this->session->set_flashdata("error_message", lang_transform("reservation_error_text"));
					redirect('/', 'refresh');
				}
			}
		}
	}

	public function yapikredi($post,$amount,$reserve_no){
		$amount = str_replace(",","",$amount);
		$amount = str_replace(".","",$amount);
		$params = array(
			"ccno" => str_replace(" ","",$post['card_info']['cardno']),
			"expdate" => substr($post['card_info']['cardYear'],-2).sprintf("%02d", $post['card_info']['cardMounth']),
			"cvv" => $post['card_info']['ccv2'],
			"custName" => $post['card_info']['cardname'],
			"XID" => $reserve_no,
			"amount" => $amount,
			"instalment" => $post['installment'],
			"tranType" => "Sale",
			"vftCode" => "",
			"currency" => "TL"
		);
		$this->session->set_userdata("params", $params);
		// $postData = '';
		// foreach($params as $k => $v){ $postData .= $k . '='.$v.'&'; }
		// rtrim($postData, '&');
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, site_url('posnet_files/posnettds.php'));
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// curl_setopt($ch, CURLOPT_HEADER, false);
		// curl_setopt($ch, CURLOPT_POST, count($postData));
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		// $output = curl_exec($ch);
		// curl_close($ch);
		// pre($output); exit;
		$mid = "6701617317";
		$tid = "67610629";
		$posnetid = "448833";
		$input_xml = '<?xml version="1.0" encoding="ISO-8859-9"?>
		<posnetRequest>
		<mid>'.$mid.'</mid>
		<tid>'.$tid.'</tid>
		<oosRequestData>
		<posnetid>'.$posnetid.'</posnetid>
		<XID>'.$reserve_no.'</XID>
		<amount>'.$amount.'</amount>
		<currencyCode>TL</currencyCode>
		<installment>'.$post['installment'].'</installment>
		<tranType>Sale</tranType>
		<cardHolderName>'.$post['card_info']['cardname'].'</cardHolderName>
		<ccno>'.str_replace(" ","",$post['card_info']['cardno']).'</ccno>
		<expDate>'.substr($post['card_info']['cardYear'],-2).sprintf("%02d", $post['card_info']['cardMounth']).'</expDate>
		<cvc>'.$post['card_info']['ccv2'].'</cvc>
		</oosRequestData>
		</posnetRequest>';
		// print_r($input_xml);exit;
		$ch = curl_init();
		$xml_url = "https://posnet.ykb.com.tr/PosnetWebService/XML";
		$pay_url = "https://posnet.ykb.com.tr/3DSWebService/YKBPaymentService";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			"xmldata=" . $input_xml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
		$data = curl_exec($ch);
		curl_close($ch);
		$array_data = json_decode(json_encode(simplexml_load_string($data)), true);
		// print_r($array_data);exit;
		if ($array_data["approved"] == 1) {
			$content = ' <!DOCTYPE html>
			<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta charset="utf-8" />
			<title></title>
			<script type="text/javascript" src="'.site_url("assets/js/yapikredi.js").'"></script>
			<script type="text/javascript">
			function moveWindow() {
				document.pay_form.submit();
			}
			</script>
			</head>
			<body onLoad="javascript:moveWindow()">
			<form name="pay_form" method="post" action="'.$pay_url.'" style="display:none;">
			<input name="mid" type="hidden" id="mid" value="'.$mid.'" />
			<input name="posnetID" type="hidden" id="PosnetID" value="'.$posnetid.'" />
			<input name="posnetData" type="hidden" id="posnetData" value="'.$array_data["oosRequestDataResponse"]["data1"].'" />
			<input name="posnetData2" type="hidden" id="posnetData2" value="'.$array_data["oosRequestDataResponse"]["data2"].'" />
			<input name="digest" type="hidden" id="sign" value="'.$array_data["oosRequestDataResponse"]["sign"].'" />
			<input name="vftCode" type="hidden" id="vftCode" value="" />
			<input name="merchantReturnURL" type="hidden" id=" merchantReturnURL" value="https://denizati-hv.com/reservation/completed" />
			<input name="lang" type="hidden" id="lang" value="tr" />
			<input name="url" type="hidden" id="url" value="https://denizati-hv.com/reservation/payment" />
			<input name="openANewWindow" type="hidden" id="openANewWindow" value="0" />
			<input type="submit" name="Submit" value="Doğrulama Yap" onclick="submitFormEx(formName, 0, "YKBWindow")" />
			</form>
			</body>
			</html>';
			echo $content;exit;
		}else{
			// bankadan gelen hatayı rezervasyona ekliyoruz.
			$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array_data,$reserve_no);
			$this->session->set_flashdata("error_message", $array_data['respCode']);
		}
	}

	public function ziraat($post,$amount,$reserve_no){
		$clientId = "190204657";
		$okUrl = site_url("reservation/completed");
		$failUrl = site_url("reservation/error_completed");
		$rnd = microtime();
		$storekey = "gxyd5Mrx";
		$storetype = "3d";
		$hashstr = $clientId . $reserve_no . $amount . $okUrl . $failUrl . $rnd . $storekey;
		$hash = base64_encode(pack('H*',sha1($hashstr)));
		$master = "";
		$visa = "";
		// Direkt ödemeden kur euro olarak gelebileceğinden currency değişkene atılıyor. Rezervasyonlarda hep TL olarak gelecek.
		if ($post['currency'] == "EURO") {
			$currency = "978";
		}else{
			$currency = "949";
		}
		if ($post['card_info']['card_type'] == "MASTERCARD") {
			$master = "selected";
		}else{
			$visa = "selected";
		}

		$content = '
		<html>
		<head>
		<title>3D</title>
		<meta http-equiv="Content-Language" content="tr">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="now">
		<script type="text/javascript" language="javascript">
		function moveWindow() {
			document.pay_form.submit();
		}
		</script>
		</head>
		<body onLoad="javascript:moveWindow()">
		<center>
		<form method="post" action="https://sanalpos2.ziraatbank.com.tr/fim/est3Dgate" style="display:none;" name="pay_form">
		<table>
		<tr>
		<td>Credit Card Number</td>
		<td><input type="text" name="pan" size="20" value="'.str_replace(" ", "", $post['card_info']['cardno']).'"/></td>
		</tr>
		<tr>
		<td>CVV</td>
		<td><input type="text" name="cv2" size="4" value="'.$post['card_info']['ccv2'].'"/></td>
		</tr>
		<tr>
		<td>Expiration Date Year</td>
		<td><input type="text" name="Ecom_Payment_Card_ExpDate_Year" value="'.substr($post['card_info']['cardYear'],-2).'"/></td>
		</tr>
		<tr>
		<td>Expiration Date Month</td>
		<td><input type="text" name="Ecom_Payment_Card_ExpDate_Month" value="'.$post['card_info']['cardMounth'].'"/></td>
		</tr>
		<tr>
		<td>Choosing Visa / Master Card</td>
		<td>
		<select name="cardType">
		<option value="1" '.$visa.'>Visa</option>
		<option value="2" '.$master.'>MasterCard</option>
		</select>
		</td>
		</tr>
		<tr>
		<td align="center" colspan="2">
		<input type="submit" value="Complete Payment"/>
		</td>
		</tr>
		</table>
		<input type="hidden" name="clientid" value="'.$clientId.'">
		<input type="hidden" name="amount" value="'.$amount.'">
		<input type="hidden" name="oid" value="'.$reserve_no.'">
		<input type="hidden" name="okUrl" value="'.$okUrl.'">
		<input type="hidden" name="failUrl" value="'.$failUrl.'">
		<input type="hidden" name="rnd" value="'.$rnd.'" >
		<input type="hidden" name="hash" value="'.$hash.'" >
		<input type="hidden" name="storetype" value="3d" >
		<input type="hidden" name="lang" value="'.$this->session->userdata("lang").'">
		<input type="hidden" name="currency" value="'.$currency.'">
		</form>
		</center>
		</body>
		</html>';
		echo $content;exit;
	}

	public function finansbank($post,$amount,$reserve_no){
		$MbrId="5";   //Kurum Kodu
		$MerchantID="035300000028365";   //Üye işyeri numarası
		$MerchantPass="11221632";//Üye işyeri 3D şifresi
		$UserCode="tetasapi";  //Kullanıcı Kodu
		$UserPass="esT63";  //Kullanıcı Şifre
		$SecureType="3DPay";//Güvenlik tipi
		$TxnType="Auth";//İşlem Tipi
		if ($post['installment']>1) {
			$InstallmentCount=$post['installment'];
		}else{
			$InstallmentCount=0;
		}
			$Currency="949";  //Para Birimi
			$OkUrl = site_url("reservation/completed");
			$FailUrl = site_url("reservation/error_completed");
			$OrderId= $reserve_no;//Sipariş numarası
			$PurchAmount= $post['total_price'];   //Tutar
			$Lang="TR";//Dil bilgisi
			$rnd = microtime(); 
			$hashstr = $MbrId . $OrderId . $PurchAmount . $OkUrl . $FailUrl . $TxnType . $InstallmentCount . $rnd . $MerchantPass;
			$hash = base64_encode(pack('H*',sha1($hashstr)));


			$content = '
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
			<html>
			<head>
			<title>QNB Finansbank - 3D Pay</title>
			<meta http-equiv="Content-Language" content="tr">
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
			<link href="Site.css" rel="stylesheet" type="text/css" />
			<script type="text/javascript" language="javascript">
			function moveWindow() {
				document.pay_form.submit();
			}
			</script>
			</head>
			<body onLoad="javascript:moveWindow()">
			<center>
			<form method="post" action="https://vpos.qnbfinansbank.com/Gateway/Default.aspx" name="pay_form" style="display:none;">
			<table class="tableClass">
			<tr>
			<td colspan="2">
			<h1>
			QNB Finansbank - 3D Pay
			</h1>
			</td>
			</tr>
			<tr>
			<td style="text-align: right">
			Kredi Kart Numarası :
			</td>
			<td style="text-align: left">
			<input type="text" name="Pan" maxlength="19"class="inputClass" value="'.str_replace(" ", "", $post['card_info']['cardno']).'" />
			</td>
			</tr>
			<tr>
			<td style="text-align: right">
			Guvenlik Kodu (Cvv) :
			</td>
			<td style="text-align: left">
			<input type="text" name="Cvv2" maxlength="4"class="inputClass" value="'.$post['card_info']['ccv2'].'" />
			</td>
			</tr>
			<tr>
			<td style="text-align: right">
			Son Kullanma Tarihi (MMYY) :
			</td>
			<td style="text-align: left">
			<input type="text" name="Expiry" maxlength="4"class="inputClass" value="'.$post['card_info']['cardMounth'].substr($post['card_info']['cardYear'],-2).'" />
			</td>
			</tr>
			<tr>
			<td align="center" colspan="2">
			<input type="submit" value="Gönder" class="buttonClass" />
			</td>
			</tr>
			</table>

			<input type="hidden" name="MbrId" value="'.$MbrId.'">
			<input type="hidden" name="MerchantID" value="'.$MerchantID.'">
			<input type="hidden" name="UserCode" value="'.$UserCode.'">
			<input type="hidden" name="UserPass" value="'.$UserPass.'">
			<input type="hidden" name="SecureType" value="'.$SecureType.'">
			<input type="hidden" name="TxnType" value="'.$TxnType.'">
			<input type="hidden" name="InstallmentCount" value="'.$InstallmentCount.'">
			<input type="hidden" name="Currency" value="'.$Currency.'">
			<input type="hidden" name="OkUrl" value="'.$OkUrl.'">
			<input type="hidden" name="FailUrl" value="'.$FailUrl.'">
			<input type="hidden" name="OrderId" value="'.$OrderId.'">
			<input type="hidden" name="PurchAmount" value="'.$PurchAmount.'">
			<input type="hidden" name="Lang" value="'.$Lang.'">
			<input type="hidden" name="Rnd" value="'.$rnd.'">
			<input type="hidden" name="Hash" value="'.$hash.'">

			</form>
			</center>
			</body>
			</html>';
			echo $content;exit;
		}

		public function halkbank($post,$amount,$reserve_no){
			$clientId = "500256528";
			$okUrl = site_url("reservation/completed");
			$failUrl = site_url("reservation/error_completed");
			$rnd = microtime();
			$storekey = "gxyd5Mrx";
			$storetype = "3d";
			$hashstr = $clientId . $reserve_no . $amount . $okUrl . $failUrl . $rnd . $storekey;
			$hash = base64_encode(pack('H*',sha1($hashstr)));
			$master = "";
			$visa = "";
			if ($post['card_info']['card_type'] == "MASTERCARD") {
				$master = "selected";
			}else{
				$visa = "selected";
			}

			$content = '
			<html>
			<head>
			<title>3D</title>
			<meta http-equiv="Content-Language" content="tr">
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
			<meta http-equiv="Pragma" content="no-cache">
			<meta http-equiv="Expires" content="now">
			<script type="text/javascript" language="javascript">
			function moveWindow() {
				document.pay_form.submit();
			}
			</script>
			</head>
			<body onLoad="javascript:moveWindow()">
			<center>
			<form method="post" action="https://sanalpos.halkbank.com.tr/fim/est3Dgate" style="display:none;" name="pay_form">
			<table>
			<tr>
			<td>Credit Card Number</td>
			<td><input type="text" name="pan" size="20" value="'.str_replace(" ", "", $post['card_info']['cardno']).'"/></td>
			</tr>
			<tr>
			<td>CVV</td>
			<td><input type="text" name="cv2" size="4" value="'.$post['card_info']['ccv2'].'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Year</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Year" value="'.substr($post['card_info']['cardYear'],-2).'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Month</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Month" value="'.$post['card_info']['cardMounth'].'"/></td>
			</tr>
			<tr>
			<td>Choosing Visa / Master Card</td>
			<td>
			<select name="cardType">
			<option value="1" '.$visa.'>Visa</option>
			<option value="2" '.$master.'>MasterCard</option>
			</select>
			</td>
			</tr>
			<tr>
			<td align="center" colspan="2">
			<input type="submit" value="Complete Payment"/>
			</td>
			</tr>
			</table>
			<input type="hidden" name="clientid" value="'.$clientId.'">
			<input type="hidden" name="amount" value="'.$amount.'">
			<input type="hidden" name="oid" value="'.$reserve_no.'">
			<input type="hidden" name="okUrl" value="'.$okUrl.'">
			<input type="hidden" name="failUrl" value="'.$failUrl.'">
			<input type="hidden" name="rnd" value="'.$rnd.'" >
			<input type="hidden" name="hash" value="'.$hash.'" >
			<input type="hidden" name="storetype" value="3d" >
			<input type="hidden" name="lang" value="'.$this->session->userdata("lang").'">
			<input type="hidden" name="currency" value="949">
			</form>
			</center>
			</body>
			</html>';
			echo $content;exit;
		}

		public function isbank($post,$amount,$reserve_no) {
			$clientId = "700667979769";
			$okUrl = site_url("reservation/completed");
			$failUrl = site_url("reservation/error_completed");
			$rnd = microtime();
			$storekey = "gxyd5Mrx";
			$storetype = "3d";
			$hashstr = $clientId . $reserve_no . $amount . $okUrl . $failUrl . $rnd . $storekey;
			$hash = base64_encode(pack('H*',sha1($hashstr)));
			$master = "";
			$visa = "";
			if ($post['card_info']['card_type'] == "MASTERCARD") {
				$master = "selected";
			}else{
				$visa = "selected";
			}

			$content = '
			<html>
			<head>
			<title>3D</title>
			<meta http-equiv="Content-Language" content="tr">
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
			<meta http-equiv="Pragma" content="no-cache">
			<meta http-equiv="Expires" content="now">
			<script type="text/javascript" language="javascript">
			function moveWindow() {
				document.pay_form.submit();
			}
			</script>
			</head>
			<body onLoad="javascript:moveWindow()">
			<center>
			<form method="post" action="https://sanalpos.isbank.com.tr/fim/est3Dgate" style="display:none;" name="pay_form">
			<table>
			<tr>
			<td>Credit Card Number</td>
			<td><input type="text" name="pan" size="20" value="'.str_replace(" ", "", $post['card_info']['cardno']).'"/></td>
			</tr>
			<tr>
			<td>CVV</td>
			<td><input type="text" name="cv2" size="4" value="'.$post['card_info']['ccv2'].'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Year</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Year" value="'.substr($post['card_info']['cardYear'],-2).'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Month</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Month" value="'.$post['card_info']['cardMounth'].'"/></td>
			</tr>
			<tr>
			<td>Choosing Visa / Master Card</td>
			<td>
			<select name="cardType">
			<option value="1" '.$visa.'>Visa</option>
			<option value="2" '.$master.'>MasterCard</option>
			</select>
			</td>
			</tr>
			<tr>
			<td align="center" colspan="2">
			<input type="submit" value="Complete Payment"/>
			</td>
			</tr>
			</table>
			<input type="hidden" name="clientid" value="'.$clientId.'">
			<input type="hidden" name="amount" value="'.$amount.'">
			<input type="hidden" name="oid" value="'.$reserve_no.'">
			<input type="hidden" name="okUrl" value="'.$okUrl.'">
			<input type="hidden" name="failUrl" value="'.$failUrl.'">
			<input type="hidden" name="rnd" value="'.$rnd.'" >
			<input type="hidden" name="hash" value="'.$hash.'" >
			<input type="hidden" name="storetype" value="3d" >
			<input type="hidden" name="lang" value="'.$this->session->userdata("lang").'">
			<input type="hidden" name="currency" value="949">
			</form>
			</center>
			</body>
			</html>';
			echo $content;exit;
		}

		public function akbank($post,$amount,$reserve_no) {
			$clientId = "102092890";
			$okUrl = site_url("reservation/completed");
			$failUrl = site_url("reservation/error_completed");
			$rnd = microtime();
			$storekey = "gxyd5Mrx";
			$storetype = "3d";
			$hashstr = $clientId . $reserve_no . $amount . $okUrl . $failUrl . $rnd . $storekey;
			$hash = base64_encode(pack('H*',sha1($hashstr)));
			$master = "";
			$visa = "";
			if ($post['card_info']['card_type'] == "MASTERCARD") {
				$master = "selected";
			}else{
				$visa = "selected";
			}

			$content = '
			<html>
			<head>
			<title>3D</title>
			<meta http-equiv="Content-Language" content="tr">
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
			<meta http-equiv="Pragma" content="no-cache">
			<meta http-equiv="Expires" content="now">
			<script type="text/javascript" language="javascript">
			function moveWindow() {
				document.pay_form.submit();
			}
			</script>
			</head>
			<body onLoad="javascript:moveWindow()">
			<center>
			<form method="post" action="https://www.sanalakpos.com/fim/est3Dgate" style="display:none;" name="pay_form">
			<table>
			<tr>
			<td>Credit Card Number</td>
			<td><input type="text" name="pan" size="20" value="'.str_replace(" ", "", $post['card_info']['cardno']).'"/></td>
			</tr>
			<tr>
			<td>CVV</td>
			<td><input type="text" name="cv2" size="4" value="'.$post['card_info']['ccv2'].'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Year</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Year" value="'.substr($post['card_info']['cardYear'],-2).'"/></td>
			</tr>
			<tr>
			<td>Expiration Date Month</td>
			<td><input type="text" name="Ecom_Payment_Card_ExpDate_Month" value="'.$post['card_info']['cardMounth'].'"/></td>
			</tr>
			<tr>
			<td>Choosing Visa / Master Card</td>
			<td>
			<select name="cardType">
			<option value="1" '.$visa.'>Visa</option>
			<option value="2" '.$master.'>MasterCard</option>
			</select>
			</td>
			</tr>
			<tr>
			<td align="center" colspan="2">
			<input type="submit" value="Complete Payment"/>
			</td>
			</tr>
			</table>
			<input type="hidden" name="clientid" value="'.$clientId.'">
			<input type="hidden" name="amount" value="'.$amount.'">
			<input type="hidden" name="oid" value="'.$reserve_no.'">
			<input type="hidden" name="okUrl" value="'.$okUrl.'">
			<input type="hidden" name="failUrl" value="'.$failUrl.'">
			<input type="hidden" name="rnd" value="'.$rnd.'" >
			<input type="hidden" name="hash" value="'.$hash.'" >
			<input type="hidden" name="storetype" value="3d" >
			<input type="hidden" name="lang" value="'.$this->session->userdata("lang").'">
			<input type="hidden" name="currency" value="949">
			</form>
			</center>
			</body>
			</html>';
			echo $content;exit;
		}

		public function completed(){
			if ($_POST) {
				$response = 0;
				if ($this->session->userdata("reservation_info")['card_info']['bank_name'] == "Yapıkredi Bankası") {
					$mid = "6701617317";
					$tid = "67610629";
					$posnetid = "448833";
					$total_price = str_replace(",", "", $this->session->userdata("reservation_info")["total_price"]);
					$total_price = str_replace(".", "", $total_price);

					$encKey = '44,84,69,63,30,14,60,0';
					$firstHash = base64_encode(hash('sha256',$encKey . ";" . $tid,true));
					$MAC = base64_encode(hash('sha256',$this->session->userdata("reserve_no") . ";" . $total_price . ";" . $this->session->userdata("reservation_info")["currency"] . ";" . $mid . ";" . $firstHash,true));
					//$MAC = rawurlencode($MAC);
					$bank_data = $_POST["BankPacket"];

					$input_xml = '<?xml version="1.0" encoding="ISO-8859-9"?>
					<posnetRequest>
					<mid>'.$mid.'</mid>
					<tid>'.$tid.'</tid>
					<oosResolveMerchantData>
					<bankData>'.$bank_data.'</bankData>
					<merchantData>'.$_POST["MerchantPacket"].'</merchantData>
					<sign>'.$_POST["Sign"].'</sign>
					<mac>'.$MAC.'</mac>
					</oosResolveMerchantData>
					</posnetRequest> ';

					$ch = curl_init();
					$xml_url = "https://posnet.ykb.com.tr/PosnetWebService/XML";

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $xml_url);
					curl_setopt($ch, CURLOPT_POSTFIELDS,
						"xmldata=" . $input_xml);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
					$data = curl_exec($ch);
					curl_close($ch);
					$array_data = json_decode(json_encode(simplexml_load_string($data)), true);
					// print_r($array_data);exit;
					if ($array_data["approved"] == 1 && $array_data['oosResolveMerchantDataResponse']['mdStatus'] == 1) {

						// $MAC = base64_encode(hash('sha256',$array_data['oosResolveMerchantDataResponse']['mdStatus'] . ";" . $array_data['oosResolveMerchantDataResponse']['xid'] . ";" . $array_data['oosResolveMerchantDataResponse']['amount'] . ";" . $array_data['oosResolveMerchantDataResponse']['currency'] . ";" . $mid . ";" . $firstHash,true));

						$input_xml = '<?xml version="1.0" encoding="ISO-8859-9"?>
						<posnetRequest>
						<mid>'.$mid.'</mid>
						<tid>'.$tid.'</tid>
						<oosTranData>
						<bankData>'.$bank_data.'</bankData>
						<mac>'.$MAC.'</mac>
						</oosTranData>
						</posnetRequest> ';

						$ch = curl_init();
						$xml_url = "https://posnet.ykb.com.tr/PosnetWebService/XML";

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $xml_url);
						curl_setopt($ch, CURLOPT_POSTFIELDS,
							"xmldata=" . $input_xml);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
						$data = curl_exec($ch);
						curl_close($ch);
						$array_data = json_decode(json_encode(simplexml_load_string($data)), true);
						// print_r($array_data);exit;

						if ($array_data["approved"] == 1) {
							$response = 1;
							$reserve_no = $this->session->userdata("reserve_no");
						}
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array_data,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}elseif ($this->session->userdata("reservation_info")['card_info']['bank_name'] == "Finansbank") {
					if ($_POST["3DStatus"] == "1" || $_POST["ProcReturnCode"] == "00") {
						$response = 1;
						$reserve_no = $_POST['OrderId'];
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($_POST,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}elseif ($this->session->userdata("reservation_info")['card_info']['bank_name'] == "Halk Bankası") {
					$input_xml = '
					<CC5Request>
					<Name>denizatiapi</Name>
					<Password>gxyd5Mrx</Password>
					<ClientId>500256528</ClientId>
					<IPAddress>'.$_POST['clientIp'].'</IPAddress>
					<OrderId>'.$_POST['oid'].'</OrderId>
					<Type>Auth</Type>
					<Number>'.$_POST['md'].'</Number>
					<Amount>'.$_POST['amount'].'</Amount>
					<Currency>'.$_POST['currency'].'</Currency>';
					if ($this->session->userdata("reservation_info")['installment'] > 1) {
						$input_xml .= '<Taksit>'.$this->session->userdata("reservation_info")['installment'].'</Taksit>';
					}
					$input_xml .= '<PayerTxnId>'.$_POST['xid'].'</PayerTxnId>
					<PayerSecurityLevel>'.$_POST['eci'].'</PayerSecurityLevel>
					<PayerAuthenticationCode>'.$_POST['cavv'].'</PayerAuthenticationCode>
					</CC5Request>';

					$url = "https://sanalpos.halkbank.com.tr/fim/api";
					$curl = curl_init($url);
					curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $input_xml);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

					$result = curl_exec($curl);

					if(curl_errno($curl)){
						throw new Exception(curl_error($curl));
					}

					curl_close($curl);

					$xml = simplexml_load_string($result);
					$json = json_encode($xml);
					$array = json_decode($json, TRUE);
					if ($array["Response"] == "Approved" || $array["ProcReturnCode"] == "00") {
						$response = 1;
						$reserve_no = $_POST["oid"];
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}elseif ($this->session->userdata("reservation_info")['card_info']['bank_name'] == "İş Bankası") {
					$input_xml = '
					<CC5Request>
					<Name>denizatiapi</Name>
					<Password>gxyd5Mrx</Password>
					<ClientId>700667979769</ClientId>
					<IPAddress>'.$_POST['clientIp'].'</IPAddress>
					<OrderId>'.$_POST['oid'].'</OrderId>
					<Type>Auth</Type>
					<Number>'.$_POST['md'].'</Number>
					<Amount>'.$_POST['amount'].'</Amount>
					<Currency>'.$_POST['currency'].'</Currency>';
					if ($this->session->userdata("reservation_info")['installment'] > 1) {
						$input_xml .= '<Taksit>'.$this->session->userdata("reservation_info")['installment'].'</Taksit>';
					}
					$input_xml .= '<PayerTxnId>'.$_POST['xid'].'</PayerTxnId>
					<PayerSecurityLevel>'.$_POST['eci'].'</PayerSecurityLevel>
					<PayerAuthenticationCode>'.$_POST['cavv'].'</PayerAuthenticationCode>
					</CC5Request>';

					$url = "https://sanalpos.isbank.com.tr/fim/api";
					$curl = curl_init($url);
					curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $input_xml);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

					$result = curl_exec($curl);

					if(curl_errno($curl)){
						throw new Exception(curl_error($curl));
					}

					curl_close($curl);

					$xml = simplexml_load_string($result);
					$json = json_encode($xml);
					$array = json_decode($json, TRUE);
					if ($array["Response"] == "Approved" || $array["ProcReturnCode"] == "00") {
						$response = 1;
						$reserve_no = $_POST["oid"];
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}elseif ($this->session->userdata("reservation_info")['card_info']['bank_name'] == "Akbank") {
					$input_xml = '
					<CC5Request>
					<Name>denizatiapi</Name>
					<Password>gxyd5Mrx</Password>
					<ClientId>102092890</ClientId>
					<IPAddress>'.$_POST['clientIp'].'</IPAddress>
					<OrderId>'.$_POST['oid'].'</OrderId>
					<Type>Auth</Type>
					<Number>'.$_POST['md'].'</Number>
					<Amount>'.$_POST['amount'].'</Amount>
					<Currency>'.$_POST['currency'].'</Currency>';
					if ($this->session->userdata("reservation_info")['installment'] > 1) {
						$input_xml .= '<Taksit>'.$this->session->userdata("reservation_info")['installment'].'</Taksit>';
					}
					$input_xml .= '<PayerTxnId>'.$_POST['xid'].'</PayerTxnId>
					<PayerSecurityLevel>'.$_POST['eci'].'</PayerSecurityLevel>
					<PayerAuthenticationCode>'.$_POST['cavv'].'</PayerAuthenticationCode>
					</CC5Request>';

					$url = "https://www.sanalakpos.com/fim/api";
					$curl = curl_init($url);
					curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $input_xml);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

					$result = curl_exec($curl);

					if(curl_errno($curl)){
						throw new Exception(curl_error($curl));
					}

					curl_close($curl);

					$xml = simplexml_load_string($result);
					$json = json_encode($xml);
					$array = json_decode($json, TRUE);
					if ($array["Response"] == "Approved" || $array["ProcReturnCode"] == "00") {
						$response = 1;
						$reserve_no = $_POST["oid"];
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}else{
					$input_xml = '
					<CC5Request>
					<Name>denizatiapi</Name>
					<Password>gxyd5Mrx</Password>
					<ClientId>190204657</ClientId>
					<IPAddress>'.$_POST['clientIp'].'</IPAddress>
					<OrderId>'.$_POST['oid'].'</OrderId>
					<Type>Auth</Type>
					<Number>'.$_POST['md'].'</Number>
					<Amount>'.$_POST['amount'].'</Amount>
					<Currency>'.$_POST['currency'].'</Currency>';
					if ($this->session->userdata("reservation_info")['installment'] > 1) {
						$input_xml .= '<Taksit>'.$this->session->userdata("reservation_info")['installment'].'</Taksit>';
					}
					$input_xml .= '<PayerTxnId>'.$_POST['xid'].'</PayerTxnId>
					<PayerSecurityLevel>'.$_POST['eci'].'</PayerSecurityLevel>
					<PayerAuthenticationCode>'.$_POST['cavv'].'</PayerAuthenticationCode>
					</CC5Request>';

					$url = "https://sanalpos2.ziraatbank.com.tr/fim/api";
					$curl = curl_init($url);
					curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $input_xml);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

					$result = curl_exec($curl);

					if(curl_errno($curl)){
						throw new Exception(curl_error($curl));
					}

					curl_close($curl);

					$xml = simplexml_load_string($result);
					$json = json_encode($xml);
					$array = json_decode($json, TRUE);
					if ($array["Response"] == "Approved" || $array["ProcReturnCode"] == "00") {
						$response = 1;
						$reserve_no = $_POST["oid"];
					}else{
						// bankadan gelen hatayı rezervasyona ekliyoruz.
						$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array,$this->session->userdata("reserve_no"));
						$this->session->set_flashdata("error_message", "3D Secure Error");
						redirect('/','refresh');
					}
				}
				if ($response==1) {
					if ($this->session->userdata("reservation_info")['reservation_type'] == "Direkt Ödeme") {
						// Kredi kartından ödeme yapıldıktan sonra direkt ödemeyi güncelliyoruz.
						$update_direct_payment = $this->Reservation_model->update_direct_payment($this->session->userdata("reservation_info")['token']);
						// Ödeme yapan kullanıcıya ödeme yapıldığına dair e-posta gönderiyoruz.
						$get_direct_payment = $this->Reservation_model->get_direct_payment($this->session->userdata("reservation_info")['token']);
						$send_mail_direct_payment = $this->Reservation_model->send_mail_direct_payment($get_direct_payment);
						// Yöneticiye ödeme yapıldığına dair e-posta gönderiyoruz.
						$send_mail_admin = $this->Reservation_model->send_mail_admin($get_direct_payment,"Direkt Ödeme");
					}else{
						// Kredi kartından ödeme yapıldıktan sonra rezervasyonu güncelliyoruz.
						$update_reservation = $this->Reservation_model->update_reservation($reserve_no);
						// sezon kota bilgisinden seçilen günlerdeki oda sayısı düşülüyor.
						foreach ($this->session->userdata("season_days") as $season_id) {
							$rooms_count = count($this->session->userdata("room_information")['guest_rooms']);
							$update_season_quota = $this->db->query("update season_quota set quota = quota -".$rooms_count." WHERE id = ".$season_id."");
						}
						// rezervasyon bilgileri voucher olarak e-posta ile gönderilecek.
						$voucher = voucher($this->session->userdata("reservation_info"),$this->session->userdata("room_information"),$reserve_no);
						// Sigortanın seçilebilir ve seçilemez durumuna göre iptal politikası içeriği değişiyor.
						$this->load->helper('content/content');
						if ($this->session->userdata("reservation_info")['total_insurance']>0) {
							$cancellation = get_content(get_lang_id_record(66,'content',$this->session->userdata('lang'))->id);
						}else{
							$cancellation = get_content(get_lang_id_record(239,'content',$this->session->userdata('lang'))->id);
						}
						// Mesafeli satış sözleşmesi de voucherda gönderilmek üzere çekiliyor.
						$sales_contract = get_content(get_lang_id_record(67,'content',$this->session->userdata('lang'))->id);
						$send_mail_voucher = $this->Reservation_model->send_mail_voucher($voucher,$this->session->userdata("reservation_info")['email'],$cancellation,$sales_contract,$reserve_no);
						// Yöneticiye ödeme yapıldığına dair e-posta gönderiyoruz.
						$send_mail_admin = $this->Reservation_model->send_mail_admin($reserve_no,"Rezervasyon");
					}
					$reserve_type = $this->session->userdata("reservation_info")['reservation_type'];
					// sessiondaki rezervasyon bilgilerini siliyor
					$this->session->unset_userdata('reservation_info');
					$this->session->unset_userdata('room_information');
					$this->session->unset_userdata('params');
					// sonuç sayfasını gösteriyor
					$this->data['reserve_no'] = $reserve_no;

					if ($reserve_type == "Direkt Ödeme") {
						$this->data['page']["title"] = "Ödeme tamamlandı!";
						$this->load->view('reservation/completed_direct_payment', $this->data);
					}else{
						$this->data['page']["title"] = "Rezervasyon tamamlandı!";
						$this->load->view('reservation/completed', $this->data);
					}
				} else {
					// bankadan gelen hatayı rezervasyona ekliyoruz.
					$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($array,$this->session->userdata("reserve_no"));
					if (isset($array['ErrMsg'])) {
						$this->session->set_flashdata("error_message", $array['ErrMsg']);
						redirect('/','refresh');
					} else {
						$this->session->set_flashdata("error_message", lang_transform("payment_error_text"));
						redirect('/','refresh');
					}
				}
			}else{
				$this->session->set_flashdata("error_message", lang_transform("payment_error_text"));
				redirect('/','refresh');
			}
		}

		public function error_completed(){
			if ($_POST) {
				$update_reserve_bank_error = $this->Reservation_model->update_reserve_bank_error($this->input->post(),$this->session->userdata("reserve_no"));
				$this->session->set_flashdata("error_message", lang_transform("payment_error_text"));
				redirect('/','refresh');
			}
		}

	}