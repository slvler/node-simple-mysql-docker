<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Sezonlar</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<a href="<?php echo site_url('season/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
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
							<label class="text-danger">Sezon silinirse veya tarihinde değişiklik yapılırsa o sezona ait bütün günlük stok bilgileri silinecektir.</label>
							<hr>
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th></th>
										<th>Başlık</th>
										<th>Başlangıç Tarihi</th>
										<th>Bitiş Tarihi</th>
										<th>Fiyat (Kişi başı yetişkin)</th>
										<th>Aktif</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($page as $item): ?>										
										<tr>
											<td width="100">#</td>
											<td><?php echo $item->title; ?></td>
											<td><?php echo $item->start_date; ?></td>
											<td><?php echo $item->end_date; ?></td>
											<td><?php echo $item->price; ?> TL</td>
											<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("season/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
											<td>
												<a href="<?php echo site_url('season/admin/quota/'.$item->id); ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Günlük Stok"><i class="fa fa-dot-circle-o"></i></a>
												<a href="<?php echo site_url('season/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
												<a onclick="delete_confirm('<?php echo site_url('season/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
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