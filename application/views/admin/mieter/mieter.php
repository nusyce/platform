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
	
		<?php $this->load->view('admin/includes/_messages.php') ?>
		
		<form action="<?php echo base_url('admin/mieter/save')?>" class="client-form" autocomplete="off" method="post" accept-charset="utf-8">
						<div class="row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="col-md-6">
							<h3>Private Informationen</h3>
								<div class="row">
										<?php $value = (isset($mieter) ? $mieter->id : ''); ?>
										<?php echo render_input('id', '', $value,'hidden'); ?>

									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->fullname : ''); ?>
										<?php echo render_input('fullname', 'Vollständiger Name', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->vorname : ''); ?>
										<?php echo render_input('vorname', 'Vorname', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->nachname : ''); ?>
										<?php echo render_input('nachname', 'Nachname', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->email : ''); ?>
										<?php echo render_input('email', 'Email', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->strabe_m : ''); ?>
										<?php echo render_input('strabe_m', 'Straße', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->hausnummer_m : ''); ?>
										<?php echo render_input('hausnummer_m', 'Hausnummer', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->wohnungsnummer : ''); ?>
										<?php echo render_input('wohnungsnummer', 'Wohnungsnummer', $value); ?>
									</div>


									<div class="col-md-12">

										<?php $data = [];
										$data[] = array('value' => 'UG');
										$data[] = array('value' => 'EG');
										$data[] = array('value' => '1. OG');
										$data[] = array('value' => '2. OG');
										$data[] = array('value' => '3. OG');
										$data[] = array('value' => '4. OG');
										$data[] = array('value' => '5. OG');
										$data[] = array('value' => '6. OG');
										$data[] = array('value' => '7. OG');
										$data[] = array('value' => '8. OG');
										$data[] = array('value' => '9. OG');
										$data[] = array('value' => '10. OG');
										$value = (isset($mieter) ? $mieter->etage : ''); ?>
										<?php echo render_select('etage', $data, array('value', 'value'), 'Etage', $value); ?>
									</div>
									<div class="col-md-12">
										<?php
										$data = [];
										$data[] = array('value' => 'Links');
										$data[] = array('value' => 'Rechts');
										$data[] = array('value' => 'Mitte');
										$data[] = array('value' => 'Mitte/Links');
										$data[] = array('value' => 'Mitte/Rechts');
										$value = (isset($mieter) ? $mieter->flugel : ''); ?>
										<?php echo render_select('flugel', $data, array('value', 'value'), 'Fl�gel', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->plz : ''); ?>
										<?php echo render_input('plz', 'PLZ', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->stadt : ''); ?>
										<?php echo render_input('stadt', 'Stadt', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_1 : ''); ?>
										<?php echo render_input('telefon_1', 'Telefon 1', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_2 : ''); ?>
										<?php echo render_input('telefon_2', '²Telefon 2', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->telefon_3 : ''); ?>
										<?php echo render_input('telefon_3', 'Telefon 3', $value); ?>
									</div>
									<div class="col-md-12">
										<?php $value = (isset($mieter) ? $mieter->notice : ''); ?>
										<?php echo render_textarea('notice', 'Notice', $value); ?>
									</div>
									<div class="col-md-12">
									<p>Besonderheit</p>
									<div class="row">
									<div class="col-md-6">
									<div class="col-md-12">
										<?php $selected = isset($mieter) && $mieter->haustiere == '1' ? 1 : 0;
										$datas = array(array('id' => 0, 'value' => 'Nein'), array('id' => 1, 'value' => 'Ja'));
										echo render_select('haustiere', $datas, array('id', 'value'), 'Haustiere', $selected); ?>

									</div>
									</div>
									<div class="col-md-6">
									<div class="col-md-12">
										<?php $selected = isset($mieter) && $mieter->raucher == '1' ? 1 : 0;
										$datas = array(array('id' => 0, 'value' => 'Nein'), array('id' => 1, 'value' => 'Ja'));
										echo render_select('raucher', $datas, array('id', 'value'), 'Raucher', $selected); ?>

									</div>
									</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
							<h3>Projekt:</h3>
								<div class="row">
								<div class="col-md-12">
								<?php $projects = get_all_projects();
										$customer_default_projektname = "";
										$selected = (isset($mieter) ? $mieter->projektname : $customer_default_projektname);
										echo render_select('projektname', $projects, array('name', array('name')), 'Projekt', $selected, array('data-none-selected-text' => 'dropdown_non_selected_tex'));
										?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->baubeginn : ''); ?>
										<?php echo render_input('baubeginn', 'Baubeginn', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->bauende : ''); ?>
										<?php echo render_input('bauende', 'Bauende', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->beraumung : ''); ?>
										<?php echo render_input('beraumung', 'Beräumung', $value,'date'); ?>
									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->ruckraumung : ''); ?>
										<?php echo render_input('ruckraumung', 'RückräumungZ', $value,'date'); ?>
									</div>
									<div class="col-md-12">
					
									<h5> Fenstereinbau</h5>
									
									</div>
									<div class="col-md-6">

										<?php
										$datas = array(array('id' => "Vollsanierung", 'value' => 'Vollsanierung'), array('id' => 'Nur Fenster', 'value' => 'Nur Fenster'));
										echo render_select('fenstereinbau', $datas, array('id', 'value'), 'Art', $selected); ?>


									</div>
									<div class="col-md-6">
									<?php $value = (isset($mieter) ? $mieter->fenstereinbau_d : ''); ?>
										<?php echo render_input('fenstereinbau_d', 'Fenstereinbau Datum', $value,'date'); ?>
									</div>
									<div class="col-md-12">
					
									<h5> Keller</h5>
									
									</div>
									<div class="col-md-4">
					
									<?php $value = (isset($mieter) ? $mieter->k_nummer : ''); ?>
										<?php echo render_input('k_nummer', 'Kellernummer', $value); ?>
									
									</div>
									<div class="col-md-4">
									<?php $value = (isset($mieter) ? $mieter->k_baubeginn : ''); ?>
										<?php echo render_input('k_baubeginn', 'Keller Beräumung', $value,'date'); ?>
									</div>
									<div class="col-md-4">
									<?php $value = (isset($mieter) ? $mieter->k_ruckraumung : ''); ?>
										<?php echo render_input('k_ruckraumung', 'Keller R?ckr?umung', $value,'date'); ?>
									</div>
									<div class="col-md-12">

										<h5>Ausweichkeller</h5>

									</div>
									<div class="col-md-4">

										<?php $value = (isset($mieter) ? $mieter->strabe_a : ''); ?>
										<?php echo render_input('strabe_a', 'Straße', $value); ?>

									</div>
									<div class="col-md-4">
										<?php $value = (isset($mieter) ? $mieter->hausnummer_a : ''); ?>
										<?php echo render_input('hausnummer_a', 'Hausnummer', $value); ?>
									</div>
									<div class="col-md-4">
										<?php $value = (isset($mieter) ? $mieter->kellernummer_a : ''); ?>
										<?php echo render_input('kellernummer_a', 'Kellernummer', $value); ?>
									</div>
									<div class="col-md-12">

										<h5>Umsetzwohnung</h5>

									</div>
									<div class="col-md-6">
										<?php
										$datas = [];
										$datas[] = array('id' => 1, 'value' => 'Privat');
										$datas[] = array('id' => 2, 'value' => 'Gewerblich');
										$datas[] = array('id' => 3, 'value' => 'Keine');


										$selected = isset($mieter) ? $mieter->art_w : ''; ?>
										<?php echo render_select('art_w', $datas, array('id', 'value'), 'Art', $selected); ?>


									</div>
									<div class="col-md-6">

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->strabe_p : ''); ?>
										<?php echo render_input('strabe_p', 'Straße', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->nr_p : ''); ?>
										<?php echo render_input('nr_p', 'Nr.:', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->etage_p : ''); ?>
										<?php echo render_input('etage_p', 'Etage', $value); ?>

									</div>
									<div class="col-md-6">

										<?php $value = (isset($mieter) ? $mieter->fulger_p : ''); ?>
										<?php echo render_input('fulger_p', 'Flügel', $value); ?>

									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">
				<div class="col-md-12">
					<input style="width: 150px;" type="submit"  value="Add Mieter" class="btn btn-primary pull-right">
				</div>
			</div></form>
	</section>
</div>
