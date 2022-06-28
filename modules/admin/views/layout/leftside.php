<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<?php foreach($this->data['all_modules'] as $modules): ?>
			<?php if(file_exists(FCPATH."modules/".$modules."/config/settings.php")){
				$this->load->config($modules."/settings", FALSE, TRUE);
				$module_list[$this->config->item("module_category")][$modules] = array(
					"icon" => $this->config->item("module_icon"),
					"name" => $this->config->item("module_name")
				);
			} ?>
		<?php endforeach; ?>
		
		<?php foreach($module_list as $ml_key => $ml_value): ?>
			<li class="navigation-header"><span><?php echo $ml_key; ?></span><i class="zmdi zmdi-more"></i></li>
			<?php foreach($ml_value as $m_key => $m_value): ?>
				<li>
					<a href="<?php echo site_url($m_key.'/admin') ?>" class="<?php echo($this->uri->segment(1)==$m_key)?"active":""; ?>">
						<div class="pull-left">
							<i class="<?php echo $m_value["icon"] ?> mr-20"></i><span class="right-nav-text"><?php echo $m_value["name"] ?></span>
						</div>
						<div class="clearfix"></div>
					</a>
				</li>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</ul>
</div>

<div class="page-wrapper">
	<div class="container-fluid">