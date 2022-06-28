<?php $this->load->view('home/layout/header'); ?>
<link href="assets/css/jquery.toast.min.css" rel="stylesheet" type="text/css">
<script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>
<?php
$this->load->helper('content/content');
$privacy_policy = get_content(get_lang_id_record(65,'content',$this->session->userdata('lang'))->id);
// Sigortanın seçilebilir ve seçilemez durumuna göre iptal politikası içeriği değişiyor.
if ($insurance_status == 1) {
    $cancellation = get_content(get_lang_id_record(66,'content',$this->session->userdata('lang'))->id);
    // sigorta seçilebilir durumdayken sigortasız paket koşullarını göstermek için değişkene alıyoruz.
    $cancellation2 = get_content(get_lang_id_record(239,'content',$this->session->userdata('lang'))->id);
}else{
    $cancellation = get_content(get_lang_id_record(239,'content',$this->session->userdata('lang'))->id);
}
$sales_contract = get_content(get_lang_id_record(67,'content',$this->session->userdata('lang'))->id);
?>
<main id="main" class="page-reservation">
	<!-- Rezervasyon Formu -->

    <!-- 
        Gerekli Kütüphaneler 
        jQuery head tagında tanımlanmıştır. 
    -->
    
    <link href="assets/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="assets/css/reservation.css" rel="stylesheet"/>
    <script src="assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="assets/plugins/momentjs/locale/tr.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/plugins/datepicker/locales/bootstrap-datepicker.tr.min.js"></script>
    
    <script type="text/javascript">
    	var rangeFormat = 'DD.MM.YYYY, ddd',
    	txtChildrentTitle = "<?php echo lang_transform("child_age"); ?>",
    	msgGuestMaxRoom = "<?php echo lang_transform("max_number_person_text"); ?>",
    	msgGuestMaxRoomCapacity = '<?php echo lang_transform("room_standart_text"); ?>',
    	rangeLocale = { format: rangeFormat, "separator": " - ", "applyLabel": "Uygula", "cancelLabel": "Vazgeç", ranges: { 'Bugün': [moment(), moment()], 'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')], 'Son 7 gün': [moment().subtract(6, 'days'), moment()], 'Son 30 gün': [moment().subtract(29, 'days'), moment()], 'Bu ay': [moment().startOf('month'), moment().endOf('month')], 'Geçen ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')] }, "fromLabel": "Dan", "toLabel": "a", "customRangeLabel": "Seç", "daysOfWeek": [ "Paz", "Pzt", "Sal", "Çar", "Per", "Cum", "Cmt"], "monthNames": [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ], "firstDay": 1 };  
    </script>
    
    <div class="r-search-hero bg-light mb-2">
    	<div class="container">
    		<div class="r-step">
    			<div class="r-step-item active">
    				<span class="r-step-number">1</span>
    				<label class="r-step-text"><?php echo lang_transform("room_date_selection"); ?></label>
    			</div>
    			<div class="r-step-item">
    				<span class="r-step-number">2</span>
    				<label class="r-step-text"><?php echo lang_transform("complete_reservation"); ?></label>
    			</div>
    		</div>
    		<form action="<?php echo site_url("reservation"); ?>" method="post" id="formReservationSearch" class="r-search-form" novalidate="novalidate">
                <input type="hidden" name="reservation_type" value="reservation" />
                <div class="r-search-form-group r-search-dates">
                    <label class="r-search-form-label">
                        <span><?php echo lang_transform("check_in_out_date"); ?></span>
                        <!-- <span><span class="r-search-day">3</span> <?php echo lang_transform("day"); ?></span> -->
                    </label>
                    <input type="text" name="daterange" class="form-control r-search-form-input daterange" aria-invalid="false">
                </div>
                <div class="r-search-form-group r-search-guests">
                    <label class="r-search-form-label">
                        <?php echo lang_transform("rooms_and_visitors"); ?>
                        <span class="text-danger js-r-search-guest-err"></span>
                    </label>
                    <a class="form-control custom-select r-search-form-input r-search-form-select collapsed" href="#js-r-rooms-guests-panel0" data-toggle="collapse">
                        <p class="mb-0 r-search-form-select-text">
                            <span class="js-number-of-rooms">1</span>
                            <span class="js-rooms-text"> <?php echo lang_transform("room"); ?></span>
                            <span class="js-adlt">: </span>
                            <span class="js-number-of-adults js-adlt">1<span class="js-adlt"> </span></span>
                            <span class="js-adults-text js-adlt"> <?php echo lang_transform("adult"); ?></span>
                            <span class="js-chld is-hidden">, </span>
                            <span class="js-chld js-number-of-children is-hidden">0</span>
                            <span class="js-chld js-children-text is-hidden"><?php echo lang_transform("child"); ?></span>
                        </p>
                    </a> 
                    <div class="collapse r-rooms-guests-panel js-r-rooms-guests-panel" id="js-r-rooms-guests-panel0">
                        <div class="rooms-guest-wrapper">
                            <div class="r-rooms js-rooms form-group">
                                <div class="labelContainer field-title"><?php echo lang_transform("room"); ?></div>
                                <div class="clearfix r-s2-stepper">
                                    <input name="rooms[count]" id="guest_room_count" class="form-control" data-min="1" readonly data-max="6" value="1" />
                                    <a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Oda sayısını azaltın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg></a>
                                    <a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Oda sayısını artırın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></a>
                                </div>
                            </div>
                            <div class="r-room-wrapper js-adult-children-wrapper">
                                <div class="row r-adult-children-block js-adult-children-block" data-id="1">
                                    <div class="col-12"><label class="text-primary r-adult-children-count">1. <?php echo lang_transform("room"); ?></label></div>
                                    <div class="col-6 r-adults js-adults js-guests form-group">
                                        <div class="labelContainer field-title"><?php echo lang_transform("adult"); ?> (Max:<span class="js-adult-max">3</span> <?php echo lang_transform("person"); ?>)</div>
                                        <div class="clearfix r-s2-stepper">
                                            <input name="guest_rooms[1][adult_count]" id="guest_adult_count" class="form-control" data-min="1" readonly data-max="3" value="1" />
                                            <a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Yetişkin sayısını azaltın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg></a>
                                            <a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Yetişkin sayısını artırın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></a>
                                        </div>
                                    </div>
                                    <div class="col-6 r-children js-children js-guests form-group">
                                        <div class="labelContainer field-title"><?php echo lang_transform("ages_of_children"); ?> (Max:<span class="js-children-max">2</span> <?php echo lang_transform("person"); ?>)</div>
                                        <div class="clearfix r-s2-stepper">
                                            <input name="guest_rooms[1][child_count]" id="guest_child_count" class="form-control" data-min="0" readonly data-max="2" value="0" />
                                            <a href="javascript:;" class="r-minus js-minus t-icon-minus is-inactive" aria-label="Çocuk sayısını azaltın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg></a>
                                            <a href="javascript:;" class="r-plus js-plus t-icon-plus" aria-label="Çocuk sayısını arttırın"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></a>

                                            
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="r-search-form-group r-search-btn">
                    <button type="submit" name="submit" class="btn btn-primary btn-block r-search-form-btn">
                        <?php echo lang_transform("check_rates "); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mb-3">
    	<div class="row">
    		<div class="col-12 col-lg-9 content">
    			<ul class="nav nav-tabs r-detail-tabs" id="tabReservationDetail" role="tablist">
    				<li class="nav-item">
    					<a href="#tabDetailForm" class="nav-link r-tablink active" data-toggle="tab" role="tab"><?php echo lang_transform("reservation_information"); ?></a>
    				</li>
    				<li class="nav-item">
    					<a href="#tabDetailPackage" class="nav-link r-tablink" data-toggle="tab" role="tab"><?php echo lang_transform("packets"); ?></a>
    				</li>
    			</ul>
    			<div class="tab-content">
    				<div id="tabDetailForm" class="tab-pane active" role="tabpanel">
    					<form action="<?php echo site_url("reservation/payment"); ?>" method="post" id="formReservationDetail" novalidate="novalidate">
                            <input type="hidden" name="reservation_type" value="<?php echo $room_information['reservation_type']; ?>" />
                            <input type="hidden" name="currency" value="TRY" /> <!-- yazdırmak için. para birimi  -->
                            <input type="hidden" name="package_name" value="<?php echo @$room_information['package_name']; ?>" /> <!-- yazdırmak için. para birimi  -->
                            <input type="hidden" name="total_amount" value="<?php echo number_format($price,2); ?>" /> <!-- acenta kodu -->
                            <input type="hidden" name="agency_code" value="" /> <!-- acenta kodu -->
                            <input type="hidden" name="agency_price" value="" />  <!-- acenta fiyatı -->
                            <input type="hidden" name="total_tax" value="<?php echo $tax_price; ?>" /> <!-- Vergi fiyatı -->
                            <input type="hidden" name="total_insurance" value="" /> <!-- Sigorta fiyatı -->
                            <input type="hidden" name="deposit_percent" value="<?php echo settings("deposit_percent"); ?>" /> <!-- Otelde ödeme yapılması için yüzde -->
                            <input type="hidden" name="deposit_total" value="" /> <!-- Otelde ödeme yapılacak tutar -->
                            <input type="hidden" name="insurance_rate" value="<?php echo settings("insurance_price"); ?>" /> <!-- Sigorta fiyatı -->
                            <input type="hidden" name="number_of_installments" value="<?php echo settings("number_of_installments"); ?>" /> <!-- Sigorta fiyatı -->
                            <?php // Erken rezervasyon varsa toplam indirim tanımlanıyor. Yoksa peşin ödeme tanımlanıyor. İndirim tipi belirtiliyor. ?>
                            <?php if (@$booking_discount_price>0): ?>
                                <input type="hidden" name="total_discount" value="<?php echo (@$booking_discount_price)?"-".$booking_discount_price:""; ?>" /> <!-- indirim -->
                                <input type="hidden" name="discount_type" value="1">
                                <?php else: ?>
                                    <input type="hidden" name="total_discount" value="<?php echo (@$advance_discount_rate)?"-".$advance_discount_rate:""; ?>" /> <!-- indirim -->
                                    <input type="hidden" name="discount_type" value="0">
                                <?php endif ?>
                                <input type="hidden" name="total_price" value="" /> <!-- toplam fiyat -->
                                <div class="card card-collapse">
                                   <?php
                                   $this->load->helper('product/product');
                                   $product = get_product(get_lang_id_record(1,'product',$this->session->userdata('lang'))->id);
                                   ?>
                                   <div class="card-header" data-target="#cCllaps1" data-toggle="collapse">
                                    <h3 class="card-title mb-0"><?php echo $product['title']; ?></h3>
                                </div>
                                <div id="cCllaps1" class="card-body collapse show">
                                    <p class="semibold"><?php echo $product['summary']; ?></p>
                                    <div class="row">
                                       <div class="col-6 col-md-4 col-xl-3">
                                          <div class="roomProp">
                                           <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31.017" height="20.994" viewBox="0 0 31.017 20.994"><path d="M19.4,59.391a.627.627,0,1,0-.784.979,1.261,1.261,0,0,1,0,2.09A2.629,2.629,0,0,0,17.6,64.517a2.678,2.678,0,0,0,1.012,2.057A.628.628,0,0,0,19,66.7a.587.587,0,0,0,.49-.229.6.6,0,0,0-.1-.882,1.261,1.261,0,0,1,0-2.09,2.629,2.629,0,0,0,1.012-2.057A2.678,2.678,0,0,0,19.4,59.391Z" transform="translate(-12.67 -45.71)" fill="#0168b3"/><path d="M38.1,59.391a.627.627,0,1,0-.784.979,1.261,1.261,0,0,1,0,2.09A2.629,2.629,0,0,0,36.3,64.517a2.678,2.678,0,0,0,1.012,2.057.628.628,0,0,0,.392.131.587.587,0,0,0,.49-.229.6.6,0,0,0-.1-.882,1.261,1.261,0,0,1,0-2.09,2.629,2.629,0,0,0,1.012-2.057A2.487,2.487,0,0,0,38.1,59.391Z" transform="translate(-25.264 -45.71)" fill="#0168b3"/><path d="M56.9,59.391a.627.627,0,1,0-.784.979,1.261,1.261,0,0,1,0,2.09A2.629,2.629,0,0,0,55.1,64.517a2.678,2.678,0,0,0,1.012,2.057.628.628,0,0,0,.392.131.587.587,0,0,0,.49-.229.6.6,0,0,0-.1-.882,1.261,1.261,0,0,1,0-2.09,2.629,2.629,0,0,0,1.012-2.057A2.678,2.678,0,0,0,56.9,59.391Z" transform="translate(-37.926 -45.71)" fill="#0168b3"/><path d="M75.7,59.391a.627.627,0,1,0-.784.979,1.261,1.261,0,0,1,0,2.09A2.629,2.629,0,0,0,73.9,64.517a2.678,2.678,0,0,0,1.012,2.057.628.628,0,0,0,.392.131.587.587,0,0,0,.49-.229.6.6,0,0,0-.1-.882,1.261,1.261,0,0,1,0-2.09,2.629,2.629,0,0,0,1.012-2.057A2.678,2.678,0,0,0,75.7,59.391Z" transform="translate(-50.588 -45.71)" fill="#0168b3"/><path d="M31.983,17.8H4.035A1.533,1.533,0,0,0,2.5,19.335V28.15a1.533,1.533,0,0,0,1.535,1.535H31.983a1.533,1.533,0,0,0,1.535-1.535V19.335A1.533,1.533,0,0,0,31.983,17.8Zm-3.4,2.677h1.5a.62.62,0,1,1,0,1.241h-1.5a.62.62,0,0,1-.62-.62A.583.583,0,0,1,28.587,20.477Zm-3.82,0h1.5a.62.62,0,1,1,0,1.241h-1.5a.62.62,0,0,1-.62-.62A.583.583,0,0,1,24.767,20.477Zm7.477,7.705a.281.281,0,0,1-.261.261H4.035a.281.281,0,0,1-.261-.261V24.4h28.47Z" transform="translate(-2.5 -17.8)" fill="#0168b3"/><path d="M11.72,43.473H35.881a.62.62,0,0,0,.62-.62.672.672,0,0,0-.62-.653H11.72a.62.62,0,0,0-.62.62A.672.672,0,0,0,11.72,43.473Z" transform="translate(-8.292 -34.234)" fill="#0168b3"/></svg>
                                        </span>
                                        <span class="text">Klima</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-xl-3">
                                  <div class="roomProp">
                                   <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26.085" height="27.631" viewBox="0 0 26.085 27.631"><path d="M64.506,39.672a7.954,7.954,0,0,1-.481,3.966c-2.029,3.427-7.329,3.435-8.61-.6-.978-3.08,1.532-6.6.7-9.043-1.05-3.084-5.646-2.677-8.247-2.6a2.845,2.845,0,0,0-.007-1.263c3.326-.094,8.12-.456,9.452,3.458.994,2.921-1.551,6.384-.7,9.067.948,2.987,4.841,2.833,6.318.34a7.09,7.09,0,0,0,.315-3.166A2.472,2.472,0,0,0,64.506,39.672Zm-19.135-11.1a2.2,2.2,0,0,1,0,4.4H43.1v-.792H41.17V30.917H43.1v-.282H41.17V29.368H43.1v-.792Zm19.4.735.864,7.859a2.061,2.061,0,0,1-4.1.45L60.743,30.4a5.96,5.96,0,0,1-5.406-5.863L45.6,22.875V21.591L42.52,18.51H61.3a5.96,5.96,0,0,1,3.474,10.8Zm-19.4.532h-1v1.866h1a.933.933,0,0,0,0-1.866Z" transform="translate(-41.17 -18.51)" fill="#0168b3"/></svg>
                                </span>
                                <span class="text">Saç Kurutma Makinası</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                          <div class="roomProp">
                           <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25.488" height="25.488" viewBox="0 0 25.488 25.488"><path d="M24.426-60H1.062C0-60,0-60,0-58.938v23.364c0,1.062,0,1.062,1.062,1.062H24.426c1.062,0,1.062,0,1.062-1.062V-58.938C25.488-60,25.488-60,24.426-60ZM2.124-36.636v-21.24h21.24v21.24Zm6.9-16.206v-2.4c0-.51,0-.51-.51-.51H7.073c-.51,0-.51,0-.51.51v2.4c0,2.4-2.315,3.165-2.315,6.9v6.287c0,.892,0,.892.892.892h5.31c.871,0,.871,0,.871-.892v-6.287C11.321-49.677,9.027-50.442,9.027-52.842ZM20.476-51.5H13.53c-.34,0-.34,0-.446.3a6.134,6.134,0,0,0-.34,1.975,4,4,0,0,0,3.462,4.312V-41.1c0,1.317-2.251.913-2.251,1.827,0,.51,0,.51.51.51H19.52c.51,0,.51,0,.51-.51,0-.913-2.251-.446-2.251-1.827v-3.823a4,4,0,0,0,3.462-4.312,6.582,6.582,0,0,0-.319-1.954C20.794-51.5,20.794-51.5,20.476-51.5Zm0,0" transform="translate(0 60)" fill="#0168b3"/></svg>
                        </span>
                        <span class="text">Minibar</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-xl-3">
                  <div class="roomProp">
                   <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27.112" height="18.698" viewBox="0 0 27.112 18.698"><path d="M30.177,35.858H4.935V20.9H30.177V35.858Zm.935-15.893H4V36.793H31.112Z" transform="translate(-4 -19.965)" fill="#0168b3"/><rect width="14.958" height="0.935" transform="translate(6.077 17.763)" fill="#0168b3"/><rect width="23.373" height="13.089" transform="translate(1.87 1.87)" fill="#0168b3"/></svg>
                </span>
                <span class="text">Televizyon</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-3">
          <div class="roomProp">
           <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="34.407" height="20.591" viewBox="0 0 34.407 20.591"><g transform="translate(0)"><g transform="translate(1.264 6.39)"><path d="M12.893,40.166c-.025-.026-.051-.051-.077-.074A1.186,1.186,0,0,0,11.195,38.7a1.976,1.976,0,0,0-.212-.268A2.022,2.022,0,0,0,7.5,40.01a1.565,1.565,0,0,0,.41,2.924,1.031,1.031,0,0,0,.77,1.011l.807.807v1.483h.674V44.751L10.9,44a1.751,1.751,0,0,0,1.544-2.025,1.112,1.112,0,0,0,.445-1.813ZM9.5,43.815a1.023,1.023,0,0,0,.151-.116c.008-.008.016-.017.023-.025a1.772,1.772,0,0,0,.39.217l-.244.244Z" transform="translate(-6.651 -37.795)" fill="#0168b3"/><path d="M13.434,61.225H9.726a.29.29,0,0,0-.289.29l.579,3.4a.29.29,0,0,0,.29.29h2.549a.289.289,0,0,0,.289-.29l.579-3.4A.29.29,0,0,0,13.434,61.225ZM12.5,64.832l.076-3.278h.433Z" transform="translate(-8.416 -52.64)" fill="#0168b3"/></g><path d="M47.457,33.522,40.714,32.35l.343,1.18,5.679.987Z" transform="translate(-26.969 -27.956)" fill="#0168b3"/><path d="M52.731,21.119c-.121-.251-.38-.7-.708-.755s-.723.278-.922.473c-5.2-.563-9.863,2.095-10.381,3.659l20.547,3.571C61.345,26.312,57.827,22.334,52.731,21.119Z" transform="translate(-26.973 -20.358)" fill="#0168b3"/><path d="M27.319,37.331l2.5.434.721-1L23.794,35.6l.343,1.181,2.5.434L24.562,49.143H3.2V50.6H37.609V49.143H25.266Z" transform="translate(-3.202 -30.013)" fill="#0168b3"/><path d="M78.43,40.025l5.679.987.746-.991-6.768-1.176Z" transform="translate(-50.647 -32.071)" fill="#0168b3"/><g transform="translate(8.987 9.945)"><path d="M34.384,52.117a.208.208,0,0,1-.208-.208v-4.2a.208.208,0,0,1,.208-.207H39.7a.208.208,0,0,1,.208.207v4.2a.208.208,0,0,1-.208.208H34.384Z" transform="translate(-31.813 -47.499)" fill="#0168b3"/><path d="M38.025,51.513h-1.5a.208.208,0,0,0-.208.208v3.384a.2.2,0,0,0-.03,0H29.643v-3.38a.208.208,0,0,0-.208-.208h-1.5a.208.208,0,0,0-.208.208v7.12a.208.208,0,0,0,.208.207h1.5a.208.208,0,0,0,.208-.207V57.018h6.643a.2.2,0,0,0,.03,0v1.826a.208.208,0,0,0,.208.207h1.5a.208.208,0,0,0,.208-.207v-7.12A.208.208,0,0,0,38.025,51.513Zm-9.3,4.806a.26.26,0,1,1,.26-.26A.26.26,0,0,1,28.726,56.319Zm8.52,0a.26.26,0,1,1,.26-.26A.26.26,0,0,1,37.246,56.319Z" transform="translate(-27.727 -50.042)" fill="#0168b3"/></g></g></svg>
        </span>
        <span class="text">Teras</span>
    </div>
