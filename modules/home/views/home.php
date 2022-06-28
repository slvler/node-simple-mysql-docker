<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('slider/home'); ?>

<main id="main">

	<?php $this->load->view('home/modules/reservation'); ?>

	<?php $this->load->view('home/modules/about'); ?>

	<?php $this->load->view('home/modules/promotion'); ?>    
        
</main>

<?php $this->load->view('home/layout/footer'); ?>

<script src="assets/js/reservation.js" type="text/javascript"></script>
