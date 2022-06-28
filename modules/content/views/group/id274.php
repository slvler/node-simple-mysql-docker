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
			<div id="clpsSidebar" class="collapse sidebar-body">
				<?php $this->load->view('content/modules/sidebar'); ?>
			</div>
		</div>
		<div class="col-12 col-md-8 content">
			<?php if ($page['child']): ?>
				<div class="row gutter-10 gutter-5-md-down gallery">
					<?php foreach ($page['child'] as $row): ?>
						<div class="col-12">
							<h2><?php echo $row->title; ?></h2>
							<?php $videos = json_decode($row->extra); ?>
							<div class="row">
								<?php foreach ($videos as $item): ?>
									<div class="col-12 col-md-4 mb-2">
										<a href="https://www.youtube.com/embed/<?php echo $item->value; ?>" class="fancybox" data-fancybox="aktiviteler">
											<img src="http://img.youtube.com/vi/<?php echo $item->value; ?>/0.jpg" alt="<?php echo $item->key; ?>">
										</a>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</main>

<?php $this->load->view('home/layout/footer'); ?>