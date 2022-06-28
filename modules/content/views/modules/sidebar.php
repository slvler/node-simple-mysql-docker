<?php
if ($page['parent']==0) {
	$sidebar = $page['child'];
}else{
	$sidebar = $page['sibling'];
}
?>
<ul class="leftmenu">
	<?php foreach ($sidebar as $row): ?>
		<li <?php echo (get_seo_url("content/index/".$row->id) == $this->uri->segment(1))?'class="active"':''; ?>>
			<a href="<?php echo get_seo_url("content/index/".$row->id); ?>"><?php echo $row->title; ?></a>
		</li>
	<?php endforeach ?>
</ul>