</div>
<div class="col-6 col-md-4 col-xl-3">
  <div class="roomProp">
   <span class="icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="23.329" height="24.129" viewBox="0 0 23.329 24.129"><path d="M14.4,29.5H36.321v.512c0,1.856-1.344,3.456-3.328,4.416v1.056a1.44,1.44,0,0,1-2.88,0v-.256c-.352.032-.7.064-1.088.064h-7.3c-.384,0-.768-.032-1.12-.064v.256a1.44,1.44,0,0,1-2.88,0V34.433c-1.984-.96-3.264-2.56-3.264-4.384V29.5Zm1.536-12.161c0-1.952,1.184-3.616,3.136-3.616a5.268,5.268,0,0,1,.672.064,1.716,1.716,0,0,0-1.28,1.568h4.224a1.9,1.9,0,0,0-1.856-1.7,3.419,3.419,0,0,0-2.3-.864h0a3.531,3.531,0,0,0-3.52,3.52V27.553H14.4v1.056H36.321V27.553H15.936Zm2.784-.96h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.8,0h-.288v1.248h.256V16.384Zm.768,0h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.768,0H22.4v1.248h.256ZM18.72,18.4h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.8,0h-.288v1.248h.256V18.4Zm.768,0h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.768,0H22.4v1.248h.256ZM18.72,20.448h-.256V21.7h.256Zm.8,0h-.256V21.7h.256Zm.8,0h-.288V21.7h.256V20.448Zm.768,0h-.256V21.7h.256Zm.8,0h-.256V21.7h.256Zm.768,0H22.4V21.7h.256ZM18.72,22.465h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.8,0h-.288v1.248h.256V22.465Zm.768,0h-.256v1.248h.256Zm.8,0h-.256v1.248h.256Zm.768,0H22.4v1.248h.256Zm-4.192,3.264h.256V24.481h-.256Zm.8,0h.256V24.481h-.256Zm.768,0h.256V24.481h-.256Zm.8,0h.256V24.481h-.256Zm.768,0h.256V24.481H21.6Zm.8,0h.256V24.481H22.4ZM37.217,16.32H35.009v-.672H29.761v.672H27.9a.512.512,0,0,0,0,1.024h1.856v7.9h.32V24.033h.288v1.216h.32V24.033h.288v1.216h.32V24.033h.288v1.216h.32V24.033h.288v1.216h.32V24.033H32.8v1.216h.32V24.033h.352v1.216h.32V24.033h.288v1.216h.32V24.033h.288v1.216h.32v-7.9h2.208a.512.512,0,1,0,0-1.024Z" transform="translate(-14.4 -12.8)" fill="#0168b3"/></svg>
