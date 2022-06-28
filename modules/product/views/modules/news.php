<?php
$this->load->helper("article/article");
$articles = articles(8, 3);
$article = article(8);
?>

	<section class="fw-section padding-top-3x padding-bottom-3x">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 tablet-center">
					<h2 class="block-title text-dark text-left tablet-center">
						<?php echo $article['title']; ?><small class="h4"><?php echo $article['summary']; ?></small>
					</h2>
				</div>
			</div>
			<div class="row">
				<?php foreach ($articles as $item): ?>
					<div class="col-sm-4">
						<div class="blog-post-tile">
							<article class="post-tile">
								<div class="post-body">
									<header class="post-header">
										<div class="column"></div>
										<div class="column"><?php echo date("d/m/Y", strtotime($item->record_date)) ?></div>
									</header>
									<h3 class="post-title"><a href="<?php echo site_url($item->url); ?>"><?php echo $item->title; ?></a></h3>
									<p class="post-excerpt"><?php echo $item->summary; ?></p>
									<footer class="post-footer text-right">
										<div class="tags-links">
											<a href="<?php echo site_url($item->url); ?>" rel="tag" class="pull-right">Detaylar</a>
										</div>
									</footer>
								</div>
							</article>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>