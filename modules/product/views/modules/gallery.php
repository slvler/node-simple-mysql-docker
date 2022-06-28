<?php
$this->load->helper("content/content");
$gallery = get_images($id = 1, $limit = 0);
?>
	<div class="logos">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="list-unstyled slick">
						<?php foreach ($gallery as $item): ?>
							<li><img src="<?php echo $item->url; ?>" class="img-responsive" /></li>
						<?php endforeach; ?>
					</ul>
					<script>
						$(function() {
							var myCarousel= $('.logos .slick');
							myCarousel.slick({
								slidesToShow: 6,
								autoplay: true,
								centerMode:false,
								arrows:true,
								dots:false,
								slidesToScroll: 1,
								responsive: [
									{
										breakpoint: 1200,
										settings: {
											rows:5,
										}
									},
									{
										breakpoint: 992,
										settings: {
											rows:4,
										}
									},
									{
										breakpoint: 768,
										settings: {
											slidesToShow: 3
										}
									},
									{
										breakpoint: 420,
										settings: {
											slidesToShow: 2
										}
									}
								]
							});
						});
					</script>
				</div>
			</div>
		</div>
	</div>