</span>
<span class="text">Banyo</span>
</div>
</div>
<div class="col-6 col-md-4 col-xl-3">
  <div class="roomProp">
   <span class="icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="24.469" height="24.469" viewBox="0 0 24.469 24.469"><g transform="translate(5.098 22.43)"><path d="M5.51,24.039a.51.51,0,0,1-.51-.51V22.51a.51.51,0,0,1,1.02,0v1.02A.51.51,0,0,1,5.51,24.039Z" transform="translate(-5 -22)" fill="#0168b3"/></g><g transform="translate(18.352 22.43)"><path d="M18.51,24.039a.51.51,0,0,1-.51-.51V22.51a.51.51,0,0,1,1.02,0v1.02A.51.51,0,0,1,18.51,24.039Z" transform="translate(-18 -22)" fill="#0168b3"/></g><path d="M19.822,3H4.529A1.531,1.531,0,0,0,3,4.529V18.8a1.531,1.531,0,0,0,1.529,1.529H19.822A1.531,1.531,0,0,0,21.352,18.8V4.529A1.531,1.531,0,0,0,19.822,3ZM4.886,19.16A.51.51,0,0,1,4.02,18.8a.509.509,0,0,1,.143-.357.523.523,0,0,1,.724,0,.493.493,0,0,1,0,.714Zm0-14.273a.5.5,0,1,1-.714-.714.511.511,0,0,1,.714,0,.493.493,0,0,1,0,.714Zm9.838,13.407H12.082a1.529,1.529,0,1,1,0-1.02h2.643a.51.51,0,0,1,0,1.02Zm-2.549-3.059a5.1,5.1,0,1,1,5.1-5.1A5.1,5.1,0,0,1,12.176,15.234Zm8,3.925a.478.478,0,0,1-.357.153.509.509,0,0,1-.357-.143.517.517,0,0,1-.153-.367.5.5,0,0,1,.867-.357.493.493,0,0,1,0,.714Zm.01-14.273a.517.517,0,0,1-.367.153.509.509,0,0,1-.357-.143.517.517,0,0,1-.153-.367.478.478,0,0,1,.153-.357.511.511,0,0,1,.714,0,.478.478,0,0,1,.153.357A.509.509,0,0,1,20.189,4.886Z" transform="translate(0.059 0.059)" fill="#0168b3"/><circle cx="0.5" cy="0.5" r="0.5" transform="translate(7.5 17.736)" fill="#0168b3"/><circle cx="1" cy="1" r="1" transform="translate(8.5 9.736)" fill="#0168b3"/><path d="M12.078,6a4.078,4.078,0,1,0,4.078,4.078A4.082,4.082,0,0,0,12.078,6Zm0,6.117a2.039,2.039,0,1,1,2.039-2.039A2.041,2.041,0,0,1,12.078,12.117Z" transform="translate(0.156 0.117)" fill="#0168b3"/><path d="M19.881,0H4.588A4.593,4.593,0,0,0,0,4.588V18.861a4.593,4.593,0,0,0,4.588,4.588H19.881a4.593,4.593,0,0,0,4.588-4.588V4.588A4.593,4.593,0,0,0,19.881,0ZM22.43,18.861a2.552,2.552,0,0,1-2.549,2.549H4.588a2.552,2.552,0,0,1-2.549-2.549V4.588A2.552,2.552,0,0,1,4.588,2.039H19.881A2.552,2.552,0,0,1,22.43,4.588Z" fill="#0168b3"/></svg>
