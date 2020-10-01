<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<div class="card">
				<div class="card-header">
					<div class="d-inline-block">
						<h3 class="card-title">Translation <?= get_menu_option('mieter','Mieter') ?></h3>

					</div>

				</div>
			</div>



		<div class="row">
			<div class="col-md-12">
				<div class="panel-body" id="mieter-transl">
					<?php
					echo form_open($this->uri->uri_string(), array('id' => 'mieter-transl')); ?>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('fullname', get_transl_field('tsl_mieter', 'fullname', 'Vollständiger Name'), get_transl_field('tsl_mieter', 'fullname', 'Vollständiger Name')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('vorname', get_transl_field('tsl_mieter', 'vorname', 'Vorname'), get_transl_field('tsl_mieter', 'vorname', 'Vorname')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('nachname', get_transl_field('tsl_mieter', 'nachname', 'Nachname'), get_transl_field('tsl_mieter', 'nachname', 'Nachname')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('email', get_transl_field('tsl_mieter', 'email', 'Email'), get_transl_field('tsl_mieter', 'email', 'Email')); ?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('strabe_m', get_transl_field('tsl_mieter', 'strabe_m', 'Straße'), get_transl_field('tsl_mieter', 'strabe_m', 'Straße')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('hausnummer_m', get_transl_field('tsl_mieter', 'hausnummer', 'Hausnummer'), get_transl_field('tsl_mieter', 'hausnummer', 'Hausnummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('wohnungsnummer', get_transl_field('tsl_mieter', 'wohnungsnummer', 'wohnungsnummer'), get_transl_field('tsl_mieter', 'wohnungsnummer', 'wohnungsnummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('plz', get_transl_field('tsl_mieter', 'plz', 'PLZ'), get_transl_field('tsl_mieter', 'plz', 'PLZ')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('stadt', get_transl_field('tsl_mieter', 'stadt', 'Stadt'), get_transl_field('tsl_mieter', 'stadt', 'Stadt')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('telefon_1', get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1'), get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('telefon_2', get_transl_field('tsl_mieter', 'telefon_2', 'Telefon 2'), get_transl_field('tsl_mieter', 'telefon_2', 'Telefon 2')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('etage', get_transl_field('tsl_mieter', 'etage', 'Etage'), get_transl_field('tsl_mieter', 'etage', 'Etage')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('matchingdata', get_transl_field('tsl_mieter', 'matchingdata', 'Matching Data'), get_transl_field('tsl_mieter', 'matchingdata', 'Matching Data')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('ausweichkellerhausnummer', get_transl_field('tsl_mieter', 'ausweichkellerhausnummer', 'Ausweichkeller Hausnummer'), get_transl_field('tsl_mieter', 'ausweichkellerhausnummer', 'Ausweichkeller Hausnummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('ausweichkellerkellernummer', get_transl_field('tsl_mieter', 'ausweichkellerkellernummer', 'Ausweichkeller Kellernummer'), get_transl_field('tsl_mieter', 'ausweichkellerkellernummer', 'Ausweichkeller Kellernummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('umsetzwohnungart', get_transl_field('tsl_mieter', 'umsetzwohnungart', 'Umsetzwohnung Art'), get_transl_field('tsl_mieter', 'umsetzwohnungart', 'Umsetzwohnung Art')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('ausweichkelleretage', get_transl_field('tsl_mieter', 'ausweichkelleretage', 'Ausweichkeller Etage'), get_transl_field('tsl_mieter', 'ausweichkelleretage', 'Ausweichkeller Etage')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('vollstandigernam', get_transl_field('tsl_mieter', 'vollstandigernam', 'Vollständiger Nam'), get_transl_field('tsl_mieter', 'vollstandigernam', 'Vollständiger Nam')); ?>
									</div>
								</div>


							</div>


							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">

										<?php echo render_input('telefon_3', get_transl_field('tsl_mieter', 'telefon_3', 'Telefon 3'), get_transl_field('tsl_mieter', 'telefon_3', 'Telefon 3')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('notice', get_transl_field('tsl_mieter', 'notice', 'Notice'), get_transl_field('tsl_mieter', 'notice', 'Notice')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('haustiere', get_transl_field('tsl_mieter', 'haustiere', 'Haustiere'), get_transl_field('tsl_mieter', 'haustiere', 'Haustiere')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('raucher', get_transl_field('tsl_mieter', 'raucher', 'Raucher'), get_transl_field('tsl_mieter', 'raucher', 'Raucher')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('kundenbetreuer', get_transl_field('tsl_mieter', 'kundenbetreuer', 'Kundenbetreuer'), get_transl_field('tsl_mieter', 'kundenbetreuer', 'Kundenbetreuer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('beraumung', get_transl_field('tsl_mieter', 'baubeginn', 'Baubeginn'), get_transl_field('tsl_mieter', 'baubeginn', 'Baubeginn')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('bauende', get_transl_field('tsl_mieter', 'bauende', 'Bauende'),get_transl_field('tsl_mieter', 'bauende', 'Bauende')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('aktiviert', get_transl_field('tsl_mieter', 'aktiviert', 'Aktiviert'),get_transl_field('tsl_mieter', 'aktiviert', 'Aktiviert')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('gesamt', get_transl_field('tsl_mieter', 'gesamt', 'Gesamt:'),get_transl_field('tsl_mieter', 'gesamt', 'Gesamt')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('projekt', get_transl_field('tsl_mieter', 'projekt', 'Projekt:'),get_transl_field('tsl_mieter', 'projekt', 'Projekt')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('nr', get_transl_field('tsl_mieter', 'nr', 'Nr.'),get_transl_field('tsl_mieter', 'nr', 'Nr. ')); ?>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('art', get_transl_field('tsl_mieter', 'art', 'Art'),get_transl_field('tsl_mieter', 'art', 'Art. ')); ?>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('erstellen', get_transl_field('tsl_mieter', 'erstellen', 'Erstellen'),get_transl_field('tsl_mieter', 'erstellen', 'Erstellen ')); ?>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('projektprojektname', get_transl_field('tsl_mieter', 'projektprojektname', 'ProjektProjektname'),get_transl_field('tsl_mieter', 'projektprojektname', 'Projekt Projektname ')); ?>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('cancel', get_transl_field('tsl_mieter', 'cancel', 'Cancel'), get_transl_field('tsl_mieter', 'cancel', 'Cancel')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('mpeci', get_transl_field('tsl_mieter', 'mpeci', 'Mieter per Excel, CSV importieren'), get_transl_field('tsl_mieter', 'mpeci', 'Mieter per Excel, CSV importieren')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('dsde', get_transl_field('tsl_mieter', 'dsde', 'Download Sample Data EXCEL'), get_transl_field('tsl_mieter', 'dsde', 'Download Sample Data EXCEL')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('csv', get_transl_field('tsl_mieter', 'csv', 'Download Sample Data CSV'), get_transl_field('tsl_mieter', 'csv', 'Download Sample Data CSV')); ?>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('filterenach', get_transl_field('tsl_mieter', 'Filterenach', 'Filtere nach'),get_transl_field('tsl_mieter', 'filterenach', 'Filtere nach')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('flugel', get_transl_field('tsl_mieter', 'flugel', 'Flügel'),get_transl_field('tsl_mieter', 'flugel', 'Flügel')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('privateinformationen', get_transl_field('tsl_mieter', 'privateinformationen', 'Private Informationen'),get_transl_field('tsl_mieter', 'privateinformationen', 'Private Informationen')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('beraumung', get_transl_field('tsl_mieter', 'beraumung', 'Beräumung'),get_transl_field('tsl_mieter', 'beraumung', 'Beräumung')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('ruckraumung', get_transl_field('tsl_mieter', 'ruckraumung', 'Rückräumung'),get_transl_field('tsl_mieter', 'ruckraumung', 'Rückräumung')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('fenstereinbau', get_transl_field('tsl_mieter', 'fenstereinbau', 'Fenstereinbau'),get_transl_field('tsl_mieter', 'fenstereinbau', 'Fenstereinbau')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('fenstereinbau_d', get_transl_field('tsl_mieter', 'fenstereinbau_d', 'Fenstereinbau Datum'),get_transl_field('tsl_mieter', 'fenstereinbau_d', 'Fenstereinbau Datum')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('keller', get_transl_field('tsl_mieter', 'keller', 'Keller'),get_transl_field('tsl_mieter', 'keller', 'Keller')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('k_nummer', get_transl_field('tsl_mieter', 'k_nummer', 'Kellernummer'),get_transl_field('tsl_mieter', 'k_nummer', 'Kellernummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('ausweichkeller', get_transl_field('tsl_mieter', 'ausweichkeller', 'Ausweichkeller'),get_transl_field('tsl_mieter', 'ausweichkeller', 'Ausweichkeller')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('kellernummer', get_transl_field('tsl_mieter', 'kellernummer', 'Kellernummer'),get_transl_field('tsl_mieter', 'kellernummer', 'Kellernummer')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('umsetzwohnung', get_transl_field('tsl_mieter', 'umsetzwohnung', 'Umsetzwohnung'),get_transl_field('tsl_mieter', 'umsetzwohnung', 'Umsetzwohnung')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('datienanhangehochladen ', get_transl_field('tsl_mieter', 'datienanhangehochladen ', 'Datien/Anhänge hochladen '),get_transl_field('tsl_mieter', 'datienanhangehochladen ', 'Datien/Anhänge hochladen ')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('besonderheit ', get_transl_field('tsl_mieter', 'besonderheit ', 'Besonderheit'),get_transl_field('tsl_mieter', 'besonderheit', 'Besonderheit')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('k_Baubeginn', 'Keller Beräumung', get_transl_field('tsl_mieter', 'k_baubeginn','Baubeginn'),get_transl_field('tsl_mieter', 'k_baubeginn','Baubeginn')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('mieterimportieren', 'MIETER IMPORTIEREN', get_transl_field('tsl_mieter', 'mieterimportieren','MIETER IMPORTIEREN'),get_transl_field('tsl_mieter', 'mieterimportieren','MIETER IMPORTIEREN')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input('umsetzwohnungflugel', get_transl_field('tsl_mieter', 'umsetzwohnungflugel', 'Umsetzwohnung Flügel'), get_transl_field('tsl_mieter', 'umsetzwohnungflugel', 'Umsetzwohnung Flügel')); ?>
									</div>
								</div>
							</div>


						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="text-right">
									<button type="submit" id="submit"
											class="btn btn-info">submit</button>
								</div>
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


