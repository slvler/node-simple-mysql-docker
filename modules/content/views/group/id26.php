<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('content/modules/slider'); ?>
<style>
.table-survey td:first-child{ width: 30%; text-align: left; vertical-align: top !imp<?php echo lang_transform("middle"); ?>nt; }
.table-survey td:last-child{ position: relative; padding: 0 !imp<?php echo lang_transform("middle"); ?>nt; overflow: hidden; }
.table-survey td textarea{ width: 98%; margin: 1%; border-color: #a6a6a6; }
.table-survey td .radio-wrapper{ position: absolute; left: 0; right: 0; top: 0; bottom: 0; }
.table-survey td .radio-wrapper.static .td{ vertical-align: top; }
.table-radio{ display: table; width: 100%; height: 100%; }
.table-radio .td{ display: table-cell; width: 20%; padding: 8px 3px; text-align: center; vertical-align: middle; }
.table-radio .td:nth-child(n+2){ border-left: 1px solid #e1e1e1; }
.radio-input{ display: inline-block; cursor: pointer; }
.radio-input:before{ content: ""; float: left; width: 20px; height: 20px; margin-right: 5px; background-color: #e1e1e1; border: 1px solid #a6a6a6; border-radius: 1px; }
.radio-input.checked:before{ content: url("assets/img/iconRadio.png"); }
</style>

<link href="assets/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/momentjs/locale/tr.js"></script>
<script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

<main id="main" class="pt-2 pb-5 container">
	
	<?php $this->load->view('content/modules/breadcrumb'); ?>

	<div class="row">

		<div class="col-xs-12">

			<form action="<?php echo site_url("contact/survey"); ?>" id="form-survey" method="post" class="text-center">
				<input type="hidden" name="form" value="Anket">
				<h2 class="mini margin-bottom-10"><?php echo lang_transform("general_information"); ?></h2>


				<div class="row">
					
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("name"); ?></label>
						<input type="text" class="form-control " name="g01_s01" id="g01_s01" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("surname"); ?></label>
						<input type="text" class="form-control " name="g01_s02" id="g01_s02" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("phone"); ?></label>
						<input type="text" class="form-control" name="g01_s03" id="g01_s03" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("email"); ?></label>
						<input type="text" class="form-control" name="g01_s04" id="g01_s04" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("address"); ?></label>
						<textarea class="form-control" name="g01_s05" id="g01_s05"></textarea>
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("the_room_number"); ?></label>
						<input type="text" class="form-control " name="g01_s06" id="g01_s06" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("duration_of_the_otel"); ?></label>
						<input type="text" class="form-control " name="g01_s07" id="g01_s07" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("check_in_date"); ?></label>
						<input type="text" class="form-control picker" name="g01_s08" id="g01_s08" value="">
					</div>
					<div class="col-12 col-md-4 mb-1">
						<label for=""><?php echo lang_transform("check_out_date"); ?></label>
						<input type="text" class="form-control zebra no-icon picker" name="g01_s09" id="g01_s09" value="" >
					</div>
				</div>

				<h2 class="mini margin-bottom-10"><?php echo lang_transform("front_office_reception"); ?></h2>

				<table class="table table-bordered table-reservation table-survey">
					<tbody>
						<tr>
							<td></td>
							<td>
								<div class="radio-wrapper static">
									<div class="table-radio">
										<div class="td"><?php echo lang_transform("very_good"); ?></div>
										<div class="td"><?php echo lang_transform("good"); ?></div>
										<div class="td"><?php echo lang_transform("middle"); ?></div>
										<div class="td"><?php echo lang_transform("bad"); ?></div>
										<div class="td"><?php echo lang_transform("very_bad"); ?></div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g02_s01"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s01" value="<?php echo lang_transform("very_good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s01" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s01" value="<?php echo lang_transform("middle"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s01" value="<?php echo lang_transform("bad"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s01" value="<?php echo lang_transform("very_bad"); ?>">
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g02_s02"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s02" alue="5">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s02" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s02" value="<?php echo lang_transform("middle"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s02" value="<?php echo lang_transform("bad"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s02" value="<?php echo lang_transform("very_bad"); ?>">
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g02_s03"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s03" value="<?php echo lang_transform("very_good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s03" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s03" value="<?php echo lang_transform("middle"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s03" value="<?php echo lang_transform("bad"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s03" value="<?php echo lang_transform("very_bad"); ?>">
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g02_s04"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s04" value="<?php echo lang_transform("very_good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s04" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s04" value="<?php echo lang_transform("middle"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s04" value="<?php echo lang_transform("bad"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g02_s04" value="<?php echo lang_transform("very_bad"); ?>">
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g02_s05"); ?></td>
							<td>
								<textarea class="form-control" rows="4" name="g02_s05" id="g02_s05"></textarea>
							</td>
						</tr>
					</tbody>
				</table>

				<h2 class="mini margin-bottom-10"><?php echo lang_transform("housekeeping"); ?></h2>

				<table class="table table-bordered table-reservation table-survey">
					<tbody>
						<tr>
							<td></td>
							<td>
								<div class="radio-wrapper static">
									<div class="table-radio">
										<div class="td"><?php echo lang_transform("very_good"); ?></div>
										<div class="td"><?php echo lang_transform("good"); ?></div>
										<div class="td"><?php echo lang_transform("middle"); ?></div>
										<div class="td"><?php echo lang_transform("bad"); ?></div>
										<div class="td"><?php echo lang_transform("very_bad"); ?></div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g03_s01"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s01" value="<?php echo lang_transform("very_good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s01" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s01" value="<?php echo lang_transform("middle"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s01" value="<?php echo lang_transform("bad"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s01" value="<?php echo lang_transform("very_bad"); ?>">
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo lang_transform("g03_s02"); ?></td>
							<td>
								<div class="radio-wrapper">
									<div class="table-radio">
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s02" value="<?php echo lang_transform("very_good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s02" value="<?php echo lang_transform("good"); ?>">
											</div>
										</div>
										<div class="td">
											<div class="radio-input">
												<input type="radio" required class="" name="g03_s02" value="<?php echo lang_transform("middle"); ?>">
											</div>                                        </div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g03_s03"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g03_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s04" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s04" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s04" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s04" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s04" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s05" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s05" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s05" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s05" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g03_s05" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g03_s06"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("technical_service"); ?></h2>

					<table class="table table-bordered table-reservation table-survey">
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("very_good"); ?></div>
											<div class="td"><?php echo lang_transform("good"); ?></div>
											<div class="td"><?php echo lang_transform("middle"); ?></div>
											<div class="td"><?php echo lang_transform("bad"); ?></div>
											<div class="td"><?php echo lang_transform("very_bad"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g04_s01"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s01" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s01" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s01" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s01" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s01" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g04_s02"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s02" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s02" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s02" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g04_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g04_s04"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("garden"); ?></h2>

					<table class="table table-bordered table-reservation table-survey">
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("very_good"); ?></div>
											<div class="td"><?php echo lang_transform("good"); ?></div>
											<div class="td"><?php echo lang_transform("middle"); ?></div>
											<div class="td"><?php echo lang_transform("bad"); ?></div>
											<div class="td"><?php echo lang_transform("very_bad"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g05_s01"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s01" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s01" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s01" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s01" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s01" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g05_s02"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s02" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s02" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s02" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g05_s03"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s04" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s04" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s04" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s04" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g05_s04" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g05_s05"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("bars_service"); ?></h2>

					<table class="table table-bordered table-reservation table-survey">
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("very_good"); ?></div>
											<div class="td"><?php echo lang_transform("good"); ?></div>
											<div class="td"><?php echo lang_transform("middle"); ?></div>
											<div class="td"><?php echo lang_transform("bad"); ?></div>
											<div class="td"><?php echo lang_transform("very_bad"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g06_s01"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s01" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s01" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s01" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s01" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s01" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g06_s02"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s02" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s02" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s02" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g06_s03"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g06_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s04" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s04" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s04" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s04" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s04" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s05" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s05" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s05" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s05" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g06_s05" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g06_s06"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("food_services_kitchen"); ?></h2>

					<table class="table table-bordered table-reservation table-survey">
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("very_good"); ?></div>
											<div class="td"><?php echo lang_transform("good"); ?></div>
											<div class="td"><?php echo lang_transform("middle"); ?></div>
											<div class="td"><?php echo lang_transform("bad"); ?></div>
											<div class="td"><?php echo lang_transform("very_bad"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s01"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s01" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s01" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s01" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s01" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s01" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s02"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s02" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s02" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s02" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s03"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s04" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s04" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s04" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s04" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s04" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s05"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s05" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s05" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s05" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s05" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s05" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s06"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s06" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s06" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s06" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s06" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s06" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s07"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s07" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s07" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s07" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s07" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s07" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s08"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s08" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s08" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s08" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s08" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s08" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g07_s09"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s09" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s09" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s09" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s09" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s09" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s10" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s10" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s10" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s10" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g07_s10" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g07_s11"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("entertainment_services"); ?></h2>

					<table class="table table-bordered table-reservation table-survey">
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("very_good"); ?></div>
											<div class="td"><?php echo lang_transform("good"); ?></div>
											<div class="td"><?php echo lang_transform("middle"); ?></div>
											<div class="td"><?php echo lang_transform("bad"); ?></div>
											<div class="td"><?php echo lang_transform("very_bad"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g08_s01"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s01" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s01" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s01" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s01" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s01" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g08_s02"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s02" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s02" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s02" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s02" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s02" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g08_s03"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s03" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s03" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s03" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s03" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s03" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g08_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s04" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s04" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s04" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s04" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s04" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g08_s05"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s05" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s05" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s05" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s05" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s05" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s04"); ?></td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s06" value="<?php echo lang_transform("very_good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s06" value="<?php echo lang_transform("good"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s06" value="<?php echo lang_transform("middle"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s06" value="<?php echo lang_transform("bad"); ?>">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g08_s06" value="<?php echo lang_transform("very_bad"); ?>">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php echo lang_transform("g02_s05"); ?></td>
								<td>
									<textarea class="form-control" rows="4" name="g08_s07"></textarea>
								</td>
							</tr>
						</tbody>
					</table>

					<h2 class="mini margin-bottom-10"><?php echo lang_transform("suggestions"); ?></h2>

					<div class="horizontal-scroll">
						<table class="table table-bordered table-reservation table-survey">
							<tbody>
								<tr>
									<td></td>
									<td>
										<div class="radio-wrapper static">
											<div class="table-radio">
												<div class="td"><?php echo lang_transform("yes"); ?></div>
												<div class="td"><?php echo lang_transform("no"); ?></div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td><?php echo lang_transform("g09_s01"); ?></td>
									<td>
										<div class="radio-wrapper">
											<div class="table-radio">
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s01" value="Evet">
													</div>
												</div>
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s01" value="Hayır">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td><?php echo lang_transform("g09_s02"); ?></td>
									<td>
										<textarea class="form-control" rows="4" name="g09_s02"></textarea>
									</td>
								</tr>
								<tr>
									<td><?php echo lang_transform("g09_s03"); ?></td>
									<td>
										<textarea class="form-control" rows="4" name="g09_s03"></textarea>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<div class="radio-wrapper static">
											<div class="table-radio">
												<div class="td"><?php echo lang_transform("g09_s04_1"); ?></div>
												<div class="td"><?php echo lang_transform("g09_s04_2"); ?></div>
												<div class="td"><?php echo lang_transform("g09_s04_3"); ?></div>
												<div class="td"><?php echo lang_transform("g09_s04_4"); ?></div>
												<div class="td"><?php echo lang_transform("g09_s04_5"); ?></div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td><?php echo lang_transform("g09_s04_title"); ?></td>
									<td>
										<div class="radio-wrapper">
											<div class="table-radio">
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s04" value="Acentam Tavsiye Etti">
													</div>
												</div>
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s04" value="Daha Önceki Gelişimde Memnun Kalmıştım">
													</div>
												</div>
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s04" value="Gazete, Dergi vb. İlanlardan">
													</div>
												</div>
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s04" value="Arkadaşım Tavsiye Etti">
													</div>
												</div>
												<div class="td">
													<div class="radio-input">
														<input type="radio" required class="" name="g09_s04" value="İnternetten Buldum">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody></table>
						</div>

						<table class="table table-bordered table-reservation table-survey">
							<tbody><tr>
								<td></td>
								<td>
									<div class="radio-wrapper static">
										<div class="table-radio">
											<div class="td"><?php echo lang_transform("yes"); ?></div>
											<div class="td"><?php echo lang_transform("maybe"); ?></div>
											<div class="td"><?php echo lang_transform("no"); ?></div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Tekrar Gelir Misiniz?</td>
								<td>
									<div class="radio-wrapper">
										<div class="table-radio">
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g09_s05" value="Evet">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g09_s05" value="Belki">
												</div>
											</div>
											<div class="td">
												<div class="radio-input">
													<input type="radio" required class="" name="g09_s05" value="Hayır">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody></table>

						<script>
							$(function() {



                            // radio
                            // $('.radio-input input[type=radio]').attr('checked', false);
                            $('.radio-input').on('click', function() {
                            	$(this).closest('.radio-wrapper').find('.radio-input').removeClass('checked');
                            	$(this).addClass('checked');
                            	$(this).find(':radio').prop('checked', true);
                            });

                            // check class'lari js ile eklenir
                            $('input[type=radio]:checked').closest('.radio-input').addClass('checked');

                        });
                    </script>

                    <button type="submit" class="btn btn-info btn-lg"><?php echo ($this->session->userdata("lang")=="tr")?"ANKETİ TAMAMLA":"FINISH SURVEY"; ?></button>

                </form>

            </div>

        </div>
    </main>

    <?php $this->load->view('home/layout/footer'); ?>
    <script>
    	$(function() {
    		$('.radio-input').on('click', function() {
    			$(this).closest('.radio-wrapper').find('.radio-input').removeClass('checked');
    			$(this).addClass('checked');
    			$(this).find(':radio').prop('checked', true);
    		});
    		$('input[type=radio]:checked').closest('.radio-input').addClass('checked');

    	});
    </script>