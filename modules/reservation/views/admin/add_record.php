<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Yeni Rezervasyon Ekle</h5>
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
													<option value="tr">Türkçe</option>
													<option value="en">İngilizce</option>
												</select>
												<label for="currency" class="form-label">Kur (Kullanıcıya gidecek voucherda fiyatların görüntüleneceği kur seçeneği)</label>
												<select class="form-control custom-select" name="currency" id="currency" aria-invalid="false">
													<option value="TL">TL</option>
													<option value="EURO">EURO</option>
												</select>
												<h5 class="mt-20">Voucher Not (Bu alanda yazılacak içerik, voucher mailinde üst alanda görüntülecenektir.)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control tinymce" id="voucher_not" name="voucher_not" rows="3"></textarea>
														</div>
													</div>
												</div>
												<h5 class="mt-20">Voucher Alt Not (Bu alanda yazılacak içerik, voucher not kısmında görüntülecenektir.)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control tinymce" id="voucher_footer_not" name="voucher_footer_not" rows="3"></textarea>
														</div>
													</div>
												</div>									
												<h5 class="mt-20">Rezervasyon Bilgileri</h5>
												<hr>
												<div class="row">
													<div class="col-xs-12">
														<a class="btn btn-xs btn-primary pull-right mb-15" id="add_field_button2">Yeni Oda Ekle</a>
													</div>
													<div id="input_fields_wrap2" class="col-md-12">
														<div class="row mb-15">
															<div class="col-md-12">
																<h6>1. Oda</h6>
																<hr>
															</div>
															<div class="col-md-3 form-group">
																<label for="adult" class="form-label">Yetişkin Sayısı</label>
																<input type="text" name="guest_rooms[1][adult_count]" class="form-control" id="adult" autocomplete="off" value="">
															</div>
															<div class="col-md-3 form-group">
																<label for="child_count" class="form-label">Çocuk Sayısı</label>
																<input type="text" name="guest_rooms[1][child_count]" class="form-control" id="child_count" autocomplete="off" value="">
															</div>
															<div class="col-md-3 form-group">
																<label for="child_ages_1" class="form-label">1. Çocuk Yaşı</label>
																<input type="text" name="guest_rooms[1][child_ages][1]" class="form-control" id="child_ages_1" autocomplete="off" value="">
															</div>
															<div class="col-md-3 form-group">
																<label for="child_ages_2" class="form-label">2. Çocuk Yaşı</label>
																<input type="text" name="guest_rooms[1][child_ages][2]" class="form-control" id="child_ages_2" autocomplete="off" value="">
															</div>
														</div>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="total_price">Toplam Fiyat</label>
															<input type="text" class="form-control price-format" id="total_price" name="total_price" />
														</div>
														<div class="form-group">
															<label for="pay_hotel" class="form-label">Ödeme Tipi</label>
															<select class="form-control custom-select" name="pay_hotel" id="pay_hotel" aria-invalid="false">
																<option value="Peşin Ödeme">Peşin Ödeme</option>
																<option value="Otelde Ödeme">Otelde Ödeme</option>
															</select>
														</div>
														<div class="form-group pay-hotel-control hidden">
															<label class="control-label mb-10 text-left" for="pay_price">Ödenen Fiyat</label>
															<input type="text" class="form-control price-format" id="pay_price" name="pay_price" />
														</div>
														<div class="form-group pay-hotel-control hidden">
															<label class="control-label mb-10 text-left" for="pay_hotel_price">Otelde Ödenecek Fiyat</label>
															<input type="text" class="form-control price-format" id="pay_hotel_price" name="pay_hotel_price" />
														</div>
														<div class="form-group mb-0">
															<label class="control-label mb-10 text-left">Giriş - Çıkış Tarihi</label>
															<input class="form-control input-daterange-datepicker" type="text" name="date">
														</div>
													</div>
												</div>
												<h5 class="mt-20">Rezervasyon İrtibat ve Fatura Bilgileri</h5>
												<hr>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="name">Ad</label>
															<input type="text" class="form-control" id="name" name="name" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="surname">Soyad</label>
															<input type="text" class="form-control" id="surname" name="surname" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="phone">Telefon</label>
															<input type="text" class="form-control" id="phone" name="phone" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="email">E-posta</label>
															<input type="text" class="form-control" id="email" name="email" required />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="country">Ülke</label>
															<select id="country" name="country" class="form-control custom-select">
																<option value="Türkiye">Türkiye</option>
																<option value="ABD Virgin Adaları">ABD Virgin Adaları</option>
																<option value="ABD Çevresindeki Küçük Adalar">ABD Çevresindeki Küçük Adalar</option>
																<option value="Almanya">Almanya</option>
																<option value="Amerikan Samoa">Amerikan Samoa</option>
																<option value="Andorra">Andorra</option>
																<option value="Angola">Angola</option>
																<option value="Anguilla">Anguilla</option>
																<option value="Antigua ve Barbuda">Antigua ve Barbuda</option>
																<option value="Arjantin">Arjantin</option>
																<option value="Arnavutluk">Arnavutluk</option>
																<option value="Aruba">Aruba</option>
																<option value="Avustralya">Avustralya</option>
																<option value="Avusturya">Avusturya</option>
																<option value="Azerbaycan">Azerbaycan</option>
																<option value="Bahamalar">Bahamalar</option>
																<option value="Bahreyn">Bahreyn</option>
																<option value="Bangladeş">Bangladeş</option>
																<option value="Barbados">Barbados</option>
																<option value="Belize">Belize</option>
																<option value="Belçika">Belçika</option>
																<option value="Benin">Benin</option>
																<option value="Bermuda">Bermuda</option>
																<option value="Beyaz Rusya">Beyaz Rusya</option>
																<option value="Birleşik Arap Emirlikleri">Birleşik Arap Emirlikleri</option>
																<option value="Birleşik Devletler">Birleşik Devletler</option>
																<option value="Birleşik Krallık">Birleşik Krallık</option>
																<option value="Birleşik Krallık Virgin Adaları">Birleşik Krallık Virgin Adaları</option>
																<option value="Bolivya">Bolivya</option>
																<option value="Bonaire, Sint Eustatius ve Saba">Bonaire, Sint Eustatius ve Saba</option>
																<option value="Bosna Hersek">Bosna Hersek</option>
																<option value="Botsvana">Botsvana</option>
																<option value="Bouvet Adaları">Bouvet Adaları</option>
																<option value="Brezilya">Brezilya</option>
																<option value="Brunei">Brunei</option>
																<option value="Bulgaristan">Bulgaristan</option>
																<option value="Burkina Faso">Burkina Faso</option>
																<option value="Burundi">Burundi</option>
																<option value="Butan">Butan</option>
																<option value="Cape Verde">Cape Verde</option>
																<option value="Cebelitarık">Cebelitarık</option>
																<option value="Cezayir">Cezayir</option>
																<option value="Christmas Adaları">Christmas Adaları</option>
																<option value="Cibuti">Cibuti</option>
																<option value="Cocos Adaları">Cocos Adaları</option>
																<option value="Cook Adaları">Cook Adaları</option>
																<option value="Danimarka">Danimarka</option>
																<option value="Demokratik Kongo Cumhuriyeti">Demokratik Kongo Cumhuriyeti</option>
																<option value="Dominik">Dominik</option>
																<option value="Dominik Cumhuriyeti">Dominik Cumhuriyeti</option>
																<option value="Ekvador">Ekvador</option>
																<option value="Ekvator Ginesi">Ekvator Ginesi</option>
																<option value="El Salvador">El Salvador</option>
																<option value="Endonezya">Endonezya</option>
																<option value="Eritre">Eritre</option>
																<option value="Ermenistan">Ermenistan</option>
																<option value="Estonya">Estonya</option>
																<option value="Etyopya">Etyopya</option>
																<option value="F.Y.R.O. Makedonya">F.Y.R.O. Makedonya</option>
																<option value="Falkland Adaları">Falkland Adaları</option>
																<option value="Faroe Adaları">Faroe Adaları</option>
																<option value="Fas">Fas</option>
																<option value="Federal Mikronezya Devleti">Federal Mikronezya Devleti</option>
																<option value="Fiji">Fiji</option>
																<option value="Fildişi Sahili">Fildişi Sahili</option>
																<option value="Filipinler">Filipinler</option>
																<option value="Filistin Bölgeleri">Filistin Bölgeleri</option>
																<option value="Finlandiya">Finlandiya</option>
																<option value="Fransa">Fransa</option>
																<option value="Fransız Ginesi">Fransız Ginesi</option>
																<option value="Fransız Güney ve Antarktika Toprakları">Fransız Güney ve Antarktika Toprakları</option>
																<option value="Fransız Polinezyası">Fransız Polinezyası</option>
																<option value="Gabon">Gabon</option>
																<option value="Gambiya">Gambiya</option>
																<option value="Gana">Gana</option>
																<option value="Gine">Gine</option>
																<option value="Gine-Bissau">Gine-Bissau</option>
																<option value="Grenada">Grenada</option>
																<option value="Grönland">Grönland</option>
																<option value="Guadeloupe">Guadeloupe</option>
																<option value="Guam">Guam</option>
																<option value="Guatemala">Guatemala</option>
																<option value="Guyana">Guyana</option>
																<option value="Güney Afrika">Güney Afrika</option>
																<option value="Güney Kore">Güney Kore</option>
																<option value="Gürcistan">Gürcistan</option>
																<option value="Haiti">Haiti</option>
																<option value="Heard ve Mc Donald Adaları">Heard ve Mc Donald Adaları</option>
																<option value="Hindistan">Hindistan</option>
																<option value="Hollanda">Hollanda</option>
																<option value="Honduras">Honduras</option>
																<option value="Hong Kong ÖİB">Hong Kong ÖİB</option>
																<option value="Hırvtistan">Hırvtistan</option>
																<option value="Jamaika">Jamaika</option>
																<option value="Japonya">Japonya</option>
																<option value="Kamboçya">Kamboçya</option>
																<option value="Kamerun">Kamerun</option>
																<option value="Kanada">Kanada</option>
																<option value="Karadağ">Karadağ</option>
																<option value="Katar">Katar</option>
																<option value="Kayman Adaları">Kayman Adaları</option>
																<option value="Kazakistan">Kazakistan</option>
																<option value="Kenya">Kenya</option>
																<option value="Kiribati">Kiribati</option>
																<option value="Kolombiya">Kolombiya</option>
																<option value="Komor">Komor</option>
																<option value="Kongo Cumhuriyeti">Kongo Cumhuriyeti</option>
																<option value="Kosta Rika">Kosta Rika</option>
																<option value="Kurasao">Kurasao</option>
																<option value="Kuveyt">Kuveyt</option>
																<option value="Kuzey Kıbrıs">Kuzey Kıbrıs</option>
																<option value="Kuzey Mariana Adaları">Kuzey Mariana Adaları</option>
																<option value="Küba">Küba</option>
																<option value="Kıbrıs">Kıbrıs</option>
																<option value="Kırgızistan">Kırgızistan</option>
																<option value="Laos">Laos</option>
																<option value="Lesoto">Lesoto</option>
																<option value="Letonya">Letonya</option>
																<option value="Liberya">Liberya</option>
																<option value="Libya">Libya</option>
																<option value="Liechtenstein">Liechtenstein</option>
																<option value="Litvanya">Litvanya</option>
																<option value="Lübnan">Lübnan</option>
																<option value="Lüksemburg">Lüksemburg</option>
																<option value="Macaristan">Macaristan</option>
																<option value="Macau ÖİB">Macau ÖİB</option>
																<option value="Madagaskar">Madagaskar</option>
																<option value="Malavi">Malavi</option>
																<option value="Maldivler">Maldivler</option>
																<option value="Malezya">Malezya</option>
																<option value="Mali">Mali</option>
																<option value="Malta">Malta</option>
																<option value="Maritus">Maritus</option>
																<option value="Marshall Adaları">Marshall Adaları</option>
																<option value="Martinik">Martinik</option>
																<option value="Mayotte">Mayotte</option>
																<option value="Meksika">Meksika</option>
																<option value="Moldova">Moldova</option>
																<option value="Monako">Monako</option>
																<option value="Montserrat">Montserrat</option>
																<option value="Moritanya">Moritanya</option>
																<option value="Mozambik">Mozambik</option>
																<option value="Moğolistan">Moğolistan</option>
																<option value="Myanmar">Myanmar</option>
																<option value="Mısır">Mısır</option>
																<option value="Namibya">Namibya</option>
																<option value="Nauru">Nauru</option>
																<option value="Nepal">Nepal</option>
																<option value="Nijer">Nijer</option>
																<option value="Nijerya">Nijerya</option>
																<option value="Nikaragua">Nikaragua</option>
																<option value="Niue">Niue</option>
																<option value="Norfolk Adaları">Norfolk Adaları</option>
																<option value="Norveç">Norveç</option>
																<option value="Pakistan">Pakistan</option>
																<option value="Palau">Palau</option>
																<option value="Panama">Panama</option>
																<option value="Papua Yeni Gine">Papua Yeni Gine</option>
																<option value="Paraguay">Paraguay</option>
																<option value="Peru">Peru</option>
																<option value="Pitcairn Adası">Pitcairn Adası</option>
																<option value="Polonya">Polonya</option>
																<option value="Portekiz">Portekiz</option>
																<option value="Porto Riko">Porto Riko</option>
																<option value="Reunion">Reunion</option>
																<option value="Romanya">Romanya</option>
																<option value="Ruanda">Ruanda</option>
																<option value="Rusya">Rusya</option>
																<option value="Saint Kitts ve Nevis">Saint Kitts ve Nevis</option>
																<option value="Saint Lucia">Saint Lucia</option>
																<option value="Saint Vincent ve Granada">Saint Vincent ve Granada</option>
																<option value="Samoa">Samoa</option>
																<option value="San Marino">San Marino</option>
																<option value="Sao Tome ve Principe">Sao Tome ve Principe</option>
																<option value="Senegal">Senegal</option>
																<option value="Seyşeller">Seyşeller</option>
																<option value="Sierra Leone">Sierra Leone</option>
																<option value="Singapur">Singapur</option>
																<option value="Sint Maarten">Sint Maarten</option>
																<option value="Slovakya">Slovakya</option>
																<option value="Slovenya">Slovenya</option>
																<option value="Solomon Adaları">Solomon Adaları</option>
																<option value="Sri Lanka">Sri Lanka</option>
																<option value="St. Barthelemy">St. Barthelemy</option>
																<option value="St. Helena">St. Helena</option>
																<option value="St. Martin">St. Martin</option>
																<option value="St. Pierre ve Miquelon">St. Pierre ve Miquelon</option>
																<option value="Sudan">Sudan</option>
																<option value="Surinam">Surinam</option>
																<option value="Suudi Arabistan">Suudi Arabistan</option>
																<option value="Svalbard">Svalbard</option>
																<option value="Svaziland">Svaziland</option>
																<option value="Sırbistan">Sırbistan</option>
																<option value="Tacikistan">Tacikistan</option>
																<option value="Tanzanya">Tanzanya</option>
																<option value="Tayland">Tayland</option>
																<option value="Tayvan">Tayvan</option>
																<option value="Togo">Togo</option>
																<option value="Tokelau">Tokelau</option>
																<option value="Tonga">Tonga</option>
																<option value="Trinidad ve Tobago">Trinidad ve Tobago</option>
																<option value="Tunus">Tunus</option>
																<option value="Turks ve Caicos">Turks ve Caicos</option>
																<option value="Tuvalu">Tuvalu</option>
																<option value="Türkmenistan">Türkmenistan</option>
																<option value="Uganda">Uganda</option>
																<option value="Ukrayna">Ukrayna</option>
																<option value="Umman">Umman</option>
																<option value="Uruguay">Uruguay</option>
																<option value="Vanuatu">Vanuatu</option>
																<option value="Vatikan Şehri">Vatikan Şehri</option>
																<option value="Venezuela">Venezuela</option>
																<option value="Vietnam">Vietnam</option>
																<option value="Wallis and Futuna">Wallis and Futuna</option>
																<option value="Yeni Kaledonya">Yeni Kaledonya</option>
																<option value="Yeni Zelanda">Yeni Zelanda</option>
																<option value="Yunanistan">Yunanistan</option>
																<option value="Zambiya">Zambiya</option>
																<option value="Zimbabve">Zimbabve</option>
																<option value="Çad">Çad</option>
																<option value="Çek Cumhuriyeti">Çek Cumhuriyeti</option>
																<option value="Çin">Çin</option>
																<option value="Özbekistan">Özbekistan</option>
																<option value="Ürdün">Ürdün</option>
																<option value="İngiliz Hint Okyanusu Bölgesi">İngiliz Hint Okyanusu Bölgesi</option>
																<option value="İrlanda">İrlanda</option>
																<option value="İspanya">İspanya</option>
																<option value="İsrail">İsrail</option>
																<option value="İsveç">İsveç</option>
																<option value="İsviçre">İsviçre</option>
																<option value="İtalya">İtalya</option>
																<option value="İzlanda">İzlanda</option>
																<option value="Şili">Şili</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="idno">Kimlik Numarası</label>
															<input type="text" class="form-control" id="idno" name="idno" />
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="address">Adres</label>
															<textarea class="form-control" id="address" name="address" rows="3"></textarea>
														</div>
													</div>
													<div class="col-md-12 mb-10 mt-10">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" data-toggle="collapse" data-target='#ccCllapsInvoice' id="chck1">
															<label class="custom-control-label" for="chck1">Fatura bilgileri farklı girilecek</label>
														</div>
														<div id="ccCllapsInvoice" class="collapse mt-10">
															<h5>Fatura Bilgileri</h5>
															<hr>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="name">Ad</label>
																		<input type="text" class="form-control" id="name" name="invoice[name]" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="surname">Soyad</label>
																		<input type="text" class="form-control" id="surname" name="invoice[surname]" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="phone">Telefon</label>
																		<input type="text" class="form-control" id="phone" name="invoice[phone]" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="email">E-posta</label>
																		<input type="text" class="form-control" id="email" name="invoice[email]" />
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="country">Ülke</label>
																		<select id="country" name="invoice[country]" class="form-control custom-select">
																			<option value="Türkiye">Türkiye</option>
																			<option value="ABD Virgin Adaları">ABD Virgin Adaları</option>
																			<option value="ABD Çevresindeki Küçük Adalar">ABD Çevresindeki Küçük Adalar</option>
																			<option value="Almanya">Almanya</option>
																			<option value="Amerikan Samoa">Amerikan Samoa</option>
																			<option value="Andorra">Andorra</option>
																			<option value="Angola">Angola</option>
																			<option value="Anguilla">Anguilla</option>
																			<option value="Antigua ve Barbuda">Antigua ve Barbuda</option>
																			<option value="Arjantin">Arjantin</option>
																			<option value="Arnavutluk">Arnavutluk</option>
																			<option value="Aruba">Aruba</option>
																			<option value="Avustralya">Avustralya</option>
																			<option value="Avusturya">Avusturya</option>
																			<option value="Azerbaycan">Azerbaycan</option>
																			<option value="Bahamalar">Bahamalar</option>
																			<option value="Bahreyn">Bahreyn</option>
																			<option value="Bangladeş">Bangladeş</option>
																			<option value="Barbados">Barbados</option>
																			<option value="Belize">Belize</option>
																			<option value="Belçika">Belçika</option>
																			<option value="Benin">Benin</option>
																			<option value="Bermuda">Bermuda</option>
																			<option value="Beyaz Rusya">Beyaz Rusya</option>
																			<option value="Birleşik Arap Emirlikleri">Birleşik Arap Emirlikleri</option>
																			<option value="Birleşik Devletler">Birleşik Devletler</option>
																			<option value="Birleşik Krallık">Birleşik Krallık</option>
																			<option value="Birleşik Krallık Virgin Adaları">Birleşik Krallık Virgin Adaları</option>
																			<option value="Bolivya">Bolivya</option>
																			<option value="Bonaire, Sint Eustatius ve Saba">Bonaire, Sint Eustatius ve Saba</option>
																			<option value="Bosna Hersek">Bosna Hersek</option>
																			<option value="Botsvana">Botsvana</option>
																			<option value="Bouvet Adaları">Bouvet Adaları</option>
																			<option value="Brezilya">Brezilya</option>
																			<option value="Brunei">Brunei</option>
																			<option value="Bulgaristan">Bulgaristan</option>
																			<option value="Burkina Faso">Burkina Faso</option>
																			<option value="Burundi">Burundi</option>
																			<option value="Butan">Butan</option>
																			<option value="Cape Verde">Cape Verde</option>
																			<option value="Cebelitarık">Cebelitarık</option>
																			<option value="Cezayir">Cezayir</option>
																			<option value="Christmas Adaları">Christmas Adaları</option>
																			<option value="Cibuti">Cibuti</option>
																			<option value="Cocos Adaları">Cocos Adaları</option>
																			<option value="Cook Adaları">Cook Adaları</option>
																			<option value="Danimarka">Danimarka</option>
																			<option value="Demokratik Kongo Cumhuriyeti">Demokratik Kongo Cumhuriyeti</option>
																			<option value="Dominik">Dominik</option>
																			<option value="Dominik Cumhuriyeti">Dominik Cumhuriyeti</option>
																			<option value="Ekvador">Ekvador</option>
																			<option value="Ekvator Ginesi">Ekvator Ginesi</option>
																			<option value="El Salvador">El Salvador</option>
																			<option value="Endonezya">Endonezya</option>
																			<option value="Eritre">Eritre</option>
																			<option value="Ermenistan">Ermenistan</option>
																			<option value="Estonya">Estonya</option>
																			<option value="Etyopya">Etyopya</option>
																			<option value="F.Y.R.O. Makedonya">F.Y.R.O. Makedonya</option>
																			<option value="Falkland Adaları">Falkland Adaları</option>
																			<option value="Faroe Adaları">Faroe Adaları</option>
																			<option value="Fas">Fas</option>
																			<option value="Federal Mikronezya Devleti">Federal Mikronezya Devleti</option>
																			<option value="Fiji">Fiji</option>
																			<option value="Fildişi Sahili">Fildişi Sahili</option>
																			<option value="Filipinler">Filipinler</option>
																			<option value="Filistin Bölgeleri">Filistin Bölgeleri</option>
																			<option value="Finlandiya">Finlandiya</option>
																			<option value="Fransa">Fransa</option>
																			<option value="Fransız Ginesi">Fransız Ginesi</option>
																			<option value="Fransız Güney ve Antarktika Toprakları">Fransız Güney ve Antarktika Toprakları</option>
																			<option value="Fransız Polinezyası">Fransız Polinezyası</option>
																			<option value="Gabon">Gabon</option>
																			<option value="Gambiya">Gambiya</option>
																			<option value="Gana">Gana</option>
																			<option value="Gine">Gine</option>
																			<option value="Gine-Bissau">Gine-Bissau</option>
																			<option value="Grenada">Grenada</option>
																			<option value="Grönland">Grönland</option>
																			<option value="Guadeloupe">Guadeloupe</option>
																			<option value="Guam">Guam</option>
																			<option value="Guatemala">Guatemala</option>
																			<option value="Guyana">Guyana</option>
																			<option value="Güney Afrika">Güney Afrika</option>
																			<option value="Güney Kore">Güney Kore</option>
																			<option value="Gürcistan">Gürcistan</option>
																			<option value="Haiti">Haiti</option>
																			<option value="Heard ve Mc Donald Adaları">Heard ve Mc Donald Adaları</option>
																			<option value="Hindistan">Hindistan</option>
																			<option value="Hollanda">Hollanda</option>
																			<option value="Honduras">Honduras</option>
																			<option value="Hong Kong ÖİB">Hong Kong ÖİB</option>
																			<option value="Hırvtistan">Hırvtistan</option>
																			<option value="Jamaika">Jamaika</option>
																			<option value="Japonya">Japonya</option>
																			<option value="Kamboçya">Kamboçya</option>
																			<option value="Kamerun">Kamerun</option>
																			<option value="Kanada">Kanada</option>
																			<option value="Karadağ">Karadağ</option>
																			<option value="Katar">Katar</option>
																			<option value="Kayman Adaları">Kayman Adaları</option>
																			<option value="Kazakistan">Kazakistan</option>
																			<option value="Kenya">Kenya</option>
																			<option value="Kiribati">Kiribati</option>
																			<option value="Kolombiya">Kolombiya</option>
																			<option value="Komor">Komor</option>
																			<option value="Kongo Cumhuriyeti">Kongo Cumhuriyeti</option>
																			<option value="Kosta Rika">Kosta Rika</option>
																			<option value="Kurasao">Kurasao</option>
																			<option value="Kuveyt">Kuveyt</option>
																			<option value="Kuzey Kıbrıs">Kuzey Kıbrıs</option>
																			<option value="Kuzey Mariana Adaları">Kuzey Mariana Adaları</option>
																			<option value="Küba">Küba</option>
																			<option value="Kıbrıs">Kıbrıs</option>
																			<option value="Kırgızistan">Kırgızistan</option>
																			<option value="Laos">Laos</option>
																			<option value="Lesoto">Lesoto</option>
																			<option value="Letonya">Letonya</option>
																			<option value="Liberya">Liberya</option>
																			<option value="Libya">Libya</option>
																			<option value="Liechtenstein">Liechtenstein</option>
																			<option value="Litvanya">Litvanya</option>
																			<option value="Lübnan">Lübnan</option>
																			<option value="Lüksemburg">Lüksemburg</option>
																			<option value="Macaristan">Macaristan</option>
																			<option value="Macau ÖİB">Macau ÖİB</option>
																			<option value="Madagaskar">Madagaskar</option>
																			<option value="Malavi">Malavi</option>
																			<option value="Maldivler">Maldivler</option>
																			<option value="Malezya">Malezya</option>
																			<option value="Mali">Mali</option>
																			<option value="Malta">Malta</option>
																			<option value="Maritus">Maritus</option>
																			<option value="Marshall Adaları">Marshall Adaları</option>
																			<option value="Martinik">Martinik</option>
																			<option value="Mayotte">Mayotte</option>
																			<option value="Meksika">Meksika</option>
																			<option value="Moldova">Moldova</option>
																			<option value="Monako">Monako</option>
																			<option value="Montserrat">Montserrat</option>
																			<option value="Moritanya">Moritanya</option>
																			<option value="Mozambik">Mozambik</option>
																			<option value="Moğolistan">Moğolistan</option>
																			<option value="Myanmar">Myanmar</option>
																			<option value="Mısır">Mısır</option>
																			<option value="Namibya">Namibya</option>
																			<option value="Nauru">Nauru</option>
																			<option value="Nepal">Nepal</option>
																			<option value="Nijer">Nijer</option>
																			<option value="Nijerya">Nijerya</option>
																			<option value="Nikaragua">Nikaragua</option>
																			<option value="Niue">Niue</option>
																			<option value="Norfolk Adaları">Norfolk Adaları</option>
																			<option value="Norveç">Norveç</option>
																			<option value="Pakistan">Pakistan</option>
																			<option value="Palau">Palau</option>
																			<option value="Panama">Panama</option>
																			<option value="Papua Yeni Gine">Papua Yeni Gine</option>
																			<option value="Paraguay">Paraguay</option>
																			<option value="Peru">Peru</option>
																			<option value="Pitcairn Adası">Pitcairn Adası</option>
																			<option value="Polonya">Polonya</option>
																			<option value="Portekiz">Portekiz</option>
																			<option value="Porto Riko">Porto Riko</option>
																			<option value="Reunion">Reunion</option>
																			<option value="Romanya">Romanya</option>
																			<option value="Ruanda">Ruanda</option>
																			<option value="Rusya">Rusya</option>
																			<option value="Saint Kitts ve Nevis">Saint Kitts ve Nevis</option>
																			<option value="Saint Lucia">Saint Lucia</option>
																			<option value="Saint Vincent ve Granada">Saint Vincent ve Granada</option>
																			<option value="Samoa">Samoa</option>
																			<option value="San Marino">San Marino</option>
																			<option value="Sao Tome ve Principe">Sao Tome ve Principe</option>
																			<option value="Senegal">Senegal</option>
																			<option value="Seyşeller">Seyşeller</option>
																			<option value="Sierra Leone">Sierra Leone</option>
																			<option value="Singapur">Singapur</option>
																			<option value="Sint Maarten">Sint Maarten</option>
																			<option value="Slovakya">Slovakya</option>
																			<option value="Slovenya">Slovenya</option>
																			<option value="Solomon Adaları">Solomon Adaları</option>
																			<option value="Sri Lanka">Sri Lanka</option>
																			<option value="St. Barthelemy">St. Barthelemy</option>
																			<option value="St. Helena">St. Helena</option>
																			<option value="St. Martin">St. Martin</option>
																			<option value="St. Pierre ve Miquelon">St. Pierre ve Miquelon</option>
																			<option value="Sudan">Sudan</option>
																			<option value="Surinam">Surinam</option>
																			<option value="Suudi Arabistan">Suudi Arabistan</option>
																			<option value="Svalbard">Svalbard</option>
																			<option value="Svaziland">Svaziland</option>
																			<option value="Sırbistan">Sırbistan</option>
																			<option value="Tacikistan">Tacikistan</option>
																			<option value="Tanzanya">Tanzanya</option>
																			<option value="Tayland">Tayland</option>
																			<option value="Tayvan">Tayvan</option>
																			<option value="Togo">Togo</option>
																			<option value="Tokelau">Tokelau</option>
																			<option value="Tonga">Tonga</option>
																			<option value="Trinidad ve Tobago">Trinidad ve Tobago</option>
																			<option value="Tunus">Tunus</option>
																			<option value="Turks ve Caicos">Turks ve Caicos</option>
																			<option value="Tuvalu">Tuvalu</option>
																			<option value="Türkmenistan">Türkmenistan</option>
																			<option value="Uganda">Uganda</option>
																			<option value="Ukrayna">Ukrayna</option>
																			<option value="Umman">Umman</option>
																			<option value="Uruguay">Uruguay</option>
																			<option value="Vanuatu">Vanuatu</option>
																			<option value="Vatikan Şehri">Vatikan Şehri</option>
																			<option value="Venezuela">Venezuela</option>
																			<option value="Vietnam">Vietnam</option>
																			<option value="Wallis and Futuna">Wallis and Futuna</option>
																			<option value="Yeni Kaledonya">Yeni Kaledonya</option>
																			<option value="Yeni Zelanda">Yeni Zelanda</option>
																			<option value="Yunanistan">Yunanistan</option>
																			<option value="Zambiya">Zambiya</option>
																			<option value="Zimbabve">Zimbabve</option>
																			<option value="Çad">Çad</option>
																			<option value="Çek Cumhuriyeti">Çek Cumhuriyeti</option>
																			<option value="Çin">Çin</option>
																			<option value="Özbekistan">Özbekistan</option>
																			<option value="Ürdün">Ürdün</option>
																			<option value="İngiliz Hint Okyanusu Bölgesi">İngiliz Hint Okyanusu Bölgesi</option>
																			<option value="İrlanda">İrlanda</option>
																			<option value="İspanya">İspanya</option>
																			<option value="İsrail">İsrail</option>
																			<option value="İsveç">İsveç</option>
																			<option value="İsviçre">İsviçre</option>
																			<option value="İtalya">İtalya</option>
																			<option value="İzlanda">İzlanda</option>
																			<option value="Şili">Şili</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="id_no2">Kimlik Numarası</label>
																		<input type="text" class="form-control" id="id_no2" name="invoice[id_no]" />
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label mb-10 text-left" for="address">Adres</label>
																		<textarea class="form-control" id="address" name="invoice[address]" rows="3"></textarea>
																	</div>
																</div>
															</div>        
														</div> 
													</div>
													<div class="col-md-12 mb-10 mt-10">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="honeymoon" id="chck2">
															<label class="custom-control-label" for="chck2">Balayı Çiftiyiz</label>
														</div>
													</div>
												</div>
												<h5 class="mt-20">Konaklayacak Kişilere Ait Bilgiler</h5>
												<hr>
												<div class="row">
													<div class="col-xs-12">
														<a class="btn btn-xs btn-primary pull-right mb-15" id="add_field_button">Yeni Kişi Ekle</a>
													</div>
													<div id="input_fields_wrap" class="col-md-12">
														<div class="row mb-15">
															<div class="col-md-2 form-group">
																<label for="visitor_gender1" class="form-label">Cinsiyet</label>
																<select class="form-control custom-select" name="visitor[1][gender]" id="visitor_gender1" aria-invalid="false">
																	<option value="Kadın">Kadın</option>
																	<option value="Erkek">Erkek</option>
																	<option value="Belirtilmemiş">Belirtilmemiş</option>
																</select>
															</div>
															<div class="col-md-4 form-group">
																<label for="visitor_name1" class="form-label">Ad</label>
																<input type="text" name="visitor[1][name]" class="form-control" id="visitor_name1" autocomplete="off" value="">
															</div>
															<div class="col-md-3 form-group">
																<label for="visitor_surname1" class="form-label">Soyad</label>
																<input type="text" name="visitor[1][surname]" class="form-control" id="visitor_surname1" autocomplete="off" value="">
															</div>
															<div class="col-md-2 form-group">
																<label class="form-label">Doğum Tarihi</label>
																<input type="text" name="visitor[1][birthday]" placeholder="" data-mask="99.99.9999" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<h5 class="mt-20">Özel Talepler (İsteğe bağlı)</h5>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
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
																<input type="checkbox" id="checkReturnInsurance" name="return_insurance" value="28.50" class="custom-control-input">
																<label class="custom-control-label" for="checkReturnInsurance">İptal ve İade sigortası istiyorum.</label>
															</div>
															<div class="form-group insurance-control hidden">
																<label class="control-label mb-10 text-left" for="total_insurance">Sigorta Ücreti</label>
																<input type="text" class="form-control price-format" id="total_insurance" name="total_insurance" />
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
		var i = 2;
		$("#add_field_button2").click(function(e){
			e.preventDefault();
			$("#input_fields_wrap2").append('<div class="row mb-15"><div class="col-md-12"><h6>'+i+'. Oda</h6><hr></div><div class="col-md-3 form-group"><label for="adult" class="form-label">Yetişkin Sayısı</label><input type="text" name="guest_rooms['+i+'][adult_count]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-3 form-group"><label for="adult" class="form-label">Çocuk Sayısı</label><input type="text" name="guest_rooms['+i+'][child_count]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-3 form-group"><label for="adult" class="form-label">1. Çocuk Yaşı</label><input type="text" name="guest_rooms['+i+'][child_ages][1]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-md-2 form-group"><label for="adult" class="form-label">2. Çocuk Yaşı</label><input type="text" name="guest_rooms['+i+'][child_ages][2]" class="form-control" id="adult" autocomplete="off" value=""></div><div class="col-xs-1"><a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a></div></div></div>');
			i++;
		});
		
		$("#input_fields_wrap2").on("click","#remove_field", function(e){
			e.preventDefault(); $(this).parents('.row.mb-15').remove(); i--;
		});


		<?php // Dinamik konaklayacak kişi ekleme fonksiyonu ?>
		var j = 2;
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