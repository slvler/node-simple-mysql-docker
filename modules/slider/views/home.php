<?php
$this->load->helper("slider/slider");
$slider_data = slider();
?>
<?php if ($slider_data): ?>
	<!-- Slider -->
	<div id="slider">
		<div id="sliderHome" class="slick-slider">
			<?php foreach ($slider_data as $index => $row): ?>
				<?php if($row->title == "Merhaba,...") {
					$row->title = "<p>".$row->title."</p>";
					$mobile_desc = '<p class="small text-shadow">Sizlerle yeniden birlikte olabilmek için gün sayıyoruz...</p>';
					$mobile_desc .= '<p class="text-shadow mb-5">26 Haziran\'da açılıyoruz</p>';
					$mobile_desc .= '<a data-fancybox="" class="text-shadow small-2x" data-src="#covid-popup" href="#">COVID 19 &ouml;nlemleri i&ccedil;in tıklayınız...</a>';
				} ?>
				<div class="slick-slide">
					<img data-src="<?php echo image_moo($row->media); ?>" class="lazy slick-image" alt="<?php echo $row->title; ?>" />
					<div class="slider-block">
						<div class="container">
							<h2 class="slide-title">
								<?php echo $row->title; ?>
								<?php if ($row->media_mobile): ?>
									<img src="<?php echo image_moo($row->media_mobile); ?>" alt="<?php echo $row->title; ?>">
								<?php endif ?>
							</h2>
							<?php if($mobile_desc): ?>
								<div class="slide-desc hide-md-down"><?php echo $row->description; ?></div>
								<div class="slide-desc hide-md-up"><?php echo $mobile_desc; ?></div>
							<?php else: ?>
								<div class="slide-desc"><?php echo $row->description; ?></div>
							<?php endif; ?>
							
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<!-- Slider End -->
<?php endif ?>