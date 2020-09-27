<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <?php if (isset($data_a) && $data_a): ?>
                            <div id="matchin-system">
                                <h3><?php echo ( get_transl_field('tsl_mieter', 'matchingdata', 'Matching Data')); ?>
                                </h3>
                                <hr class="hr-panel-heading"/>
                                <?php
                                $data = array();
                                foreach ($data_a['header'] as $h) {
                                    if ($h) {
                                        array_push($data, array('slug' => slugify($h), 'label' => $h));
                                    }
                                } ?>
                                <?php echo form_open(admin_url('mieter/import_perform_data')) ?>
                                <?php echo form_hidden('data', serialize($data_a['values'])); ?>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'vollstandigernam', 'Vollständiger Nam')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('fullname', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'vorname', 'Vorname')); ?>
                                        </label></div>
                                    <div class="col-md-3"><?php echo render_select('vorname', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label<?php echo ( get_transl_field('tsl_mieter', 'nachname', 'Nachname')); ?>
                                        </label></div>
                                    <div class="col-md-3"><?php echo render_select('nachname', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'email', 'Email')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('email', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'strabe_m', 'Straße')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('strabe_m', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label> <?php echo ( get_transl_field('tsl_mieter', 'hausnummer', 'Hausnummer')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('hausnummer_m', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'etage', 'Etage')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('etage', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'flugel', 'Flügel')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('flugel', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'plz', 'PLZ')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('plz', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'stadt', 'Stadt')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('stadt', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label> <?php echo ( get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('telefon_1', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label> <?php echo (get_transl_field('tsl_mieter', 'telefon_2', 'Telefon 2')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('telefon_2', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'telefon_3', 'Telefon 3')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('telefon_3', $data, array('slug', 'label')) ?></div>
                                    <!--
                                <div class="col-md-3"><label>Stadt</label></div>
                                <div class="col-md-3"><?php /*echo render_select('fullname',$data,array('slug', 'label'))*/ ?></div>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'projektprojektname', 'Projekt Projektname')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('projektname', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'k_baubeginn','Baubeginn')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('baubeginn', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label> <?php echo ( get_transl_field('tsl_mieter', 'bauende', 'Bauende')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('bauende', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'beraumung', 'Beräumung')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('beraumung', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label> <?php echo ( get_transl_field('tsl_mieter', 'ruckraumung', 'Rückräumung')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('ruckraumung', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'art', 'Art')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('fenstereinbau', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'fenstereinbau_d', 'Fenstereinbau Datum')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('fenstereinbau_d', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'k_nummer', 'Kellernummer')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('k_nummer', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo ( get_transl_field('tsl_mieter', 'k_baubeginn','Keller Beräumung')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('k_baubeginn', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label>Keller Rückräumung</label></div>
                                    <div class="col-md-3"><?php echo render_select('k_ruckraumung', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Ausweichkeller Straße</label></div>
                                    <div class="col-md-3"><?php echo render_select('strabe_a', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label> <?php echo (get_transl_field('tsl_mieter', 'ausweichkellerhausnummer', 'Ausweichkeller Hausnummer')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('hausnummer_a', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'ausweichkellerkellernummer', 'Ausweichkeller Kellernummer')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('kellernummer_a', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label><?php echo (get_transl_field('tsl_mieter', 'umsetzwohnungart', 'Umsetzwohnung Art')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('art_w', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Ausweichkeller Straße</label></div>
                                    <div class="col-md-3"><?php echo render_select('strabe_p', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label>Umsetzwohnung Nr</label></div>
                                    <div class="col-md-3"><?php echo render_select('nr_p', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label> <?php echo (get_transl_field('tsl_mieter', 'ausweichkelleretage', 'Ausweichkeller Etage')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('etage_p', $data, array('slug', 'label')) ?></div>
                                    <div class="col-md-3"><label> <?php echo ( get_transl_field('tsl_mieter', 'umsetzwohnungflugel', 'Umsetzwohnung Flügel')); ?></label></div>
                                    <div class="col-md-3"><?php echo render_select('fulger_p', $data, array('slug', 'label')) ?></div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit"
                                            class="btn btn-info   btn-import-submit">
                                        <?php echo 'import'; ?></button>
                                    <a class="btn btn-danger"
                                       href="<?= admin_url('mieter/import'); ?>"><?php echo (get_transl_field('tsl_mieter', 'cancel', 'Cancel')); ?></a>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        <?php else: ?>
                            <h3 style="margin-top: 0"><?php echo (get_transl_field('tsl_mieter', 'mpeci', 'Mieter per Excel, CSV importieren')); ?></h3>
                            <hr class="hr-panel-heading"/>
                            <div class="row">
                                <div class="col-md-10 mtop15">
                                    <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'import_form')); ?>
                                    <?php echo form_hidden('clients_import', 'true'); ?>
                                    <?php echo render_input('file_excel', '* Eine EXCEL Datei wählen', '', 'file'); ?>
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-info import btn-import-submit"><?php echo 'import'; ?></button>
                                        <a class="btn btn-success"
                                           href="<?= base_url() . 'assets/sample-data/mieter_demo_data.xlsx' ?>"><?php echo ( get_transl_field('tsl_mieter', 'dsde', 'Download Sample Data EXCEL')); ?></a>
                                        <a class="btn btn-success"
                                           href="<?= base_url() . 'assets/sample-data/mieter_demo_data.csv' ?>"><?php echo ( get_transl_field('tsl_mieter', 'csv', 'Download Sample Data CSV')); ?>
                                        </a>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php init_tail(); ?>
<script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>

</body>
</html>
