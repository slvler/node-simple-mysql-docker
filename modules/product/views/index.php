<?php $this->load->view('home/layout/header'); ?>

<section class="section-content clearfix">

	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-6 pt-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang_transform("home"); ?></a></li>
							<li class="breadcrumb-item active"><?php echo $page['title']; ?></li>
						</ol>
					</nav>
					<h1><?php echo $page['title']; ?></h1>
				</div>
				<div class="col-6 col-sm-6 col-md-6 text-right">
					<a href="javascript:history.back();" class="prev d-inline-block margin-top-sm margin-top-xs"><i class="fa fa-chevron-left"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="main pt-2 pb-2 bg-white">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if ($page['list_img'] != NULL) { ?>
					<img src="<?php echo $page['list_img']; ?>" class="img-fluid">
					<?php } ?>
					<div class="details text-center">
						<p class="mb-1 mt-2 font-size-18 font-bold text-left"><?php echo $page['title']; ?></p>
						<div class="desc text-left py-2">
							<?php if ($page['content'] != NULL) { ?>
							<?php echo $page['content']; ?>
							<?php } ?>
						</div>
						<?php /* FOTO GALERİ */ ?>
						<?php if (count($page['gallery_images'])>0): ?>
							<div class="clearfix"></div>
							<div class="content-grid mb-5">
								<div class="row">
									<?php foreach ($page['gallery_images'] as $item): ?>

										<a data-fancybox="gallery" rel="group" href="<?php echo $item->url; ?>" class="fancybox col-md-3 text-center mb-4">
											<img src="<?php echo image_moo($item->url, 320, 450); ?>" class="img-fluid thumbnail m-0" />
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>

<?php $this->load->view('home/layout/footer'); ?>