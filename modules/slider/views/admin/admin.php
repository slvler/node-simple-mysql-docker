<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Slider</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<a href="<?php echo site_url('slider/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
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
										<th>Başlık</th>
										<th>Link</th>
										<th>Aktif</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td width="100"><div class="btn btn-xs btn-default handle"><i class="fa fa-arrows"></i></div></td>
											<td><?php echo $item->title; ?></td>
											<td><?php echo $item->link; ?></td>
											<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("slider/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
											<td>
												<a href="<?php echo site_url('slider/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
												<a onclick="delete_confirm('<?php echo site_url('slider/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
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

<script>
$( document ).ready(function() {
	$("#sortable").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#sortable').sortable('serialize');
			window.location.href = "slider/admin/update_list?"+order;
		}
	});
});
</script>