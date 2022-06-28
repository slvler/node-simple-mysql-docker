<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('content/modules/slider'); ?>
<?php
$this->load->helper('content/content');
$child = get_price_table(19,"tr");
?>

<main id="main" class="pt-2 pb-5 container">
	
	<?php $this->load->view('content/modules/breadcrumb'); ?>
	
	<div class="row">
		<div class="col-12 col-md-3 sidebar">
			<a class="btn btn-primary btn-sidebar collapsed hide-md-up" data-toggle="collapse" href="#clpsSidebar" role="button" aria-expanded="false" aria-controls="collapseExample">
				<span class="mrx-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" fill="#ffffff"/></svg></span>
				<span><?php echo lang_transform("page_list"); ?></span>
			</a>
			<div id="clpsSidebar" class="collapse sidebar-body">
				<?php $this->load->view('content/modules/sidebar'); ?>
			</div>
		</div>
		<div class="col-12 col-md-8 content">
			<table border="1" cellpadding="0" cellspacing="0" class="price-table table table-bordered table-custom">
				<tbody>
					<tr>
						<th>&nbsp;</th>
						<?php foreach (json_decode($child[0]->extra) as $row): ?>
							<th>
								<p align="center"><strong><?php echo $row->key; ?></strong></p>
							</th>
						<?php endforeach ?>
					</tr>
					<?php foreach ($child as $value): ?>
						<tr>
							<?php $title = get_content(get_lang_id_record($value->id,'content',$this->session->userdata('lang'))->id); ?>
							<th>
								<p align="center"><?php echo @$title['title']; ?></p>
							</th>
							<?php $extra = json_decode($value->extra); ?>
							<?php foreach ($extra as $item): ?>
								<td style="vertical-align: middle;">
									<p align="center">
										<strong>
											<?php if ($item->value == "Ücretsiz"): ?>
												<span style="font-size:14px;"><?php echo lang_transform("free"); ?></span>
											<?php else: ?>
												<span style="font-size:14px;"><?php echo ($this->session->userdata("lang")=="tr")?$item->value." ₺":number_format($item->value / settings("currency"),2)." €"; ?></span>
											<?php endif ?>
										</strong>
									</p>
								</td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php echo $page['content']; ?>
		</div>
	</div>
</main>

<?php $this->load->view('home/layout/footer'); ?>