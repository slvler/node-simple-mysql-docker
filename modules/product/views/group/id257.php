<?php $this->load->view('home/layout/header'); ?>

	<?php if($page['header_img'] != NULL): ?>
	<div class="section-banner" style="background-image:url('<?php echo $page['header_img']; ?>')"></div>
	<?php endif; ?>
	
	<div class="section section-content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="info-bar hidden-xxs">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url(); ?>"><?php echo lang_transform("anasayfa"); ?></a></li>
							<?php /* ÜST İÇERİKLER */ ?>
							<?php if(@$page['parents']): ?>
								<?php foreach(array_reverse($page['parents']) as $parents): ?>
									<li><a href="<?php echo get_seo_url("product/index/".$parents["id"]); ?>"><?php echo $parents["title"]; ?></a></li>
								<?php endforeach; ?>
							<?php endif; ?>
							<li class="active"><?php echo $page['title']; ?></li>
							<li class="back">
								<a href="javascript:history.back();" class="back">
									<img src="assets/images/iconArrowLeft.png" alt=""> <?php echo lang_transform("back"); ?>
								</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<?php /* ALT İÇERİKLER */ ?>
			<?php if ($page['child']): ?>
			<div class="row">
				<div class="col-xxs-12 col-sm-12 col-md-12">
					<div class="row">
						<?php foreach ($page['child'] as $item): ?>
							<?php if ($item->page_type == "category"): ?>
							<div class="col-xxs-12 col-xs-6 col-md-6 margin-bottom-20">
								<div class="product-wrapper product-wrapper-2">
									<a href="<?php echo site_url(get_seo_url("product/index/".$item->id)); ?>" class="box-image">
										<?php $list_img = ($item->list_img != NULL ? $item->list_img : get_lang_id_record($item->id, "product", $default_lang->lang)->list_img); ?>
										<img src="<?php echo image_moo($list_img, 610, 428); ?>" alt="<?php echo $item->title; ?>" width="610" height="393" class="img-responsive">
									</a>
									<span class="title-wrapper"><span class="title"><?php echo tr_strtoupper($item->title); ?></span></span>
								</div>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php $this->load->view('home/layout/footer'); ?>