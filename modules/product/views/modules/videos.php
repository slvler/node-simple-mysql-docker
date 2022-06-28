<?php
$this->load->helper("article/article");
$videos = videos(20);
?>

<div class="col-md-6 col-xs-12 text-center video">
	<div class="title">VİDEOLAR</div>
	<div class="mmslick">
		<?php foreach ($videos as $item): ?>
			<a href="https://www.youtube-nocookie.com/embed/<?php echo $item->video; ?>?autoplay=1&amp;rel=0&amp;showinfo=0" class="item fancybox" data-fancybox-type="iframe">
				<img src="http://img.youtube.com/vi/<?php echo $item->video; ?>/maxresdefault.jpg" class="img-responsive" />
				<i class="fa fa-play-circle" aria-hidden="true"></i>
			</a>
		<?php endforeach; ?>
	</div>
</div>