</span>
<span class="text">Dijital Kasa</span>
</div>
</div>
<div class="col-6 col-md-4 col-xl-3">
  <div class="roomProp">
   <span class="icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="27.756" height="17.321" viewBox="0 0 27.756 17.321"><path d="M42.641,34.468c-.492.644-1.9.636-2.957.551-1.514-.109-1.709.021-2.119-.967-.393-.921-.5-2.759-.945-3.7a3.467,3.467,0,0,0-1.207-1.285c-1.274-.708-4.62-.861-6.354-.84s-5.08.132-6.354.84A3.47,3.47,0,0,0,21.5,30.35c-.449.943-.552,2.781-.945,3.7-.41.988-.605.858-2.119.967-1.059.085-2.465.094-2.957-.551-.647-.836-.1-4.413.351-5.3s4.672-3.538,13.231-3.538,12.783,2.652,13.23,3.538S43.289,33.632,42.641,34.468Zm-8.307-2.235V29.817H31.7l-.123,2.094L26.5,31.877l-.079-2.06H23.83l-.084.119v2.372l-5.19,5.215-.242,5.429H39.805l-.2-5.429Z" transform="translate(-15.181 -25.632)" fill="#0168b3"/></svg>
</span>
<span class="text">Telefon</span>
</div>
</div>
</div>
</div>
</div>
<div class="card card-collapse">
   <div class="card-header" data-target="#cCllaps2" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("reservation_contact_information"); ?></h3>
</div>
<div id="cCllaps2" class="card-body collapse show">
    <div class="row">
     <div class="col-12 col-md-6 form-group">
      <label for="txtInput1" class="form-label"><?php echo lang_transform("your_name"); ?></label>
      <input type="text" name="name" class="form-control" id="txtInput1" required="required" value="" />
  </div>
  <div class="col-12 col-md-6 form-group">
      <label for="txtInput2" class="form-label"><?php echo lang_transform("your_surname"); ?></label>
      <input type="text" name="surname" class="form-control" id="txtInput2" required="required" value="" />
  </div>
  <div class="col-12 col-md-6 form-group">
      <label for="txtInput3" class="form-label"><?php echo lang_transform("phone"); ?></label>
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
        <input type="text" name="phone" class="form-control" id="txtInput3" onkeypress="EGEGEN.isNumber(event)" required="required" value="" />
    </div>
</div>
<div class="col-12 col-md-6 form-group">
  <label for="txtInput4" class="form-label"><?php echo lang_transform("email"); ?></label>
  <input type="email" name="email" class="form-control" id="txtInput4" required="required" value="" />
</div>
<div class="col-12 col-md-6 form-group">
  <label for="txtInput5" class="form-label"><?php echo lang_transform("country"); ?></label>
  <select id="txtInput5" name="country" class="form-control custom-select" required="required">
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
<div class="col-12 col-md-6 form-group">
  <label for="txtInput6" class="form-label"><?php echo lang_transform("identification_number"); ?></label>
  <input type="text" name="idno" class="form-control" id="txtInput6" required="required" maxlength="14" onkeypress="return EGEGEN.isNumber(event)" value="" />
</div>
<div class="col-12 form-group">
  <label for="txtInput7" class="form-label"><?php echo lang_transform("address"); ?></label>
  <textarea id="txtInput7" class="form-control" name="address"></textarea>
</div>
<div class="col-12 form-group">
  <div class="custom-control custom-checkbox">
   <input type="checkbox" class="custom-control-input" data-toggle="collapse" data-target='#ccCllapsInvoice' id="chck1">
   <label class="custom-control-label" for="chck1"><?php echo lang_transform("billing_different_text"); ?></label>
</div>
</div>
<div id="ccCllapsInvoice" class="col-12 collapse">
  <h4><?php echo lang_transform("my_billing_information"); ?></h4>

  <div class="row">
   <div class="col-12 col-md-6 form-group">
    <label for="invoice_name" class="form-label"><?php echo lang_transform("your_name"); ?></label>
    <input type="text" name="invoice[name]" class="form-control" id="invoice_name" required="required" value="" />
</div>
<div class="col-12 col-md-6 form-group">
    <label for="invoice_surname" class="form-label"><?php echo lang_transform("your_surname"); ?></label>
    <input type="text" name="invoice[surname]" class="form-control" id="invoice_surname" required="required" value="" />
</div>
<div class="col-12 col-md-6 form-group">
    <label for="invoice_phone" class="form-label"><?php echo lang_transform("phone"); ?></label>
    <input type="text" name="invoice[phone]" class="form-control mask" data-mask="phone" id="invoice_phone" required="required" value="" />
</div>
<div class="col-12 col-md-6 form-group">
    <label for="invoice_email" class="form-label"><?php echo lang_transform("email"); ?></label>
    <input type="email" name="invoice[email]" class="form-control" id="invoice_email" required="required" value="" />
