<?php $this->load->view('home/layout/header'); ?>
<?php
$this->load->helper('content/content');
$privacy_policy = get_content(get_lang_id_record(65,'content',$this->session->userdata('lang'))->id);
$sales_contract = get_content(get_lang_id_record(67,'content',$this->session->userdata('lang'))->id);
?>
<style type="text/css">.card-collapse .card-header:after{display: none;}</style>

<main id="main">

	<link href="assets/css/reservation.css" rel="stylesheet"/>


	<div class="container section">
		<div class="row">
			<div class="col-12 col-lg-9 content">

				<form action="<?php echo site_url("reservation/payment"); ?>" method="post" id="formReservationDetail" novalidate="novalidate">
					<input type="hidden" name="reservation_type" value="Direkt Ödeme" />
					<input type="hidden" name="total_price" value="<?php echo $payment->price; ?>">
					<input type="hidden" name="agency_code" value="" />
					<div class="card card-collapse mb-0">
						<div class="card-header">
							<h3 class="card-title mb-1"><?php echo lang_transform("explanation"); ?></h3>
							<div><?php echo $payment->description; ?></div>
						</div>
						<div class="card-header">
							<h3 class="card-title mb-0"><?php echo lang_transform("payment_information"); ?></h3>
						</div>
						<div id="cCllaps7" class="card-body collapse show">
							<div class="row">
								<div class="col-12 col-md-7">
									<div class="form-group">
										<label for="txtCartNo" class="form-label"><?php echo lang_transform("card_number"); ?></label>
										<input type="text" name="card_info[cardno]" onkeyup="GenReservation.updateCardNumber(event)" class="form-control mask" id="txtCartNo" data-mask="card" required="required" autocomplete="off" maxlength="19" value="">
										<input type="hidden" name="card_info[bank_name]" id="bank_name">
										<input type="hidden" name="card_info[card_type]" id="card_type">
										<input type="hidden" name="token" id="token" value="<?php echo $payment->token; ?>">
										<input type="hidden" name="installment" id="installment" value="1">
										<input type="hidden" name="currency" id="currency" value="<?php echo $payment->currency; ?>">
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
								</div>
								<div class="col-12 col-md-5">
									<label class="form-label"><?php echo lang_transform("payment_options"); ?></label>
									<div class="form-group">
										<div class="hirePurchase">
											<div class="custom-control custom-radio hirePurchaseItem">
												<input type="radio" id="chckHirePurchase1" name="installment" value="1" required="required" checked="checked" value="Tek Çekim" class="custom-control-input">
												<label class="custom-control-label" for="chckHirePurchase1">
													<span class="hirePurchaseLabel"><?php echo lang_transform("one_shot"); ?></span>
													<span class="hirePurchaseAmount"><?php echo $payment->price." ".$payment->currency; ?></span>
												</label>
											</div>
											<?php if ($payment->installment): ?>
												<div class="custom-control custom-radio hirePurchaseItem">
													<input type="radio" id="chckHirePurchase2" name="installment" value="<?php echo $payment->installment; ?>" class="custom-control-input">
													<label class="custom-control-label" for="chckHirePurchase2">
														<span class="hirePurchaseLabel"><?php echo $payment->installment; ?> <?php echo lang_transform("installment"); ?></span>
														<span class="hirePurchaseAmount"><?php echo $payment->price." ".$payment->currency; ?></span>
													</label>
												</div>
											<?php endif ?>
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
			<div class="col-12 col-lg-3 sidebar">
				<div class="card card-r-detail">
					<div class="card-header">
						<h3 class="card-title"><?php echo lang_transform("summary"); ?></h3>
					</div>
					<div class="card-body">
						<div class="r-detail-price">
							<div class="r-detail-price-item r-price-total">
								<span class="label"><?php echo lang_transform("total"); ?>:</span>
								<span class="price"><?php echo $payment->price." ".$payment->currency; ?></span>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</main>


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

<?php $this->load->view('home/layout/footer'); ?>

<script src="assets/js/reservation.js" type="text/javascript"></script>
<script type="text/javascript">
	var hire = $("input[name='hire_purchase']");
	var installment = $('#installment');
	$(hire).change(function(){
	var hire_checked = $("input[name='hire_purchase']:checked:enabled");
		installment.val(hire_checked.val());
	});
</script>