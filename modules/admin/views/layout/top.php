<div class="wrapper theme-1-active pimary-color-green">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="mobile-only-brand pull-left">
			<div class="nav-header pull-left">
				<div class="logo-wrap">
					<a href="<?php echo site_url("admin"); ?>">
						<img class="brand-img" src="assets/admin/dist/img/logo.png" alt="egegen" width="40" />
					</a>
				</div>
			</div>	
			<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
			<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
		</div>
		<div id="mobile_only_nav" class="mobile-only-nav pull-right">
			<ul class="nav navbar-right top-nav pull-right">
				<li><a href="<?php echo site_url(); ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="Siteyi Görüntüle"><i class="zmdi zmdi-globe top-nav-icon"></i></a></li>
				<li><a href="<?php echo site_url("admin/clear_cache_files"); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Tüm Çerezleri Temizle"><i class="zmdi zmdi-fire top-nav-icon"></i></a></li>
				<li class="dropdown auth-drp">
					<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo settings("logo"); ?>" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
					<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
						<li>
							<a href="<?php echo site_url('admin/update_user'); ?>"><i class="zmdi zmdi-account"></i><span><?php if($this->session->userdata['logged_in']["power"] == "root"){ echo 'Kullanıcı Yönetimi'; }else{ echo 'Şifre Değiştir'; } ?></span></a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="<?php echo site_url('admin/login/logout'); ?>"><i class="zmdi zmdi-power"></i><span>Çıkış</span></a>
						</li>
					</ul>
				</li>
			</ul>
		</div>	
	</nav>