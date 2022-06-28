<?php $this->load->view('home/layout/header'); ?>

<main id="main">

	<link href="assets/css/reservation.css" rel="stylesheet"/>

	<div class="container section reservation-completed">
		<div class="row">
			<div class="reservation_number">
				<span><?php echo lang_transform("your_reservation_number"); ?>: <?php echo $reserve_no; ?></span>
			</div>
			<p><?php echo lang_transform("reservation_completed_text"); ?></p>
		</div>
	</div>
</main>

<?php $this->load->view('home/layout/footer'); ?>

<script src="assets/js/reservation.js" type="text/javascript"></script>