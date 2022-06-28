<?php
$this->load->helper("menu/menu");
$records = menu(61);
$menu_data = menu_record(get_lang_id_record(61, "menu", $this->session->userdata('lang'))->id);
?>
<section class="mb-5 home-pattern">
	<div class="container">
		<h2 class="main-title"><?php echo $menu_data['title']; ?></h2>

		<p>
			<a href="<?php echo $menu_data['url']; ?>" class="btn btn-link lnk-primary"> 
				<span class="text"><?php echo $menu_data['content']; ?></span>
				<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z" fill="#0168b3"></path></svg></span>
			</a>
		</p>
		<div class="grid-wrap home-service">
			<?php foreach ($records as $row): ?>
				<div class="item">
					<a href="<?php echo $row->url; ?>">
						<div class="icon">
							<img src="<?php echo ($row->list_img)?image_moo($row->list_img):image_moo($row->page_default['list_img']); ?>" alt="<?php echo $row->title; ?>"/>
						</div>
						<h3 class="title"><?php echo $row->title; ?></h3>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>