<!-- BEGIN: Body-->
<style>
	.digital-clock{
		margin-left: 10px;
		font-size: 18px;
		color: white;
	}
</style>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
	<div class="navbar-wrapper">
		<div class="navbar-container content">
			<div class="navbar-collapse" id="navbar-mobile">
				<div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
					<ul class="nav navbar-nav">
						<li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs " href="#"><i class="ficon bx bx-menu"></i></a></li>
					</ul>
					<ul class="nav navbar-nav bookmark-icons">
						<li class="nav-item nav-toggle toggle-desktop"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary " ></i><i style="font-size: 20px !important;color: white;" class=" fa fa-bars" data-ticon="bx-disc"></i></a></li>

					</ul>
				</div>
				<ul class="nav navbar-nav float-right" style="float: right !important;">
					<br>
					<div class="digital-clock"></div>
					<!--<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
						<div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
					</li>
					<li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
					<li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
						<div class="search-input">
							<div class="search-input-icon"><i class="bx bx-search primary"></i></div>
							<input class="input" type="text" placeholder="Explore Frest..." tabindex="-1" data-search="template-search">
							<div class="search-input-close"><i class="bx bx-x"></i></div>
							<ul class="search-list"></ul>
						</div>
					</li>-->

					<li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
							<div class="user-nav d-sm-flex d-none"><span style="color: white" class="user-name"><?= ucwords($this->session->userdata('username')); ?></span></div><span><img class="round" src="<?= base_url()?>/assets/img/user-placeholder.jpg" alt="avatar" height="40" width="40"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right pb-0"><!--<i class="bx bx-user mr-50"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="bx bx-envelope mr-50"></i> My Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="bx bx-check-square mr-50"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="bx bx-message mr-50"></i> Chats</a>-->
							<a class="dropdown-item" href="<?= base_url('admin/package') ?>">Membership</a>
							<div class="dropdown-divider mb-0"></div>
							<a class="dropdown-item" href="<?= base_url('admin/auth/logout') ?>"><!--<i class="bx bx-power-off mr-50"></i>-->Abmelden</a>
						</div>
					</li>
                     <div id="notif-zone"></div>
				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- END: Header-->
