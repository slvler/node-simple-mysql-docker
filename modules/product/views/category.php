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
					<?php if ($page['header_img'] != NULL) { ?>
					<img src="<?php echo $page['header_img']; ?>" class="img-fluid">
					<?php } ?>
					<div class="details text-center">
						<div class="desc text-left py-4">
							<?php if ($page['content'] != NULL) { ?>
							<?php echo $page['content']; ?>
							<?php } ?>
						</div>
						<div class="row">
							<?php foreach ($page['child'] as $row) { ?>
							<div class="col-3">
								<div class="products">
									<div class="products-img">
										<a href="<?php echo get_seo_url("product/index/".$row->id); ?>">
											<img src="<?php echo image_moo($row->list_img,255,150); ?>" class="img-fluid">
										</a>
									</div>
									<a href="<?php echo get_seo_url("product/index/".$row->id); ?>">
										<p class="mb-1 mt-2 font-size-18 font-bold"><?php echo $row->title; ?></p>
									</a>
									<div class="products-details">
										<p class="font-size-14"><?php echo $row->summary; ?></p>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>

<?php $this->load->view('home/layout/footer'); ?>