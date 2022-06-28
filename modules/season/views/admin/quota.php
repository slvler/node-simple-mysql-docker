<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Günlük Stok</h5>
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
								<div class="tab-content">
									<div id="lang" class="tab-pane fade active in" role="tabpanel">
										<input type="hidden" name="season_id" value="<?php echo @$page['id']; ?>">
										<div class="row">											
											<div class="col-md-9 col-xs-12">										
												<div class="form-group">
													<p class="control-label text-left">Sezon Adı: <?php echo @$page['title']; ?></p>
													<label class="control-label mb-10 text-left">Sezon Tarihi: <?php echo date("d-m-Y", strtotime(@$page['start_date']))." - ".date("d-m-Y", strtotime(@$page['end_date'])); ?></label>
													<p>Her tarihe günlük oda stok bilgisi girebilirsiniz. Boş bıraktıklarınız stok sınırlaması yok olarak algılanacaktır. - olarak giriş yaparsanız odaya ait stok olmayacak ve rezervasyon yapılamayacaktır.</p>
												</div>
												<?php
												// iki tarih arasındaki günleri alıyoruz.
												$days = date_between_admin(date("Y-m-d", strtotime(@$page['start_date'])),date("Y-m-d", strtotime(@$page['end_date'])));
												$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
												$val = "";
												?>
												<?php foreach ($days as $row): ?>
													<?php
													$day = explode("-", $row);
													foreach ($quota as $value) {
														if ($day[2]."-".$day[1] == $value->title) {
															$val = $value->quota;
														}
													}
													?>
													<div style="display: inline-block;">
														<p><strong><?php echo $day[2]." ".$tr_months[(int)$day[1]-1]; ?></strong></p>
														<input type="text" name="quota[<?php echo $day[2]."-".$day[1]; ?>]" value="<?php echo $val; ?>">
													</div>
													<?php $val = ""; ?>
												<?php endforeach ?>
											</div>
											<div class="col-md-3 col-xs-12"></div>
										</div>
									</div>
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