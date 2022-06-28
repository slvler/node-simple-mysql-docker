<?php $this->load->view('home/layout/header'); ?>

<section class="section-content clearfix">

	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-6 pt-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item active">Search</li>
						</ol>
					</nav>
					<h1>Search <?php echo ($this->input->get("text") != NULL)? "(".$this->input->get("text").")" : ""; ?></h1>
				</div>
				<div class="col-6 col-sm-6 col-md-6 text-right">
					<a href="javascript:history.back();" class="prev d-inline-block margin-top-sm margin-top-xs"><i class="fa fa-chevron-left"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="details products-list padding-top-20">
		<div class="container">
			<div class="row row-narrow">
				<div class="col-xs-12 col-sm-12 margin-bottom-30">
					<p class="p-0 mb-3 mt-3 font-size-18"><?php echo count($search); ?> found content</p>
					<div class="row pl-3">
						<?php foreach ($search as $item) { ?>

						<div class="items padding-10 text-center-xs col-sm-12 mb-3">
							<div class="row">
								<div class="col-sm-3 p-0">
									<a href="<?php echo get_seo_url('content/index/'.$item->id); ?>">
										<img src="<?php echo ($item->list_img == NULL)? image_moo_nc("assets/images/noimage.png", 250, 250) : image_moo_nc($item->list_img, 250, 250); ?>" 
										class="img-responsive" />

									</a>
								</div>
								<div class="col-sm-9 pl-0">
									<h4>
										<a href="<?php echo get_seo_url('content/index/'.$item->id); ?>">
											<?php echo $item->title; ?>
										</a>
									</h4>
									<p><?php echo $item->content; ?></p>
								</div>
							</div>
						</div>

						<?php } ?>
					</div>
				</div>
				
			</div>
		</div>
	</div>

</section>

<?php $this->load->view('home/layout/footer'); ?>