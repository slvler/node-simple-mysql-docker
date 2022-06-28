<?php $this->load->view('admin/layout/header'); ?>

	<div class="wrapper pa-0">
		<div class="page-wrapper pa-0 ma-0 auth-page" style='background: url("assets/admin/dist/img/login-bg-2.jpg") center center / cover no-repeat; min-height: 937px;''>
			<div class="container-fluid">
				<div class="table-struct full-width full-height">
					<div class="table-cell vertical-align-middle auth-form-wrap">
						<div class="auth-form  ml-auto mr-auto no-float">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<div class="mb-30 text-center">
										<img class="brand-img" src="assets/admin/dist/img/egegen-logo-black.png" alt="egegen" width="75" />
										<h3 class="text-center txt-dark mb-10">egegen</h3>
										<h6 class="text-center nonecase-font txt-grey">İçerik Yönetim Sistemi</h6>
									</div>
									<?php if (!empty ($this->session->flashdata('error_message'))): ?>
										<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<i class="zmdi zmdi-block pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('error_message'); ?></p>
											<div class="clearfix"></div>
										</div>
									<?php endif; ?>
									<?php if (!empty ($this->session->flashdata('success_message'))): ?>
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
											<div class="clearfix"></div>
										</div>
									<?php endif; ?>
									<div class="form-wrap">
										<form method="post" action="<?php echo site_url('admin/login'); ?>">
											<div class="form-group">
												<label class="control-label mb-10" for="user">Kullanıcı Adı</label>
												<input type="text" class="form-control" required="required" id="user" name="user" placeholder="Kullanıcı Adı" autocomplete="off" />
											</div>
											<div class="form-group">
												<label class="pull-left control-label mb-10" for="password">Şifre</label>
												<input type="password" class="form-control" required="required" id="password" name="password" placeholder="Şifre" />
											</div>
											<div class="form-group text-center">
												<button type="submit" class="btn btn-success">Giriş</button>
											</div>
										</form>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/end'); ?>