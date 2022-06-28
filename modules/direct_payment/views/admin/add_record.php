<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Yeni Direkt Ödeme Ekle</h5>
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
										<div class="row">											
											<div class="col-md-9 col-xs-12">
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="language">Kullanıcının Siteyi Görüntüleyeceği Dil</label>
													<select id="language" name="language" class="form-control custom-select">
														<option value="tr">TÜRKÇE</option>
														<option value="en">İNGİLİZCE</option>
													</select>
												</div>										
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="fullname">Ad Soyad</label>
													<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Ödeme yapacak kullanıcının adı soyadı" required />
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="email">E-posta</label>
													<input type="email" class="form-control" id="email" name="email" placeholder="Ödeme yapacak kullanıcının e-posta adresi" required />
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="currency">Para Birimi</label>
													<select id="currency" name="currency" class="form-control custom-select">
														<option value="TL">TL</option>
														<option value="EURO">EURO</option>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="price">Fiyat (TL)</label>
													<input type="text" class="form-control price-format" id="price" name="price" placeholder="Ödeme yapılması istenen tutar" required />
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="installment">Taksit</label>
													<input type="number" class="form-control" id="installment" name="installment" placeholder="Ödeme yapacak kullanıcıya tanımlanacak taksit" required />
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="description">Açıklama (Kullanıcının e-posta içeriğinde göreceği açıklama)</label>
													<textarea class="form-control tinymce" id="description" name="description"></textarea>
												</div>
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