<?php
$cur_tab = $this->uri->segment(2) == '' ? 'dashboard' : $this->uri->segment(2);
?>
<style>
    .edit-menu {
        z-index: 999;
        opacity: 0;
        position: absolute;
        margin-left: 190px;
        margin-top: 7px;
    }

    .nav-item:hover .edit-menu {
        z-index: 999;
        opacity: 1;
        position: absolute;
        margin-left: 190px;
        margin-top: 7px;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= ucwords($this->session->userdata('username')); ?></a>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('admin/auth/logout') ?>" class="nav-link btn-light"><?= trans('logout') ?></a>
                </li>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <!--<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
            $menu = get_sidebar_menu();

            foreach ($menu as $nav):

                $sub_menu = get_sidebar_sub_menu($nav['module_id']);

                $has_submenu = (count($sub_menu) > 0) ? true : false;
                ?>

        <?php if ($this->rbac->check_module_permission($nav['controller_name'])): ?>

        <li id="<?= ($nav['controller_name']) ?>" class="nav-item <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview">

          <a href="<?= base_url('admin/' . $nav['controller_name']) ?>" class="nav-link">
            <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i>
            <p>
              <?= trans($nav['module_name']) ?>
              <?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>
            </p>
          </a>


          <?php
                if ($has_submenu):
                    ?>
          <ul class="nav nav-treeview">

            <?php foreach ($sub_menu as $sub_nav): ?>

            <li class="nav-item">
              <a href="<?= base_url('admin/' . $nav['controller_name'] . '/' . $sub_nav['link']); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p><?= trans($sub_nav['name']) ?></p>
              </a>
            </li>

            <?php endforeach; ?>

          </ul>
          <?php endif; ?>

        </li>

        <?php endif; ?>

        <?php endforeach; ?>

        <li class="nav-header"><?= trans('miscellaneous') ?></li>
        <li class="nav-item">
          <a href="https://adminlte.io/docs" class="nav-link">
            <i class="nav-icon fa fa-file"></i>
            <p><?= trans('documentation') ?></p>
          </a>
        </li>
        <li class="nav-header"><?= trans('labels') ?></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-danger"></i>
            <p class="text"><?= trans('important') ?></p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-warning"></i>
            <p><?= trans('warning') ?></p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-info"></i>
            <p><?= trans('informational') ?></p>
          </a>
        </li>
      </ul>-->
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


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
                            class="nav-item <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview need-edition">
                            <?php if ($has_submenu): ?>
                                <a class="edit-menu" href="#" aria-expanded="false"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                            <a href="<?= base_url('admin/' . $nav['controller_name']) ?>" class="nav-link">

                                <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i>
                                <p>
                                    <span class="menu-text"><?= get_menu_option($nav['controller_name'], $module_name) ?></span>
                                    <?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>
                                </p>
                            </a>
                            <?php
                            if ($has_submenu):
                                ?>
                                <ul class="nav nav-treeview">

                                    <?php foreach ($sub_menu as $sub_nav): ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('admin/' . $nav['controller_name'] . '/' . $sub_nav['link']); ?>"
                                               class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p><?= get_menu_option($sub_nav['link'], $sub_nav['name']) ?></p>
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
        </nav>
        <a style="border-top: 1px solid #4f5962;
    border-bottom: 0px;" href="<?= base_url('admin'); ?>" class="brand-link">
            <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" class="brand-image  elevation-3"
                 style="">
            <!-- <span class="brand-text font-weight-light"><?= $this->general_settings['company']; ?></span>-->
        </a>
    </div>

</aside>

<script>
    $("#<?= $cur_tab ?>").addClass('menu-open');
    $("#<?= $cur_tab ?> > a").addClass('active');
</script>
