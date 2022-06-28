<!doctype html>
<html lang="<?php echo $this->session->userdata('lang'); ?>" itemscope itemtype="http://schema.org/WebPage" dir="ltr">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="content-language" content="<?php echo $this->session->userdata('lang'); ?>">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="content-language" content="<?php echo $this->session->userdata('lang'); ?>">
	<meta name="description" content="<?php if(@$page['description']){ echo $page['description'];} ?>" />
	<meta name="keywords" content="<?php if(@$page['keywords']){ echo $page['keywords'];} ?>" />
	<title><?php if(@$page['title']){ echo $page['title'].' - '.settings("title");} ?></title>

	<meta name="og:title" content="<?php if(@$page['title']){ echo $page['title'].' - '.settings("title");} ?>">
	<meta name="og:description" content="<?php if(@$page['description']){ echo $page['description'];} ?>">
	<meta name="og:image" content="<?php echo(@$page["list_img"])?$page["list_img"]:settings("logo"); ?>">
	<meta name="og:url" content="<?php echo site_url($this->uri->uri_string); ?>">
	<meta property="og:locale" content="<?php echo $this->session->userdata('lang'); ?>">
	<meta name="og:site_name" content="<?php echo settings("title"); ?>">
	<meta name="og:type" content="website">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?php echo site_url($this->uri->uri_string); ?>">
	<meta name="twitter:title" content="<?php if(@$page['title']){ echo $page['title'].' - '.settings("title");} ?>">
	<meta name="twitter:description" content="<?php if(@$page['description']){ echo $page['description'];} ?>">
	<meta name="twitter:image" content="<?php echo(@$page["list_img"])?$page["list_img"]:settings("logo"); ?>">
	<meta name="twitter:site_name" content="<?php echo settings("title"); ?>">
	<meta name="twitter:creator" content="@egegen">
	<meta name="twitter:site" content="@egegen">

	<meta itemprop="name" content="<?php if(@$page['title']){ echo $page['title'].' - '.settings("title");} ?>">
	<meta itemprop="description" content="<?php if(@$page['description']){ echo $page['description'];} ?>">
	<meta itemprop="url" content="<?php echo site_url($this->uri->uri_string); ?>">
	<meta itemprop="image" content="<?php echo(@$page["list_img"])?$page["list_img"]:settings("logo"); ?>">

	<!-- favicons -->
	<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon"/>
	<link rel="icon" href="assets/img/favicon.png" type="image/x-icon"/>

	<?php if(settings("css_js_cache") == 1): ?>
		<link rel="stylesheet" href="<?php echo minify_assets("css", array(
		"assets/css/main.css"
		)); ?>" />
	<?php else: ?>
		<link rel="stylesheet" href="assets/css/main.css" />
	<?php endif; ?>

	<?php echo settings("google_analytics"); ?>
	<?php echo settings("yandex_metrica"); ?>
	<script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>

	<script>var BASE_URL = "<?php echo site_url(); ?>", LANG = "<?php echo $this->session->userdata('lang'); ?>";</script>
</head>
<body>