<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark"><?php echo $record['form']." - ".$record['fullname']; ?></h5>
		</div>
	</div>
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
								<a href="<?php echo site_url('contact/admin/'); ?>" class="btn btn-xs btn-default mb-15 pull-right" data-toggle="tooltip" title="Üst Sayfaya Git"><i class="fa fa-arrow-left"></i></a>
								<table class="table table-hover mb-0">
									<?php if(isset($record['fullname'])): ?>
										<tr>
											<td>Ad Soyad</td>
											<td><?php echo $record['fullname']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['subject'])): ?>
										<tr>
											<td>Şehir</td>
											<td><?php echo $record['subject']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['address'])): ?>
										<tr>
											<td>Adres</td>
											<td><?php echo $record['address']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['created_date'])): ?>
										<tr>
											<td>Zaman</td>
											<td><?php echo $record['created_date']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['phone'])): ?>
										<tr>
											<td>Telefon</td>
											<td><?php echo $record['phone']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['email'])): ?>
										<tr>
											<td>E-Posta</td>
											<td><?php echo $record['email']; ?></td>
										</tr>
									<?php endif; ?>
									<?php if(isset($record['message'])): ?>
										<tr>
											<td>Mesaj</td>
											<td><?php echo $record['message']; ?></td>
										</tr>
									<?php endif; ?>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>