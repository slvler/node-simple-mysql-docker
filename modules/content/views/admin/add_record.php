<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Yeni İçerik Ekle</h5>
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
										<?php if($item->default == 1): ?><a href="<?php echo site_url('content/admin/index/'.(int)($this->uri->segment(4))); ?>" class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Üst Sayfaya Git"><i class="fa fa-arrow-left"></i></a><?php endif; ?>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach(all_languages() as $item): ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">											
												<div class="col-md-9 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" <?php echo($item->default == 1)?'required="required"':""; ?> />
													</div>
													<div class="row">
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[list_img]">Görsel <small>(Listeleme)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[list_img]" name="<?php echo $item->lang ?>_list_img" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[header_img]">Görsel <small>(Üst)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[header_img]" name="<?php echo $item->lang ?>_header_img" />
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[video]">Video</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[video]" name="<?php echo $item->lang ?>[video]" placeholder="Video Linki" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[summary]">Özet</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[summary]" name="<?php echo $item->lang ?>[summary]" placeholder="Ön yazı" rows="3"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[content]">İçerik</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[content]" name="<?php echo $item->lang ?>[content]"></textarea>
													</div>
												</div>					
												<div class="col-md-3 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Sayfa Tanımı</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]" placeholder="Sayfa Tanımı" rows="3"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[keywords]">Anahtar Kelimeler</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[keywords]" name="<?php echo $item->lang ?>[keywords]" placeholder="Anahtar Kelimeler"></textarea>
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
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>