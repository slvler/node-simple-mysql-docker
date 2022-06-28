<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Rezervasyon Düzenle</h5>
	</div>
</div>
<?php if (!empty ($this->session->flashdata('success_message'))): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
		<div class="clearfix"></div>
	</div>
<?php endif; ?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">			
				<div class="panel-body">
					<div class="form-wrap">
						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="reservation_type" value="panel reservation">
							<div  class="pills-struct">
								<div class="tab-content">
									<div id="lang" class="tab-pane fade active in" role="tabpanel">
										<div class="row">											
											<div class="col-md-9 col-xs-12">	
												<label for="language" class="form-label">Dil (Kullanıcıya gidecek voucherda içeriklerin görüntüleneceği dil seçeneği)</label>
												<select class="form-control custom-select" name="language" id="language" aria-invalid="false">
													<option value="tr" <?php echo ($page["language"]=="tr")?"selected":""; ?>>Türkçe</option>
													<option value="en" <?php echo ($page["language"]=="en")?"selected":""; ?>>İngilizce</option>
												</select>
												<label for="currency" class="form-label">Kur (Kullanıcıya gidecek voucherda fiyatların görüntüleneceği kur seçeneği)</label>
												<select class="form-control custom-select" name="currency" id="currency" aria-invalid="false">
													<option value="TL" <?php echo ($page["currency"]=="TL")?"selected":""; ?>>TL</option>
													<option value="EURO" <?php echo ($page["currency"]=="EURO")?"selected":""; ?>>EURO</option>
												</select>
												<h5 class="mt-20">Voucher Not (Bu alanda yazılacak içerik, voucher mailinde üst alanda görüntülecenektir.)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control tinymce" id="voucher_not" name="voucher_not" rows="3"><?php echo $page["voucher_not"]; ?></textarea>
														</div>
													</div>
												</div>
												<h5 class="mt-20">Voucher Alt Not (Bu alanda yazılacak içerik, voucher not kısmında görüntülecenektir.)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control tinymce" id="voucher_footer_not" name="voucher_footer_not" rows="3"><?php echo $page["voucher_footer_not"]; ?></textarea>
														</div>
													</div>
												</div>									
												<h5 class="mt-20">Rezervasyon Bilgileri</h5>
												<hr>
												<div class="row">
													<?php if(@$page["guest_rooms"]){ $page["guest_rooms"] = json_decode($page["guest_rooms"]); }else{ $page["guest_rooms"] = json_decode('{"1":{"adult_count":"2","child_count":"","child_ages":{"":"","":""}}}'); } ?>
													<div class="col-xs-12">
														<a class="btn btn-xs btn-primary pull-right mb-15" id="add_field_button2">Yeni Oda Ekle</a>
													</div>
													<div id="input_fields_wrap2" class="col-md-12">
														<?php $i=0; foreach ($page["guest_rooms"] as $key => $row): ?>
														
														<div class="row mb-15">
															<div class="col-md-12">
																<h6>1. Oda</h6>
																<hr>
															</div>
															<div class="col-md-3 form-group">
																<label for="adult" class="form-label">Yetişkin Sayısı</label>
																<input type="text" name="guest_rooms[<?php echo $key; ?>][adult_count]" class="form-control" id="adult" autocomplete="off" value="<?php echo $row->adult_count; ?>">
															</div>
															<div class="col-md-3 form-group">
																<label for="adult" class="form-label">Çocuk Sayısı</label>
																<input type="text" name="guest_rooms[<?php echo $key; ?>][child_count]" class="form-control" id="adult" autocomplete="off" value="<?php echo $row->child_count; ?>">
															</div>
															<?php $j=1; foreach ($row->child_ages as $item): ?>
															<div class="col-md-<?php echo ($j==1)?"3":"2"; ?> form-group">
																<label for="adult" class="form-label"><?php echo $j; ?>. Çocuk Yaşı</label>
																<input type="text" name="guest_rooms[<?php echo $key; ?>][child_ages][<?php echo $j; ?>]" class="form-control" id="adult" autocomplete="off" value="<?php echo $item; ?>">
															</div>
															<?php $j++; endforeach ?>
															<div class="col-xs-1">
																<?php if($i != 0): ?>
																	<a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a>
																<?php endif; ?>
															</div>
														</div>
														<?php $i++; endforeach ?>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="total_price">Toplam Fiyat</label>
															<input type="text" class="form-control price-format" id="total_price" name="total_price" value="<?php echo $page["total_price"]; ?>" />
														</div>
														<div class="form-group">
															<label for="pay_hotel" class="form-label">Ödeme Tipi</label>
															<select class="form-control custom-select" name="pay_hotel" id="pay_hotel" aria-invalid="false">
																<option value="Peşin Ödeme" <?php echo ($page["pay_hotel"]=="Peşin Ödeme")?"selected":""; ?>>Peşin Ödeme</option>
																<option value="Otelde Ödeme" <?php echo ($page["pay_hotel"]=="Otelde Ödeme")?"selected":""; ?>>Otelde Ödeme</option>
															</select>
														</div>
														<div class="form-group pay-hotel-control <?php echo ($page["pay_hotel"]=="Otelde Ödeme")?"":"hidden"; ?>">
															<label class="control-label mb-10 text-left" for="pay_price">Ödenen Fiyat</label>
															<input type="text" class="form-control price-format" id="pay_price" name="pay_price" value="<?php echo $page["pay_price"]; ?>" />
														</div>
														<?php $page["pay_hotel_price"] = str_replace(",", "", $page["total_price"]) - str_replace(",", "", $page["pay_price"]); ?>
														<div class="form-group pay-hotel-control <?php echo ($page["pay_hotel"]=="Otelde Ödeme")?"":"hidden"; ?>">
															<label class="control-label mb-10 text-left" for="pay_hotel_price">Otelde Ödenecek Fiyat</label>
															<input type="text" class="form-control price-format" id="pay_hotel_price" name="pay_hotel_price" value="<?php echo number_format($page["pay_hotel_price"],2); ?>" />
														</div>
														<div class="form-group mb-0">
															<label class="control-label mb-10 text-left">Giriş - Çıkış Tarihi</label>
															<input class="form-control input-daterange-datepicker" type="text" name="date" value="<?php echo date("m/d/Y", strtotime($page["start_date"]))." - ".date("m/d/Y", strtotime($page["end_date"])); ?>">
														</div>
													</div>
												</div>
												<h5 class="mt-20">Rezervasyon İrtibat ve Fatura Bilgileri</h5>
												<hr>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="name">Ad</label>
															<input type="text" class="form-control" id="name" name="name" value="<?php echo $page["name"]; ?>" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="surname">Soyad</label>
															<input type="text" class="form-control" id="surname" name="surname" value="<?php echo $page["surname"]; ?>" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="phone">Telefon</label>
															<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $page["phone"]; ?>" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="email">E-posta</label>
															<input type="text" class="form-control" id="email" name="email" required value="<?php echo $page["email"]; ?>" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="country">Ülke</label>
															<select id="country" name="country" class="form-control custom-select">
																<option <?php echo ($page["country"]=="Türkiye")?"selected":""; ?> value="Türkiye">Türkiye</option>
																<option <?php echo ($page["country"]=="ABD Virgin Adaları")?"selected":""; ?> value="ABD Virgin Adaları">ABD Virgin Adaları</option>
																<option <?php echo ($page["country"]=="ABD Çevresindeki Küçük Adalar")?"selected":""; ?> value="ABD Çevresindeki Küçük Adalar">ABD Çevresindeki Küçük Adalar</option>
																<option <?php echo ($page["country"]=="Almanya")?"selected":""; ?> value="Almanya">Almanya</option>
																<option <?php echo ($page["country"]=="Amerikan Samoa")?"selected":""; ?> value="Amerikan Samoa">Amerikan Samoa</option>
																<option <?php echo ($page["country"]=="Andorra")?"selected":""; ?> value="Andorra">Andorra</option>
																<option <?php echo ($page["country"]=="Angola")?"selected":""; ?> value="Angola">Angola</option>
																<option <?php echo ($page["country"]=="Anguilla")?"selected":""; ?> value="Anguilla">Anguilla</option>
																<option <?php echo ($page["country"]=="Antigua ve Barbuda")?"selected":""; ?> value="Antigua ve Barbuda">Antigua ve Barbuda</option>
																<option <?php echo ($page["country"]=="Arjantin")?"selected":""; ?> value="Arjantin">Arjantin</option>
																<option <?php echo ($page["country"]=="Arnavutluk")?"selected":""; ?> value="Arnavutluk">Arnavutluk</option>
																<option <?php echo ($page["country"]=="Aruba")?"selected":""; ?> value="Aruba">Aruba</option>
																<option <?php echo ($page["country"]=="Avustralya")?"selected":""; ?> value="Avustralya">Avustralya</option>
																<option <?php echo ($page["country"]=="Avusturya")?"selected":""; ?> value="Avusturya">Avusturya</option>
																<option <?php echo ($page["country"]=="Azerbaycan")?"selected":""; ?> value="Azerbaycan">Azerbaycan</option>
																<option <?php echo ($page["country"]=="Bahamalar")?"selected":""; ?> value="Bahamalar">Bahamalar</option>
																<option <?php echo ($page["country"]=="Bahreyn")?"selected":""; ?> value="Bahreyn">Bahreyn</option>
																<option <?php echo ($page["country"]=="Bangladeş")?"selected":""; ?> value="Bangladeş">Bangladeş</option>
																<option <?php echo ($page["country"]=="Barbados")?"selected":""; ?> value="Barbados">Barbados</option>
																<option <?php echo ($page["country"]=="Belize")?"selected":""; ?> value="Belize">Belize</option>
																<option <?php echo ($page["country"]=="Belçika")?"selected":""; ?> value="Belçika">Belçika</option>
																<option <?php echo ($page["country"]=="Benin")?"selected":""; ?> value="Benin">Benin</option>
																<option <?php echo ($page["country"]=="Bermuda")?"selected":""; ?> value="Bermuda">Bermuda</option>
																<option <?php echo ($page["country"]=="Beyaz Rusya")?"selected":""; ?> value="Beyaz Rusya">Beyaz Rusya</option>
																<option <?php echo ($page["country"]=="Birleşik Arap Emirlikleri")?"selected":""; ?> value="Birleşik Arap Emirlikleri">Birleşik Arap Emirlikleri</option>
																<option <?php echo ($page["country"]=="Birleşik Devletler")?"selected":""; ?> value="Birleşik Devletler">Birleşik Devletler</option>
																<option <?php echo ($page["country"]=="Birleşik Krallık")?"selected":""; ?> value="Birleşik Krallık">Birleşik Krallık</option>
																<option <?php echo ($page["country"]=="Birleşik Krallık Virgin Adaları")?"selected":""; ?> value="Birleşik Krallık Virgin Adaları">Birleşik Krallık Virgin Adaları</option>
																<option <?php echo ($page["country"]=="Bolivya")?"selected":""; ?> value="Bolivya">Bolivya</option>
																<option <?php echo ($page["country"]=="Bonaire, Sint Eustatius ve Saba")?"selected":""; ?> value="Bonaire, Sint Eustatius ve Saba">Bonaire, Sint Eustatius ve Saba</option>
																<option <?php echo ($page["country"]=="Bosna Hersek")?"selected":""; ?> value="Bosna Hersek">Bosna Hersek</option>
																<option <?php echo ($page["country"]=="Botsvana")?"selected":""; ?> value="Botsvana">Botsvana</option>
																<option <?php echo ($page["country"]=="Bouvet Adaları")?"selected":""; ?> value="Bouvet Adaları">Bouvet Adaları</option>
																<option <?php echo ($page["country"]=="Brezilya")?"selected":""; ?> value="Brezilya">Brezilya</option>
																<option <?php echo ($page["country"]=="Brunei")?"selected":""; ?> value="Brunei">Brunei</option>
																<option <?php echo ($page["country"]=="Bulgaristan")?"selected":""; ?> value="Bulgaristan">Bulgaristan</option>
																<option <?php echo ($page["country"]=="Burkina Faso")?"selected":""; ?> value="Burkina Faso">Burkina Faso</option>
																<option <?php echo ($page["country"]=="Burundi")?"selected":""; ?> value="Burundi">Burundi</option>
																<option <?php echo ($page["country"]=="Butan")?"selected":""; ?> value="Butan">Butan</option>
																<option <?php echo ($page["country"]=="Cape Verde")?"selected":""; ?> value="Cape Verde">Cape Verde</option>
																<option <?php echo ($page["country"]=="Cebelitarık")?"selected":""; ?> value="Cebelitarık">Cebelitarık</option>
																<option <?php echo ($page["country"]=="Cezayir")?"selected":""; ?> value="Cezayir">Cezayir</option>
																<option <?php echo ($page["country"]=="Christmas Adaları")?"selected":""; ?> value="Christmas Adaları">Christmas Adaları</option>
																<option <?php echo ($page["country"]=="Cibuti")?"selected":""; ?> value="Cibuti">Cibuti</option>
																<option <?php echo ($page["country"]=="Cocos Adaları")?"selected":""; ?> value="Cocos Adaları">Cocos Adaları</option>
																<option <?php echo ($page["country"]=="Cook Adaları")?"selected":""; ?> value="Cook Adaları">Cook Adaları</option>
																<option <?php echo ($page["country"]=="Danimarka")?"selected":""; ?> value="Danimarka">Danimarka</option>
																<option <?php echo ($page["country"]=="Demokratik Kongo Cumhuriyeti")?"selected":""; ?> value="Demokratik Kongo Cumhuriyeti">Demokratik Kongo Cumhuriyeti</option>
																<option <?php echo ($page["country"]=="Dominik")?"selected":""; ?> value="Dominik">Dominik</option>
																<option <?php echo ($page["country"]=="Dominik Cumhuriyeti")?"selected":""; ?> value="Dominik Cumhuriyeti">Dominik Cumhuriyeti</option>
																<option <?php echo ($page["country"]=="Ekvador")?"selected":""; ?> value="Ekvador">Ekvador</option>
																<option <?php echo ($page["country"]=="Ekvator Ginesi")?"selected":""; ?> value="Ekvator Ginesi">Ekvator Ginesi</option>
																<option <?php echo ($page["country"]=="El Salvador")?"selected":""; ?> value="El Salvador">El Salvador</option>
																<option <?php echo ($page["country"]=="Endonezya")?"selected":""; ?> value="Endonezya">Endonezya</option>
																<option <?php echo ($page["country"]=="Eritre")?"selected":""; ?> value="Eritre">Eritre</option>
																<option <?php echo ($page["country"]=="Ermenistan")?"selected":""; ?> value="Ermenistan">Ermenistan</option>
																<option <?php echo ($page["country"]=="Estonya")?"selected":""; ?> value="Estonya">Estonya</option>
																<option <?php echo ($page["country"]=="Etyopya")?"selected":""; ?> value="Etyopya">Etyopya</option>
																<option <?php echo ($page["country"]=="F.Y.R.O. Makedonya")?"selected":""; ?> value="F.Y.R.O. Makedonya">F.Y.R.O. Makedonya</option>
																<option <?php echo ($page["country"]=="Falkland Adaları")?"selected":""; ?> value="Falkland Adaları">Falkland Adaları</option>
																<option <?php echo ($page["country"]=="Faroe Adaları")?"selected":""; ?> value="Faroe Adaları">Faroe Adaları</option>
																<option <?php echo ($page["country"]=="Fas")?"selected":""; ?> value="Fas">Fas</option>
																<option <?php echo ($page["country"]=="Federal Mikronezya Devleti")?"selected":""; ?> value="Federal Mikronezya Devleti">Federal Mikronezya Devleti</option>
																<option <?php echo ($page["country"]=="Fiji")?"selected":""; ?> value="Fiji">Fiji</option>
																<option <?php echo ($page["country"]=="Fildişi Sahili")?"selected":""; ?> value="Fildişi Sahili">Fildişi Sahili</option>
																<option <?php echo ($page["country"]=="Filipinler")?"selected":""; ?> value="Filipinler">Filipinler</option>
																<option <?php echo ($page["country"]=="Filistin Bölgeleri")?"selected":""; ?> value="Filistin Bölgeleri">Filistin Bölgeleri</option>
																<option <?php echo ($page["country"]=="Finlandiya")?"selected":""; ?> value="Finlandiya">Finlandiya</option>
																<option <?php echo ($page["country"]=="Fransa")?"selected":""; ?> value="Fransa">Fransa</option>
																<option <?php echo ($page["country"]=="Fransız Ginesi")?"selected":""; ?> value="Fransız Ginesi">Fransız Ginesi</option>
																<option <?php echo ($page["country"]=="Fransız Güney ve Antarktika Toprakları")?"selected":""; ?> value="Fransız Güney ve Antarktika Toprakları">Fransız Güney ve Antarktika Toprakları</option>
																<option <?php echo ($page["country"]=="Fransız Polinezyası")?"selected":""; ?> value="Fransız Polinezyası">Fransız Polinezyası</option>
																<option <?php echo ($page["country"]=="Gabon")?"selected":""; ?> value="Gabon">Gabon</option>
																<option <?php echo ($page["country"]=="Gambiya")?"selected":""; ?> value="Gambiya">Gambiya</option>
																<option <?php echo ($page["country"]=="Gana")?"selected":""; ?> value="Gana">Gana</option>
																<option <?php echo ($page["country"]=="Gine")?"selected":""; ?> value="Gine">Gine</option>
																<option <?php echo ($page["country"]=="Gine-Bissau")?"selected":""; ?> value="Gine-Bissau">Gine-Bissau</option>
																<option <?php echo ($page["country"]=="Grenada")?"selected":""; ?> value="Grenada">Grenada</option>
																<option <?php echo ($page["country"]=="Grönland")?"selected":""; ?> value="Grönland">Grönland</option>
																<option <?php echo ($page["country"]=="Guadeloupe")?"selected":""; ?> value="Guadeloupe">Guadeloupe</option>
																<option <?php echo ($page["country"]=="Guam")?"selected":""; ?> value="Guam">Guam</option>
																<option <?php echo ($page["country"]=="Guatemala")?"selected":""; ?> value="Guatemala">Guatemala</option>
																<option <?php echo ($page["country"]=="Guyana")?"selected":""; ?> value="Guyana">Guyana</option>
																<option <?php echo ($page["country"]=="Güney Afrika")?"selected":""; ?> value="Güney Afrika">Güney Afrika</option>
																<option <?php echo ($page["country"]=="Güney Kore")?"selected":""; ?> value="Güney Kore">Güney Kore</option>
																<option <?php echo ($page["country"]=="Gürcistan")?"selected":""; ?> value="Gürcistan">Gürcistan</option>
																<option <?php echo ($page["country"]=="Haiti")?"selected":""; ?> value="Haiti">Haiti</option>
																<option <?php echo ($page["country"]=="Heard ve Mc Donald Adaları")?"selected":""; ?> value="Heard ve Mc Donald Adaları">Heard ve Mc Donald Adaları</option>
																<option <?php echo ($page["country"]=="Hindistan")?"selected":""; ?> value="Hindistan">Hindistan</option>
																<option <?php echo ($page["country"]=="Hollanda")?"selected":""; ?> value="Hollanda">Hollanda</option>
																<option <?php echo ($page["country"]=="Honduras")?"selected":""; ?> value="Honduras">Honduras</option>
																<option <?php echo ($page["country"]=="Hong Kong ÖİB")?"selected":""; ?> value="Hong Kong ÖİB">Hong Kong ÖİB</option>
																<option <?php echo ($page["country"]=="Hırvtistan")?"selected":""; ?> value="Hırvtistan">Hırvtistan</option>
																<option <?php echo ($page["country"]=="Jamaika")?"selected":""; ?> value="Jamaika">Jamaika</option>
																<option <?php echo ($page["country"]=="Japonya")?"selected":""; ?> value="Japonya">Japonya</option>
																<option <?php echo ($page["country"]=="Kamboçya")?"selected":""; ?> value="Kamboçya">Kamboçya</option>
																<option <?php echo ($page["country"]=="Kamerun")?"selected":""; ?> value="Kamerun">Kamerun</option>
																<option <?php echo ($page["country"]=="Kanada")?"selected":""; ?> value="Kanada">Kanada</option>
																<option <?php echo ($page["country"]=="Karadağ")?"selected":""; ?> value="Karadağ">Karadağ</option>
																<option <?php echo ($page["country"]=="Katar")?"selected":""; ?> value="Katar">Katar</option>
																<option <?php echo ($page["country"]=="Kayman Adaları")?"selected":""; ?> value="Kayman Adaları">Kayman Adaları</option>
																<option <?php echo ($page["country"]=="Kazakistan")?"selected":""; ?> value="Kazakistan">Kazakistan</option>
																<option <?php echo ($page["country"]=="Kenya")?"selected":""; ?> value="Kenya">Kenya</option>
																<option <?php echo ($page["country"]=="Kiribati")?"selected":""; ?> value="Kiribati">Kiribati</option>
																<option <?php echo ($page["country"]=="Kolombiya")?"selected":""; ?> value="Kolombiya">Kolombiya</option>
																<option <?php echo ($page["country"]=="Komor")?"selected":""; ?> value="Komor">Komor</option>
																<option <?php echo ($page["country"]=="Kongo Cumhuriyeti")?"selected":""; ?> value="Kongo Cumhuriyeti">Kongo Cumhuriyeti</option>
																<option <?php echo ($page["country"]=="Kosta Rika")?"selected":""; ?> value="Kosta Rika">Kosta Rika</option>
																<option <?php echo ($page["country"]=="Kurasao")?"selected":""; ?> value="Kurasao">Kurasao</option>
																<option <?php echo ($page["country"]=="Kuveyt")?"selected":""; ?> value="Kuveyt">Kuveyt</option>
																<option <?php echo ($page["country"]=="Kuzey Kıbrıs")?"selected":""; ?> value="Kuzey Kıbrıs">Kuzey Kıbrıs</option>
																<option <?php echo ($page["country"]=="Kuzey Mariana Adaları")?"selected":""; ?> value="Kuzey Mariana Adaları">Kuzey Mariana Adaları</option>
																<option <?php echo ($page["country"]=="Küba")?"selected":""; ?> value="Küba">Küba</option>
																<option <?php echo ($page["country"]=="Kıbrıs")?"selected":""; ?> value="Kıbrıs">Kıbrıs</option>
																<option <?php echo ($page["country"]=="Kırgızistan")?"selected":""; ?> value="Kırgızistan">Kırgızistan</option>
																<option <?php echo ($page["country"]=="Laos")?"selected":""; ?> value="Laos">Laos</option>
																<option <?php echo ($page["country"]=="Lesoto")?"selected":""; ?> value="Lesoto">Lesoto</option>
																<option <?php echo ($page["country"]=="Letonya")?"selected":""; ?> value="Letonya">Letonya</option>
																<option <?php echo ($page["country"]=="Liberya")?"selected":""; ?> value="Liberya">Liberya</option>
																<option <?php echo ($page["country"]=="Libya")?"selected":""; ?> value="Libya">Libya</option>
																<option <?php echo ($page["country"]=="Liechtenstein")?"selected":""; ?> value="Liechtenstein">Liechtenstein</option>
																<option <?php echo ($page["country"]=="Litvanya")?"selected":""; ?> value="Litvanya">Litvanya</option>
																<option <?php echo ($page["country"]=="Lübnan")?"selected":""; ?> value="Lübnan">Lübnan</option>
																<option <?php echo ($page["country"]=="Lüksemburg")?"selected":""; ?> value="Lüksemburg">Lüksemburg</option>
																<option <?php echo ($page["country"]=="Macaristan")?"selected":""; ?> value="Macaristan">Macaristan</option>
																<option <?php echo ($page["country"]=="Macau ÖİB")?"selected":""; ?> value="Macau ÖİB">Macau ÖİB</option>
																<option <?php echo ($page["country"]=="Madagaskar")?"selected":""; ?> value="Madagaskar">Madagaskar</option>
																<option <?php echo ($page["country"]=="Malavi")?"selected":""; ?> value="Malavi">Malavi</option>
																<option <?php echo ($page["country"]=="Maldivler")?"selected":""; ?> value="Maldivler">Maldivler</option>
																<option <?php echo ($page["country"]=="Malezya")?"selected":""; ?> value="Malezya">Malezya</option>
																<option <?php echo ($page["country"]=="Mali")?"selected":""; ?> value="Mali">Mali</option>
																<option <?php echo ($page["country"]=="Malta")?"selected":""; ?> value="Malta">Malta</option>
																<option <?php echo ($page["country"]=="Maritus")?"selected":""; ?> value="Maritus">Maritus</option>
																<option <?php echo ($page["country"]=="Marshall Adaları")?"selected":""; ?> value="Marshall Adaları">Marshall Adaları</option>
																<option <?php echo ($page["country"]=="Martinik")?"selected":""; ?> value="Martinik">Martinik</option>
																<option <?php echo ($page["country"]=="Mayotte")?"selected":""; ?> value="Mayotte">Mayotte</option>
																<option <?php echo ($page["country"]=="Meksika")?"selected":""; ?> value="Meksika">Meksika</option>
																<option <?php echo ($page["country"]=="Moldova")?"selected":""; ?> value="Moldova">Moldova</option>
																<option <?php echo ($page["country"]=="Monako")?"selected":""; ?> value="Monako">Monako</option>
																<option <?php echo ($page["country"]=="Montserrat")?"selected":""; ?> value="Montserrat">Montserrat</option>
																<option <?php echo ($page["country"]=="Moritanya")?"selected":""; ?> value="Moritanya">Moritanya</option>
																<option <?php echo ($page["country"]=="Mozambik")?"selected":""; ?> value="Mozambik">Mozambik</option>
																<option <?php echo ($page["country"]=="Moğolistan")?"selected":""; ?> value="Moğolistan">Moğolistan</option>
																<option <?php echo ($page["country"]=="Myanmar")?"selected":""; ?> value="Myanmar">Myanmar</option>
																<option <?php echo ($page["country"]=="Mısır")?"selected":""; ?> value="Mısır">Mısır</option>
																<option <?php echo ($page["country"]=="Namibya")?"selected":""; ?> value="Namibya">Namibya</option>
																<option <?php echo ($page["country"]=="Nauru")?"selected":""; ?> value="Nauru">Nauru</option>
																<option <?php echo ($page["country"]=="Nepal")?"selected":""; ?> value="Nepal">Nepal</option>
																<option <?php echo ($page["country"]=="Nijer")?"selected":""; ?> value="Nijer">Nijer</option>
																<option <?php echo ($page["country"]=="Nijerya")?"selected":""; ?> value="Nijerya">Nijerya</option>
																<option <?php echo ($page["country"]=="Nikaragua")?"selected":""; ?> value="Nikaragua">Nikaragua</option>
																<option <?php echo ($page["country"]=="Niue")?"selected":""; ?> value="Niue">Niue</option>
																<option <?php echo ($page["country"]=="Norfolk Adaları")?"selected":""; ?> value="Norfolk Adaları">Norfolk Adaları</option>
																<option <?php echo ($page["country"]=="Norveç")?"selected":""; ?> value="Norveç">Norveç</option>
																<option <?php echo ($page["country"]=="Pakistan")?"selected":""; ?> value="Pakistan">Pakistan</option>
																<option <?php echo ($page["country"]=="Palau")?"selected":""; ?> value="Palau">Palau</option>
																<option <?php echo ($page["country"]=="Panama")?"selected":""; ?> value="Panama">Panama</option>
																<option <?php echo ($page["country"]=="Papua Yeni Gine")?"selected":""; ?> value="Papua Yeni Gine">Papua Yeni Gine</option>
																<option <?php echo ($page["country"]=="Paraguay")?"selected":""; ?> value="Paraguay">Paraguay</option>
																<option <?php echo ($page["country"]=="Peru")?"selected":""; ?> value="Peru">Peru</option>
																<option <?php echo ($page["country"]=="Pitcairn Adası")?"selected":""; ?> value="Pitcairn Adası">Pitcairn Adası</option>
																<option <?php echo ($page["country"]=="Polonya")?"selected":""; ?> value="Polonya">Polonya</option>
																<option <?php echo ($page["country"]=="Portekiz")?"selected":""; ?> value="Portekiz">Portekiz</option>
																<option <?php echo ($page["country"]=="Porto Riko")?"selected":""; ?> value="Porto Riko">Porto Riko</option>
																<option <?php echo ($page["country"]=="Reunion")?"selected":""; ?> value="Reunion">Reunion</option>
																<option <?php echo ($page["country"]=="Romanya")?"selected":""; ?> value="Romanya">Romanya</option>
																<option <?php echo ($page["country"]=="Ruanda")?"selected":""; ?> value="Ruanda">Ruanda</option>
																<option <?php echo ($page["country"]=="Rusya")?"selected":""; ?> value="Rusya">Rusya</option>
																<option <?php echo ($page["country"]=="Saint Kitts ve Nevis")?"selected":""; ?> value="Saint Kitts ve Nevis">Saint Kitts ve Nevis</option>
																<option <?php echo ($page["country"]=="Saint Lucia")?"selected":""; ?> value="Saint Lucia">Saint Lucia</option>
																<option <?php echo ($page["country"]=="Saint Vincent ve Granada")?"selected":""; ?> value="Saint Vincent ve Granada">Saint Vincent ve Granada</option>
																<option <?php echo ($page["country"]=="Samoa")?"selected":""; ?> value="Samoa">Samoa</option>
																<option <?php echo ($page["country"]=="San Marino")?"selected":""; ?> value="San Marino">San Marino</option>
																<option <?php echo ($page["country"]=="Sao Tome ve Principe")?"selected":""; ?> value="Sao Tome ve Principe">Sao Tome ve Principe</option>
																<option <?php echo ($page["country"]=="Senegal")?"selected":""; ?> value="Senegal">Senegal</option>
																<option <?php echo ($page["country"]=="Seyşeller")?"selected":""; ?> value="Seyşeller">Seyşeller</option>
																<option <?php echo ($page["country"]=="Sierra Leone")?"selected":""; ?> value="Sierra Leone">Sierra Leone</option>
																<option <?php echo ($page["country"]=="Singapur")?"selected":""; ?> value="Singapur">Singapur</option>
																<option <?php echo ($page["country"]=="Sint Maarten")?"selected":""; ?> value="Sint Maarten">Sint Maarten</option>
																<option <?php echo ($page["country"]=="Slovakya")?"selected":""; ?> value="Slovakya">Slovakya</option>
																<option <?php echo ($page["country"]=="Slovenya")?"selected":""; ?> value="Slovenya">Slovenya</option>
																<option <?php echo ($page["country"]=="Solomon Adaları")?"selected":""; ?> value="Solomon Adaları">Solomon Adaları</option>
																<option <?php echo ($page["country"]=="Sri Lanka")?"selected":""; ?> value="Sri Lanka">Sri Lanka</option>
																<option <?php echo ($page["country"]=="St. Barthelemy")?"selected":""; ?> value="St. Barthelemy">St. Barthelemy</option>
																<option <?php echo ($page["country"]=="St. Helena")?"selected":""; ?> value="St. Helena">St. Helena</option>
																<option <?php echo ($page["country"]=="St. Martin")?"selected":""; ?> value="St. Martin">St. Martin</option>
																<option <?php echo ($page["country"]=="St. Pierre ve Miquelon")?"selected":""; ?> value="St. Pierre ve Miquelon">St. Pierre ve Miquelon</option>
																<option <?php echo ($page["country"]=="Sudan")?"selected":""; ?> value="Sudan">Sudan</option>
																<option <?php echo ($page["country"]=="Surinam")?"selected":""; ?> value="Surinam">Surinam</option>
																<option <?php echo ($page["country"]=="Suudi Arabistan")?"selected":""; ?> value="Suudi Arabistan">Suudi Arabistan</option>
																<option <?php echo ($page["country"]=="Svalbard")?"selected":""; ?> value="Svalbard">Svalbard</option>
																<option <?php echo ($page["country"]=="Svaziland")?"selected":""; ?> value="Svaziland">Svaziland</option>
																<option <?php echo ($page["country"]=="Sırbistan")?"selected":""; ?> value="Sırbistan">Sırbistan</option>
																<option <?php echo ($page["country"]=="Tacikistan")?"selected":""; ?> value="Tacikistan">Tacikistan</option>
																<option <?php echo ($page["country"]=="Tanzanya")?"selected":""; ?> value="Tanzanya">Tanzanya</option>
																<option <?php echo ($page["country"]=="Tayland")?"selected":""; ?> value="Tayland">Tayland</option>
																<option <?php echo ($page["country"]=="Tayvan")?"selected":""; ?> value="Tayvan">Tayvan</option>
																<option <?php echo ($page["country"]=="Togo")?"selected":""; ?> value="Togo">Togo</option>
																<option <?php echo ($page["country"]=="Tokelau")?"selected":""; ?> value="Tokelau">Tokelau</option>
																<option <?php echo ($page["country"]=="Tonga")?"selected":""; ?> value="Tonga">Tonga</option>
																<option <?php echo ($page["country"]=="Trinidad ve Tobago")?"selected":""; ?> value="Trinidad ve Tobago">Trinidad ve Tobago</option>
																<option <?php echo ($page["country"]=="Tunus")?"selected":""; ?> value="Tunus">Tunus</option>
																<option <?php echo ($page["country"]=="Turks ve Caicos")?"selected":""; ?> value="Turks ve Caicos">Turks ve Caicos</option>
																<option <?php echo ($page["country"]=="Tuvalu")?"selected":""; ?> value="Tuvalu">Tuvalu</option>
																<option <?php echo ($page["country"]=="Türkmenistan")?"selected":""; ?> value="Türkmenistan">Türkmenistan</option>
																<option <?php echo ($page["country"]=="Uganda")?"selected":""; ?> value="Uganda">Uganda</option>
																<option <?php echo ($page["country"]=="Ukrayna")?"selected":""; ?> value="Ukrayna">Ukrayna</option>
																<option <?php echo ($page["country"]=="Umman")?"selected":""; ?> value="Umman">Umman</option>
																<option <?php echo ($page["country"]=="Uruguay")?"selected":""; ?> value="Uruguay">Uruguay</option>
																<option <?php echo ($page["country"]=="Vanuatu")?"selected":""; ?> value="Vanuatu">Vanuatu</option>
																<option <?php echo ($page["country"]=="Vatikan Şehri")?"selected":""; ?> value="Vatikan Şehri">Vatikan Şehri</option>
																<option <?php echo ($page["country"]=="Venezuela")?"selected":""; ?> value="Venezuela">Venezuela</option>
																<option <?php echo ($page["country"]=="Vietnam")?"selected":""; ?> value="Vietnam">Vietnam</option>
																<option <?php echo ($page["country"]=="Wallis and Futuna")?"selected":""; ?> value="Wallis and Futuna">Wallis and Futuna</option>
																<option <?php echo ($page["country"]=="Yeni Kaledonya")?"selected":""; ?> value="Yeni Kaledonya">Yeni Kaledonya</option>
																<option <?php echo ($page["country"]=="Yeni Zelanda")?"selected":""; ?> value="Yeni Zelanda">Yeni Zelanda</option>
																<option <?php echo ($page["country"]=="Yunanistan")?"selected":""; ?> value="Yunanistan">Yunanistan</option>
																<option <?php echo ($page["country"]=="Zambiya")?"selected":""; ?> value="Zambiya">Zambiya</option>
																<option <?php echo ($page["country"]=="Zimbabve")?"selected":""; ?> value="Zimbabve">Zimbabve</option>
																<option <?php echo ($page["country"]=="Çad")?"selected":""; ?> value="Çad">Çad</option>
																<option <?php echo ($page["country"]=="Çek Cumhuriyeti")?"selected":""; ?> value="Çek Cumhuriyeti">Çek Cumhuriyeti</option>
																<option <?php echo ($page["country"]=="Çin")?"selected":""; ?> value="Çin">Çin</option>
																<option <?php echo ($page["country"]=="Özbekistan")?"selected":""; ?> value="Özbekistan">Özbekistan</option>
																<option <?php echo ($page["country"]=="Ürdün")?"selected":""; ?> value="Ürdün">Ürdün</option>
																<option <?php echo ($page["country"]=="İngiliz Hint Okyanusu Bölgesi")?"selected":""; ?> value="İngiliz Hint Okyanusu Bölgesi">İngiliz Hint Okyanusu Bölgesi</option>
																<option <?php echo ($page["country"]=="İrlanda")?"selected":""; ?> value="İrlanda">İrlanda</option>
																<option <?php echo ($page["country"]=="İspanya")?"selected":""; ?> value="İspanya">İspanya</option>
																<option <?php echo ($page["country"]=="İsrail")?"selected":""; ?> value="İsrail">İsrail</option>
																<option <?php echo ($page["country"]=="İsveç")?"selected":""; ?> value="İsveç">İsveç</option>
																<option <?php echo ($page["country"]=="İsviçre")?"selected":""; ?> value="İsviçre">İsviçre</option>
																<option <?php echo ($page["country"]=="İtalya")?"selected":""; ?> value="İtalya">İtalya</option>
																<option <?php echo ($page["country"]=="İzlanda")?"selected":""; ?> value="İzlanda">İzlanda</option>
																<option <?php echo ($page["country"]=="Şili")?"selected":""; ?> value="Şili">Şili</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="idno">Kimlik Numarası</label>
															<input type="text" class="form-control" id="idno" name="idno" value="<?php echo $page["idno"]; ?>" />
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="address">Adres</label>
															<textarea class="form-control" id="address" name="address" rows="3"><?php echo $page["address"]; ?></textarea>
														</div>
													</div>
													<div class="col-md-12 mb-10 mt-10">
														<?php $invoice = json_decode($page["invoice"]); ?>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="chck1" <?php echo ($invoice->name == "")?"":"checked"; ?>>
															<label class="custom-control-label" for="chck1">Fatura bilgileri farklı girilecek</label>
														</div>
														<div id="ccCllapsInvoice" class="mt-10 <?php echo ($invoice->name == "")?"hidden":""; ?>">
															<h5>Fatura Bilgileri</h5>
															<hr>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="name">Ad</label>
																		<input type="text" class="form-control" id="name" name="invoice[name]" value="<?php echo $invoice->name; ?>" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="surname">Soyad</label>
																		<input type="text" class="form-control" id="surname" name="invoice[surname]" value="<?php echo $invoice->surname; ?>" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="phone">Telefon</label>
																		<input type="text" class="form-control" id="phone" name="invoice[phone]" value="<?php echo $invoice->phone; ?>" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="email">E-posta</label>
																		<input type="text" class="form-control" id="email" name="invoice[email]" value="<?php echo $invoice->email; ?>" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="country">Ülke</label>
																		<select id="country" name="invoice[country]" class="form-control custom-select">
																			<option <?php echo ($invoice->country=="Türkiye")?"selected":""; ?> value="Türkiye">Türkiye</option>
																			<option <?php echo ($invoice->country=="ABD Virgin Adaları")?"selected":""; ?> value="ABD Virgin Adaları">ABD Virgin Adaları</option>
																			<option <?php echo ($invoice->country=="ABD Çevresindeki Küçük Adalar")?"selected":""; ?> value="ABD Çevresindeki Küçük Adalar">ABD Çevresindeki Küçük Adalar</option>
																			<option <?php echo ($invoice->country=="Almanya")?"selected":""; ?> value="Almanya">Almanya</option>
																			<option <?php echo ($invoice->country=="Amerikan Samoa")?"selected":""; ?> value="Amerikan Samoa">Amerikan Samoa</option>
																			<option <?php echo ($invoice->country=="Andorra")?"selected":""; ?> value="Andorra">Andorra</option>
																			<option <?php echo ($invoice->country=="Angola")?"selected":""; ?> value="Angola">Angola</option>
																			<option <?php echo ($invoice->country=="Anguilla")?"selected":""; ?> value="Anguilla">Anguilla</option>
																			<option <?php echo ($invoice->country=="Antigua ve Barbuda")?"selected":""; ?> value="Antigua ve Barbuda">Antigua ve Barbuda</option>
																			<option <?php echo ($invoice->country=="Arjantin")?"selected":""; ?> value="Arjantin">Arjantin</option>
																			<option <?php echo ($invoice->country=="Arnavutluk")?"selected":""; ?> value="Arnavutluk">Arnavutluk</option>
																			<option <?php echo ($invoice->country=="Aruba")?"selected":""; ?> value="Aruba">Aruba</option>
																			<option <?php echo ($invoice->country=="Avustralya")?"selected":""; ?> value="Avustralya">Avustralya</option>
																			<option <?php echo ($invoice->country=="Avusturya")?"selected":""; ?> value="Avusturya">Avusturya</option>
																			<option <?php echo ($invoice->country=="Azerbaycan")?"selected":""; ?> value="Azerbaycan">Azerbaycan</option>
																			<option <?php echo ($invoice->country=="Bahamalar")?"selected":""; ?> value="Bahamalar">Bahamalar</option>
																			<option <?php echo ($invoice->country=="Bahreyn")?"selected":""; ?> value="Bahreyn">Bahreyn</option>
																			<option <?php echo ($invoice->country=="Bangladeş")?"selected":""; ?> value="Bangladeş">Bangladeş</option>
																			<option <?php echo ($invoice->country=="Barbados")?"selected":""; ?> value="Barbados">Barbados</option>
																			<option <?php echo ($invoice->country=="Belize")?"selected":""; ?> value="Belize">Belize</option>
																			<option <?php echo ($invoice->country=="Belçika")?"selected":""; ?> value="Belçika">Belçika</option>
																			<option <?php echo ($invoice->country=="Benin")?"selected":""; ?> value="Benin">Benin</option>
																			<option <?php echo ($invoice->country=="Bermuda")?"selected":""; ?> value="Bermuda">Bermuda</option>
																			<option <?php echo ($invoice->country=="Beyaz Rusya")?"selected":""; ?> value="Beyaz Rusya">Beyaz Rusya</option>
																			<option <?php echo ($invoice->country=="Birleşik Arap Emirlikleri")?"selected":""; ?> value="Birleşik Arap Emirlikleri">Birleşik Arap Emirlikleri</option>
																			<option <?php echo ($invoice->country=="Birleşik Devletler")?"selected":""; ?> value="Birleşik Devletler">Birleşik Devletler</option>
																			<option <?php echo ($invoice->country=="Birleşik Krallık")?"selected":""; ?> value="Birleşik Krallık">Birleşik Krallık</option>
																			<option <?php echo ($invoice->country=="Birleşik Krallık Virgin Adaları")?"selected":""; ?> value="Birleşik Krallık Virgin Adaları">Birleşik Krallık Virgin Adaları</option>
																			<option <?php echo ($invoice->country=="Bolivya")?"selected":""; ?> value="Bolivya">Bolivya</option>
																			<option <?php echo ($invoice->country=="Bonaire, Sint Eustatius ve Saba")?"selected":""; ?> value="Bonaire, Sint Eustatius ve Saba">Bonaire, Sint Eustatius ve Saba</option>
																			<option <?php echo ($invoice->country=="Bosna Hersek")?"selected":""; ?> value="Bosna Hersek">Bosna Hersek</option>
																			<option <?php echo ($invoice->country=="Botsvana")?"selected":""; ?> value="Botsvana">Botsvana</option>
																			<option <?php echo ($invoice->country=="Bouvet Adaları")?"selected":""; ?> value="Bouvet Adaları">Bouvet Adaları</option>
																			<option <?php echo ($invoice->country=="Brezilya")?"selected":""; ?> value="Brezilya">Brezilya</option>
																			<option <?php echo ($invoice->country=="Brunei")?"selected":""; ?> value="Brunei">Brunei</option>
																			<option <?php echo ($invoice->country=="Bulgaristan")?"selected":""; ?> value="Bulgaristan">Bulgaristan</option>
																			<option <?php echo ($invoice->country=="Burkina Faso")?"selected":""; ?> value="Burkina Faso">Burkina Faso</option>
																			<option <?php echo ($invoice->country=="Burundi")?"selected":""; ?> value="Burundi">Burundi</option>
																			<option <?php echo ($invoice->country=="Butan")?"selected":""; ?> value="Butan">Butan</option>
																			<option <?php echo ($invoice->country=="Cape Verde")?"selected":""; ?> value="Cape Verde">Cape Verde</option>
																			<option <?php echo ($invoice->country=="Cebelitarık")?"selected":""; ?> value="Cebelitarık">Cebelitarık</option>
																			<option <?php echo ($invoice->country=="Cezayir")?"selected":""; ?> value="Cezayir">Cezayir</option>
																			<option <?php echo ($invoice->country=="Christmas Adaları")?"selected":""; ?> value="Christmas Adaları">Christmas Adaları</option>
																			<option <?php echo ($invoice->country=="Cibuti")?"selected":""; ?> value="Cibuti">Cibuti</option>
																			<option <?php echo ($invoice->country=="Cocos Adaları")?"selected":""; ?> value="Cocos Adaları">Cocos Adaları</option>
																			<option <?php echo ($invoice->country=="Cook Adaları")?"selected":""; ?> value="Cook Adaları">Cook Adaları</option>
																			<option <?php echo ($invoice->country=="Danimarka")?"selected":""; ?> value="Danimarka">Danimarka</option>
																			<option <?php echo ($invoice->country=="Demokratik Kongo Cumhuriyeti")?"selected":""; ?> value="Demokratik Kongo Cumhuriyeti">Demokratik Kongo Cumhuriyeti</option>
																			<option <?php echo ($invoice->country=="Dominik")?"selected":""; ?> value="Dominik">Dominik</option>
																			<option <?php echo ($invoice->country=="Dominik Cumhuriyeti")?"selected":""; ?> value="Dominik Cumhuriyeti">Dominik Cumhuriyeti</option>
																			<option <?php echo ($invoice->country=="Ekvador")?"selected":""; ?> value="Ekvador">Ekvador</option>
																			<option <?php echo ($invoice->country=="Ekvator Ginesi")?"selected":""; ?> value="Ekvator Ginesi">Ekvator Ginesi</option>
																			<option <?php echo ($invoice->country=="El Salvador")?"selected":""; ?> value="El Salvador">El Salvador</option>
																			<option <?php echo ($invoice->country=="Endonezya")?"selected":""; ?> value="Endonezya">Endonezya</option>
																			<option <?php echo ($invoice->country=="Eritre")?"selected":""; ?> value="Eritre">Eritre</option>
																			<option <?php echo ($invoice->country=="Ermenistan")?"selected":""; ?> value="Ermenistan">Ermenistan</option>
																			<option <?php echo ($invoice->country=="Estonya")?"selected":""; ?> value="Estonya">Estonya</option>
																			<option <?php echo ($invoice->country=="Etyopya")?"selected":""; ?> value="Etyopya">Etyopya</option>
																			<option <?php echo ($invoice->country=="F.Y.R.O. Makedonya")?"selected":""; ?> value="F.Y.R.O. Makedonya">F.Y.R.O. Makedonya</option>
																			<option <?php echo ($invoice->country=="Falkland Adaları")?"selected":""; ?> value="Falkland Adaları">Falkland Adaları</option>
																			<option <?php echo ($invoice->country=="Faroe Adaları")?"selected":""; ?> value="Faroe Adaları">Faroe Adaları</option>
																			<option <?php echo ($invoice->country=="Fas")?"selected":""; ?> value="Fas">Fas</option>
																			<option <?php echo ($invoice->country=="Federal Mikronezya Devleti")?"selected":""; ?> value="Federal Mikronezya Devleti">Federal Mikronezya Devleti</option>
																			<option <?php echo ($invoice->country=="Fiji")?"selected":""; ?> value="Fiji">Fiji</option>
																			<option <?php echo ($invoice->country=="Fildişi Sahili")?"selected":""; ?> value="Fildişi Sahili">Fildişi Sahili</option>
																			<option <?php echo ($invoice->country=="Filipinler")?"selected":""; ?> value="Filipinler">Filipinler</option>
																			<option <?php echo ($invoice->country=="Filistin Bölgeleri")?"selected":""; ?> value="Filistin Bölgeleri">Filistin Bölgeleri</option>
																			<option <?php echo ($invoice->country=="Finlandiya")?"selected":""; ?> value="Finlandiya">Finlandiya</option>
																			<option <?php echo ($invoice->country=="Fransa")?"selected":""; ?> value="Fransa">Fransa</option>
																			<option <?php echo ($invoice->country=="Fransız Ginesi")?"selected":""; ?> value="Fransız Ginesi">Fransız Ginesi</option>
																			<option <?php echo ($page["country"]=="Fransız Güney ve Antarktika Toprakları")?"selected":""; ?> value="Fransız Güney ve Antarktika Toprakları">Fransız Güney ve Antarktika Toprakları</option>invoice->countryecho ($invoice->country=="Fransız Polinezyası")?"selected":""; ?> value="Fransız Polinezyası">Fransız Polinezyası</option>
																			<option <?php echo ($invoice->country=="Gabon")?"selected":""; ?> value="Gabon">Gabon</option>
																			<option <?php echo ($invoice->country=="Gambiya")?"selected":""; ?> value="Gambiya">Gambiya</option>
																			<option <?php echo ($invoice->country=="Gana")?"selected":""; ?> value="Gana">Gana</option>
																			<option <?php echo ($invoice->country=="Gine")?"selected":""; ?> value="Gine">Gine</option>
																			<option <?php echo ($invoice->country=="Gine-Bissau")?"selected":""; ?> value="Gine-Bissau">Gine-Bissau</option>
																			<option <?php echo ($invoice->country=="Grenada")?"selected":""; ?> value="Grenada">Grenada</option>
																			<option <?php echo ($invoice->country=="Grönland")?"selected":""; ?> value="Grönland">Grönland</option>
																			<option <?php echo ($invoice->country=="Guadeloupe")?"selected":""; ?> value="Guadeloupe">Guadeloupe</option>
																			<option <?php echo ($invoice->country=="Guam")?"selected":""; ?> value="Guam">Guam</option>
																			<option <?php echo ($invoice->country=="Guatemala")?"selected":""; ?> value="Guatemala">Guatemala</option>
																			<option <?php echo ($invoice->country=="Guyana")?"selected":""; ?> value="Guyana">Guyana</option>
																			<option <?php echo ($invoice->country=="Güney Afrika")?"selected":""; ?> value="Güney Afrika">Güney Afrika</option>
																			<option <?php echo ($invoice->country=="Güney Kore")?"selected":""; ?> value="Güney Kore">Güney Kore</option>
																			<option <?php echo ($invoice->country=="Gürcistan")?"selected":""; ?> value="Gürcistan">Gürcistan</option>
																			<option <?php echo ($invoice->country=="Haiti")?"selected":""; ?> value="Haiti">Haiti</option>
																			<option <?php echo ($invoice->country=="Heard ve Mc Donald Adaları")?"selected":""; ?> value="Heard ve Mc Donald Adaları">Heard ve Mc Donald Adaları</option>
																			<option <?php echo ($invoice->country=="Hindistan")?"selected":""; ?> value="Hindistan">Hindistan</option>
																			<option <?php echo ($invoice->country=="Hollanda")?"selected":""; ?> value="Hollanda">Hollanda</option>
																			<option <?php echo ($invoice->country=="Honduras")?"selected":""; ?> value="Honduras">Honduras</option>
																			<option <?php echo ($invoice->country=="Hong Kong ÖİB")?"selected":""; ?> value="Hong Kong ÖİB">Hong Kong ÖİB</option>
																			<option <?php echo ($invoice->country=="Hırvtistan")?"selected":""; ?> value="Hırvtistan">Hırvtistan</option>
																			<option <?php echo ($invoice->country=="Jamaika")?"selected":""; ?> value="Jamaika">Jamaika</option>
																			<option <?php echo ($invoice->country=="Japonya")?"selected":""; ?> value="Japonya">Japonya</option>
																			<option <?php echo ($invoice->country=="Kamboçya")?"selected":""; ?> value="Kamboçya">Kamboçya</option>
																			<option <?php echo ($invoice->country=="Kamerun")?"selected":""; ?> value="Kamerun">Kamerun</option>
																			<option <?php echo ($invoice->country=="Kanada")?"selected":""; ?> value="Kanada">Kanada</option>
																			<option <?php echo ($invoice->country=="Karadağ")?"selected":""; ?> value="Karadağ">Karadağ</option>
																			<option <?php echo ($invoice->country=="Katar")?"selected":""; ?> value="Katar">Katar</option>
																			<option <?php echo ($invoice->country=="Kayman Adaları")?"selected":""; ?> value="Kayman Adaları">Kayman Adaları</option>
																			<option <?php echo ($invoice->country=="Kazakistan")?"selected":""; ?> value="Kazakistan">Kazakistan</option>
																			<option <?php echo ($invoice->country=="Kenya")?"selected":""; ?> value="Kenya">Kenya</option>
																			<option <?php echo ($invoice->country=="Kiribati")?"selected":""; ?> value="Kiribati">Kiribati</option>
																			<option <?php echo ($invoice->country=="Kolombiya")?"selected":""; ?> value="Kolombiya">Kolombiya</option>
																			<option <?php echo ($invoice->country=="Komor")?"selected":""; ?> value="Komor">Komor</option>
																			<option <?php echo ($invoice->country=="Kongo Cumhuriyeti")?"selected":""; ?> value="Kongo Cumhuriyeti">Kongo Cumhuriyeti</option>
																			<option <?php echo ($invoice->country=="Kosta Rika")?"selected":""; ?> value="Kosta Rika">Kosta Rika</option>
																			<option <?php echo ($invoice->country=="Kurasao")?"selected":""; ?> value="Kurasao">Kurasao</option>
																			<option <?php echo ($invoice->country=="Kuveyt")?"selected":""; ?> value="Kuveyt">Kuveyt</option>
																			<option <?php echo ($invoice->country=="Kuzey Kıbrıs")?"selected":""; ?> value="Kuzey Kıbrıs">Kuzey Kıbrıs</option>
																			<option <?php echo ($invoice->country=="Kuzey Mariana Adaları")?"selected":""; ?> value="Kuzey Mariana Adaları">Kuzey Mariana Adaları</option>
																			<option <?php echo ($invoice->country=="Küba")?"selected":""; ?> value="Küba">Küba</option>
																			<option <?php echo ($invoice->country=="Kıbrıs")?"selected":""; ?> value="Kıbrıs">Kıbrıs</option>
																			<option <?php echo ($invoice->country=="Kırgızistan")?"selected":""; ?> value="Kırgızistan">Kırgızistan</option>
																			<option <?php echo ($invoice->country=="Laos")?"selected":""; ?> value="Laos">Laos</option>
																			<option <?php echo ($invoice->country=="Lesoto")?"selected":""; ?> value="Lesoto">Lesoto</option>
																			<option <?php echo ($invoice->country=="Letonya")?"selected":""; ?> value="Letonya">Letonya</option>
																			<option <?php echo ($invoice->country=="Liberya")?"selected":""; ?> value="Liberya">Liberya</option>
																			<option <?php echo ($invoice->country=="Libya")?"selected":""; ?> value="Libya">Libya</option>
																			<option <?php echo ($invoice->country=="Liechtenstein")?"selected":""; ?> value="Liechtenstein">Liechtenstein</option>
																			<option <?php echo ($invoice->country=="Litvanya")?"selected":""; ?> value="Litvanya">Litvanya</option>
																			<option <?php echo ($invoice->country=="Lübnan")?"selected":""; ?> value="Lübnan">Lübnan</option>
																			<option <?php echo ($invoice->country=="Lüksemburg")?"selected":""; ?> value="Lüksemburg">Lüksemburg</option>
																			<option <?php echo ($invoice->country=="Macaristan")?"selected":""; ?> value="Macaristan">Macaristan</option>
																			<option <?php echo ($invoice->country=="Macau ÖİB")?"selected":""; ?> value="Macau ÖİB">Macau ÖİB</option>
																			<option <?php echo ($invoice->country=="Madagaskar")?"selected":""; ?> value="Madagaskar">Madagaskar</option>
																			<option <?php echo ($invoice->country=="Malavi")?"selected":""; ?> value="Malavi">Malavi</option>
																			<option <?php echo ($invoice->country=="Maldivler")?"selected":""; ?> value="Maldivler">Maldivler</option>
																			<option <?php echo ($invoice->country=="Malezya")?"selected":""; ?> value="Malezya">Malezya</option>
																			<option <?php echo ($invoice->country=="Mali")?"selected":""; ?> value="Mali">Mali</option>
																			<option <?php echo ($invoice->country=="Malta")?"selected":""; ?> value="Malta">Malta</option>
																			<option <?php echo ($invoice->country=="Maritus")?"selected":""; ?> value="Maritus">Maritus</option>
																			<option <?php echo ($invoice->country=="Marshall Adaları")?"selected":""; ?> value="Marshall Adaları">Marshall Adaları</option>
																			<option <?php echo ($invoice->country=="Martinik")?"selected":""; ?> value="Martinik">Martinik</option>
																			<option <?php echo ($invoice->country=="Mayotte")?"selected":""; ?> value="Mayotte">Mayotte</option>
																			<option <?php echo ($invoice->country=="Meksika")?"selected":""; ?> value="Meksika">Meksika</option>
																			<option <?php echo ($invoice->country=="Moldova")?"selected":""; ?> value="Moldova">Moldova</option>
																			<option <?php echo ($invoice->country=="Monako")?"selected":""; ?> value="Monako">Monako</option>
																			<option <?php echo ($invoice->country=="Montserrat")?"selected":""; ?> value="Montserrat">Montserrat</option>
																			<option <?php echo ($invoice->country=="Moritanya")?"selected":""; ?> value="Moritanya">Moritanya</option>
																			<option <?php echo ($invoice->country=="Mozambik")?"selected":""; ?> value="Mozambik">Mozambik</option>
																			<option <?php echo ($invoice->country=="Moğolistan")?"selected":""; ?> value="Moğolistan">Moğolistan</option>
																			<option <?php echo ($invoice->country=="Myanmar")?"selected":""; ?> value="Myanmar">Myanmar</option>
																			<option <?php echo ($invoice->country=="Mısır")?"selected":""; ?> value="Mısır">Mısır</option>
																			<option <?php echo ($invoice->country=="Namibya")?"selected":""; ?> value="Namibya">Namibya</option>
																			<option <?php echo ($invoice->country=="Nauru")?"selected":""; ?> value="Nauru">Nauru</option>
																			<option <?php echo ($invoice->country=="Nepal")?"selected":""; ?> value="Nepal">Nepal</option>
																			<option <?php echo ($invoice->country=="Nijer")?"selected":""; ?> value="Nijer">Nijer</option>
																			<option <?php echo ($invoice->country=="Nijerya")?"selected":""; ?> value="Nijerya">Nijerya</option>
																			<option <?php echo ($invoice->country=="Nikaragua")?"selected":""; ?> value="Nikaragua">Nikaragua</option>
																			<option <?php echo ($invoice->country=="Niue")?"selected":""; ?> value="Niue">Niue</option>
																			<option <?php echo ($invoice->country=="Norfolk Adaları")?"selected":""; ?> value="Norfolk Adaları">Norfolk Adaları</option>
																			<option <?php echo ($invoice->country=="Norveç")?"selected":""; ?> value="Norveç">Norveç</option>
																			<option <?php echo ($invoice->country=="Pakistan")?"selected":""; ?> value="Pakistan">Pakistan</option>
																			<option <?php echo ($invoice->country=="Palau")?"selected":""; ?> value="Palau">Palau</option>
																			<option <?php echo ($invoice->country=="Panama")?"selected":""; ?> value="Panama">Panama</option>
																			<option <?php echo ($invoice->country=="Papua Yeni Gine")?"selected":""; ?> value="Papua Yeni Gine">Papua Yeni Gine</option>
																			<option <?php echo ($invoice->country=="Paraguay")?"selected":""; ?> value="Paraguay">Paraguay</option>
																			<option <?php echo ($invoice->country=="Peru")?"selected":""; ?> value="Peru">Peru</option>
																			<option <?php echo ($invoice->country=="Pitcairn Adası")?"selected":""; ?> value="Pitcairn Adası">Pitcairn Adası</option>
																			<option <?php echo ($invoice->country=="Polonya")?"selected":""; ?> value="Polonya">Polonya</option>
																			<option <?php echo ($invoice->country=="Portekiz")?"selected":""; ?> value="Portekiz">Portekiz</option>
																			<option <?php echo ($invoice->country=="Porto Riko")?"selected":""; ?> value="Porto Riko">Porto Riko</option>
																			<option <?php echo ($invoice->country=="Reunion")?"selected":""; ?> value="Reunion">Reunion</option>
																			<option <?php echo ($invoice->country=="Romanya")?"selected":""; ?> value="Romanya">Romanya</option>
																			<option <?php echo ($invoice->country=="Ruanda")?"selected":""; ?> value="Ruanda">Ruanda</option>
																			<option <?php echo ($invoice->country=="Rusya")?"selected":""; ?> value="Rusya">Rusya</option>
																			<option <?php echo ($invoice->country=="Saint Kitts ve Nevis")?"selected":""; ?> value="Saint Kitts ve Nevis">Saint Kitts ve Nevis</option>
																			<option <?php echo ($invoice->country=="Saint Lucia")?"selected":""; ?> value="Saint Lucia">Saint Lucia</option>
																			<option <?php echo ($invoice->country=="Saint Vincent ve Granada")?"selected":""; ?> value="Saint Vincent ve Granada">Saint Vincent ve Granada</option>
																			<option <?php echo ($invoice->country=="Samoa")?"selected":""; ?> value="Samoa">Samoa</option>
																			<option <?php echo ($invoice->country=="San Marino")?"selected":""; ?> value="San Marino">San Marino</option>
																			<option <?php echo ($invoice->country=="Sao Tome ve Principe")?"selected":""; ?> value="Sao Tome ve Principe">Sao Tome ve Principe</option>
																			<option <?php echo ($invoice->country=="Senegal")?"selected":""; ?> value="Senegal">Senegal</option>
																			<option <?php echo ($invoice->country=="Seyşeller")?"selected":""; ?> value="Seyşeller">Seyşeller</option>
																			<option <?php echo ($invoice->country=="Sierra Leone")?"selected":""; ?> value="Sierra Leone">Sierra Leone</option>
																			<option <?php echo ($invoice->country=="Singapur")?"selected":""; ?> value="Singapur">Singapur</option>
																			<option <?php echo ($invoice->country=="Sint Maarten")?"selected":""; ?> value="Sint Maarten">Sint Maarten</option>
																			<option <?php echo ($invoice->country=="Slovakya")?"selected":""; ?> value="Slovakya">Slovakya</option>
																			<option <?php echo ($invoice->country=="Slovenya")?"selected":""; ?> value="Slovenya">Slovenya</option>
																			<option <?php echo ($invoice->country=="Solomon Adaları")?"selected":""; ?> value="Solomon Adaları">Solomon Adaları</option>
																			<option <?php echo ($invoice->country=="Sri Lanka")?"selected":""; ?> value="Sri Lanka">Sri Lanka</option>
																			<option <?php echo ($invoice->country=="St. Barthelemy")?"selected":""; ?> value="St. Barthelemy">St. Barthelemy</option>
																			<option <?php echo ($invoice->country=="St. Helena")?"selected":""; ?> value="St. Helena">St. Helena</option>
																			<option <?php echo ($invoice->country=="St. Martin")?"selected":""; ?> value="St. Martin">St. Martin</option>
																			<option <?php echo ($invoice->country=="St. Pierre ve Miquelon")?"selected":""; ?> value="St. Pierre ve Miquelon">St. Pierre ve Miquelon</option>
																			<option <?php echo ($invoice->country=="Sudan")?"selected":""; ?> value="Sudan">Sudan</option>
																			<option <?php echo ($invoice->country=="Surinam")?"selected":""; ?> value="Surinam">Surinam</option>
																			<option <?php echo ($invoice->country=="Suudi Arabistan")?"selected":""; ?> value="Suudi Arabistan">Suudi Arabistan</option>
																			<option <?php echo ($invoice->country=="Svalbard")?"selected":""; ?> value="Svalbard">Svalbard</option>
																			<option <?php echo ($invoice->country=="Svaziland")?"selected":""; ?> value="Svaziland">Svaziland</option>
																			<option <?php echo ($invoice->country=="Sırbistan")?"selected":""; ?> value="Sırbistan">Sırbistan</option>
																			<option <?php echo ($invoice->country=="Tacikistan")?"selected":""; ?> value="Tacikistan">Tacikistan</option>
																			<option <?php echo ($invoice->country=="Tanzanya")?"selected":""; ?> value="Tanzanya">Tanzanya</option>
																			<option <?php echo ($invoice->country=="Tayland")?"selected":""; ?> value="Tayland">Tayland</option>
																			<option <?php echo ($invoice->country=="Tayvan")?"selected":""; ?> value="Tayvan">Tayvan</option>
																			<option <?php echo ($invoice->country=="Togo")?"selected":""; ?> value="Togo">Togo</option>
																			<option <?php echo ($invoice->country=="Tokelau")?"selected":""; ?> value="Tokelau">Tokelau</option>
																			<option <?php echo ($invoice->country=="Tonga")?"selected":""; ?> value="Tonga">Tonga</option>
																			<option <?php echo ($invoice->country=="Trinidad ve Tobago")?"selected":""; ?> value="Trinidad ve Tobago">Trinidad ve Tobago</option>
																			<option <?php echo ($invoice->country=="Tunus")?"selected":""; ?> value="Tunus">Tunus</option>
																			<option <?php echo ($invoice->country=="Turks ve Caicos")?"selected":""; ?> value="Turks ve Caicos">Turks ve Caicos</option>
																			<option <?php echo ($invoice->country=="Tuvalu")?"selected":""; ?> value="Tuvalu">Tuvalu</option>
																			<option <?php echo ($invoice->country=="Türkmenistan")?"selected":""; ?> value="Türkmenistan">Türkmenistan</option>
																			<option <?php echo ($invoice->country=="Uganda")?"selected":""; ?> value="Uganda">Uganda</option>
																			<option <?php echo ($invoice->country=="Ukrayna")?"selected":""; ?> value="Ukrayna">Ukrayna</option>
																			<option <?php echo ($invoice->country=="Umman")?"selected":""; ?> value="Umman">Umman</option>
																			<option <?php echo ($invoice->country=="Uruguay")?"selected":""; ?> value="Uruguay">Uruguay</option>
																			<option <?php echo ($invoice->country=="Vanuatu")?"selected":""; ?> value="Vanuatu">Vanuatu</option>
																			<option <?php echo ($invoice->country=="Vatikan Şehri")?"selected":""; ?> value="Vatikan Şehri">Vatikan Şehri</option>
																			<option <?php echo ($invoice->country=="Venezuela")?"selected":""; ?> value="Venezuela">Venezuela</option>
																			<option <?php echo ($invoice->country=="Vietnam")?"selected":""; ?> value="Vietnam">Vietnam</option>
																			<option <?php echo ($invoice->country=="Wallis and Futuna")?"selected":""; ?> value="Wallis and Futuna">Wallis and Futuna</option>
																			<option <?php echo ($invoice->country=="Yeni Kaledonya")?"selected":""; ?> value="Yeni Kaledonya">Yeni Kaledonya</option>
																			<option <?php echo ($invoice->country=="Yeni Zelanda")?"selected":""; ?> value="Yeni Zelanda">Yeni Zelanda</option>
																			<option <?php echo ($invoice->country=="Yunanistan")?"selected":""; ?> value="Yunanistan">Yunanistan</option>
																			<option <?php echo ($invoice->country=="Zambiya")?"selected":""; ?> value="Zambiya">Zambiya</option>
																			<option <?php echo ($invoice->country=="Zimbabve")?"selected":""; ?> value="Zimbabve">Zimbabve</option>
																			<option <?php echo ($invoice->country=="Çad")?"selected":""; ?> value="Çad">Çad</option>
																			<option <?php echo ($invoice->country=="Çek Cumhuriyeti")?"selected":""; ?> value="Çek Cumhuriyeti">Çek Cumhuriyeti</option>
																			<option <?php echo ($invoice->country=="Çin")?"selected":""; ?> value="Çin">Çin</option>
																			<option <?php echo ($invoice->country=="Özbekistan")?"selected":""; ?> value="Özbekistan">Özbekistan</option>
																			<option <?php echo ($invoice->country=="Ürdün")?"selected":""; ?> value="Ürdün">Ürdün</option>
																			<option <?php echo ($invoice->country=="İngiliz Hint Okyanusu Bölgesi")?"selected":""; ?> value="İngiliz Hint Okyanusu Bölgesi">İngiliz Hint Okyanusu Bölgesi</option>
																			<option <?php echo ($invoice->country=="İrlanda")?"selected":""; ?> value="İrlanda">İrlanda</option>
																			<option <?php echo ($invoice->country=="İspanya")?"selected":""; ?> value="İspanya">İspanya</option>
																			<option <?php echo ($invoice->country=="İsrail")?"selected":""; ?> value="İsrail">İsrail</option>
																			<option <?php echo ($invoice->country=="İsveç")?"selected":""; ?> value="İsveç">İsveç</option>
																			<option <?php echo ($invoice->country=="İsviçre")?"selected":""; ?> value="İsviçre">İsviçre</option>
																			<option <?php echo ($invoice->country=="İtalya")?"selected":""; ?> value="İtalya">İtalya</option>
																			<option <?php echo ($invoice->country=="İzlanda")?"selected":""; ?> value="İzlanda">İzlanda</option>
																			<option <?php echo ($invoice->country=="Şili")?"selected":""; ?> value="Şili">Şili</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="id_no2">Kimlik Numarası</label>
																		<input type="text" class="form-control" id="id_no2" name="invoice[id_no]" value="<?php echo $invoice->id_no; ?>" />
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="address">Adres</label>
																		<textarea class="form-control" id="address" name="invoice[address]" rows="3"><?php echo $invoice->address; ?></textarea>
																	</div>
																</div>
															</div>        
														</div> 
													</div>
													<div class="col-md-12 mb-10 mt-10">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="honeymoon" id="chck2" <?php echo ($page["honeymoon"]=="on")?"checked":""; ?>>
															<label class="custom-control-label" for="chck2">Balayı Çiftiyiz</label>
														</div>
													</div>
												</div>
												<h5 class="mt-20">Konaklayacak Kişilere Ait Bilgiler</h5>
												<hr>
												<div class="row">
													<?php if(@$page["visitor"]){ $page["visitor"] = json_decode($page["visitor"]); }else{ $page["visitor"] = json_decode('{"1":{"gender":"","name":"","surname":"","birthday":""}}'); } ?>
													<div class="col-xs-12">
														<a class="btn btn-xs btn-primary pull-right mb-15" id="add_field_button">Yeni Kişi Ekle</a>
													</div>
													<div id="input_fields_wrap" class="col-md-12">
														<?php $k=0; foreach ($page["visitor"] as $value): ?>
														<div class="row mb-15">
															<div class="col-md-2 form-group">
																<label for="visitor_gender1" class="form-label">Cinsiyet</label>
																<select class="form-control custom-select" name="visitor[1][gender]" id="visitor_gender1" aria-invalid="false">
																	<option value="Kadın" <?php echo ($value->gender=="Kadın")?"selected":""; ?>>Kadın</option>
																	<option value="Erkek" <?php echo ($value->gender=="Erkek")?"selected":""; ?>>Erkek</option>
																	<option value="Belirtilmemiş" <?php echo ($value->gender=="Belirtilmemiş")?"selected":""; ?>>Belirtilmemiş</option>
																</select>
															</div>
															<div class="col-md-4 form-group">
																<label for="visitor_name1" class="form-label">Ad</label>
																<input type="text" name="visitor[1][name]" class="form-control" id="visitor_name1" autocomplete="off" value="<?php echo $value->name; ?>">
															</div>
															<div class="col-md-3 form-group">
																<label for="visitor_surname1" class="form-label">Soyad</label>
																<input type="text" name="visitor[1][surname]" class="form-control" id="visitor_surname1" autocomplete="off" value="<?php echo $value->surname; ?>">
															</div>
															<div class="col-md-2 form-group">
																<label class="form-label">Doğum Tarihi</label>
																<input type="text" name="visitor[1][birthday]" placeholder="" data-mask="99.99.9999" class="form-control" value="<?php echo $value->birthday; ?>">
															</div>
															<div class="col-xs-1">
																<?php if($k != 0): ?>
																	<a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a>
																<?php endif; ?>
															</div>
														</div>
														<?php $k++; endforeach ?>
													</div>
												</div>
												<h5 class="mt-20">Özel Talepler (İsteğe bağlı)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control" id="special_requests" name="special_requests" rows="3"><?php echo $page["special_requests"]; ?></textarea>
														</div>
													</div>
												</div>
												<!-- <h5 class="mt-20">Yatak Tipi</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<div class="custom-control custom-radio inline-block">
																<input type="radio" id="checkBed1" name="bed" class="custom-control-input" value="Tekli" checked>
																<label class="custom-control-label" for="checkBed1">Tekli</label>
															</div>
															<div class="custom-control custom-radio inline-block">
																<input type="radio" id="checkBed2" name="bed" class="custom-control-input" value="Çift Kişilik">
																<label class="custom-control-label" for="checkBed2">Çift Kişilik</label>
															</div>
														</div>
													</div>
												</div> -->
												<h5 class="mt-20">Sigorta</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<div class="custom-control custom-checkbox custom-control-inline mb-20">
																<input type="checkbox" id="checkReturnInsurance" name="return_insurance" class="custom-control-input" <?php echo ($page["total_insurance"] != "")?"checked":""; ?>>
																<label class="custom-control-label" for="checkReturnInsurance">İptal ve İade sigortası istiyorum.</label>
															</div>
															<div class="form-group insurance-control <?php echo ($page["total_insurance"] != "")?"":"hidden"; ?>">
																<label class="control-label mb-10 text-left" for="total_insurance">Sigorta Ücreti</label>
																<input type="text" class="form-control price-format" id="total_insurance" name="total_insurance" value="<?php echo $page["total_insurance"]; ?>" />
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3 col-xs-12"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group clearfix">
								<button type="submit" class="btn btn-success pull-right">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
