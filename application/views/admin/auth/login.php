<!-- Content Wrapper. Contains page content -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(true); ?>

<style>
	.login-box, .register-box {
		width: 500px;
		margin: 7% auto;
	}

	.login-form {
		margin-top: 20px !important;
		margin-bottom: 20px !important;
	}

	.row {
		display: flex;
		flex-wrap: wrap;
		margin-right: 0px;
		margin-left: -15px;
	}

	.col-4 {
		width: 100%;
		padding-right: 0px;
		padding-left: 0px;
	}

	.login-panel {
		margin-bottom: 30px;
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
}" src="<?= base_url($this->general_settings['favicon']); ?>">
	<p style="text-align: center"> Die Komplett-Losung fur alle Mitarbeiter<br>
		Wir bringen die Zukunft - Jetzt 30 Tage lang kostenlos testen!</p>

	<div class="row" style="margin-top: 25px">
		<div class="col-md-3">

		</div>
		<div class="col-md-6">
		</div>
		<div class="col-md-3">

		</div>
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-3 login-panel" style="padding-right: 15px;
    padding-left: 15px;">
			<div class="card-body login-card-body" style="background-color: white">
				<h2 class="login-box-msg"> Admin Login
				</h2>


				<?php echo form_open(base_url('admin/auth/login'), 'class="login-form" '); ?>
				<?php echo render_input('admin', '', 'true', 'hidden'); ?>
				<div class="form-group has-feedback">
					<input type="text" name="username" id="name" class="form-control"
						   placeholder="E-Mail-Adresse or Telefonnummer">
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				</div>
				<div class="row">
					<div class="col-7">

							<label>
								<input type="checkbox">remember me
							</label>

					</div>

					<!-- /.col -->
					<div class="col-5" style="padding: 0">
						<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat"
							   value="Anmelden">
					</div>
					<!-- /.col -->
				</div>
				<?php echo form_close(); ?>

				<p class="mb-1">
					<a href="<?= base_url('admin/auth/forgot_password'); ?>">Passwort vergessen?</a>
				</p>
				<p class="mb-0">
					<a href="<?= base_url('admin/auth/register'); ?>" class="text-center">Neues Konto erstellen</a>
				</p>
			</div>
		</div>

		<div class="col-md-3 login-panel" style="padding-right: 15px;
    padding-left: 15px;">
			<div class="card-body login-card-body" style="background-color: white">
				<h2 class="login-box-msg"> Workers Login
				</h2>
				<?php echo form_open(base_url('admin/auth/login'), 'class="login-form2" '); ?>
				<div class="form-group has-feedback">
					<input type="text" name="username" id="name" class="form-control"
						   placeholder="E-Mail-Adresse or Telefonnummer">
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				</div>
				<div class="row">
					<div class="col-7">

							<label>
								<input type="checkbox"> remember me
							</label>

					</div>
					<!-- /.col -->
					<div class="col-5" style="padding: 0">
						<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat"
							   value="Anmelden">
					</div>
					<!-- /.col -->
				</div>
				<?php echo form_close(); ?>

				<p class="mb-1">
					<a href="<?= base_url('admin/auth/forgot_password'); ?>">Passwort vergessen?</a>
				</p>

			</div>
		</div>
		<div class="col-md-3"></div>
	</div>

	<!-- /.login-box -->
</div>

<?php init_tail(true); ?>
