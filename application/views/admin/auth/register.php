<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(true); ?>
<style>
	.login-box, .register-box {
		width: 360px;
		margin: 7% auto;
	}
</style>
<div class="form-background">
  <div class="register-box">
    <div class="register-logo">
		<img style="    width: 250px;
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    margin-bottom: 20px;
}" src="<?= base_url($this->general_settings['favicon']); ?>">
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <h4 class="login-box-msg">register new membership</h4>

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <?php echo form_open(base_url('admin/auth/register'), 'class="login-form" '); ?>
          <div class="form-group has-feedback">
             <input required type="text" name="username" id="name" value="" class="form-control" placeholder="username" >
          </div>
          <div class="form-group has-feedback">
            <input type="text" required name="firstname" id="firstname" value="" class="form-control" placeholder="firstname" >
          </div>
          <div class="form-group has-feedback">
           <input type="text" name="lastname" id="lastname" value="" class="form-control" placeholder="lastname" >
          </div>
          <div class="form-group has-feedback">
             <input required type="text" name="email" id="email" value="" class="form-control" placeholder="email" >
          </div>
		  <div class="form-group has-feedback">
			  <input required type="text" name="companyname" id="companyname" value="" class="form-control" placeholder="companyname" >
		  </div>
          <div class="form-group has-feedback">
             <input type="password" name="password" id="password" class="form-control" placeholder="password" >
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="confirm" >
          </div>
          <div class="row">
            <div class="col-8">

                <label>
                  <input type="checkbox"> i agree to the terms</a>
                </label>

            </div>
            <?php if($this->recaptcha_status): ?>
              <div class="recaptcha-cnt">
                  <?php generate_recaptcha(); ?>
              </div>
            <?php endif; ?>
            <!-- /.col -->
			  <div class="col-5"  >
              <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="register" style="width: 120px;">
            </div>
            <!-- /.col -->
          </div>
        <?php echo form_close(); ?>

        <a href="<?= base_url('admin/auth/login'); ?>" class="text-center">i already have membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
</div>
<?php init_tail(true); ?>
