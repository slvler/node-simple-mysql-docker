<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Yeni Slider Ekle</h5>
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
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">											
												<div class="col-md-9 col-xs-12">										
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[type]">Medya Tipi Seçimi <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Eklemek istediğiniz medyanın tipini seçiniz. Seçtiğiniz tip dışında yükleme yaparsanız işlem gerçekleşmeyecektir."></i></label>
														<select class="form-control" name="<?php echo $item->lang ?>[type]" id="<?php echo $item->lang ?>[type]">
															<option value="image">Görsel</option>
															<option value="video">Video</option>
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
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[video]" name="<?php echo $item->lang ?>[video]" placeholder="Video Linki" />
															</div>
														</div>
														<div class="col-md-3 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[video_type]">Video Platform Seçimi <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Eklemek istediğiniz videonun platformunu seçin. Seçtiğiniz platform dışında yükleme yaparsanız işlem gerçekleşmeyecektir."></i></label>
																<select class="form-control" name="<?php echo $item->lang ?>[video_type]" id="<?php echo $item->lang ?>[video_type]">
																	<option value="youtube">Youtube</option>
																	<option value="vimeo">Vimeo</option>
																</select>
															</div>
														</div>
													</div>
													<hr />
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Açıklama</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]"></textarea>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-8 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[link]">Link</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[link]" name="<?php echo $item->lang ?>[link]" placeholder="Slider Linki" />
															</div>
														</div>
														<div class="col-md-4 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[btn_name]">Buton Adı</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[btn_name]" name="<?php echo $item->lang ?>[btn_name]" placeholder="Buton Adı" value="Detaylar" />
															</div>
														</div>
													</div>
												</div>					
												<div class="col-md-3 col-xs-12"></div>
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
	$("#<?php echo $item->lang ?>\\[type\\]").change(function() {
		$("#<?php echo $item->lang ?>_image_media_frame").hide();
		$("#<?php echo $item->lang ?>_video_media_frame").hide();
		$("#<?php echo $item->lang ?>_"+$(this).val()+"_media_frame").show();
	});
	<?php endforeach; ?>
</script>