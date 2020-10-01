<style>

	.nav-item:hover .edit-menu {
		z-index: 999;
		opacity: 1;
		position: absolute;
		margin-left: 190px;

	}

	.fa-pencil {
		font-size: 18px !important;
	}

	p {
		margin-top: 0;
		margin-bottom: 0px;
	}

	.open .menu-text {
		color: #323a45 !important;
	}

	.menu-text {
		font-size: 13px;
		color: white;
	}

	.main-menu.menu-light .navigation > li {
		margin: 0 0;
		transition: background-color 0.5s ease;
		margin-left: 0px;
		margin-top: 10px;
	}

	.nav-item .icon-nav-item {
		color: white;
	}

	.edit-menu .fa {
		color: white;
	}
</style>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="navbar-header">
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url('admin') ?>">

					<h2 style="padding-left: 0px;"
						class="brand-text mb-0"><?= $this->general_settings['company']; ?></h2>
				</a></li>
			<li class="nav-item mobile-menu d-xl-none mr-auto for-mobile" style="margin-right: 20px !important;
    margin-top: 10px;"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#" style="color: white!important;"><i class="ficon bx bx-menu" style="font-size: 25px !important;"></i></a></li>

		</ul>


	</div>
	<div class="shadow-bottom"></div>
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
			data-icon-style="lines">
			<?php
			$menu = get_sidebar_menu();

			foreach ($menu as $nav):

				$sub_menu = get_sidebar_sub_menu($nav['module_id']);
				$module_name = $nav['module_name'];
				$mymodule_name = get_admin_module_names();
				foreach ($mymodule_name as $mod_name) {
					if ($nav['module_id'] == $mod_name['id_module']) {
						$module_name = $mod_name['module_name'];
					}
				}
				$has_submenu = (count($sub_menu) > 0) ? true : false;
				if ($nav['controller_name'] != 'admin_roles'):
					?>

					<?php if ($this->rbac->check_module_permission($nav['controller_name'])): ?>

					<li id="<?= ($nav['controller_name']) ?>" data-traget="<?= ($nav['controller_name']) ?>"
						class="nav-item <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview need-edition <?= ($this->uri->segment(2)==$nav['controller_name']) ? 'active' : '' ?> <?= ($this->uri->segment(2)==$nav['controller_name']&&$has_submenu) ? 'open' : '' ?>">
						<?php if ($has_submenu): ?>
							<a class="edit-menu" href="#" aria-expanded="false"><i class="fa fa-pencil"></i></a>
						<?php endif; ?>
						<a href="<?= base_url('admin/' . $nav['controller_name']) ?>" class="nav-link">

							<i class="nav-icon fa <?= $nav['fa_icon'] ?> icon-nav-item"></i>
							<p>
								<span class="menu-text"><?= get_menu_option($nav['controller_name'], $module_name) ?></span>
								<!--<?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>-->
							</p>
						</a>
						<?php
						if ($has_submenu):
							?>
							<ul class="menu-content">

								<?php foreach ($sub_menu as $sub_nav): ?>
									<li class="nav-item <?= ($this->uri->segment(2).'/'.$this->uri->segment(3)==$nav['controller_name'].'/'. $sub_nav['link']) ? 'active' : '' ?>" >
										<a href="<?= base_url('admin/' . $nav['controller_name'] . '/' . $sub_nav['link']); ?>"
										   class="nav-link">

											<p class="p-nav-link"><?= $sub_nav['name'] ?></p>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

					</li>

				<?php endif; ?>
				<?php endif; ?>
				<?php // $data['module_id'] = $nav['module_id'];$data['module_name'] = $module_name; $this->load->view('admin/includes/menu-edite',$data)
				?>
			<?php endforeach; ?>


		</ul>
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item mr-auto">
				<div class="brand-logo"><img style="width: 150px;
    margin-left: 10px;margin-top: 10px" class="logo" src="<?= base_url($this->general_settings['favicon']); ?>"/></div>
				<!--<h2 class="brand-text mb-0">Frest</h2>-->
			</li>

		</ul>
	</div>

</div>
