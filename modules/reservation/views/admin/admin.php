<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-md-3 col-xs-6">
		<h5 class="txt-dark">Rezervasyonlar</h5>
	</div>
	<div class="col-md-6 col-xs-6">
		<form action="<?php echo site_url("reservation/admin"); ?>" method="get">
			<div class="row">
				<div class="col-md-10 col-xs-6 pa-0">
					<input type="text" placeholder="Rezervasyonlarda Ara (<?php echo $total_count; ?>)" class="form-control" name="s" value="<?php echo @$_GET["s"] ?>" autocomplete="off" />					
				</div>
				<div class="col-md-2 col-xs-6 pa-0">
					<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-3 col-xs-6">
		<a href="<?php echo site_url('reservation/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right ml-5">Yeni Kayıt</a>
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
<div class="panel panel-default card-view">
	<div class="panel-wrapper collapse in">			
		<div class="panel-body">
			<form class="row" method="GET" autocomplete="off">
				<div class="col-md-4 col-xs-12">
					<div class="row">
						<div class="col-xs-6 pr-0">
							<input type="text" name="start_date" class="form-control datepicker" placeholder="Rezervasyon Giriş Tarihi" value="<?php echo @$_GET["start_date"] ?>" />
						</div>
						<div class="col-xs-6 pl-0">
							<input type="text" name="end_date" class="form-control datepicker" placeholder="Rezervasyon Çıkış Tarihi" value="<?php echo @$_GET["end_date"] ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="row">
						<div class="col-xs-6 pr-0">
							<input type="text" name="register_start_date" class="form-control datepicker" placeholder="Kayıt Başlangıç Tarihi" value="<?php echo @$_GET["register_start_date"] ?>" />
						</div>
						<div class="col-xs-6 pl-0">
							<input type="text" name="register_end_date" class="form-control datepicker" placeholder="Kayıt Bitiş Tarihi" value="<?php echo @$_GET["register_end_date"] ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-1 col-xs-6">
					<button type="submit" class="btn btn-block btn-success">Göster</button>
				</div>
				<div class="col-md-1 col-xs-6">
					<?php 
					if($this->input->server('QUERY_STRING')){
						$export_uri = "reservation/admin/excel_export2?".$this->input->server('QUERY_STRING'); 
					} else {
						$export_uri = "reservation/admin/excel_export2";
					}
					?>
					<a href="<?=site_url($export_uri)?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="Dışa Aktar"><i class="fa fa-file-excel-o"></i></a>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-4">
		<a href="<?php echo site_url("reservation/admin?status=Rezervasyon tamamlandı") ?>" class="filter-button completed">Tamamlanan Rezervasyonlar</a>
	</div>
	<div class="col-sm-12 col-md-4">
		<a href="<?php echo site_url("reservation/admin?status=Rezervasyon tamamlanmadı") ?>" class="filter-button incomplete">Tamamlanmayan Rezervasyonlar</a>
	</div>
	<div class="col-sm-12 col-md-4">
		<a href="<?php echo site_url("reservation/admin?status=Panel rezervasyon") ?>" class="filter-button panel">Panelden Yapılan Rezervasyonlar</a>
	</div>
</div>
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
										<th>Rezervasyon No</th>
										<th>Ad Soyad</th>
										<th>E-Mail</th>
										<th>Telefon</th>
										<th>Giriş - Çıkış Tarihleri</th>
										<th>Kayıt Tarihi</th>
										<th>Durum</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody id="sortable">
									<?php $i=1; foreach ($page as $item): ?>										
									<tr id="listItem_<?php echo $item->id; ?>">
										<td class="fullname"><?php echo $item->reserve_no; ?></td>
										<td class="fullname"><?php echo $item->name." ".$item->surname; ?></td>
										<td class="email"><?php echo $item->email; ?></td>
										<td class="phone"><?php echo $item->phone; ?></td>
										<td class="phone"><?php echo $item->start_date." ".$item->end_date; ?></td>
										<td class="phone"><?php echo $item->created_date; ?></td>
										<?php if ($item->status == "Rezervasyon tamamlandı"): ?>
											<td class="phone text-success"><?php echo $item->status; ?></td>
											<?php elseif($item->status == "Panel rezervasyon"): ?>
												<td class="phone text-primary"><?php echo $item->status; ?></td>
												<?php else: ?>
													<td class="phone text-danger"><?php echo $item->status; ?></td>
												<?php endif ?>
												<td>
													<a href="<?php echo site_url('reservation/admin/voucher/'.$item->id); ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Voucher Gönder"><i class="fa fa-envelope"></i></a>
													<a href="<?php echo site_url('reservation/admin/record/'.$item->id); ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Görüntüle" target="_blank"><i class="fa fa-eye"></i></a>
													<a href="<?php echo site_url('reservation/admin/voucher_print/'.$item->id); ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Voucher Yazdır" target="_blank"><i class="fa fa-print"></i></a>
													<?php if ($item->status == "Panel rezervasyon"): ?>
														<a href="<?php echo site_url('reservation/admin/edit_record/'.$item->id); ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Voucher Düzenle"><i class="fa fa-pencil"></i></a>
													<?php endif ?>
													<a onclick="delete_confirm('<?php echo site_url('reservation/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
											<?php $i++; endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<?php if(!@$_GET["s"]): ?>
								<select class="btn btn-xs btn-success btn-outline pull-right mt-15 ml-15" onchange="location = this.value;">
									<?php for($p = 1; $p <= ceil($total_count/$this->pagination->per_page); $p++): ?>
										<option value="<?php echo site_url("reservation/admin/index?per_page=".(($p*$this->pagination->per_page)-$this->pagination->per_page)); ?>" <?php echo((@$_GET["per_page"]/$this->pagination->per_page)+1 == $p)?"selected":""; ?>><?php echo $p; ?></option>
									<?php endfor; ?>
								</select>
								<?php echo $this->pagination->create_links(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('admin/layout/footer'); ?>
		<?php $this->load->view('admin/layout/end'); ?>
		<script>
		$('.datepicker').datepicker({
			dateFormat: 'dd/mm/yy',
			monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
			dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
			firstDay:1
		});
	</script>