<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Genel Ayarlar</h5>
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
	<form method="post" enctype="multipart/form-data">
		<div class="col-sm-8 col-xs-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="form-wrap">
							<div  class="pills-struct">
								<ul role="tablist" class="nav nav-pills">
									<?php foreach($this->data["all_languages"] as $item): ?>
										<li class="<?php echo($item->default == 1)?"active":""; ?>" role="presentation"><a aria-expanded="<?php echo($item->default == 1)?"true":"false"; ?>" data-toggle="tab" role="tab" href="#lang_<?php echo $item->lang ?>"><?php echo $item->language ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach($this->data["all_languages"] as $item): ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[logo]">Logo</label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[logo]" name="<?php echo $item->lang ?>_logo" />
													</div>
													<?php if(! @$page[$item->lang]['logo'] == ""): ?>
														<img src="<?php echo @$page[$item->lang]['logo']; ?>" class="img-responsive thumbnail" />
													<?php endif; ?>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[logo2]">Logo <small>(2)</small></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[logo2]" name="<?php echo $item->lang ?>_logo2" />
													</div>
													<?php if(! @$page[$item->lang]['logo2'] == ""): ?>
														<img src="<?php echo @$page[$item->lang]['logo2']; ?>" class="img-responsive thumbnail" />
													<?php endif; ?>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-8 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Site Başlığı</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="Site Başlığı" value="<?php echo @$page[$item->lang]['title'] ?>" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Sayfa Tanımı <small>(Description)</small></label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]" placeholder="Sayfa Tanımı" rows="3"><?php echo @$page[$item->lang]['description']; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[keywords]">Anahtar Kelimeler <small>(Keywords)</small></label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[keywords]" name="<?php echo $item->lang ?>[keywords]" placeholder="Anahtar Kelimeler"><?php echo @$page[$item->lang]['keywords']; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[footer_text]">Footer Yazısı</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[footer_text]" name="<?php echo $item->lang ?>[footer_text]" placeholder="Footer Yazısı" value="<?php echo @$page[$item->lang]['footer_text'] ?>" />
													</div>
												</div>
												<div class="col-md-4 col-xs-12">
													<h5 class="mb-20">Sosyal Medya Adresleri</h5>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_facebook_url]" placeholder="Facebook" value="<?php echo @$page[$item->lang]['social_facebook_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_instagram_url]" placeholder="Instagram" value="<?php echo @$page[$item->lang]['social_instagram_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_twitter_url]" placeholder="Twitter" value="<?php echo @$page[$item->lang]['social_twitter_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_youtube_url]" placeholder="Youtube" value="<?php echo @$page[$item->lang]['social_youtube_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_googleplus_url]" placeholder="Google Plus" value="<?php echo @$page[$item->lang]['social_googleplus_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_linkedin_url]" placeholder="Linkedin" value="<?php echo @$page[$item->lang]['social_linkedin_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_pinterest_url]" placeholder="Pinterest" value="<?php echo @$page[$item->lang]['social_pinterest_url'] ?>" />
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="form-wrap">
							<?php if($this->session->userdata['logged_in']["power"] == "root"): ?>
								<div class="checkbox checkbox-success checkbox-circle">
									<input id="general[page_cache]" name="general[page_cache]" type="checkbox" <?php echo(@$page[$this->data["default_lang"]->lang]['page_cache'] == 1)?'checked="checked"':""; ?>>
									<label for="general[page_cache]">Sayfa Çerezleri</label>
								</div>	
								<div class="checkbox checkbox-success checkbox-circle">
									<input id="general[css_js_cache]" name="general[css_js_cache]" type="checkbox" <?php echo(@$page[$this->data["default_lang"]->lang]['css_js_cache'] == 1)?'checked="checked"':""; ?>>
									<label for="general[css_js_cache]">CSS & JS Çerezleri</label>
								</div>
								<hr />
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[room_limit]">Tek seferde rezervasyon yapılabilecek oda limiti</label>
								<input type="number" class="form-control" id="general[room_limit]" name="general[room_limit]" placeholder="Tek seferde rezervasyon yapılabilecek oda limiti" value="<?php echo @$page[$this->data["default_lang"]->lang]['room_limit'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[booking_discount_rate]">Erken rezervasyon indirim oranı</label>
								<input type="number" class="form-control" id="general[booking_discount_rate]" name="general[booking_discount_rate]" placeholder="Erken rezervasyon indirim oranı" value="<?php echo @$page[$this->data["default_lang"]->lang]['booking_discount_rate'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[promotion_booking_discount_rate]">Paketler İçin Erken rezervasyon indirim oranı</label>
								<input type="number" class="form-control" id="general[promotion_booking_discount_rate]" name="general[promotion_booking_discount_rate]" placeholder="Erken rezervasyon indirim oranı" value="<?php echo @$page[$this->data["default_lang"]->lang]['promotion_booking_discount_rate'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[advance_discount_rate]">Peşin ödeme indirim oranı</label>
								<input type="number" class="form-control" id="general[advance_discount_rate]" name="general[advance_discount_rate]" placeholder="Peşin ödeme indirim oranı" value="<?php echo @$page[$this->data["default_lang"]->lang]['advance_discount_rate'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[currency]">Euro Kur Fiyatı</label>
								<input type="text" class="form-control price-format" id="general[currency]" name="general[currency]" placeholder="Euro Kur Fiyatı" value="<?php echo @$page[$this->data["default_lang"]->lang]['currency'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[tax]">Vergi Ücreti</label>
								<input type="number" class="form-control" id="general[tax]" name="general[tax]" placeholder="Euro Kur Fiyatı" value="<?php echo @$page[$this->data["default_lang"]->lang]['tax'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[insurance_price]">Sigorta Fiyatı oranı</label>
								<input type="number" class="form-control" id="general[insurance_price]" name="general[insurance_price]" placeholder="Sigorta Fiyatı" value="<?php echo @$page[$this->data["default_lang"]->lang]['insurance_price'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[deposit_percent]">Otelde ödeme depozito yüzdesi</label>
								<input type="number" class="form-control" id="general[deposit_percent]" name="general[deposit_percent]" placeholder="Sigorta Fiyatı" value="<?php echo @$page[$this->data["default_lang"]->lang]['deposit_percent'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[number_of_installments]">Taksit Sayısı</label>
								<input type="number" class="form-control" id="general[number_of_installments]" name="general[number_of_installments]" placeholder="Sigorta Fiyatı" value="<?php echo @$page[$this->data["default_lang"]->lang]['number_of_installments'] ?>" />
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[payment_email]">Ödeme Bildirim E-postalarının Gönderileceği Adres</label>
								<input type="text" class="form-control" id="general[payment_email]" name="general[payment_email]" placeholder="E-posta adresi" value="<?php echo @$page[$this->data["default_lang"]->lang]['payment_email'] ?>" />
							</div>
							<?php if($this->session->userdata['logged_in']["power"] == "root"): ?>
								<div class="form-group mb-30">
									<label class="control-label mb-10 text-left">Arama Yapılabilecek Modüller</label>
									<div class="row">
										<?php $searchModules = ["content","product"] ?>
										<?php $i=0; foreach($searchModules as $searchModule): ?>
										<?php if($this->db->table_exists($searchModule)): ?>
											<div class="col-md-4 col-xs-6">
												<div class="checkbox checkbox-success">
													<input id="searchModule<?php echo $i ?>" type="checkbox" name="general[search_module][]" value="<?php echo $searchModule ?>" <?php echo (strstr(@$page[$this->data["default_lang"]->lang]['search_module'],$searchModule)?"checked":""); ?> />
													<label for="searchModule<?php echo $i ?>"><?php echo $searchModule ?></label>
												</div>
											</div>
										<?php endif; ?>
										<?php $i++; endforeach; ?>
									</div>
								</div>
								<hr />
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[google_analytics]">Google Head Kodları</label>
								<textarea class="form-control" id="general[google_analytics]" name="general[google_analytics]" placeholder="Google Analytics Kodları" rows="10"><?php echo @$page[$this->data["default_lang"]->lang]['google_analytics']; ?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label mb-10 text-left" for="general[yandex_metrica]">Yandex / Facebook Head Kodları</label>
								<textarea class="form-control" id="general[yandex_metrica]" name="general[yandex_metrica]" placeholder="Yandex Metrica / Facebook Pixel Kodları" rows="10"><?php echo @$page[$this->data["default_lang"]->lang]['yandex_metrica']; ?></textarea>
							</div>
							<hr />
							<?php if($this->session->userdata['logged_in']["power"] == "root"): ?>
								<h5 class="mb-20">SMTP Bilgileri</h5>
								<div class="form-group">
									<input type="text" class="form-control" name="general[smtp_host]" placeholder="SMTP Hostu" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_host'] ?>" />
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="general[smtp_port]" placeholder="SMTP Portu" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_port'] ?>" />
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="general[smtp_user]" placeholder="SMTP Mail Adresi" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_user'] ?>" />
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="general[smtp_pass]" placeholder="SMTP Şifresi" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_pass'] ?>" />
								</div>
							<?php endif; ?>
							<div class="form-group">
								<textarea rows="3" class="form-control" name="general[smtp_to]" placeholder="Gönderilecek Adresler (aralarında virgül kullanarak birden fazla eposta adresi girebilirsiniz)"><?php echo @$page[$this->data["default_lang"]->lang]['smtp_to'] ?></textarea>
							</div>
							<div class="form-group clearfix">
								<button type="submit" class="btn btn-success pull-right">Kaydet</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>