<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>Plateform</title>
	<link rel="apple-touch-icon" href="<?= base_url($this->general_settings['favicon']); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url($this->general_settings['favicon']); ?>">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/vendors/css/charts/apexcharts.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/vendors/css/extensions/swiper.min.css">
	<!-- END: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/themes/semi-dark-layout.css">
	<!-- END: Theme CSS-->

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/app/css/pages/dashboard-ecommerce.css">
	<!-- END: Page CSS-->


	<!-- END: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/plugin/datatables/datatables.css">
	<link rel="stylesheet" type="text/css" id="roboto-css" href="<?php echo site_url('assets/plugins/roboto/roboto.css'); ?>">

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/css/style.css">


	<style>
		body {
			font-family: Roboto, Geneva, sans-serif;
			font-size:15px;
		}

		.bold, b, strong, h1,h2,h3,h4,h5,h6 {
			font-weight: 400;
		}
		.panel_s .panel-body {
			background: #fff;
			border: 1px solid #dce1ef;
			border-radius: 4px;
			padding: 20px;
			position: relative;
		}

	</style>


<script>
	var admin_url="<?php echo base_url('admin/') ?>";
	var csrfTokenName="<?php $this->security->get_csrf_token_name(); ?>";
	var csrfTokenHash="<?php echo $this->security->get_csrf_hash(); ?>";
</script>




</head>
