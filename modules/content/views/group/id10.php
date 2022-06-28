<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('content/modules/slider'); ?>

<main id="main" class="pt-2 pb-5 container">
	
	<?php $this->load->view('content/modules/breadcrumb'); ?>

	<div class="row">
		<div class="col-12 col-md-3 sidebar">
			<a class="btn btn-primary btn-sidebar collapsed hide-md-up" data-toggle="collapse" href="#clpsSidebar" role="button" aria-expanded="false" aria-controls="collapseExample">
				<span class="mrx-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" fill="#ffffff"/></svg></span>
				<span><?php echo lang_transform("page_list"); ?></span>
			</a>
			<div id="clpsSidebar" class="collapse sidebar-body mb-2">
				<?php $this->load->view('content/modules/sidebar'); ?>
			</div>
			<table class="table table-bordered table-custom" id="table-custom">
				<tbody>
					<tr>
						<td class="grey text-left">Denizatı-Çeşme</td>
						<td>105 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-İzmir</td>
						<td>49 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-Airport</td>
						<td>33 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-Efes</td>
						<td>37 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-Kuşadası</td>
						<td>48 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-Gümüldür</td>
						<td>5 km</td>
					</tr>
					<tr>
						<td class="grey text-left">Denizatı-Özdere</td>
						<td>8 km</td>
					</tr>
				</tbody>
			</table>
			<div class="gps mb-2" id="gps">
				<div class="mb-1"><img src="assets/img/iconGps.png" alt=""></div>
				<div class="font-black">Meraklısı için GPS koordinatları</div>
				<div class="font-medium">N 38° 03' 19.20" - E 27° 02' 17.69"</div>
			</div>
			<!-- <div class="hidden-xs hidden-sm">
				<a href="<?php echo get_seo_url("content/index/".get_lang_id_record(52,'content',$this->session->userdata('lang'))->id) ?>" class="block mb-3">
					<img src="assets/img/imageTransfer.jpg" alt="" class="img-responsive img-full">
				</a>
			</div> -->
		</div>
		<div class="col-12 col-md-8 content">
			<div id="print_div">
				<?php echo $page['content']; ?>
			</div>
			<div class="row">
				<div class="col-12 mb-3">
					<div id="map-canvas" class="google-map margin-bottom-20"><a target="_blank" href="https://www.google.com/maps/@38.055542,27.038690,18z"> <img style="width: 100%;" src="assets/img/yol-haritası.jpg" alt="icon-print" class="margin-right-10"> </a></div>
				</div>
			</div>
			<div>
				<a href="javascript:;" class="btn-print bg-color-2 border-1 padding-10 font-bold font-size-15" onclick='printDiv();'>
					<img src="assets/img/iconPrint.png" alt="icon-print" class="margin-right-10"> Yol tarifinin çıktısını almak ister misiniz?
				</a>
			</div>
			<?php if ($page['gallery_images']): ?>
				<h2><?php echo lang_transform("gallery"); ?></h2>
				<div class="row gutter-10 gutter-5-md-down gallery">
					<?php foreach ($page['gallery_images'] as $row): ?>
						<div class="col-6 col-md-4 col-xl-3 mb-2">
							<a href="<?php echo image_moo($row->url); ?>" class="fancybox" data-fancybox="aktiviteler">
								<img src="<?php echo image_moo($row->url,167,128); ?>" alt="" class="img-thumbnail" />
							</a>
						</div>
					<?php endforeach ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</main>

<?php $this->load->view('home/layout/footer'); ?>
<script type="text/javascript">
	function printDiv() 
	{

		var divToPrint=document.getElementById('table-custom');
		var gps=document.getElementById('gps');
		var print_div=document.getElementById('print_div');

		var newWin=window.open('','Print-Window');

		newWin.document.open();

		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+gps.innerHTML+print_div.innerHTML+'</body></html>');

		newWin.document.close();

		setTimeout(function(){newWin.close();},10);

	}
</script>