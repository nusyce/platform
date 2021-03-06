<style>
	input, button, select, optgroup  {
		margin: 0;
		font-family: inherit;
		font-size: inherit;
		line-height: inherit;
		width: 100%;
		height: 35px;
	}
</style>

<div class="content-wrapper">
	<section class="content">
		<div class="card-header">
			<div class="d-inline-block">
				<h3 class="card-title"> <i class="fa fa-pencil"></i>
					Edit Admin </h3>
			</div>
			<div class="d-inline-block float-right">
				<a href="http://localhost/adminlite/admin/admin" class="btn btn-success"><i class="fa fa-list"></i> Admin List</a>
			</div>
		</div>
		<?php $this->load->view('admin/includes/_messages.php') ?>
		
			<div class="col-md-12">

			<div class="horizontal-scrollable-tabs">

<div class="horizontal-tabs">
	<ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
		<li role="presentation" class="active">
			<a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab" aria-expanded="true">
				Kunden Details                        </a>
		</li>
		<li style="    margin-left: 10px;" role="presentation" class="active">
			<a href="#leistungsempfanger" aria-controls="contact_info" role="tab" data-toggle="tab" aria-expanded="true">
			Leistungsempfänger</a>
		</li>
		<li style="    margin-left: 10px;" role="presentation" class="">
			<a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab" aria-expanded="false">
				Rechnung &amp; Versand                        </a>
		</li>


	</ul>

</div>
</div>

				<div class="tab-content mtop15">
					<div role="tabpanel" class="tab-pane active" id="contact_info">
					<form action="<?php echo base_url('admin/client/save')?>" class="client-form" autocomplete="off" method="post" accept-charset="utf-8">
						<div class="row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="col-md-6">
								<div class="row">
										<?php $value = (isset($client) ? $client->userid : ''); ?>
										<?php echo render_input('userid', '', $value,'hidden'); ?>

									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->company : ''); ?>
										<?php echo render_input('company', 'Firma', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->strabe : ''); ?>
										<?php echo render_input('strabe', 'Straße', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->hausnummer : ''); ?>
										<?php echo render_input('hausnummer', 'Hausnummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->zip : ''); ?>
										<?php echo render_input('zip', 'PLZ', $value); ?>
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
										<?php echo render_input('vat', 'Steuernummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->email : ''); ?>
										<?php echo render_input('email', 'Email', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->phonenumber : ''); ?>
										<?php echo render_input('phonenumber', 'Telefonnummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->website : ''); ?>
										<?php echo render_input('website', 'Webseite', $value); ?>
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
					<input style="width: 150px;" type="submit"  value="Add Kunden" class="btn btn-primary pull-right">
				</div>
			</div></form>
					
					</div>

					<div role="tabpanel" class="tab-pane" id="leistungsempfanger">
					<form action="<?php echo base_url('admin/client/save')?>" class="client-form" autocomplete="off" method="post" accept-charset="utf-8">
						<div class="row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="col-md-6">
								<div class="row">
										<?php $value = (isset($client) ? $client->userid : ''); ?>
										<?php echo render_input('userid', '', $value,'hidden'); ?>

									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->company : ''); ?>
										<?php echo render_input('company', 'Firma', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->strabe : ''); ?>
										<?php echo render_input('strabe', 'Straße', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->hausnummer : ''); ?>
										<?php echo render_input('hausnummer', 'Hausnummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->zip : ''); ?>
										<?php echo render_input('zip', 'PLZ', $value); ?>
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
										<?php echo render_input('vat', 'Steuernummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->email : ''); ?>
										<?php echo render_input('email', 'Email', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->phonenumber : ''); ?>
										<?php echo render_input('phonenumber', 'Telefonnummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($client) ? $client->website : ''); ?>
										<?php echo render_input('website', 'Webseite', $value); ?>
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
					<input style="width: 150px;" type="submit"  value="Add Kunden" class="btn btn-primary pull-right">
				</div>
			</div></form>
					
					</div>
					<div role="tabpanel" class="tab-pane" id="billing_and_shipping">
					<form action="<?php echo base_url('admin/client/save')?>" class="client-form" autocomplete="off" method="post" accept-charset="utf-8">
						<div class="row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="col-md-6">
								<div class="row">
										<?php $value = (isset($client) ? $client->userid : ''); ?>
										<?php echo render_input('userid', '', $value,'hidden'); ?>

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
					        <input style="width: 150px;" type="submit"  value="Add Kunden" class="btn btn-primary pull-right">
				                </div>
			                        </div>
                    </form>
					</div>
				</div>


			</div>
	</section>
</div>
