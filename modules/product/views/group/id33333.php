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
			<div class="row">
				<div class="col-xxs-12 col-sm-3 col-md-2">
					<div class="sidebar">
						<ul class="list-unstyled subpage-left-menu">
							<?php /* YAN İÇERİKLER */ ?>
							<?php if ($page['sibling']): ?>
								<?php foreach ($page['sibling'] as $item): ?>
									<li class="<?php echo($page['id'] == $item->id)?"active":""; ?>">
										<a href="<?php echo site_url(get_seo_url("product/index/".$item->id)); ?>"><?php echo $item->title; ?></a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="col-xxs-12 col-sm-9 col-md-10">
					<div class="row">
						<?php /* ALT İÇERİKLER */ ?>
						<?php if ($page['child']): ?>
						<?php foreach ($page['child'] as $item): ?>
							<?php if ($item->page_type == "product"): ?>
							<?php $item->extra = json_decode($item->extra); ?>
							<div class="col-xxs-6 col-xs-6 col-md-3 margin-bottom-20">
								<div class="product-wrapper product-wrapper-2">
									<a href="<?php echo site_url(get_seo_url("product/index/".$item->id)); ?>" class="box-image berjer">
										<?php $list_img = ($item->list_img != NULL ? $item->list_img : get_lang_id_record($item->id, "product", $default_lang->lang)->list_img); ?>
										<img src="<?php echo image_moo($list_img, 428, 610); ?>" alt="<?php echo $item->title; ?>" width="428" height="610" class="img-responsive">
									</a>
									<span class="discountBlue">
										<?php echo($item->discount_type == "change")?"Değiştirme Kampanyası":"% 30 İndirim"; ?>
									</span>
									<span class="title-wrapper"><h4 class="title no-margin-bottom"><?php echo tr_strtoupper($item->title); ?></h4></span>
									<div class="price">
										<?php
											$price1 = (@$item->extra[1]->i1 > 0) ? $item->extra[1]->i1 : $item->extra[0]->i1 ;
											$price2 = (@$item->extra[1]->i2 > 0) ? $item->extra[1]->i2 : $item->extra[0]->i2 ;
											foreach(@$item->extra as $itemExtra){
												if($itemExtra->i0 == "150x200"){
													$price1 = $itemExtra->i1;
													$price2 = $itemExtra->i2;
												}
											}
										?>
										<span class="text-line"><img src="assets/images/tl.png" alt="" width="10"><?php echo @number_format($price1, 2) ?></span>
										<span class="inline-block"><img src="assets/images/tl.png" alt="" class="margin-left-15 no-margin-xs"><?php echo @number_format($price2, 2) ?></span>
									</div>
								</div>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('home/layout/footer'); ?>