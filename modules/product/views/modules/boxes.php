<?php
$this->load->helper("content/content");
$record = get_content($id = 1);
$records = get_records($id = 1, $limit = 8);
?>
<?php $records1 = array_slice($records, 0, 4); ?>
<?php $records2 = array_slice($records, 4, 4); ?>

<section id="services" class="clearfix">
	<div class="container text-center">
		<h2 class="moduleTitle"><?php echo $record["title"] ?></h2>
		<p class="moduleDesc"><?php echo $record["summary"] ?></p>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="row">
			<?php foreach ($records1 as $item): ?>
				<a class="item col-md-3 col-xs-4" href="<?php echo get_seo_url("content/index/".$item->id); ?>">
					<div class="row">
						<img src="<?php echo image_moo($item->list_img, 240, 680); ?>" class="img-responsive" />
						<div class="itemTitle"><?php echo $item->title; ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="row">
			<?php foreach ($records2 as $item): ?>
				<a class="item col-md-3 col-xs-4" href="<?php echo get_seo_url("content/index/".$item->id); ?>">
					<div class="row">
						<img src="<?php echo image_moo($item->list_img, 240, 680); ?>" class="img-responsive" />
						<div class="itemTitle"><?php echo $item->title; ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>