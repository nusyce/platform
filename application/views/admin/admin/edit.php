<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- For Messages --><div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<div class="card">

				<div class="d-inline-block">
					<h3 class="card-title" style="margin: 0;">
						<?php echo get_menu_option(c_menu(), 'Admin') ?> </h3>
				</div>


			</div>
        <div class="panel-body">
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/admin/edit/'.$admin['admin_id']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="username" class="col-md-2 control-label">username</label>

                <div class="col-md-12">
                  <input type="text" name="username" value="<?= $admin['username']; ?>" class="form-control" id="username" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-md-2 control-label">firstname</label>

                <div class="col-md-12">
                  <input type="text" name="firstname" value="<?= $admin['firstname']; ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-md-2 control-label">lastname</label>

                <div class="col-md-12">
                  <input type="text" name="lastname" value="<?= $admin['lastname']; ?>" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-2 control-label">email</label>

                <div class="col-md-12">
                  <input type="email" name="email" value="<?= $admin['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label">mobile_no</label>

                <div class="col-md-12">
                  <input type="number" name="mobile_no" value="<?= $admin['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="role" class="col-md-2 control-label">select_status</label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value="">select_status</option>
                    <option value="1" <?= ($admin['active'] == 1)?'selected': '' ?> >active</option>
                    <option value="0" <?= ($admin['active'] == 0)?'selected': '' ?>>inactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-12 control-label">password</label>
                <div class="col-md-12">
                  <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="role" class="col-md-2 control-label">select_admin_role *</label>

                <div class="col-md-12">
                  <select name="role" class="form-control">
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($admin_roles as $role): ?>
                      <?php if($role['admin_role_id'] == $admin['admin_role_id']): ?>
                        <option value="<?= $role['admin_role_id']; ?>" selected><?= $role['admin_role_title']; ?></option>
                        <?php else: ?>
                          <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <p style="text-align: right"><input type="submit" name="submit" value="Speichern" class="btn btn-primary"></p>
                  </div>
                </div>
                <?php echo form_close(); ?>
              </div>
              <!-- /.box-body -->
            </div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
