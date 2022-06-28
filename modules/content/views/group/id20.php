<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('content/modules/slider'); ?>
<?php
$this->load->helper('promotion/promotion');
$this->load->helper('contact/contact');
$promotions = get_promotions();
$contact = contact_page();
?>
<!-- Rezervasyon Formu -->
<!-- 
    Gerekli Kütüphaneler 
    jQuery head tagında tanımlanmıştır. 
-->
<link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet"/>
<link href="assets/css/reservation.css" rel="stylesheet"/>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/momentjs/locale/tr.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
	var rangeFormat = 'DD.MM.YYYY, ddd',
	txtChildrentTitle = "<?php echo lang_transform("child_age"); ?>",
	msgGuestMaxRoom = "<?php echo lang_transform("max_number_person_text"); ?>",
	msgGuestMaxRoomCapacity = '<?php echo lang_transform("room_standart_text"); ?>';
	var rangeLocale = { format: rangeFormat, "separator": " - ", "applyLabel": "Uygula", "cancelLabel": "Vazgeç", ranges: { 'Bugün': [moment(), moment()], 'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')], 'Son 7 gün': [moment().subtract(6, 'days'), moment()], 'Son 30 gün': [moment().subtract(29, 'days'), moment()], 'Bu ay': [moment().startOf('month'), moment().endOf('month')], 'Geçen ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')] }, "fromLabel": "Dan", "toLabel": "a", "customRangeLabel": "Seç", "daysOfWeek": [ "Paz", "Pzt", "Sal", "Çar", "Per", "Cum", "Cmt"], "monthNames": [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ], "firstDay": 1};
