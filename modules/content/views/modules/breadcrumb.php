<h1 class="page-title mb-2">
	<?php if(@$page['parents']): ?>
		<?php foreach(array_reverse($page['parents']) as $parents): ?>
			<?php
			$this->load->helper('content/content');
			$parent = get_content(get_lang_id_record($parents['id'],'content',$this->session->userdata('lang'))->id); 
			?>
			<?php echo $parent["title"]; ?> /
		<?php endforeach; ?>
	<?php endif; ?>
	<span class="bold"><?php echo $page['title']; ?></span>
</h1>