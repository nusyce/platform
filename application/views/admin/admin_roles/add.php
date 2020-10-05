<!-- Content Wrapper. Contains page content -->
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
						<?php echo get_menu_option(c_menu(), 'Kunder') ?> </h3>
				</div>


			</div>
			<?php $this->load->view('admin/includes/_messages.php') ?>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box">
                    <!-- form start -->
                    <div class="box-body">

                    <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>

                    <?php echo form_open(base_url('admin/admin_roles/add'), 'id="frmvalidate"');  ?> 
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <input class="form-control" type="text" name="admin_role_title" value="<?=isset($record['admin_role_title'])?$record['admin_role_title']:''?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?= trans('admin_role') ?> <?= trans('status') ?></label>

                                        <label>
                                            <input type="radio" name="admin_role_status"  value="1" <?php if(isset($record['admin_role_status']) && $record['admin_role_status']==1 ){echo 'checked';}?> checked="checked">
                                            Active
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="admin_role_status"  value="0" <?php if(isset($record['admin_role_status']) && $record['admin_role_status']==0 ){echo 'checked';}?>>
                                            Inactive
                                        </label>

                                </div>  
                            </div>
							<div class="col-sm-12">
								<input type="submit" name="submit" value="Speichern" class="btn btn-primary pull-right">
							</div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

			</div>
		</div>
<?php init_tail(); ?>
