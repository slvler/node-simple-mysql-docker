<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Direkt Ödemeler</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<a href="<?php echo site_url('direct_payment/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
	</div>
</div>
<?php if (!empty ($this->session->flashdata('success_message'))): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
		<div class="clearfix"></div>
	</div>
<?php endif; ?>
<?php if (!empty ($this->session->flashdata('error_message'))): ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="zmdi zmdi-block pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('error_message'); ?></p>
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
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th></th>
										<th>Ad Soyad</th>
										<th>E-posta</th>
										<th>Fiyat</th>
										<th>Durum</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($page as $item): ?>										
										<tr>
											<td width="100">#</td>
											<td><?php echo $item->fullname; ?></td>
											<td><?php echo $item->email; ?></td>
											<td><?php echo $item->price." ".$item->currency; ?></td>
											<td class="<?php echo ($item->status == 1)?"text-success":"text-danger"; ?>"><?php echo ($item->status == 1)?"Ödeme Yapıldı":"Ödeme Yapılmadı"; ?></td>
											<td>
												<a href="<?php echo site_url('direct_payment/admin/send_mail/'.$item->id); ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Ödeme E-postasını Tekrar Gönder"><i class="fa fa-envelope"></i></a>
												<a href="<?php echo site_url('direct_payment/admin/record_view/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Görüntüle"><i class="fa fa-eye"></i></a>
												<a onclick="delete_confirm('<?php echo site_url('direct_payment/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
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