<?php
$this->load->helper("article/article");
$articles = articles($alias, 6);
$article = article($alias);
?>

	<section class="widget widget_nav_menu">
		<h3 class="widget-title"><?php echo $article['title']; ?></h3>
		<div class="menu-footer-menu-1-container">
			<ul class="menu">
				<?php foreach ($articles as $item): ?>
					<li class="menu-item"><a href="<?php echo site_url($item->url); ?>"><?php echo $item->title; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>