</script>
<main id="main" class="pt-2 pb-5 container">
	
	<?php $this->load->view('content/modules/breadcrumb'); ?>
	
	<form action="<?php echo site_url("reservation/promotion"); ?>" method="post" id="formPackageSelect" class="form-package-select">
		<input type="hidden" name="reservation_type" value="promotions" />
		<?php
		$this->load->helper('promotion/promotion');
		$promotions = get_promotions();
		?>
		<div class="tbl tblPackageSearchResult">
			<div class="tblHead">
				<div class="tblRow PackageSearchItem">
					<div class="tblCell tblPackageImage"></div>
					<div class="tblCell tblPackageName"><?php echo lang_transform("package_name"); ?></div>
					<div class="tblCell tblPackageDates"><?php echo lang_transform("date_range"); ?></div>
					<div class="tblCell tblPackageDay"><?php echo lang_transform("number_of_nights"); ?></div>
					<div class="tblCell tblPackagePrice"><?php echo lang_transform("package_price_per_person"); ?></div>
					<div class="tblCell tblPackageExt"></div>
				</div>
			</div>
			<div class="tblBody">
				<?php foreach ($promotions as $row): ?>
					<div class="tblRow PackageSearchItem">
						<div class="tblCell tblPackageImage">
							<img src="<?php echo image_moo($row->list_img,59,46) ?>" alt=""/>
						</div>
						<div class="tblCell tblPackageName"><?php echo $row->title; ?></div>
						<?php
						// iki tarih arasındaki günleri alıyoruz.
						$days = date_between(date("Y-m-d", strtotime(@$row->start_date)),date("Y-m-d", strtotime(@$row->end_date)));
						$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
						$start_date = explode("-", $row->start_date);
						$end_date = explode("-", $row->end_date);
						?>
						<div class="tblCell tblPackageDates"><?php echo $start_date[2]." ".$tr_months[$start_date[1]-1];?> - <?php echo $end_date[2]." ".$tr_months[$end_date[1]-1];?></div>
						<?php if ($row->id == get_lang_id_record(57, "promotion", $this->session->userdata("lang"))->id || $row->id == get_lang_id_record(58, "promotion", $this->session->userdata("lang"))->id): ?>
						<div class="tblCell tblPackageDay">3 <?php echo lang_transform("night"); ?></div>
						<?php else: ?>
							<div class="tblCell tblPackageDay"><?php echo count($days); ?> <?php echo lang_transform("night"); ?></div>
						<?php endif ?>
						<div class="tblCell tblPackagePrice"><?php echo $row->price; ?> TL</div>
						<?php if ($row->id == get_lang_id_record(57, "promotion", $this->session->userdata("lang"))->id || $row->id == get_lang_id_record(58, "promotion", $this->session->userdata("lang"))->id): ?>
						<div class="tblCell tblPackageExt">
							<a href="<?php echo get_seo_url("contact/index/".$contact["id"]); ?>" class="btn btn-primary btn-sm btn-block radius"><?php echo ($this->session->userdata("lang")=="tr")?"İletişime geç":"Contact us"; ?></a>
						</div>
						<?php else: ?>
							<div class="tblCell tblPackageExt">
								<a href="javascript:;" class="btn btn-primary btn-sm btn-block radius btn-package-select" data-id="2" data-name="<?php echo $row->title; ?>" data-startdate="<?php echo $row->start_date; ?>" data-finishdate="<?php echo $row->end_date; ?>" data-daycount="<?php echo count($days); ?>" data-price="<?php echo $row->price; ?>" data-currency="TL"><?php echo lang_transform("select"); ?></a>
							</div>
						<?php endif ?>
					</div>
				<?php endforeach ?>
			</div>
		</div>

		<script id="temp_package_search_form" type="x-tmpl-mustache">
			<div class="tblRow PackageSearchForm">
				<input type="hidden" name="package_id" value="{{id}}" />
				<input type="hidden" name="package_name" value="{{name}}" />
				<input type="hidden" name="start_date" value="{{startdate}}" />
				<input type="hidden" name="end_date" value="{{finishdate}}" />
				<input type="hidden" name="day_count" value="{{daycount}}" />
				<input type="hidden" name="price" value="{{price}}" />
				<input type="hidden" name="currency" value="{{currency}}" />
				<div class="r-search-form">
					<div class="r-search-form-group r-search-dates">
						<label class="r-search-form-label"><span class=""><?php echo lang_transform("date_range"); ?>:</span> <span>{{daycount}} <?php echo lang_transform("night"); ?></span> </label> 
						<div class="form-control r-search-form-input form-control-text">{{startdate}} - {{finishdate}}</div>
					</div>
					<div class="r-search-form-group r-search-guests">
						<label class="r-search-form-label"> <span><?php echo lang_transform("rooms_and_visitors"); ?></span><span class="text-danger js-r-search-guest-err"></span></label> 
						<a class="form-control custom-select r-search-form-input r-search-form-select collapsed" href="#js-r-rooms-guests-panel2" data-toggle="collapse" aria-expanded="false">
							<p class="mb-0 r-search-form-select-text"> <span class="js-number-of-rooms">1</span> <span class="js-rooms-text"> Oda</span> <span class="js-adlt">: </span> <span class="js-number-of-adults js-adlt">1<span class="js-adlt"> </span></span> <span class="js-adults-text js-adlt"> <?php echo lang_transform("adult"); ?></span> <span class="js-chld is-hidden">, </span> <span class="js-chld js-number-of-children is-hidden">0</span> <span class="js-chld js-children-text is-hidden"><?php echo lang_transform("child"); ?></span> </p>
						</a>
						<div id="js-r-rooms-guests-panel2" class="r-rooms-guests-panel js-r-rooms-guests-panel collapse" style="">
							<div class="rooms-guest-wrapper">
								<div class="r-rooms js-rooms form-group">
									<div class="labelContainer field-title"><?php echo lang_transform("room"); ?></div>
									<div class="clearfix r-s2-stepper">
										<input name="rooms[count]" id="guest_room_count" class="form-control" data-min="1" readonly data-max="6" value="1" />
										<a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Oda sayısını azaltın">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
												<path d="M0 10h24v4h-24z"/>
											</svg>
										</a>
										<a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Oda sayısını artırın">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
												<path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
											</svg>
										</a>
									</div>
								</div>
								<div class="r-room-wrapper js-adult-children-wrapper">
									<div class="row r-adult-children-block js-adult-children-block" data-id="1">
										<div class="col-12"><label class="text-primary r-adult-children-count">1. <?php echo lang_transform("room"); ?></label></div>
										<div class="col-6 r-adults js-adults js-guests form-group">
											<div class="labelContainer field-title"><?php echo lang_transform("adult"); ?> (Max:<span class="js-adult-max">3</span> <?php echo lang_transform("person"); ?>)</div>
											<div class="clearfix r-s2-stepper">
												<input name="guest_rooms[1][adult_count]" id="guest_adult_count" class="form-control" data-min="1" readonly data-max="3" value="1" />
												<a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Yetişkin sayısını azaltın">
													<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
														<path d="M0 10h24v4h-24z"/>
													</svg>
												</a>
												<a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Yetişkin sayısını artırın">
													<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
														<path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
													</svg>
												</a>
											</div>
										</div>
										<div class="col-6 r-children js-children js-guests form-group">
											<div class="labelContainer field-title"><?php echo lang_transform("child_age"); ?> (Max:<span class="js-children-max">2</span> <?php echo lang_transform("person"); ?>)</div>
											<div class="clearfix r-s2-stepper">
												<input name="guest_rooms[1][child_count]" id="guest_child_count" class="form-control" data-min="0" readonly data-max="2" value="0" />
												<a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Çocuk sayısını azaltın">
													<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
														<path d="M0 10h24v4h-24z"/>
													</svg>
												</a>
												<a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Çocuk sayısını arttırın">
													<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
														<path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
													</svg>
												</a>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="r-search-form-group r-search-btn">
						<button type="submit" name="submit" class="btn btn-primary btn-block r-search-form-btn"> <?php echo lang_transform("book_now"); ?> </button>
					</div>
				</div>
			</div>
		</script>

		<script id="temp_adult_children" type="x-tmpl-mustache">
			<div class="row gutter-5 r-adult-children-block js-adult-children-block" data-id="{{index}}">
				<div class="col-12"><label class="text-primary r-adult-children-count">{{index}}. <?php echo lang_transform("room"); ?></label></div>
				<div class="col-6 r-adults js-adults js-guests form-group">
					<div class="labelContainer field-title"><?php echo lang_transform("adult"); ?> (Max:<span class="js-adult-max">3</span> <?php echo lang_transform("person"); ?>)</div>
					<div class="clearfix r-s2-stepper">
						<input name="guest_rooms[{{index}}][adult_count]" id="guest_adult_count" class="form-control" data-min="1" readonly data-max="3" value="1" />
						<a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Yetişkin sayısını azaltın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg></a>
						<a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Yetişkin sayısını artırın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></a>
					</div>
				</div>
				<div class="col-6 r-children js-children js-guests form-group">
					<div class="labelContainer field-title"><?php echo lang_transform("ages_of_children"); ?> (Max:<span class="js-children-max">2</span> <?php echo lang_transform("person"); ?>)</div>
					<div class="clearfix r-s2-stepper">
						<input name="guest_rooms[{{index}}][child_count]" id="guest_child_count" class="form-control" data-min="0" readonly data-max="2" value="0" />
						<a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Çocuk sayısını azaltın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg></a>
						<a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Çocuk sayısını arttırın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></a>
					</div>
				</div>
			</div>
		</script>
		<script id="temp_children_count" type="x-tmpl-mustache">
			<div class="col-6 col-md-4 r-children-count js-children-count js-guests form-group has-success"><div class="labelContainer field-title"><?php echo lang_transform("child_age"); ?> {{index}}</div><div class="clearfix r-s2-stepper"><select name="guest_rooms[{{adult}}][child_ages][{{index}}]" id="child_{{adult}}_count_{{index}}_age" class="form-control custom-select" aria-invalid="false"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div></div>
		</script>

	</form> 
</main>

<?php $this->load->view('home/layout/footer'); ?>
<script src="assets/js/reservation.js" type="text/javascript"></script> 