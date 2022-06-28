<?php
$this->load->helper('content/content');
$record = get_content(get_lang_id_record(23, "content", $this->session->userdata('lang'))->id);
$extra = json_decode($record['extra']);
?>
<section class="section home-about">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-7">
				<div class="home-about-body">
					<h1 class="main-title"><?php echo $record['summary']; ?></h1>
					<?php echo $record['content']; ?>
					<p>
						<a href="<?php echo $extra[0]->value; ?>" class="btn btn-link lnk-primary"> 
							<span class="text"><?php echo $extra[0]->key; ?></span>
							<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z" fill="#0168b3"/></svg></span>
						</a>
					</p>
				</div>
			</div>
			<div class="col-lg-5 static">
				<div class="home-about-media">
					<div class="embed embed-video">
						<iframe class="embed-item" src="https://www.youtube.com/embed/<?php echo $record['video']; ?>?rel=0&amp;showinfo=0&amp;loop=1" allowfullscreen=""></iframe>
					</div>
				</div>    
			</div>
		</div>
	</div>    
</section>