</div>
<div class="col-12 col-md-6 form-group">
    <label for="invoice_country" class="form-label"><?php echo lang_transform("country"); ?></label>
    <select id="invoice_country" name="invoice[country]" class="form-control custom-select" required="required">
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
<div class="col-12 col-md-6 form-group">
    <label for="invoice_idno" class="form-label"><?php echo lang_transform("identification_number"); ?></label>
    <input type="text" name="invoice[idno]" class="form-control" id="invoice_idno" required="required" maxlength="14" onkeypress="return EGEGEN.isNumber(event)" value="" />
</div>
<div class="col-12 form-group">
    <label for="invoice_address" class="form-label"><?php echo lang_transform("address"); ?></label>
    <textarea id="invoice_address" class="form-control" name="invoice[address]"></textarea>
</div>
</div>        
</div>    
<div class="col-12 form-group">
  <div class="custom-control custom-checkbox">
   <input type="checkbox" class="custom-control-input" name="honeymoon" id="chck2">
   <label class="custom-control-label" for="chck2"><?php echo lang_transform("honeymoon_couple"); ?></label>
</div>
</div>
</div>
</div>
</div>

<div class="card card-collapse">
   <div class="card-header" data-target="#cCllaps6" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("information_for_guests"); ?></h3>
</div>
<div id="cCllaps6" class="card-body collapse show">
    <div class="row gutter-5">
        <?php for ($i=1; $i <= $adult_count ; $i++) { ?>
            <div class="col-12 col-md-2 form-group">
              <label for="visitor_gender1" class="form-label"><?php echo lang_transform("gender"); ?></label>
              <select class="form-control custom-select" name="visitor[<?php echo $i; ?>][gender]" id="visitor_gender1" aria-invalid="false" required="required">
                 <option value="Kadın"><?php echo lang_transform("woman"); ?></option>
                 <option value="Erkek"><?php echo lang_transform("man"); ?></option>
                 <option value="Belirtilmemiş"><?php echo lang_transform("unspecified"); ?></option>
             </select>
         </div>
         <div class="col-6 col-md-4 form-group">
          <label for="visitor_name1" class="form-label"><?php echo lang_transform("name"); ?></label>
          <input type="text" name="visitor[<?php echo $i; ?>][name]" class="form-control" id="visitor_name1" required="required" autocomplete="off" value="">
      </div>
      <div class="col-6 col-md-4 form-group">
          <label for="visitor_surname1" class="form-label"><?php echo lang_transform("surname"); ?></label>
          <input type="text" name="visitor[<?php echo $i; ?>][surname]" class="form-control" id="visitor_surname1" required="required" autocomplete="off" value="">
      </div>
      <div class="col-12 col-md-2 form-group">
          <label for="visitor_birthday1" class="form-label"><?php echo lang_transform("date_of_birth"); ?></label>
          <input type="text" name="visitor[<?php echo $i; ?>][birthday]" class="form-control picker mask" data-mask="date" id="visitor_birthday1" required="required" autocomplete="off" value="<?php echo date("m/d/Y"); ?>" data-max="<?php echo date("m/d/Y"); ?>" >
      </div>
  <?php } ?>
</div>
</div>
</div>
<div class="card card-collapse">
   <div class="card-header collapsed" data-target="#cCllaps3" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("special_requests"); ?></h3>
</div>
<div id="cCllaps3" class="card-body collapse">
    <div class="form-group">
     <textarea class="form-control" name="special_requests"></textarea>
 </div>
</div>
</div>
<!-- <div class="card card-collapse">
 <div class="card-header" data-target="#cCllaps4" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("select_bed_type"); ?></h3>
</div>
<div id="cCllaps4" class="card-body collapse show">
    <div class="form-group">
       <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="checkBed1" name="bed" class="custom-control-input" value="Tekli" checked>
        <label class="custom-control-label" for="checkBed1"><?php echo lang_transform("singles"); ?></label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="checkBed2" name="bed" class="custom-control-input" value="Çift Kişilik">
      <label class="custom-control-label" for="checkBed2"><?php echo lang_transform("double_room"); ?></label>
  </div>
</div>
<div>
    <p class="text-danger"><?php echo lang_transform("bed_type_text"); ?></p>
</div>
</div>
</div> -->
<div class="card card-collapse">
   <div class="card-header" data-target="#cCllaps5" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("return_insurance"); ?></h3>
</div>
<div id="cCllaps5" class="card-body collapse show">
    <div class="form-group">
      <div class="custom-control custom-checkbox custom-control-inline">
        <input type="checkbox" id="checkReturnInsurance" name="return_insurance" value="<?php echo $insurance_price; ?>" class="custom-control-input" <?php echo ($insurance_status == 0)?"disabled":""; ?>>
        <label class="custom-control-label" for="checkReturnInsurance"><?php echo lang_transform("cancellation_and_return_insurance_text"); ?></label>
    </div>
    <a href="javascript:;" class="lnkInfo d-block" onclick="EGEGEN.fancy.open('modalCancelPolicy','inline');">
      <span class="icon">
         <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"><g transform="translate(-1360 -700)"><g transform="translate(1360 700)" fill="#fff" stroke="#a0a0a0" stroke-width="1"><circle cx="8.5" cy="8.5" r="8.5" stroke="none"/><circle cx="8.5" cy="8.5" r="8" fill="none"/></g><g transform="translate(1365.968 702.826)"><path d="M32.406,39.472c-.048.194-.088.366-.135.534a.137.137,0,0,1-.076.076,14.39,14.39,0,0,1-1.455.471,2.129,2.129,0,0,1-1.281-.112,1.333,1.333,0,0,1-.829-1.336,9.528,9.528,0,0,1,.431-1.949c.135-.522.281-1.052.4-1.584a1.817,1.817,0,0,0-.006-.563.386.386,0,0,0-.35-.35,1.727,1.727,0,0,0-.983.094c-.049.019-.1.027-.18.048.045-.189.079-.356.127-.522a.178.178,0,0,1,.1-.1,6.716,6.716,0,0,1,1.591-.486,2.285,2.285,0,0,1,1.037.1,1.325,1.325,0,0,1,.892,1.407,11.594,11.594,0,0,1-.477,2.075q-.186.752-.36,1.507a1.066,1.066,0,0,0-.017.265c.008.382.164.565.543.572a5.179,5.179,0,0,0,.788-.085A1.778,1.778,0,0,0,32.406,39.472Z" transform="translate(-27.94 -30.158)" fill="#a0a0a0"/><path d="M48.368,0a1.247,1.247,0,0,1,1.277,1.149,1.191,1.191,0,0,1-.72,1.155,1.359,1.359,0,0,1-1.776-.593A1.233,1.233,0,0,1,48.368,0Z" transform="translate(-45.043 0.002)" fill="#a0a0a0"/></g></g></svg>
     </span>
     <span class="text"><?php echo $cancellation['title']; ?></span>
 </a>
 <?php if ($insurance_status == 1): ?>
    <a href="javascript:;" class="lnkInfo d-block" onclick="EGEGEN.fancy.open('modalCancelPolicy2','inline');">
      <span class="icon">
       <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"><g transform="translate(-1360 -700)"><g transform="translate(1360 700)" fill="#fff" stroke="#a0a0a0" stroke-width="1"><circle cx="8.5" cy="8.5" r="8.5" stroke="none"/><circle cx="8.5" cy="8.5" r="8" fill="none"/></g><g transform="translate(1365.968 702.826)"><path d="M32.406,39.472c-.048.194-.088.366-.135.534a.137.137,0,0,1-.076.076,14.39,14.39,0,0,1-1.455.471,2.129,2.129,0,0,1-1.281-.112,1.333,1.333,0,0,1-.829-1.336,9.528,9.528,0,0,1,.431-1.949c.135-.522.281-1.052.4-1.584a1.817,1.817,0,0,0-.006-.563.386.386,0,0,0-.35-.35,1.727,1.727,0,0,0-.983.094c-.049.019-.1.027-.18.048.045-.189.079-.356.127-.522a.178.178,0,0,1,.1-.1,6.716,6.716,0,0,1,1.591-.486,2.285,2.285,0,0,1,1.037.1,1.325,1.325,0,0,1,.892,1.407,11.594,11.594,0,0,1-.477,2.075q-.186.752-.36,1.507a1.066,1.066,0,0,0-.017.265c.008.382.164.565.543.572a5.179,5.179,0,0,0,.788-.085A1.778,1.778,0,0,0,32.406,39.472Z" transform="translate(-27.94 -30.158)" fill="#a0a0a0"/><path d="M48.368,0a1.247,1.247,0,0,1,1.277,1.149,1.191,1.191,0,0,1-.72,1.155,1.359,1.359,0,0,1-1.776-.593A1.233,1.233,0,0,1,48.368,0Z" transform="translate(-45.043 0.002)" fill="#a0a0a0"/></g></g></svg>
   </span>
   <span class="text"><?php echo $cancellation2['title']; ?></span>
