<?php
$this->load->helper("menu/menu");
$menu_data = menu(1);
?>

<ul class="f-menu">
	<li><a href="<?php echo site_url(); ?>"><?php echo lang_transform("home"); ?></a></li>
	<?php foreach ($menu_data as $row): ?>
		<li><a href="<?php echo $row->url; ?>" target="<?php echo $row->target; ?>"><?php echo $row->title; ?></a></li>
	<?php endforeach ?>
</ul>