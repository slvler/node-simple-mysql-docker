<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Dil Ayarları</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="<?php echo site_url('language/admin/add_record/'); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
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
								<table class="table table-hover mb-0">
									<thead>
									  <tr>
										<th>#</th>
										<th>Kod</th>
										<th>Dil</th>
										<th>Varsayılan</th>
										<th>Sil</th>
									  </tr>
									</thead>
									<tbody>
									<?php foreach ($page as $item): ?>										
										<tr>
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->lang; ?></td>
											<td><?php echo $item->language; ?></td>
											<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("language/admin/change_default/".$item->id); ?>'" <?php echo($item->default == 1)?"checked disabled":""; ?> class="js-switch js-switch-1" data-color="#469408" data-size="small"/></td>
											<td>
												<a onclick="delete_confirm('<?php echo site_url('language/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs <?php echo($item->default == 1)?"disabled":""; ?>" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
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
	<hr />
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Sabit Metinler</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a id="add_field_button" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="table-wrap">
							<form method="post">
								<div class="table-responsive">
									<table class="table table-hover mb-0">
										<thead>
										  <tr>
											<th>#</th>
											<th>Kod</th>
											<?php foreach($all_languages as $al_item): ?>
											<th><?php echo $al_item->language; ?></th>
											<?php endforeach; ?>
											<th>Sil</th>
										  </tr>
										</thead>
										<tbody id="input_fields_wrap">
										<?php foreach ($static_lang as $item): ?>
										<?php $item->values = (array) json_decode($item->values); ?>
											<tr>
												<td><?php echo $item->id; ?></td>
												<td><input class="form-control" name="static_lang[<?php echo $item->id; ?>][name]" value="<?php echo $item->name; ?>"></td>
												<?php foreach($all_languages as $al_item): ?>
												<th><input class="form-control" name="static_lang[<?php echo $item->id; ?>][values][<?php echo $al_item->lang; ?>]" value="<?php echo htmlentities(@$item->values[$al_item->lang]); ?>"></th>
												<?php endforeach; ?>
												<td><a class="btn btn-danger btn-xs" id="remove_field"><i class="fa fa-trash"></i></a></td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right mt-30">Kaydet</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/end'); ?>
<?php $this->load->view('admin/layout/footer'); ?>
<?php // Dinamik metin ekleme fonksiyonu ?>
<script>
	$(document).ready(function() {
		var i = <?php echo count($static_lang)+1; ?>;
		$("#add_field_button").click(function(e){
			e.preventDefault();
			$("#input_fields_wrap").append('<tr><td>#</td><td><input class="form-control" name="static_lang['+i+'][name]"></td><?php foreach($all_languages as $al_item): ?><th><input class="form-control" name="static_lang['+i+'][values][<?php echo $al_item->lang; ?>]"></th><?php endforeach; ?><td><a class="btn btn-danger btn-xs" id="remove_field"><i class="fa fa-trash"></i></a></td></tr>');
			i++;
		});
		
		$("#input_fields_wrap").on("click","#remove_field", function(e){
			e.preventDefault(); $(this).parents('tr').remove(); x--;
		})
	});
</script>