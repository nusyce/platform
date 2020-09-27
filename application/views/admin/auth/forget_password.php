
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(true); ?>
<style>
	.login-box, .register-box {
		width: 360px;
		margin: 7% auto;
	}
</style>
<div class="form-background">

  <div class="login-box">

    <div class="login-logo">

		<img style="    width: 250px;
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    margin-bottom: 20px;
}" src="<?= base_url($this->general_settings['favicon']); ?>">

    </div>

    <!-- /.login-logo -->

    <div class="card">

      <div class="card-body login-card-body">

        <p class="login-box-msg"><?= trans('forgot_password') ?></p>



        <?php $this->load->view('admin/includes/_messages.php') ?>

        

         <?php echo form_open(base_url('admin/auth/forgot_password'), 'class="login-form" '); ?>

          <div class="form-group has-feedback">

            <input type="text" name="email" id="email" class="form-control" placeholder="<?= trans('email') ?>" >

          </div>

          <div class="row">

            <!-- /.col -->

            <div class="col-12">

              <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="<?= trans('submit') ?>">

            </div>

            <!-- /.col -->

          </div>

        <?php echo form_close(); ?>



        <p class="mt-3"><a href="<?= base_url('admin/auth/login'); ?>"><?= trans('you_remember_password') ?> </a></p>



      </div>

      <!-- /.login-card-body -->

    </div>

  </div>

  <!-- /.login-box -->

</div>
<?php init_tail(true); ?>
          





