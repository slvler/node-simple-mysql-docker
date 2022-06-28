<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('content/modules/slider'); ?>
<?php
$this->load->helper('content/content');
$records = get_contents(49);
?>
<div class="section section-contact">

	<div class="container">
		<div class="row">
			<?php foreach ($records as $row): ?>
				<div class="col-12 col-md-6">
					<h2 class="mini no-margin-top"><?php echo $row->title; ?></h2>
					<?php echo $row->content; ?>
					<div id="map-canvas" class="google-map mb-2">
						<a target="_blank" href="<?php echo $row->summary; ?>">
							<img src="<?php echo image_moo($row->list_img); ?>" alt="icon-print" class="img-responsive">
						</a>
					</div>
				</div>
			<?php endforeach ?>

			<div class="col-12">

				<h2 class="mini">BİZE ULAŞIN</h2>

				<form method="post" accept-charset="utf-8" id="contactForm">
					<input type="hidden" name="form" value="İletişim Formu">
					<div class="row">
						<div class="col-12 col-md-6 mb-1">
							<label for="fullname"><?php echo lang_transform("name")." ".lang_transform("surname"); ?></label>
							<input type="text" name="fullname" value="" class="form-control" id="fullname" placeholder="" required>
						</div>
						<div class="col-12 col-md-6 mb-1">
							<label for="email"><?php echo lang_transform("email"); ?></label>
							<input type="email" name="email" value="" class="form-control" id="email" placeholder="" required>
						</div>
						<div class="col-12 col-md-6 mb-1">
							<label for="phone"><?php echo lang_transform("phone"); ?></label>
							<div class="input-group">
								<div class="input-group-prepend" style="max-width: 180px;">
									<select name="phone_code" class="custom-select" required="required">
										<option value="+93">Afghanistan (+93)</option>
										<option value="+355">Albania (+355)</option>
										<option value="+213">Algeria (+213)</option>
										<option value="+684">American Samoa (+684)</option>
										<option value="+376">Andorra (+376)</option>
										<option value="+244">Angola (+244)</option>
										<option value="+809">Anguilla (+809)</option>
										<option value="+268">Antigua (+268)</option>
										<option value="+54">Argentina (+54)</option>
										<option value="+374">Armenia (+374)</option>
										<option value="+297">Aruba (+297)</option>
										<option value="+247">Ascension Island (+247)</option>
										<option value="+61">Australia (+61)</option>
										<option value="+672">Australian External Territories (+672)</option>
										<option value="+43">Austria (+43)</option>
										<option value="+994">Azerbaijan (+994)</option>
										<option value="+242">Bahamas (+242)</option>
										<option value="+246">Barbados (+246)</option>
										<option value="+973">Bahrain (+973)</option>
										<option value="+880">Bangladesh (+880)</option>
										<option value="+375">Belarus (+375)</option>
										<option value="+32">Belgium (+32)</option>
										<option value="+501">Belize (+501)</option>
										<option value="+229">Benin (+229)</option>
										<option value="+809">Bermuda (+809)</option>
										<option value="+975">Bhutan (+975)</option>
										<option value="+284">British Virgin Islands (+284)</option>
										<option value="+591">Bolivia (+591)</option>
										<option value="+387">Bosnia and Hercegovina (+387)</option>
										<option value="+267">Botswana (+267)</option>
										<option value="+55">Brazil (+55)</option>
										<option value="+284">British V.I. (+284)</option>
										<option value="+673">Brunei Darussalm (+673)</option>
										<option value="+359">Bulgaria (+359)</option>
										<option value="+226">Burkina Faso (+226)</option>
										<option value="+257">Burundi (+257)</option>
										<option value="+855">Cambodia (+855)</option>
										<option value="+237">Cameroon (+237)</option>
										<option value="+1">Canada (+1)</option>
										<option value="+238">CapeVerde Islands (+238)</option>
										<option value="+1">Caribbean Nations (+1)</option>
										<option value="+345">Cayman Islands (+345)</option>
										<option value="+238">Cape Verdi (+238)</option>
										<option value="+236">Central African Republic (+236)</option>
										<option value="+235">Chad (+235)</option>
										<option value="+56">Chile (+56)</option>
										<option value="+86">China (People's Republic) (+86)</option>
										<option value="+886">China-Taiwan (+886)</option>
										<option value="+57">Colombia (+57)</option>
										<option value="+269">Comoros and Mayotte (+269)</option>
										<option value="+242">Congo (+242)</option>
										<option value="+682">Cook Islands (+682)</option>
										<option value="+506">Costa Rica (+506)</option>
										<option value="+385">Croatia (+385)</option>
										<option value="+53">Cuba (+53)</option>
										<option value="+357">Cyprus (+357)</option>
										<option value="+420">Czech Republic (+420)</option>
										<option value="+45">Denmark (+45)</option>
										<option value="+246">Diego Garcia (+246)</option>
										<option value="+767">Dominca (+767)</option>
										<option value="+809">Dominican Republic (+809)</option>
										<option value="+253">Djibouti (+253)</option>
										<option value="+593">Ecuador (+593)</option>
										<option value="+20">Egypt (+20)</option>
										<option value="+503">El Salvador (+503)</option>
										<option value="+240">Equatorial Guinea (+240)</option>
										<option value="+291">Eritrea (+291)</option>
										<option value="+372">Estonia (+372)</option>
										<option value="+251">Ethiopia (+251)</option>
										<option value="+500">Falkland Islands (+500)</option>
										<option value="+298">Faroe (Faeroe) Islands (Denmark) (+298)</option>
										<option value="+679">Fiji (+679)</option>
										<option value="+358">Finland (+358)</option>
										<option value="+33">France (+33)</option>
										<option value="+596">French Antilles (+596)</option>
										<option value="+594">French Guiana (+594)</option>
										<option value="+241">Gabon (Gabonese Republic) (+241)</option>
										<option value="+220">Gambia (+220)</option>
										<option value="+995">Georgia (+995)</option>
										<option value="+49">Germany (+49)</option>
										<option value="+233">Ghana (+233)</option>
										<option value="+350">Gibraltar (+350)</option>
										<option value="+30">Greece (+30)</option>
										<option value="+299">Greenland (+299)</option>
										<option value="+473">Grenada/Carricou (+473)</option>
										<option value="+671">Guam (+671)</option>
										<option value="+502">Guatemala (+502)</option>
										<option value="+224">Guinea (+224)</option>
										<option value="+245">Guinea-Bissau (+245)</option>
										<option value="+592">Guyana (+592)</option>
										<option value="+509">Haiti (+509)</option>
										<option value="+504">Honduras (+504)</option>
										<option value="+852">Hong Kong (+852)</option>
										<option value="+36">Hungary (+36)</option>
										<option value="+354">Iceland (+354)</option>
										<option value="+91">India (+91)</option>
										<option value="+62">Indonesia (+62)</option>
										<option value="+98">Iran (+98)</option>
										<option value="+964">Iraq (+964)</option>
										<option value="+353">Ireland (Irish Republic; Eire) (+353)</option>
										<option value="+972">Israel (+972)</option>
										<option value="+39">Italy (+39)</option>
										<option value="+225">Ivory Coast (La Cote d'Ivoire) (+225)</option>
										<option value="+876">Jamaica (+876)</option>
										<option value="+81">Japan (+81)</option>
										<option value="+962">Jordan (+962)</option>
										<option value="+7">Kazakhstan (+7)</option>
										<option value="+254">Kenya (+254)</option>
										<option value="+855">Khmer Republic (Cambodia/Kampuchea) (+855)</option>
										<option value="+686">Kiribati Republic (Gilbert Islands) (+686)</option>
										<option value="+82">Korea, Republic of (South Korea) (+82)</option>
										<option value="+850">Korea, People's Republic of (North Korea) (+850)</option>
										<option value="+965">Kuwait (+965)</option>
										<option value="+996">Kyrgyz Republic (+996)</option>
										<option value="+371">Latvia (+371)</option>
										<option value="+856">Laos (+856)</option>
										<option value="+961">Lebanon (+961)</option>
										<option value="+266">Lesotho (+266)</option>
										<option value="+231">Liberia (+231)</option>
										<option value="+370">Lithuania (+370)</option>
										<option value="+218">Libya (+218)</option>
										<option value="+423">Liechtenstein (+423)</option>
										<option value="+352">Luxembourg (+352)</option>
										<option value="+853">Macao (+853)</option>
										<option value="+389">Macedonia (+389)</option>
										<option value="+261">Madagascar (+261)</option>
										<option value="+265">Malawi (+265)</option>
										<option value="+60">Malaysia (+60)</option>
										<option value="+960">Maldives (+960)</option>
										<option value="+223">Mali (+223)</option>
										<option value="+356">Malta (+356)</option>
										<option value="+692">Marshall Islands (+692)</option>
										<option value="+596">Martinique (French Antilles) (+596)</option>
										<option value="+222">Mauritania (+222)</option>
										<option value="+230">Mauritius (+230)</option>
										<option value="+269">Mayolte (+269)</option>
										<option value="+52">Mexico (+52)</option>
										<option value="+691">Micronesia (F.S. of Polynesia) (+691)</option>
										<option value="+373">Moldova (+373)</option>
										<option value="+33">Monaco (+33)</option>
										<option value="+976">Mongolia (+976)</option>
										<option value="+473">Montserrat (+473)</option>
										<option value="+212">Morocco (+212)</option>
										<option value="+258">Mozambique (+258)</option>
										<option value="+95">Myanmar (former Burma) (+95)</option>
										<option value="+264">Namibia (former South-West Africa) (+264)</option>
										<option value="+674">Nauru (+674)</option>
										<option value="+977">Nepal (+977)</option>
										<option value="+31">Netherlands (+31)</option>
										<option value="+599">Netherlands Antilles (+599)</option>
										<option value="+869">Nevis (+869)</option>
										<option value="+687">New Caledonia (+687)</option>
										<option value="+64">New Zealand (+64)</option>
										<option value="+505">Nicaragua (+505)</option>
										<option value="+227">Niger (+227)</option>
										<option value="+234">Nigeria (+234)</option>
										<option value="+683">Niue (+683)</option>
										<option value="+850">North Korea (+850)</option>
										<option value="+1 670">North Mariana Islands (Saipan) (+1 670)</option>
										<option value="+47">Norway (+47)</option>
										<option value="+968">Oman (+968)</option>
										<option value="+92">Pakistan (+92)</option>
										<option value="+680">Palau (+680)</option>
										<option value="+507">Panama (+507)</option>
										<option value="+675">Papua New Guinea (+675)</option>
										<option value="+595">Paraguay (+595)</option>
										<option value="+51">Peru (+51)</option>
										<option value="+63">Philippines (+63)</option>
										<option value="+48">Poland (+48)</option>
										<option value="+351">Portugal (includes Azores) (+351)</option>
										<option value="+1 787">Puerto Rico (+1 787)</option>
										<option value="+974">Qatar (+974)</option>
										<option value="+262">Reunion (France) (+262)</option>
										<option value="+40">Romania (+40)</option>
										<option value="+7">Russia (+7)</option>
										<option value="+250">Rwanda (Rwandese Republic) (+250)</option>
										<option value="+670">Saipan (+670)</option>
										<option value="+378">San Marino (+378)</option>
										<option value="+239">Sao Tome and Principe (+239)</option>
										<option value="+966">Saudi Arabia (+966)</option>
										<option value="+221">Senegal (+221)</option>
										<option value="+381">Serbia and Montenegro (+381)</option>
										<option value="+248">Seychelles (+248)</option>
										<option value="+232">Sierra Leone (+232)</option>
										<option value="+65">Singapore (+65)</option>
										<option value="+421">Slovakia (+421)</option>
										<option value="+386">Slovenia (+386)</option>
										<option value="+677">Solomon Islands (+677)</option>
										<option value="+252">Somalia (+252)</option>
										<option value="+27">South Africa (+27)</option>
										<option value="+34">Spain (+34)</option>
										<option value="+94">Sri Lanka (+94)</option>
										<option value="+290">St. Helena (+290)</option>
										<option value="+869">St. Kitts/Nevis (+869)</option>
										<option value="+508">St. Pierre &(et) Miquelon (France) (+508)</option>
										<option value="+249">Sudan (+249)</option>
										<option value="+597">Suriname (+597)</option>
										<option value="+268">Swaziland (+268)</option>
										<option value="+46">Sweden (+46)</option>
										<option value="+41">Switzerland (+41)</option>
										<option value="+963">Syrian Arab Republic (Syria) (+963)</option>
										<option value="+689">Tahiti (French Polynesia) (+689)</option>
										<option value="+886">Taiwan (+886)</option>
										<option value="+7">Tajikistan (+7)</option>
										<option value="+255">Tanzania (includes Zanzibar) (+255)</option>
										<option value="+66">Thailand (+66)</option>
										<option value="+228">Togo (Togolese Republic) (+228)</option>
										<option value="+690">Tokelau (+690)</option>
										<option value="+676">Tonga (+676)</option>
										<option value="+1 868">Trinidad and Tobago (+1 868)</option>
										<option value="+216">Tunisia (+216)</option>
										<option value="+90" selected>Turkey (+90)</option>
										<option value="+993">Turkmenistan (+993)</option>
										<option value="+688">Tuvalu (Ellice Islands) (+688)</option>
										<option value="+256">Uganda (+256)</option>
										<option value="+380">Ukraine (+380)</option>
										<option value="+971">United Arab Emirates (+971)</option>
										<option value="+44">United Kingdom (+44)</option>
										<option value="+598">Uruguay (+598)</option>
										<option value="+1">USA (+1)</option>
										<option value="+7">Uzbekistan (+7)</option>
										<option value="+678">Vanuatu (New Hebrides) (+678)</option>
										<option value="+39">Vatican City (+39)</option>
										<option value="+58">Venezuela (+58)</option>
										<option value="+84">Viet Nam (+84)</option>
										<option value="+1 340">Virgin Islands (+1 340)</option>
										<option value="+681">Wallis and Futuna (+681)</option>
										<option value="+685">Western Samoa (+685)</option>
										<option value="+381">Yemen (People's Democratic Republic of) (+381)</option>
										<option value="+967">Yemen Arab Republic (North Yemen) (+967)</option>
										<option value="+381">Yugoslavia (discontinued) (+381)</option>
										<option value="+243">Zaire (+243)</option>
										<option value="+260">Zambia (+260)</option>
										<option value="+263">Zimbabwe (+263)</option>
									</select> 
								</div>
								<input type="text" name="phone" value="" class="form-control " id="phone" placeholder="" required>
							</div>
						</div>
						<div class="col-12 col-md-6 mb-1">
							<label for="subject"><?php echo lang_transform("city"); ?></label>
							<div class="select-wrapper select-wrapper-form">
								<select name="subject" id="subject" class="form-control">
									<option value=""><?php echo lang_transform("choose"); ?>...</option>
									<option value="Adana">Adana</option>
									<option value="Adıyaman">Adıyaman</option>
									<option value="Afyon">Afyon</option>
									<option value="Ağrı">Ağrı</option>
									<option value="Aksaray">Aksaray</option>
									<option value="Amasya">Amasya</option>
									<option value="Ankara">Ankara</option>
									<option value="Antalya">Antalya</option>
									<option value="Ardahan">Ardahan</option>
									<option value="Artvin">Artvin</option>
									<option value="Aydın">Aydın</option>
									<option value="Balıkesir">Balıkesir</option>
									<option value="Bartın">Bartın</option>
									<option value="Batman">Batman</option>
									<option value="Bayburt">Bayburt</option>
									<option value="Bilecik">Bilecik</option>
									<option value="Bingöl">Bingöl</option>
									<option value="Bitlis">Bitlis</option>
									<option value="Bolu">Bolu</option>
									<option value="Burdur">Burdur</option>
									<option value="Bursa">Bursa</option>
									<option value="Çanakkale">Çanakkale</option>
									<option value="Çankırı">Çankırı</option>
									<option value="Çorum">Çorum</option>
									<option value="Denizli">Denizli</option>
									<option value="Diyarbakır">Diyarbakır</option>
									<option value="Düzce">Düzce</option>
									<option value="Edirne">Edirne</option>
									<option value="Elazığ">Elazığ</option>
									<option value="Erzincan">Erzincan</option>
									<option value="Erzurum">Erzurum</option>
									<option value="Eskişehir">Eskişehir</option>
									<option value="Gaziantep">Gaziantep</option>
									<option value="Giresun">Giresun</option>
									<option value="Gümüşhane">Gümüşhane</option>
									<option value="Hakkari">Hakkari</option>
									<option value="Hatay">Hatay</option>
									<option value="Iğdır">Iğdır</option>
									<option value="Isparta">Isparta</option>
									<option value="İçel">İçel</option>
									<option value="İstanbul">İstanbul</option>
									<option value="İzmir">İzmir</option>
									<option value="Kahramanmaraş">Kahramanmaraş</option>
									<option value="Karabük">Karabük</option>
									<option value="Karaman">Karaman</option>
									<option value="Kars">Kars</option>
									<option value="Kastamonu">Kastamonu</option>
									<option value="Kayseri">Kayseri</option>
									<option value="Kırıkkale">Kırıkkale</option>
									<option value="Kırklareli">Kırklareli</option>
									<option value="Kırşehir">Kırşehir</option>
									<option value="Kilis">Kilis</option>
									<option value="Kocaeli">Kocaeli</option>
									<option value="Konya">Konya</option>
									<option value="Kütahya">Kütahya</option>
									<option value="Malatya">Malatya</option>
									<option value="Manisa">Manisa</option>
									<option value="Mardin">Mardin</option>
									<option value="Muğla">Muğla</option>
									<option value="Muş">Muş</option>
									<option value="Nevşehir">Nevşehir</option>
									<option value="Niğde">Niğde</option>
									<option value="Ordu">Ordu</option>
									<option value="Osmaniye">Osmaniye</option>
									<option value="Rize">Rize</option>
									<option value="Sakarya">Sakarya</option>
									<option value="Samsun">Samsun</option>
									<option value="Siirt">Siirt</option>
									<option value="Sinop">Sinop</option>
									<option value="Sivas">Sivas</option>
									<option value="Şanlıurfa">Şanlıurfa</option>
									<option value="Şırnak">Şırnak</option>
									<option value="Tekirdağ">Tekirdağ</option>
									<option value="Tokat">Tokat</option>
									<option value="Trabzon">Trabzon</option>
									<option value="Tunceli">Tunceli</option>
									<option value="Uşak">Uşak</option>
									<option value="Van">Van</option>
									<option value="Yalova">Yalova</option>
									<option value="Yozgat">Yozgat</option>
									<option value="Zonguldak">Zonguldak</option>
								</select>
							</div>
						</div>

						<div class="col-12 mb-1">
							<label for="address"><?php echo lang_transform("address"); ?></label>
							<textarea name="address" cols="30" rows="3" id="address" class="form-control" placeholder="" required></textarea>
						</div>
						<div class="col-12 mb-1">
							<label for="message"><?php echo lang_transform("message"); ?></label>
							<textarea name="message" cols="30" rows="3" id="message" class="form-control" placeholder="" required></textarea>
						</div>
						<div class="col-12 col-sm-3 mb-1">
							<input type="hidden" name="form" value="İletişim Formu">
							<input type="submit" name="btn_contact" id="btn_contact" class="btn btn-primary btn-block" value="<?php echo lang_transform("send"); ?>">
						</div>
					</div>
				</form>
			</div>

		</div>

	</div>

</div>

<?php $this->load->view('home/layout/footer'); ?>