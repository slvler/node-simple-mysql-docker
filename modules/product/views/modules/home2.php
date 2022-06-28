<?php
$this->load->helper("content/content");
$content = get_content(3);
?>
	<div class="col-xs-12 col-sm-6">
		<div class="bg-2">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-6">
					<div class="details bg-2 padding-20 text-center margin-left-15 margin-right-15">
						<h3><?php echo $content['title']; ?></h3>
						<p class="font-size-18"><?php echo $content['summary']; ?></p>
						<a href="<?php echo get_seo_url("content/index/".$content['id']); ?>">
							Politikamızı İncele
						</a>
					</div>
				</div>
				<div class="hidden-xs hidden-sm col-md-3 col-lg-6"></div>
			</div>
		</div>
	</div>