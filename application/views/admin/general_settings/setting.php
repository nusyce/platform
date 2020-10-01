<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
        <div class="card card-default color-palette-bo">
            <div class="card-header">
              <div class="d-inline-block">
                  <h3 class="card-title">
                  <?= trans('general_settings') ?> </h3>
              </div>
            </div>
            <div class="card-body">   
                 <!-- For Messages -->
                <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open_multipart(base_url('admin/general_settings/add')); ?>	
                <!-- Nav tabs -->


                 <!-- Tab panes -->
                <div class="tab-content">

                    <!-- General Setting -->
                    <div role="tabpanel" class="tab-pane active" id="main">



						<div class="row">
						<div class="col-md-6">
							<?php $value = (isset($general_settings) ? $general_settings['company']: ''); ?>
							<?php echo render_input('company', 'Firmenname', $value, 'text'); ?>
							<div id="company_exists_info" class="hide"></div>
							<?php $value = (isset($general_settings) ? $general_settings['vorname']: ''); ?>
							<?php echo render_input('vorname', 'Vorname', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['nachname']: ''); ?>
							<?php echo render_input('nachname', 'Nachname', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['strabe']: ''); ?>
							<?php echo render_input('strabe', 'Stra�e', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['hausnummer']: ''); ?>
							<?php echo render_input('hausnummer', 'Hausnummer', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['zip']: ''); ?>
							<?php echo render_input('zip', 'Postleitzahl', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['city']: ''); ?>
							<?php echo render_input('city', 'Ort', $value); ?>
							<div class="form-group">
								<label class="control-label"><?= trans('default_language') ?></label>
								<?php
								$options = array_column($languages, 'name','id');
								echo form_dropdown('language',$options,$general_settings['default_language'],'class="form-control"');
								?>
							</div>

							<div class="form-group">
								<label class="control-label"><?= trans('copyright') ?></label>
								<input type="text" class="form-control" name="copyright"
									   placeholder="Copyright"
									   value="<?php echo html_escape($general_settings['copyright']); ?>">
							</div>
						</div>
						<div class="col-md-6">
							<?php $value = (isset($general_settings) ? $general_settings['email']: ''); ?>
							<?php echo render_input('email', 'Email', $value, 'email'); ?>
							<?php $value = (isset($general_settings) ? $general_settings['phonenumber']: ''); ?>
							<?php echo render_input('phonenumber', 'Telefon', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['phonenumber_1']: ''); ?>
							<?php echo render_input('phonenumber_1', 'Telefon 1', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['mobil']: ''); ?>
							<?php echo render_input('mobil', 'Mobil', $value); ?>
							<?php $value = (isset($general_settings) ? $general_settings['website']: ''); ?>
							<?php
							echo render_input('website', 'client_website', $value);
							?>

							<?php $value = (isset($general_settings) ? $general_settings['firm_id']: ''); ?>
							<?php echo render_input('firm_id', 'Umsatzsteuer-ID', $value); ?>
							<div class="form-group">
								<label class="control-label"><?= trans('favicon') ?> (25*25)</label><br/>
								<?php if(!empty($general_settings['favicon'])): ?>
									<p><img style="width: 200px;" src="<?= base_url($general_settings['favicon']); ?>" class="favicon"></p>
								<?php endif; ?>
								<input type="file" name="favicon" accept=".png, .jpg, .jpeg, .gif, .svg">
								<p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg</small></p>
								<input type="hidden" name="old_favicon" value="<?php echo html_escape($general_settings['favicon']); ?>">
							</div>
							<div class="form-group">
								<label class="control-label"><?= trans('logo') ?></label><br/>
								<?php if(!empty($general_settings['logo'])): ?>
									<p><img src="<?= base_url($general_settings['logo']); ?>" class="logo" width="150"></p>
								<?php endif; ?>
								<input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif, .svg">
								<p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg</small></p>
								<input type="hidden" name="old_logo" value="<?php echo html_escape($general_settings['logo']); ?>">
							</div>
						</div>
						</div>
                    </div>

                    <!-- Email Setting -->


                    <!-- Social Media Setting -->


                </div>

                <div class="box-footer">
                    <input type="submit" name="submit" value="<?= trans('save_changes') ?>" class="btn btn-primary pull-right">
                </div>	
                <?php echo form_close(); ?>
            </div>
        </div>
		</div>
	</div>
</div>
<?php init_tail(); ?>