</a>
<?php endif ?>
<?php if ($insurance_status == 0): ?>
    <p class="text-danger d-block"><?php echo lang_transform("insurance_status_text"); ?></p>
<?php endif ?>
</div>
</div>
</div>
<div class="card card-collapse mb-0">
   <div class="card-header" data-target="#cCllaps7" data-toggle="collapse" >
    <h3 class="card-title mb-0"><?php echo lang_transform("payment_information"); ?></h3>
</div>
<div id="cCllaps7" class="card-body collapse show">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
               <div class="custom-control custom-checkbox">
                <input type="checkbox" id="pay_hotel" name="pay_hotel" value="1" class="custom-control-input">
                <label class="custom-control-label" for="pay_hotel"><?php echo lang_transform("pay_at_the_hotel"); ?> <span class="text-danger">(<?php echo lang_transform("pay_at_the_hotel_deposit_text_1")." ".lang_transform("pay_at_the_hotel_deposit_text_2")." ".lang_transform("pay_at_the_hotel_deposit_text_3"); ?>: %<?php echo settings("deposit_percent"); ?>)</span></label>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-7">
      <div class="form-group">
       <label for="txtCartNo" class="form-label"><?php echo lang_transform("card_number"); ?></label>
       <input type="text" name="card_info[cardno]" onkeyup="GenReservation.updateCardNumber(event)" class="form-control mask" id="txtCartNo" data-mask="card" required="required" autocomplete="off" maxlength="19" value="">
       <input type="hidden" name="card_info[bank_name]" id="bank_name">
       <input type="hidden" name="card_info[card_type]" id="card_type">
   </div>
   <div class="form-group">
       <label for="txtCartName" class="form-label"><?php echo lang_transform("name_on_the_card"); ?></label>
       <input type="text" name="card_info[cardname]" class="form-control" id="txtCartName" required="required" autocomplete="off" value="" />
   </div>
   <div class="row gutter-5">
       <div class="col-6">
        <div class="form-group">
         <label for="txtCartName" class="form-label"><?php echo lang_transform("effective_date"); ?>*</label>
         <div class="input-group">
          <select class="form-control custom-select" name="card_info[cardMounth]" aria-invalid="false" required="required">
           <option>1</option>
           <option>2</option>
           <option>3</option>
           <option>4</option>
           <option>5</option>
           <option>6</option>
           <option>7</option>
           <option>8</option>
           <option>9</option>
           <option>10</option>
           <option>11</option>
           <option>12</option>
       </select>
       <select class="form-control custom-select" aria-invalid="false" name="card_info[cardYear]" required="required">
           <option>2020</option>
           <option>2021</option>
           <option>2022</option>
           <option>2023</option>
           <option>2024</option>
           <option>2025</option>
           <option>2026</option>
           <option>2027</option>
           <option>2028</option>
           <option>2029</option>
           <option>2030</option>
           <option>2031</option>
           <option>2032</option>
           <option>2033</option>
           <option>2034</option>
           <option>2035</option>
           <option>2036</option>
           <option>2037</option>
           <option>2038</option>
           <option>2039</option>
           <option>2040</option>
       </select>
   </div>
</div>
</div>
<div class="col-6">
    <label for="txtCartCvc" class="form-label"><?php echo lang_transform("cvc"); ?></label>
    <input type="text" name="card_info[ccv2]" class="form-control" id="txtCartCvc" required="required" autocomplete="off" value="" maxlength="3" onkeypress="return EGEGEN.isNumber(event)" />
</div>
</div>
<div class="form-group">
   <div class="custom-control custom-checkbox">
    <input type="checkbox" id="sales_agreement" name="sales_agreement" value="1" required="required" class="custom-control-input">
    <label class="custom-control-label" for="sales_agreement"><a href="javascript:;" onclick="EGEGEN.fancy.open('modalSalesContract','inline');"><?php echo $sales_contract['title']; ?></a> <?php echo lang_transform("i_reed_and_accept"); ?></label>
</div>
</div>
<div class="form-group">
   <div class="custom-control custom-checkbox">
    <input type="checkbox" id="privacy_policy" name="privacy_policy" value="1" required="required" class="custom-control-input">
    <label class="custom-control-label" for="privacy_policy"><a href="javascript:;" onclick="EGEGEN.fancy.open('modalPrivacyPolicy','inline');"><?php echo $privacy_policy['title']; ?></a> <?php echo lang_transform("i_reed_and_accept"); ?></label>
</div>
</div>
<div class="form-group">
 <!-- <div class="custom-control custom-checkbox">
    <input type="checkbox" id="accept_campaigns_newsletter" name="accept_campaigns_newsletter" value="1" class="custom-control-input">
    <label class="custom-control-label" for="accept_campaigns_newsletter">Fırsatlardan ve kampanyalardan haberdar olmak istiyorum.</label>
