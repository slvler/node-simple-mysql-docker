<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Slider düzenle</h5>
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
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[type]">Medya Tipi Seçimi <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Eklemek istediğiniz medyanın tipini seçiniz. Seçtiğiniz tip dışında yükleme yaparsanız işlem gerçekleşmeyecektir."></i></label>
														<select class="form-control" name="<?php echo $item->lang ?>[type]" id="<?php echo $item->lang ?>[type]">
															<option value="image" <?php echo(@$page[$item->lang]['type'] == 'image')?"selected":""; ?>>Görsel</option>
															<option value="video" <?php echo(@$page[$item->lang]['type'] == 'video')?"selected":""; ?>>Video</option>
														</select>
													</div>
													<div class="row" id="<?php echo $item->lang ?>_image_media_frame">
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_media">Görsel <small>(Slider)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>_media" name="<?php echo $item->lang ?>_media" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_media_mobile">Görsel <small>(Mobil slider)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>_media_mobile" name="<?php echo $item->lang ?>_media_mobile" />
															</div>
														</div>
													</div>
													<div class="row" id="<?php echo $item->lang ?>_video_media_frame">
														<div class="col-md-9 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[video]">Video <small>(Slider)</small></label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[video]" name="<?php echo $item->lang ?>[video]" value="<?php echo(@$page[$item->lang]['type'] == 'video')? @$page[$item->lang]['media'] :""; ?>" />
															</div>
														</div>
														<div class="col-md-3 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[video_type]">Video Platform Seçimi <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Eklemek istediğiniz videonun platformunu seçin. Seçtiğiniz platform dışında yükleme yaparsanız işlem gerçekleşmeyecektir."></i></label>
																<select class="form-control" name="<?php echo $item->lang ?>[video_type]" id="<?php echo $item->lang ?>[video_type]">
																	<option value="youtube" <?php echo(@$page[$item->lang]['video_type'] == 'youtube')?"selected":""; ?>>Youtube</option>
																	<option value="vimeo" <?php echo(@$page[$item->lang]['video_type'] == 'vimeo')?"selected":""; ?>>Vimeo</option>
																</select>
															</div>
														</div>
													</div>
													<hr />
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" value="<?php echo @$page[$item->lang]['title'] ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Açıklama</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]"><?php echo @$page[$item->lang]['description'] ?></textarea>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-8 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[link]">Link</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[link]" name="<?php echo $item->lang ?>[link]" value="<?php echo @$page[$item->lang]['link'] ?>" />
															</div>
														</div>
														<div class="col-md-4 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[btn_name]">Buton Adı</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[btn_name]" name="<?php echo $item->lang ?>[btn_name]" value="<?php echo @$page[$item->lang]['btn_name'] ?>" />
															</div>
														</div>
													</div>
												</div>					
												<div class="col-md-3 col-xs-12">
													<?php if (@$page[$item->lang]['type'] == "image"): ?>
													<div class="panel panel-default">
														<div class="panel-heading"><div class="panel-title">Mevcut Görsel</div></div>
														<img src="<?php echo @$page[$item->lang]['media']; ?>" class="img-responsive" />
													</div>
													<div class="panel panel-default">
														<div class="panel-heading"><div class="panel-title">Mevcut Görsel <small>(Mobil)</small></div></div>
														<img src="<?php echo @$page[$item->lang]['media_mobile']; ?>" class="img-responsive" />
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

<?php //Medya tipi seçme fonksiyonu ?>
<script>
	<?php foreach(all_languages() as $item): ?>
	$("#<?php echo $item->lang ?>_video_media_frame").hide();
	$("#<?php echo $item->lang ?>_image_media_frame").hide();
	<?php if(@$page[$item->lang]['type'] != ""): ?>
	$("#<?php echo $item->lang ?>_<?php echo @$page[$item->lang]['type'] ?>_media_frame").show();
	<?php else: ?>
	$("#<?php echo $item->lang ?>_image_media_frame").show();
	<?php endif; ?>
	$("#<?php echo $item->lang ?>\\[type\\]").change(function() {
		$("#<?php echo $item->lang ?>_image_media_frame").hide();
		$("#<?php echo $item->lang ?>_video_media_frame").hide();
		$("#<?php echo $item->lang ?>_"+$(this).val()+"_media_frame").show();
	});
	<?php endforeach; ?>
</script>