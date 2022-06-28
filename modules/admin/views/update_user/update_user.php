<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Kullanıcı Düzenle</h5>
		</div>
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
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="form-wrap">
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="user">Kullanıcı Adı</label>
									<input type="text" class="form-control" id="user" name="user" placeholder="Kullanıcı Adı" value="<?php echo $this->session->userdata['logged_in']["user"] ?>" disabled />
								</div>
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="oldpassword">Eski Şifre</label>
									<input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Mevcut Şifreniz" required="required" />
								</div>
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="newpassword">Yeni Şifre</label>
									<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Yeni Şifreniz" required="required" />
								</div>
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="newpassword2">Tekrar Yeni Şifre</label>
									<input type="password" class="form-control" id="newpassword2" name="newpassword2" placeholder="Tekrar Yeni Şifreniz" required="required" />
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Düzenle</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>