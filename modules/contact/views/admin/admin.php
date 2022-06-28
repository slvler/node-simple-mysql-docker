<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">İletişim</h5>
	</div>
</div>
<?php if(!empty ($this->session->flashdata('success_message'))): ?>
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
							<div  class="pills-struct">
								<ul role="tablist" class="nav nav-pills">
									<?php foreach(all_languages() as $item): ?>
										<li class="<?php echo($item->default == 1)?"active":""; ?>" role="presentation"><a aria-expanded="<?php echo($item->default == 1)?"true":"false"; ?>" data-toggle="tab" role="tab" href="#lang_<?php echo $item->lang ?>"><?php echo $item->language ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach(all_languages() as $item): ?>
										<input type="hidden" name="<?php echo $item->lang ?>[id]" value="<?php echo @$page[$item->lang]['id'] ?>" />
										<?php if($item->default == 1): ?>
											<input type="hidden" name="lang_id" value="<?php echo @$page[$item->lang]['lang_id'] ?>" />
										<?php endif; ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">											
												<div class="col-md-9 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" <?php echo($item->default == 1)?'required="required"':""; ?> value="<?php echo @$page[$item->lang]['title'] ?>" />
													</div>
													<div class="row">
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[list_img]">Resim <small>(Listeleme)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[list_img]" name="<?php echo $item->lang ?>_list_img" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[header_img]">Resim <small>(Üst)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[header_img]" name="<?php echo $item->lang ?>_header_img" />
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[summary]">Özet</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[summary]" name="<?php echo $item->lang ?>[summary]" placeholder="Ön yazı" rows="3"><?php echo @$page[$item->lang]['summary'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[content]">İçerik</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[content]" name="<?php echo $item->lang ?>[content]"><?php echo @$page[$item->lang]['content'] ?></textarea>
													</div>
												</div>					
												<div class="col-md-3 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Sayfa Tanımı</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]" placeholder="Sayfa Tanımı" rows="3"><?php echo @$page[$item->lang]['description'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[keywords]">Anahtar Kelimeler</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[keywords]" name="<?php echo $item->lang ?>[keywords]" placeholder="Anahtar Kelimeler"><?php echo @$page[$item->lang]['keywords'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[url]">URL</label>
														<input type="hidden" name="<?php echo $item->lang ?>[oldurl]" value="<?php echo @get_seo_url("contact/index/".@$page[$item->lang]['id']); ?>" />
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[url]" name="<?php echo $item->lang ?>[url]" value="<?php echo @get_seo_url("contact/index/".@$page[$item->lang]['id']); ?>" />
													</div>
													<?php if(! @$page[$item->lang]['list_img'] == ""): ?>
														<div class="panel panel-default">
															<div class="panel-heading"><div class="panel-title">Resim <small>(Listeleme)</small><a onclick="delete_confirm('<?php echo site_url('content/admin/delete_record_img/list_img/'.@$page[$item->lang]['id']); ?>')" class="btn btn-default btn-xs pull-right" data-toggle="tooltip" title="Sil"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>
															<img src="<?php echo $page[$item->lang]['list_img']; ?>" class="img-responsive" />
														</div>
													<?php endif; ?>
													<?php if(! @$page[$item->lang]['header_img'] == ""): ?>
														<div class="panel panel-default">
															<div class="panel-heading"><div class="panel-title">Resim <small>(Üst)</small><a onclick="delete_confirm('<?php echo site_url('content/admin/delete_record_img/header_img/'.@$page[$item->lang]['id']); ?>')" class="btn btn-default btn-xs pull-right" data-toggle="tooltip" title="Sil"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>
															<img src="<?php echo $page[$item->lang]['header_img']; ?>" class="img-responsive" />
														</div>
													<?php endif; ?>
													<?php if(@$page[$item->lang]["extra"]){ $page[$item->lang]["extra"] = json_decode($page[$item->lang]["extra"]); }else{ $page[$item->lang]["extra"] = json_decode('[{"key":"","value":""}]'); } ?>
														<div id="<?php echo $item->lang ?>_input_fields_wrap">
															<div class="row">
																<div class="col-xs-12">
																	<a class="btn btn-xs btn-primary pull-right mb-15" id="<?php echo $item->lang ?>_add_field_button">Yeni İletişim Bilgisi Ekle</a>
																</div>
															</div>
															<?php $i=0; foreach($page[$item->lang]["extra"] as $extraKey => $extraValue): ?>
															<div class="row mb-15">
																<?php if($i != 0): ?>
																	<div class="col-xs-12"><hr class="mb-15"></div>
																<?php endif; ?>
																<div class="col-xs-10">
																	<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][<?php echo $extraKey ?>][key]" placeholder="Başlık" value="<?php echo @$extraValue->key ?>" />
																</div>
																<div class="col-xs-2">
																	<?php if($i != 0): ?>
																		<a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a>
																	<?php endif; ?>
																</div>
																<div class="col-xs-12 mt-15">
																	<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][<?php echo $extraKey ?>][value]" placeholder="Bilgi" value="<?php echo @$extraValue->value ?>" />
																</div>
															</div>
															<?php $i++; endforeach; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Kaydet</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<h5>İletişim Formu</h5>
						<hr>
						<div class="table-wrap">
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Ad Soyad</th>
											<th>Tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody id="sortable">
										<?php foreach ($post_records as $item): ?>										
											<?php if ($item->form == "İletişim Formu"): ?>
												<tr id="listItem_<?php echo $item->id; ?>">
													<td><?php echo $item->id; ?></td>
													<td><?php echo $item->fullname; ?></td>
													<td><?php echo $item->created_date; ?></td>
													<td>
														<a href="<?php echo site_url('contact/admin/record/'.$item->id); ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Görüntüle"><i class="fa fa-eye"></i></a>
														<a onclick="delete_confirm('<?php echo site_url('contact/admin/delete_record/'.$item->id); ?>')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
											<?php endif ?>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<h5>E-Bülten Formu</h5>
						<hr>
						<div class="table-wrap">
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>E-posta</th>
											<th>Tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody id="sortable">
										<?php foreach ($post_records as $item): ?>										
											<?php if ($item->form == "E-Bülten Formu"): ?>
												<tr id="listItem_<?php echo $item->id; ?>">
													<td><?php echo $item->email; ?></td>
													<td><?php echo $item->fullname; ?></td>
													<td><?php echo $item->created_date; ?></td>
													<td>
														<a href="<?php echo site_url('contact/admin/record/'.$item->id); ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Görüntüle"><i class="fa fa-eye"></i></a>
														<a onclick="delete_confirm('<?php echo site_url('contact/admin/delete_record/'.$item->id); ?>')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
											<?php endif ?>
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

	<?php // Dinamik iletişim bilgisi ekleme fonksiyonu ?>
	<script>
		$(document).ready(function() {
			<?php foreach(all_languages() as $item): ?>
			var i_<?php echo $item->lang ?> = <?php echo count($page[$item->lang]["extra"]) ?>;
			$("#<?php echo $item->lang ?>_add_field_button").click(function(e){
				e.preventDefault();
				$("#<?php echo $item->lang ?>_input_fields_wrap").append('<div class="row mb-15"><div class="col-xs-12"><hr class="mb-15"></div><div class="col-xs-10"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][key]" placeholder="Başlık" /></div><div class="col-xs-2"><a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a></div><div class="col-xs-12 mt-15"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][value]" placeholder="Bilgi" /></div></div>');
				i_<?php echo $item->lang ?>++;
			});

			$("#<?php echo $item->lang ?>_input_fields_wrap").on("click","#remove_field", function(e){
				e.preventDefault(); $(this).parents('.row.mb-15').remove(); x--;
			});
		<?php endforeach; ?>
	});
</script>