<script src="assets/admin/vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/admin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/admin/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="assets/admin/dist/js/jquery.slimscroll.js"></script>

<!-- Fancy Dropdown JS -->
<script src="assets/admin/dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Owl JavaScript -->
<script src="assets/admin/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- Switchery JavaScript -->
<script src="assets/admin/vendors/bower_components/switchery/dist/switchery.min.js"></script>
<script src="assets/admin/dist/js/price.js"></script>
<script src="assets/admin/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="assets/admin/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/admin/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/admin/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/admin/dist/js/form-picker-data.js"></script>
<script src="assets/admin/dist/js/jquery.slimscroll.js"></script>
<!-- Init JavaScript -->
<script src="assets/admin/dist/js/init.js"></script>
<script>
	$(document).ready(function() {
		<?php // Dinamik oda ve kişi sayısı ekleme fonksiyonu ?>
		var i = <?php echo count($page["guest_rooms"]); ?> + 1;
		$("#add_field_button2").click(function(e){
			e.preventDefault();
			$("#input_fields_wrap2").append('<div class="row mb-15"><div class="col-md-12"><h6>'+i+'. Oda</h6><hr></div><div class="col-md-3 form-group"><label for="adult" class="form-label">Yetişkin Sayısı</label><input type="text" name="guest_rooms['+i+'][adult_count]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-3 form-group"><label for="adult" class="form-label">Çocuk Sayısı</label><input type="text" name="guest_rooms['+i+'][child_count]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-3 form-group"><label for="adult" class="form-label">1. Çocuk Yaşı</label><input type="text" name="guest_rooms['+i+'][child_ages][1]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-2 form-group"><label for="adult" class="form-label">2. Çocuk Yaşı</label><input type="text" name="guest_rooms['+i+'][child_ages][2]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-xs-1"><a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a></div></div></div>');
			i++;
		});
		
		$("#input_fields_wrap2").on("click","#remove_field", function(e){
			e.preventDefault(); $(this).parents('.row.mb-15').remove(); i--;
		});


		<?php // Dinamik konaklayacak kişi ekleme fonksiyonu ?>
		var j = <?php echo count($page["visitor"]); ?> + 1;
		$("#add_field_button").click(function(e){
			e.preventDefault();
			$("#input_fields_wrap").append('<div class="row mb-15"><div class="col-md-2 form-group"><label for="visitor_gender1" class="form-label">Cinsiyet</label><select class="form-control custom-select" name="visitor['+j+'][gender]" id="visitor_gender1" aria-invalid="false"><option value="Kadın">Kadın</option><option value="Erkek">Erkek</option><option value="Belirtilmemiş">Belirtilmemiş</option></select></div><div class="col-md-4 form-group"><label for="visitor_name1" class="form-label">Ad</label><input type="text" name="visitor['+j+'][name]" class="form-control" id="visitor_name1" autocomplete="off" value=""></div><div class="col-md-3 form-group"><label for="visitor_surname1" class="form-label">Soyad</label><input type="text" name="visitor['+j+'][surname]" class="form-control" id="visitor_surname1" autocomplete="off" value=""></div><div class="col-md-2 form-group"><label class="form-label">Doğum Tarihi</label><input type="text" name="visitor['+j+'][birthday]" class="form-control" data-mask="99.99.9999" autocomplete="off" value=""></div><div class="col-xs-1"><a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a></div></div>');
			j++;
		});
		
		$("#input_fields_wrap").on("click","#remove_field", function(e){
			e.preventDefault(); $(this).parents('.row.mb-15').remove(); j--;
		});
	});


	$('#checkReturnInsurance').click(function(){
		if ($(this).prop('checked')) {
			$('.insurance-control').removeClass('hidden');
		}else{
			$('.insurance-control').addClass('hidden');
		}
	});
	$('#chck1').click(function(){
		if ($(this).prop('checked')) {
			$('#ccCllapsInvoice').removeClass('hidden');
		}else{
			$('#ccCllapsInvoice').addClass('hidden');
		}
	});
	$('#pay_hotel').change(function(){
		if ($(this).val() == "Otelde Ödeme") {
			$('.pay-hotel-control').removeClass('hidden');
		}else{
			$('.pay-hotel-control').addClass('hidden');
		}
	});
</script>
<script src="assets/admin/vendors/bower_components/tinymce/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector: '.tinymce',
		height: '300',
		language: 'tr_TR',
		verify_html: false,
		plugins: [
		"advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste jbimages textcolor"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
		relative_urls : true,
		document_base_url: '<?php echo base_url(); ?>',
		remove_script_host : false,
		convert_urls : true,
	});
</script>