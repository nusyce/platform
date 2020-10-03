<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
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
				<div class="col-md-12">

					<div class="horizontal-scrollable-tabs">

						<div class="horizontal-tabs">
							<ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal"
								role="tablist">
								<li role="presentation" class="active">
									<a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab"
									   aria-expanded="true">
										Kunden Details </a>
								</li>
								<li style="    margin-left: 10px;" role="presentation" class="active">
									<a href="#leistungsempfanger" aria-controls="contact_info" role="tab"
									   data-toggle="tab" aria-expanded="true">
										Leistungsempfänger</a>
								</li>
								<li style="    margin-left: 10px;" role="presentation" class="">
									<a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab"
									   data-toggle="tab" aria-expanded="false">
										Rechnung &amp; Versand </a>
								</li>


							</ul>

						</div>
					</div>
					<div class="tab-content mtop15">
						<div role="tabpanel" class="tab-pane active" id="contact_info">
							<form action="<?php echo base_url('admin/client/save') ?>" class="client-form"
								  autocomplete="off" method="post" accept-charset="utf-8">
								<div class="row">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										   value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="col-md-6">
										<div class="row" style="margin-left: -30px;">
											<?php $value = (isset($client) ? $client->userid : ''); ?>
											<?php echo render_input('userid', '', $value, 'hidden'); ?>

											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->company : ''); ?>
												<?php echo render_input('company', get_transl_field('tsl_clients', 'firma', 'Firma'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->strabe : ''); ?>
												<?php echo render_input('strabe', get_transl_field('tsl_clients', 'strabe', 'Strabe'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->hausnummer : ''); ?>
												<?php echo render_input('hausnummer', get_transl_field('tsl_clients', 'hausnummer', 'Hausnummer'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->zip : ''); ?>
												<?php echo render_input('zip', get_transl_field('tsl_clients', 'plz', 'PLZ'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->city : ''); ?>
												<?php echo render_input('city', get_transl_field('tsl_clients', 'stadt', 'Stadt'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->state : ''); ?>
												<?php echo render_input('state', get_transl_field('tsl_clients', 'bundesland', 'Bundesland'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $countries = get_all_countries();
												$customer_default_country = "";
												$selected = (isset($client) ? $client->country : $customer_default_country);
												echo render_select('country', $countries, array('country_id', array('short_name')), 'Nichts ausgewählt', $selected, array('data-none-selected-text' => 'dropdown_non_selected_tex'));
												?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->vat : ''); ?>
												<?php echo render_input('vat', get_transl_field('tsl_clients', 'steuernummer', 'Steuernummer'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->email : ''); ?>
												<?php echo render_input('email', get_transl_field('tsl_clients', 'email', 'Email'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->phonenumber : ''); ?>
												<?php echo render_input('phonenumber', get_transl_field('tsl_clients', 'telefon', 'Telefon'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->website : ''); ?>
												<?php echo render_input('website', get_transl_field('tsl_clients', 'webseite', 'Webseite'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->note : ''); ?>
												<?php echo render_textarea('note', 'Notizen', $value); ?>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<input style="width: 150px;" type="submit" value="Speichern"
											   class="btn btn-primary pull-right">
									</div>
								</div>
							</form>

						</div>

						<div role="tabpanel" class="tab-pane" id="leistungsempfanger">
							<form action="<?php echo base_url('admin/client/save') ?>" class="client-form"
								  autocomplete="off" method="post" accept-charset="utf-8">
								<div class="row">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										   value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="col-md-6">
										<div class="row">
											<?php $value = (isset($client) ? $client->userid : ''); ?>
											<?php echo render_input('userid', '', $value, 'hidden'); ?>

											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->company : ''); ?>
												<?php echo render_input('company', get_transl_field('tsl_clients', 'firma', 'Firma'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->strabe : ''); ?>
												<?php echo render_input('strabe', get_transl_field('tsl_clients', 'strabe', 'Strabe'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->hausnummer : ''); ?>
												<?php echo render_input('hausnummer', get_transl_field('tsl_clients', 'hausnummer', 'Hausnummer'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->zip : ''); ?>
												<?php echo render_input('zip', get_transl_field('tsl_clients', 'plz', 'PLZ'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->city : ''); ?>
												<?php echo render_input('city', get_transl_field('tsl_clients', 'stadt', 'Stadt'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->state : ''); ?>
												<?php echo render_input('state', get_transl_field('tsl_clients', 'bundesland', 'Bundesland'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $countries = get_all_countries();
												$customer_default_country = "";
												$selected = (isset($client) ? $client->country : $customer_default_country);
												echo render_select('country', $countries, array('country_id', array('short_name')), 'Nichts ausgewählt', $selected, array('data-none-selected-text' => 'dropdown_non_selected_tex'));
												?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->vat : ''); ?>
												<?php echo render_input('vat', get_transl_field('tsl_clients', 'steuernummer', 'Steuernummer'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->email : ''); ?>
												<?php echo render_input('email', get_transl_field('tsl_clients', 'email', 'Email'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->phonenumber : ''); ?>
												<?php echo render_input('phonenumber', get_transl_field('tsl_clients', 'telefon', 'Telefon'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->website : ''); ?>
												<?php echo render_input('website', get_transl_field('tsl_clients', 'webseite', 'Webseite'), $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->note : ''); ?>
												<?php echo render_textarea('note', 'Notizen', $value); ?>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<input style="width: 150px;" type="submit" value="Speichern"
											   class="btn btn-primary pull-right">
									</div>
								</div>
							</form>

						</div>
						<div role="tabpanel" class="tab-pane" id="billing_and_shipping">
							<form action="<?php echo base_url('admin/client/save') ?>" class="client-form"
								  autocomplete="off" method="post" accept-charset="utf-8">
								<div class="row">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
										   value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="col-md-6">
										<div class="row">
											<?php $value = (isset($client) ? $client->userid : ''); ?>
											<?php echo render_input('userid', '', $value, 'hidden'); ?>

											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->strabe : ''); ?>
												<?php echo render_textarea('strabe', 'Straße', $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->city : ''); ?>
												<?php echo render_input('city', 'Stadt', $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->state : ''); ?>
												<?php echo render_input('state', 'Bundesland', $value); ?>
											</div>

											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->zip : ''); ?>
												<?php echo render_input('zip', 'PLZ', $value); ?>
											</div>

											<div class="col-md-12">
												<?php $countries = get_all_countries();
												$customer_default_country = "";
												$selected = (isset($client) ? $client->country : $customer_default_country);
												echo render_select('country', $countries, array('country_id', array('short_name')), 'Nichts ausgewählt', $selected, array('data-none-selected-text' => 'dropdown_non_selected_tex'));
												?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->strabe : ''); ?>
												<?php echo render_textarea('strabe', 'Straße', $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->city : ''); ?>
												<?php echo render_input('city', 'Stadt', $value); ?>
											</div>
											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->state : ''); ?>
												<?php echo render_input('state', 'Bundesland', $value); ?>
											</div>

											<div class="col-md-12">
												<?php $value = (isset($client) ? $client->zip : ''); ?>
												<?php echo render_input('zip', 'PLZ', $value); ?>
											</div>

											<div class="col-md-12">
												<?php $countries = get_all_countries();
												$customer_default_country = "";
												$selected = (isset($client) ? $client->country : $customer_default_country);
												echo render_select('country', $countries, array('country_id', array('short_name')), 'Nichts ausgewählt', $selected, array('data-none-selected-text' => 'dropdown_non_selected_tex'));
												?>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<input style="width: 150px;" type="submit" value="Speichern"
											   class="btn btn-primary pull-right">
									</div>
								</div>
							</form>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
