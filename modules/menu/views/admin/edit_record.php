<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Menü Düzenle</h5>
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
								<div  class="pills-struct">
									<ul role="tablist" class="nav nav-pills">
										<?php foreach(all_languages() as $item): ?>
										<li class="<?php echo($item->default == 1)?"active":""; ?>" role="presentation"><a aria-expanded="<?php echo($item->default == 1)?"true":"false"; ?>" data-toggle="tab" role="tab" href="#lang_<?php echo $item->lang ?>"><?php echo $item->language ?></a></li>
										<?php if($item->default == 1): ?><a href="<?php echo site_url('menu/admin/index/'.@$page[$item->lang]['parent']); ?>" class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Üst Sayfaya Git"><i class="fa fa-arrow-left"></i></a><?php endif; ?>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach(all_languages() as $item): ?>
										<input type="hidden" name="<?php echo $item->lang ?>[id]" value="<?php echo @$page[$item->lang]['id'] ?>" />
										<?php if($item->default == 1): ?>
										<input type="hidden" name="lang_id" value="<?php echo @$page[$item->lang]['lang_id'] ?>" />
										<input type="hidden" name="parent" value="<?php echo @$page[$item->lang]['parent'] ?>" />
										<?php endif; ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">									
											<div class="row">
												<div class="col-md-9 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" <?php echo($item->default == 1)?'required="required"':""; ?> value="<?php echo @$page[$item->lang]['title'] ?>" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[content]">Açıklama</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[content]" name="<?php echo $item->lang ?>[content]" placeholder="Açıklama" rows="3"><?php echo @$page[$item->lang]['content'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[modules]">Sayfa Listesi</label>
														<select class="form-control select2" id="<?php echo $item->lang ?>[modules]" name="<?php echo $item->lang ?>[modules]">
															<option selected></option>
															<optgroup label="İçerikler">
																<?php echo $modules["content"][$item->lang]; ?>
															</optgroup>
														</select>
													</div>
													<div class="row">
														<div class="col-md-9 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[url]">Url</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[url]" name="<?php echo $item->lang ?>[url]" placeholder="Url" value="<?php echo @$page[$item->lang]['url'] ?>" />
															</div>
														</div>
														<div class="col-md-3 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[target]">Target</label>
																<select class="form-control" id="<?php echo $item->lang ?>[target]" name="<?php echo $item->lang ?>[target]">
																	<option value="_self" <?php echo("_self" == @$page[$item->lang]['target'])?"selected":""; ?>>Self</option>
																	<option value="_blank" <?php echo("_blank" == @$page[$item->lang]['target'])?"selected":""; ?>>Blank</option>
																	<option value="_parent" <?php echo("_parent" == @$page[$item->lang]['target'])?"selected":""; ?>>Parent</option>
																	<option value="_top" <?php echo("_top" == @$page[$item->lang]['target'])?"selected":""; ?>>Top</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[icon]">Icon <i class="fa fa-info-circle" data-toggle="tooltip" title="Ön yüzde kullanılan icon sınıflarını bu alana tanımlayabilirsiniz. Örneğin 'fa fa-home' gibi."></i></label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[icon]" name="<?php echo $item->lang ?>[icon]" placeholder="Icon sınıfları" value="<?php echo @$page[$item->lang]['icon'] ?>" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[list_img]">Görsel <small>(Listeleme)</small></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[list_img]" name="<?php echo $item->lang ?>_list_img" />
													</div>
													<?php if(! @$page[$item->lang]['list_img'] == ""): ?>
													<div class="panel panel-default">
														<div class="panel-heading"><div class="panel-title">Görsel <small>(Listeleme)</small><a onclick="delete_confirm('<?php echo site_url('menu/admin/delete_record_img/list_img/'.@$page[$item->lang]['id']); ?>')" class="btn btn-default btn-xs pull-right" data-toggle="tooltip" title="Sil"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>
														<img src="<?php echo $page[$item->lang]['list_img']; ?>" class="img-responsive" />
													</div>
													<?php endif; ?>
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
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>

<?php //Listeden içerik seçme fonksiyonu ?>
<script>
	$('.select2').select2({
		placeholder: "Listeden uygun içeriği seçebilirsiniz",
		allowClear: true
	});
	<?php foreach(all_languages() as $item): ?>
	$("#<?php echo $item->lang ?>\\[modules\\]").change(function() {
		$("#<?php echo $item->lang ?>\\[url\\]").val( $("#<?php echo $item->lang ?>\\[modules\\]").val() );
		if ($("#<?php echo $item->lang ?>\\[title\\]").val() == ""){			
			$("#<?php echo $item->lang ?>\\[title\\]").val( $("#<?php echo $item->lang ?>\\[modules\\]").find(':selected').data("title") );
		}
	});
	<?php endforeach; ?>
</script>