<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo site_url("/"); ?></loc> 
        <priority>1.0</priority>
    </url>
	<?php foreach ($page as $item): ?>
    <url>
        <loc><?php echo site_url($item->seo_url); ?></loc>
        <priority>0.5</priority>
    </url>
    <?php endforeach; ?>
</urlset>