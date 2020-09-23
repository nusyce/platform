<style>
	.login-box, .register-box {
		width: 500px;
		margin: 7% auto;
	}

	.login-form{
		margin-top: 20px !important;
		margin-bottom: 20px !important;
	}
	.form-background {
		min-height: 100%;
		overflow-x: hidden;
		/* background: url(../img/banner.jpg) bottom; */
		background-size: cover;
		background-color: #e6e3e3;
	}
</style>
<div class="form-background">
	<img style="    width: 250px;
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    margin-bottom: 20px;
}" src="<?php echo base_url().'assets\img\logo.png'?>">
	<p style="text-align: center"> Die Komplett-Losung fur alle Mitarbeiter<br>
		Wir bringen die Zukunft - Jetzt 30 Tage lang kostenlos testen!</p>

	<div class="row" style="margin-top: 25px">
		<div class="col-4">

		</div>
		<div class="col-4">
			<?php $this->load->view('admin/includes/_messages.php') ?>
		</div>
		<div class="col-4">

		</div>
		<div class="col-4"></div>
		<div class="col-4" style="padding-right: 15px;
    padding-left: 15px;"><div class="card-body login-card-body" style="background-color: white">
				<h2 class="login-box-msg">Super Admin Login
					</h2>



				<?php echo form_open(base_url('admin/super_admin/login'), 'class="login-form" '); ?>
				<?php echo render_input('superadmin', '', 'true','hidden'); ?>
				<div class="form-group has-feedback">
					<input type="text" name="username" id="name" class="form-control" placeholder="E-Mail-Adresse or Telefonnummer" >
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" >
				</div>
				<div class="row">
					<div class="col-8">
						<div class="checkbox icheck">
							<label>
								<input type="checkbox"> <?= trans('remember_me') ?>
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="Anmelden">
					</div>
					<!-- /.col -->
				</div>
				<?php echo form_close(); ?>


			</div></div>


		<div class="col-4"></div>
	</div>

  <!-- /.login-box -->
</div>
