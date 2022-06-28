<?php if ($page['header_img']): ?>
	<aside id="hero">
		<div id="sliderHero" class="slick-slider">
			<div class="slick-slide">
				<img src="<?php echo image_moo($page['header_img'],1930,557); ?>" alt=""/>
			</div>
		</div>
	</aside>
<?php elseif(@$page['gallery_images']): ?>
	<aside id="hero">
		<div id="sliderHero" class="slick-slider">
			<?php foreach ($page['gallery_images'] as $row): ?>
				<div class="slick-slide">
					<img src="<?php echo image_moo($row->url,1930,557); ?>" alt=""/>
				</div>
			<?php endforeach ?>
		</div>
	</aside>
<?php else: ?>
	<aside id="hero">
		<div id="sliderHero" class="slick-slider">
			<div class="slick-slide">
				<img src="<?php echo image_moo("assets/img/havuz1.jpg",1930,557); ?>" alt=""/>
			</div>
		</div>
	</aside>
<?php endif ?>