</div> -->
</div>
</div>
<div class="col-12 col-md-5">
    <a href="javascript:;" onclick="EGEGEN.fancy.open('modalInstallmentTable','inline');" class="btn btn-primary btn-lg semibold btn-block transform-auto mb-1">Tüm Bankaların taksit tablosunu inceleyin</a>
    <label class="form-label"><?php echo lang_transform("payment_options"); ?></label>
    <div class="form-group">
        <div class="hirePurchase">
            <input type="hidden" name="installment" id="installment">
            <div class="custom-control custom-radio hirePurchaseItem">
                <input type="radio" id="chckHirePurchase1" name="hire_purchase" data-installment="1" value="Tek Çekim" required="required" checked="checked" value="Tek Çekim" class="custom-control-input">
                <label class="custom-control-label" for="chckHirePurchase1">
                    <span class="hirePurchaseLabel"><?php echo lang_transform("one_shot"); ?></span>
                    <span class="hirePurchaseAmount"><?php echo $total_price; ?> TL</span>
                </label>
            </div>
            <?php for ($i=1; $i < settings("number_of_installments"); $i++) { ?>
                <div class="custom-control custom-radio hirePurchaseItem">
                    <input type="radio" id="chckHirePurchase<?php echo $i+1; ?>" name="hire_purchase" data-installment="<?php echo $i+1; ?>" value="<?php echo $i+1; ?>" class="custom-control-input">
                    <label class="custom-control-label" for="chckHirePurchase<?php echo $i+1; ?>">
                        <span class="hirePurchaseLabel"><?php echo $i+1; ?> <?php echo lang_transform("installment"); ?></span>
                        <span class="hirePurchaseAmount"><?php echo $total_price; ?> TL</span>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="payment-btn">
   <button type="submit" name="submit" class="btn btn-success btn-lg semibold no-radius transform-auto"><?php echo lang_transform("complete_payment"); ?></button>
</div>
</form>
</div>
<div id="tabDetailPackage" class="tab-pane" role="tabpanel">
 <div class="card">
  <div class="card-body">
   <form action="<?php echo site_url("reservation/promotion"); ?>" method="post" id="formPackageSelect" class="form-package-select" novalidate="novalidate">
    <input type="hidden" name="reservation_type" value="promotions" />
    <?php
    $this->load->helper('promotion/promotion');
    $this->load->helper('contact/contact');
    $promotions = get_promotions();
    $contact = contact_page();
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
               <p class="mb-0 r-search-form-select-text"> <span class="js-number-of-rooms">1</span> <span class="js-rooms-text"> <?php echo lang_transform("room"); ?></span> <span class="js-adlt">: </span> <span class="js-number-of-adults js-adlt">1<span class="js-adlt"> </span></span> <span class="js-adults-text js-adlt"> <?php echo lang_transform("adult"); ?></span> <span class="js-chld is-hidden">, </span> <span class="js-chld js-number-of-children is-hidden">0</span> <span class="js-chld js-children-text is-hidden"><?php echo lang_transform("child"); ?></span> </p>
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
       <div class="labelContainer field-title"><?php echo lang_transform("adult"); ?> (Max:<span class="js-adult-max">3</span> kişi)</div>
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
   <div class="labelContainer field-title"><?php echo lang_transform("child_age"); ?> (Max:<span class="js-children-max">2</span> kişi)</div>
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

</form>
</div>
</div>    
</div>
</div>
</div>
<div class="col-12 col-lg-3 sidebar">

    <div class="card card-r-detail">
      <div class="card-header">
       <h3 class="card-title"><?php echo lang_transform("summary"); ?></h3>
   </div>
   <div class="card-body">
       <div class="r-details">
        <div class="r-detail-item r-detail-item-date">
         <div class="r-detail-item-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="43.5" height="47.338" viewBox="0 0 43.5 47.338"><g transform="translate(43.5 47.338) rotate(180)" opacity="0.341"><path d="M0,1.919A2,2,0,0,1,1.942,0H16a1.992,1.992,0,0,1,1.915,1.918v43.5A1.992,1.992,0,0,1,16,47.338H1.942a1.919,1.919,0,1,1,0-3.838H14.083V3.838H1.942A1.965,1.965,0,0,1,0,1.919Z" transform="translate(25.588 0)" fill="#0168b3"/><path d="M0,12.791a2.149,2.149,0,0,1,.52-1.32L10.755.6a2.2,2.2,0,0,1,2.8-.16,2,2,0,0,1-.02,2.8l-7.2,7.637H32.625a1.919,1.919,0,1,1,0,3.838H6.338l7.2,7.637a2.116,2.116,0,0,1,.02,2.8,2.17,2.17,0,0,1-2.8-.16L.52,14.11A1.843,1.843,0,0,1,0,12.791Z" transform="translate(0 10.875)" fill="#0168b3"/></g></svg>
      </div>
      <div class="r-detail-item-content">
          <div class="r-detail-date-item">
              <?php
              $start_date = explode("-", $room_information['start_date']);
              $end_date = explode("-", $room_information['end_date']);
              ?>
              <span class="label"><?php echo lang_transform("check_in_date"); ?></span>
              <span class="number"><?php echo $start_date[2]; ?></span>
              <span class="text"><?php echo month_lang($start_date[1])." ".$start_date[0]; ?></span>
          </div>
          <div class="r-detail-date-item">
           <span class="label"><?php echo lang_transform("check_out_date"); ?></span>
           <span class="number"><?php echo $end_date[2]; ?></span>
           <span class="text"><?php echo month_lang($end_date[1])." ".$end_date[0]; ?></span>
       </div>
   </div>
</div>
<div class="r-detail-item">
 <div class="r-detail-item-icon">
  <svg xmlns="http://www.w3.org/2000/svg" width="51" height="47.804" viewBox="0 0 51 47.804"><path d="M50.435,5.531A.813.813,0,0,0,50.913,4.5a.781.781,0,0,0-1.035-.478l-6.252,2.35H7.306L1.053,4.018A.8.8,0,0,0,.018,4.5.781.781,0,0,0,.5,5.531h0L6.35,7.721V39.78L.336,43.523A.818.818,0,0,0,.1,44.639h0a.818.818,0,0,0,1.115.239l6.173-3.863H9.177l-.757,2.111a.981.981,0,0,0-.04.478v2.788a1.6,1.6,0,0,0,1.593,1.593h.4v1.394a2.389,2.389,0,1,0,4.779,0V47.984H26.3v1.394a2.389,2.389,0,1,0,4.779,0V47.984h.4a1.6,1.6,0,0,0,1.593-1.593V43.6a1.939,1.939,0,0,0-.04-.478L32.2,41.015h1.633v1.195A1.6,1.6,0,0,0,35.422,43.8H39.4A1.6,1.6,0,0,0,41,42.209V41.015h2.549l6.173,3.863a.806.806,0,1,0,.876-1.354h0L44.581,39.78V7.721ZM13.518,49.378a.8.8,0,0,1-1.593,0V47.984h1.593Zm15.93,0a.8.8,0,0,1-1.593,0V47.984h1.593Zm1.991-2.987H9.934V44.4H31.439ZM26.262,33.846H22.28a.8.8,0,0,0-.8.8v.8H19.89v-.8a.8.8,0,0,0-.8-.8H15.111a.8.8,0,0,0-.8.8v.8H12.722V32.253h15.93v3.186H27.058v-.8A.8.8,0,0,0,26.262,33.846Zm-.8,1.593v1.593H23.076V35.439Zm-7.168,0v1.593H15.908V35.439Zm-3.982,1.593v.8a.8.8,0,0,0,.8.8h3.982a.8.8,0,0,0,.8-.8v-.8h1.593v.8a.8.8,0,0,0,.8.8h3.982a.8.8,0,0,0,.8-.8v-.8H29.05l2.031,5.575H10.292l2.031-5.575Zm21.107,5.177V39.422H39.4v2.788Zm0-4.381V36.236H39.4v1.593Zm7.567,1.593H41V36.236A1.6,1.6,0,0,0,39.4,34.643H38.209V33.448H40.6a.8.8,0,0,0,.8-.8,1.163,1.163,0,0,0-.08-.358l-1.991-3.982a.752.752,0,0,0-.717-.438H36.218a.752.752,0,0,0-.717.438L33.51,32.293a.8.8,0,0,0,.358,1.075,1.163,1.163,0,0,0,.358.08h2.389v1.195H35.422a1.6,1.6,0,0,0-1.593,1.593v3.186h-2.19l-1.274-3.465a.87.87,0,0,0-.119-.2v-3.5a1.6,1.6,0,0,0-1.593-1.593H12.722a1.6,1.6,0,0,0-1.593,1.593v3.5c-.04.08-.08.119-.119.2L9.735,39.422H7.943V7.96H42.988ZM35.5,31.855,36.7,29.465H38.09l1.195,2.389Z" transform="translate(0.037 -3.963)" fill="#a7cbe4"/><path d="M38.8,25.168h2.628l.119.4A1.662,1.662,0,0,0,43.1,26.761H53.691a1.614,1.614,0,0,0,1.553-1.195l.119-.4h2.549a.8.8,0,0,0,.8-.8V18.8a.8.8,0,0,0-.8-.8H38.8a.8.8,0,0,0-.8.8v5.575A.8.8,0,0,0,38.8,25.168Zm14.854,0H43.058l-.438-1.593H54.089ZM39.593,19.593H57.116v3.982H55.682a1.6,1.6,0,0,0-1.593-1.593H42.62a1.6,1.6,0,0,0-1.593,1.593H39.593Z" transform="translate(-22.852 -12.41)" fill="#a7cbe4"/></svg>
</div>
<div class="r-detail-item-content">
  <span class="label"><?php echo lang_transform("number_of_rooms"); ?></span>
  <span class="text"><?php echo $room_information['rooms']['count']; ?> <?php echo lang_transform("room"); ?></span>
</div>
</div>  
<div class="r-detail-item">
 <div class="r-detail-item-icon">
  <svg xmlns="http://www.w3.org/2000/svg" width="44" height="43.421" viewBox="0 0 44 43.421"><path d="M53.105,24.658h-.811a7.112,7.112,0,0,0,1.968-4.921,7.237,7.237,0,1,0-14.474,0,7.112,7.112,0,0,0,1.968,4.921H40.368a2.867,2.867,0,0,0-2.895,2.895v.289a7.786,7.786,0,0,0-2.026-.289,7.049,7.049,0,0,0-5.384,2.432,2.933,2.933,0,0,0-2.432-1.274H25.953a7.112,7.112,0,0,0,1.968-4.921,7.237,7.237,0,0,0-14.474,0,7.112,7.112,0,0,0,1.968,4.921h-.521A2.867,2.867,0,0,0,12,31.605V47.237a1.158,1.158,0,0,0,2.316,0V31.605a.547.547,0,0,1,.579-.579H27.632a.547.547,0,0,1,.579.579v1.737c0,.174.058.289.058.405,0,.347-.058.695-.058,1.042a7.112,7.112,0,0,0,1.968,4.921H28.789a2.867,2.867,0,0,0-2.895,2.895V54.763a1.158,1.158,0,0,0,2.316,0V42.605a.547.547,0,0,1,.579-.579H41.526a.547.547,0,0,1,.579.579V54.763a1.158,1.158,0,0,0,2.316,0V42.605a2.867,2.867,0,0,0-2.895-2.895h-.811a7.112,7.112,0,0,0,1.968-4.921A7.292,7.292,0,0,0,39.789,29V27.553a.547.547,0,0,1,.579-.579H53.105a.547.547,0,0,1,.579.579V43.184a1.158,1.158,0,0,0,2.316,0V27.553A2.867,2.867,0,0,0,53.105,24.658Zm-37.342-.868a4.921,4.921,0,1,1,4.921,4.921A4.917,4.917,0,0,1,15.763,23.789ZM35.447,39.711a4.921,4.921,0,1,1,4.921-4.921A4.917,4.917,0,0,1,35.447,39.711Zm6.658-19.974a4.921,4.921,0,1,1,4.921,4.921A4.917,4.917,0,0,1,42.105,19.737Z" transform="translate(-12 -12.5)" fill="#a7cbe4"/></svg>
</div>
<div class="r-detail-item-content">
  <span class="label"><?php echo lang_transform("number_of_visitors"); ?></span>
  <span class="text"><?php echo $adult_count; ?> <?php echo lang_transform("adult"); ?><?php echo ($child_count)?' : '.$child_count.' '.lang_transform("child"):''; ?></span>
</div>
</div>
</div>
<hr />
<div class="r-agency-code">
    <label for="agency_code" class="form-label"><?php echo lang_transform("agent_code"); ?></label>
    <div class="input-group">
        <input type="text" name="agency_code" id="agency_code" class="form-control" placeholder="DNZAT231XYZ" placeholder="DNZAT231XYZ">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button" onclick="GenReservation.updateAgencyCode($('#subtotal').text())" id="button-addon2">OK</button>
      </div>
  </div>
</div>
<hr />
<div class="r-detail-price">
    <div class="r-detail-price-item">
     <span class="label"><?php echo lang_transform("subtotal"); ?> :</span>
     <span class="price"><span id="subtotal"><?php echo number_format($price,2); ?></span> TRY</span>
 </div>
 <div class="r-detail-price-item js-price-discount">
     <span class="label"><?php echo lang_transform("discount"); ?>(%<?php echo settings("advance_discount_rate"); ?>):</span>
     <span class="price"><span id="txtDiscountPrice">0</span></span>
 </div>
 <?php if ($room_information['reservation_type'] == "promotions"): ?>
    <?php if (settings("promotion_booking_discount_rate")>0): ?>
       <div class="r-detail-price-item">
           <input type="hidden" name="booking_discount" value="<?php echo "-".$booking_discount_price; ?>">
           <span class="label"><?php echo lang_transform("early_booking_discount"); ?>(%<?php echo settings("promotion_booking_discount_rate"); ?>):</span>
           <span class="price">-<?php echo $booking_discount_price; ?> TRY</span>
       </div>
   <?php endif ?>
   <?php else: ?>
    <?php if (settings("booking_discount_rate")>0): ?>
     <div class="r-detail-price-item">
         <input type="hidden" name="booking_discount" value="<?php echo "-".$booking_discount_price; ?>">
         <span class="label"><?php echo lang_transform("early_booking_discount"); ?>(%<?php echo settings("booking_discount_rate"); ?>):</span>
         <span class="price">-<?php echo $booking_discount_price; ?> TRY</span>
     </div>
 <?php endif ?>
<?php endif ?>
<div class="r-detail-price-item hide agency-price-div">
 <span class="label"><?php echo lang_transform("agency_discount"); ?>:</span>
 <span class="price"><span id="txtAgencyPrice">0.00</span> TRY</span>
</div>
<div class="r-detail-price-item js-price-insurance hide">
 <span class="label"><?php echo lang_transform("insurance"); ?>:</span>
 <span class="price" id="txtInsurancePrice">50</span><span> TRY</span>
</div>
<?php if ($tax_price>0): ?>
    <div class="r-detail-price-item">
     <span class="label"><?php echo lang_transform("accommodation_tax"); ?>:</span>
     <span class="price" id="txtTaxPrice"><?php echo number_format($tax_price,2); ?> TRY</span>
 </div>
<?php endif ?>
<hr />
<div class="r-detail-price-item r-price-total">
 <div class="label"><?php echo lang_transform("total"); ?>:</div>
 <div class="price">
    <span class="subprice hide">
        <span id="txtsubTotalPrice"><?php echo number_format($total_price,2); ?></span> TRY
    </span>
    <span>
        <span id="txtTotalPrice"><?php echo number_format($total_price,2); ?></span> TRY
    </span>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</main>


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

<div id="modalCancelPolicy" class="fancybox-modal" style="display: none;">
    <div class="fancybox-modal-body">
        <h4><?php echo $cancellation['title']; ?></h4>
        <?php echo $cancellation['content']; ?>
    </div>
</div>

<div id="modalCancelPolicy2" class="fancybox-modal" style="display: none;">
    <div class="fancybox-modal-body">
        <h4><?php echo $cancellation2['title']; ?></h4>
        <?php echo $cancellation2['content']; ?>
    </div>
</div>

<div id="modalSalesContract" class="fancybox-modal" style="display: none;">
    <div class="fancybox-modal-body">
        <h4><?php echo $sales_contract['title']; ?></h4>
        <?php echo $sales_contract['content']; ?>
    </div>
</div>

<div id="modalPrivacyPolicy" class="fancybox-modal" style="display: none;">
    <div class="fancybox-modal-body">
        <h4><?php echo $privacy_policy['title']; ?></h4>
        <?php echo $privacy_policy['content']; ?>
    </div>
</div>

<div id="modalInstallmentTable" class="fancybox-modal" style="display: none;">
    <div class="fancybox-modal-body">
        <h4>Taksit Tablosu</h4>
        <div class="table-responsive monthly-payment">
            <table class="table table-bordered" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                   <tr class="fr-th">
                      <td class="first no-border">&nbsp;</td>
                      <td id="0-a" data-installment="0">PEŞİN</td>
                      <?php for ($i=1; $i < settings("number_of_installments"); $i++) { ?>
                          <td id="4-a" data-installment="12"><?php echo $i+1; ?> <?php echo lang_transform("installment"); ?></td>    
                      <?php } ?>
                  </tr>
                  <?php foreach ($page['banks'] as $roww): ?>
                      <tr>
                        <td class="first"> <img src="<?php echo image_moo($roww->list_img); ?>"> </td>
                        <td rel="0">715</td>
                        <?php for ($i=1; $i < settings("number_of_installments"); $i++) { ?>
                            <td rel="<?php echo $i; ?>">715</td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php $this->load->view('home/layout/footer'); ?>
<script type="text/javascript">
    var agent_code_is_incorrect = "<?php echo lang_transform("agent_code_is_incorrect"); ?>";
    var enter_the_agency_code = "<?php echo lang_transform("enter_the_agency_code"); ?>";
    var agency_discount_has_been_made = "<?php echo lang_transform("agency_discount_has_been_made"); ?>";
    var agency_success_text = "<?php echo lang_transform("agency_success_text"); ?>";
    var text_payment_option_title = "<?php echo lang_transform("installment_options_error"); ?>";
    var text_payment_option_message = '<?php echo lang_transform("installment_options_error_one_shot"); ?>';
</script>
<script src="assets/js/reservation.js" type="text/javascript"></script>
<script src="assets/js/jquery.toast.min.js"></script>
<script src="assets/js/toast-data.js"></script>