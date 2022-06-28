<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Kullanıcı Ayarları</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="<?php echo site_url('admin/add_user'); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
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
						<div class="table-wrap">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
									  <tr>
										<th>#</th>
										<th>Kullanıcı Adı</th>
										<th>İşlemler</th>
									  </tr>
									</thead>
									<tbody>
									<?php foreach ($page as $item): ?>										
										<tr>
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->user; ?><?php if($item->power == "root"){echo ' <i class="fa fa-flag text-danger"></i>';} ?></td>
											<td>
												<a href="<?php echo site_url('admin/edit_user/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
												<a onclick="delete_confirm('<?php echo site_url('admin/delete_user/'.$item->id); ?>')" class="btn btn-xs btn-danger <?php echo($item->power == "root")?'disabled':""; ?>" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>