<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Ana Sayfa</h5>
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
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" <?php echo($item->default == 1)?'required="required"':""; ?> value="<?php echo @$page[$item->lang]['title'] ?>" />
													</div>
													<div class="form-group hidden">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[list_img]">Resim <small>(Listeleme)</small></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[list_img]" name="<?php echo $item->lang ?>_list_img" />
													</div>
													<div class="form-group hidden">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[header_img]">Resim <small>(Üst)</small></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[header_img]" name="<?php echo $item->lang ?>_header_img" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[summary]">Özet</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[summary]" name="<?php echo $item->lang ?>[summary]" placeholder="Ön yazı" rows="3"><?php echo @$page[$item->lang]['summary'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[content]">İçerik</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[content]" name="<?php echo $item->lang ?>[content]"><?php echo @$page[$item->lang]['content'] ?></textarea>
													</div>
													
													<?php $page[$item->lang]['extra'] = json_decode($page[$item->lang]['extra']); ?>
													<hr class="" />
													<div class="row">
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[extra][0]" name="<?php echo $item->lang ?>[extra][0]" placeholder="Alan - 1" value="<?php echo @$page[$item->lang]['extra'][0] ?>" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[extra][1]" name="<?php echo $item->lang ?>[extra][1]" placeholder="Alan - 2" value="<?php echo @$page[$item->lang]['extra'][1] ?>" />
															</div>
														</div>
													</div>
													<hr class="hidden" />
													<div class="row hidden">
														<div class="col-md-12 col-xs-12">
															<div class="form-group">
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[extra][2]" name="<?php echo $item->lang ?>[extra][2]" placeholder="Alan - 3" value="<?php echo @$page[$item->lang]['extra'][2] ?>" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[extra][3]" name="<?php echo $item->lang ?>[extra][3]" placeholder="Alan - 4" value="<?php echo @$page[$item->lang]['extra'][3] ?>" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[extra][4]" name="<?php echo $item->lang ?>[extra][4]" placeholder="Alan - 5" value="<?php echo @$page[$item->lang]['extra'][4] ?>" />
															</div>
														</div>
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