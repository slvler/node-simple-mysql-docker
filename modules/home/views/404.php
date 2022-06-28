<?php $this->load->view('home/layout/header'); ?>
	
	<div class="container">
		<div class="text-center py-5">
			<h1>404 - <?php echo $page["title"] ?></h1>
			<p>Ulaşmaya çalıştığınız sayfayı bulamadık.<br><a href="<?php echo base_url(); ?>">Anasayfa</a>'ya dönebilirsiniz.</p>
		</div>
	</div>
	
<?php $this->load->view('home/layout/footer'); ?>