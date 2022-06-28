<?php
$this->load->helper("menu/menu");
$menu_data = menu(1);
?>

<ul class="navbar-nav">
	<li class="nav-item">
		<a href="<?php echo site_url(); ?>" class="nav-link active"><?php echo lang_transform("home"); ?></a>
	</li>
	<?php foreach ($menu_data as $row): ?>
		<li class="nav-item <?php echo ($row->child)?'dropdown':''; ?>">
			<a href="<?php echo $row->url; ?>" class="nav-link <?php echo ($row->child)?'dropdown-toggle':''; ?>" <?php echo ($row->child)?'role="button" data-toggle="dropdown"':''; ?> target="<?php echo $row->target; ?>"><?php echo $row->title; ?></a>
			<?php if ($row->child): ?>
				<div class="dropdown-menu">
					<?php foreach ($row->child as $item): ?>
						<a class="dropdown-item" href="<?php echo $item->url; ?>" target="<?php echo $item->target; ?>"><?php echo $item->title; ?></a>
					<?php endforeach ?>
				</div>
			<?php endif ?>    
		</li>
	<?php endforeach ?>
</ul>