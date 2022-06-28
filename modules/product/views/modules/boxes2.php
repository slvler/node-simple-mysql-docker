<?php
$this->load->helper("content/content");
$record = get_content($id = 10);
$records = get_records($id = 10, $limit = 0);
?>

<section id="aboutBoxes" class="margin-bottom-30 clearfix">
	<div class="container text-center">
		<h2 class="moduleTitle"><?php echo $record["title"] ?></h2>
		<p class="moduleDesc"><?php echo $record["summary"] ?></p>
	</div>
	<div class="container">
		<div class="relative">
			<div class="row">
				<div class="slick">
					<?php foreach ($records as $item): ?>
						<div class="col-md-4 col-xs-12 col-sm-6">
							<div class="item" style="background-image:url(<?php echo image_moo($item->list_img, 768, 768); ?>)">
								<div class="itemTitle"><?php echo $item->title; ?></div>
								<a href="<?php echo get_seo_url("content/index/".$item->id); ?>" class="btn">DEVAMI<i class="icofont icofont-thin-right"></i></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<i class="slickArrows icofont icofont-thin-left"></i>
				<i class="slickArrows icofont icofont-thin-right"></i>
			</div>
		</div>
	</div>
</section>