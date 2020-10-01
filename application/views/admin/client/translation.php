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
						<h3 class="card-title">Translation <?= get_menu_option('kunden','Kunden') ?></h3>

					</div>

				</div>
			</div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body" id="clients-transl">
                    <?php
                    echo form_open($this->uri->uri_string(), array('id' => 'clients-transl')); ?>


                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('strabe_m', get_transl_field('tsl_clients', 'strabe_m', 'Straße'), get_transl_field('tsl_clients', 'strabe_m', 'Straße')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('gesamt', get_transl_field('tsl_clients', 'gesamt', 'Gesamt'),get_transl_field('tsl_clients', 'gesamt', 'Gesamt')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('reinigungstermin', get_transl_field('tsl_clients', 'reinigungstermin', 'Reinigungstermin'),get_transl_field('tsl_clients', 'reinigungstermin', 'Reinigungstermin')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('aktiv', get_transl_field('tsl_clients', 'aktiv','Aktiveeee'),get_transl_field('tsl_clients', 'aktiv','Aktiveeee')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('position', get_transl_field('tsl_clients', 'position','Position'),get_transl_field('tsl_clients', 'position','Position')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('options', get_transl_field('tsl_clients', 'options','options'),get_transl_field('tsl_clients', 'options','options')); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('erstellen', get_transl_field('tsl_clients', 'erstellen', 'Erstellen'),get_transl_field('tsl_clients', 'erstellen', 'Erstellen ')); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('firma', get_transl_field('tsl_clients', 'firma', 'Firma'),get_transl_field('tsl_clients', 'firma', 'Firma ')); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input( 'mieter' ,get_transl_field('tsl_clients', 'mieter','Mieter'),get_transl_field('tsl_clients', 'mieter','Mieter')); ?>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input( 'kunden' ,get_transl_field('tsl_clients', 'kunden','Kunden'),get_transl_field('tsl_clients', 'kunden','Kunden')); ?>
									</div>
								</div>
                            </div>




                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('hausnummer_m', get_transl_field('tsl_clients', 'hausnummer', 'Hausnummer'), get_transl_field('tsl_clients', 'hausnummer', 'Hausnummer')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('mitarbeiter', get_transl_field('tsl_clients', 'mitarbeiter', 'Mitarbeiter'), get_transl_field('tsl_clients', 'mitarbeiter', 'Mitarbeiter')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('vorname', get_transl_field('tsl_clients', 'vorname', 'Vorname'), get_transl_field('tsl_clients', 'vorname', 'Vorname')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('nachname', get_transl_field('tsl_clients', 'nachname', 'Nachname'), get_transl_field('tsl_clients', 'nachname', 'Nachname')); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('aktive', get_transl_field('tsl_clients', 'aktive', 'Aktive'),get_transl_field('tsl_clients', 'aktive', 'Aktive')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('inaktiv', get_transl_field('tsl_clients', 'inaktiv', 'Inaktiv'),get_transl_field('tsl_clients', 'inaktiv', 'Inaktiv')); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('leistungsempfanger', get_transl_field('tsl_clients', 'leistungsempfanger', 'Leistungsempfänger'),get_transl_field('tsl_clients', 'leistungsempfanger', 'Leistungsempfänger')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('kundenbetreuer',get_transl_field('tsl_clients', 'kundenbetreuer','Kundenbetreuer'),get_transl_field('tsl_clients', 'kundenbetreuer','Kundenbetreuer')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('alleloschen',get_transl_field('tsl_clients', 'alleloschen','Alle löschen'),get_transl_field('tsl_clients', 'alleloschen','Alle löschen')); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('ansprechpartner',get_transl_field('tsl_clients', 'ansprechpartner','Ansprechpartner'),get_transl_field('tsl_clients', 'ansprechpartner','Ansprechpartner')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input( 'confirm' ,get_transl_field('tsl_clients', 'confirm','confirm'),get_transl_field('tsl_clients', 'confirm','confirm')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input( 'kunderperimportieren' ,get_transl_field('tsl_clients', 'kunderperimportieren','Kunder per CSV importieren'),get_transl_field('tsl_clients', 'kunderperimportieren','Kunder per CSV importieren')); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('importieren', get_transl_field('tsl_clients', 'importieren','Importieren'),get_transl_field('tsl_clients', 'importieren','Importieren')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('email', get_transl_field('tsl_clients', 'email', 'Email'), get_transl_field('tsl_clients', 'email', 'Email')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('notizen', get_transl_field('tsl_clients', 'notizen', 'Notizen'), get_transl_field('tsl_clients', 'notizen', 'Notizen')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input('telefon', get_transl_field('tsl_clients', 'telefon', 'Telefon '), get_transl_field('tsl_clients', 'telefon', 'Telefon ')); ?>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-md-12">
										<?php echo render_input( 'action' ,get_transl_field('tsl_clients', 'action','Action'),get_transl_field('tsl_clients', 'action','Action')); ?>
									</div>
								</div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo render_input( 'aktiviert' ,get_transl_field('tsl_clients', 'aktiviert','Aktiviert'),get_transl_field('tsl_clients', 'aktiviert','Aktiviert')); ?>
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
        </div></div>
	</div>
</div>
<?php init_tail(); ?>

