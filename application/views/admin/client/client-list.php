<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<!-- <div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
							<li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
						</ol>
					</div>
				</div>
			</div>-->
		</div>
		<!-- For Messages -->
		<?php //$this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div id="page-header">
				<div class="d-inline-block" style="display: flex !important;">

					<h3 class="card-title nomb" ><span>KUNDEN</span></h3>
					<a style="margin-left: 10px" href="<?php echo base_url('admin/client/translation'); ?>"
					   class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>
				</div>
			</div>
			<div class="d-inline-block float-right" style="margin-top: 10px">
				<a href="<?php echo base_url('admin/client/client'); ?>"
				   class="btn btn-success"><?php echo 'Erstellen'; ?></a>


			</div>

			<?php
			$total = ''; ?>
			<div class="col-md-4" style="padding-right: 0px;  padding-left: 0px;margin-top: 10px">
				<div class="panel_s">
					<div class="panel-body" style="padding: 15px  15px;">
						<?= widget_status_stats('clients', $title); ?>

					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<!--	<div class="table-responsive">

			<table id="na_datatable" class="table zero-configuration dataTable"  role="grid" >

          <thead>
            <tr>

              <th>ID</th>
              <th><?php /*echo get_transl_field('tsl_mieter', 'fullname', 'Vollständiger Name')*/ ?></th>
              <th><?php /*echo get_transl_field('tsl_mieter', 'projekt', 'Projekt:')*/ ?></th>
              <th><?php /*echo get_transl_field('tsl_mieter', 'strabe_m', 'Straße')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'nr', 'Nr.')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'wohnungsnummer', 'wohnungsnummer')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'etage', 'Etage')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'flugel', 'Flügel')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'plz', 'PLZ')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'stadt', 'Stadt')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1')*/ ?></th>
				<th><?php /*echo get_transl_field('tsl_mieter', 'aktiv','Aktiveeee')*/ ?></th>

            </tr>
          </thead>
        </table>-->
			<?php

			$table_data = array(
					'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="mieter"><label></label></div>',
					'ID',
					get_transl_field('tsl_clients', 'firma', 'Firma'),
					get_transl_field('tsl_clients', 'mitarbeiter', 'Mitarbeiter'),
					get_transl_field('tsl_clients', 'mieter', 'Mieter'),
					get_transl_field('tsl_clients', 'email', 'Email'),
					get_transl_field('tsl_clients', 'telefon', 'Telefon '),
					get_transl_field('tsl_clients', 'aktiv', 'Aktiveeee'),

			);


			render_datatable($table_data, (isset($class) ? $class : 'client'), [], [
					'data-last-order-identifier' => 'client',
					'data-default-order' => '',
			]);

			?>
		</div>
	</div>
</div>
<?php init_tail(); ?>


<script>

	// Init the table
	var table_client = $('.table-client');
	if (table_client.length) {
		// Add additional server params $_POST
		var LeadsServerParams = {
			"strabe": "[name='strabe']",
			"hausnummer": "[name='hausnummer']",
			"mobiliert": "[name='mobiliert']",
			"etage": "[name='etage']",
			"plz": "[name='plz']",
			"wohnungsnumme": "[name='wohnungsnummer']",
			"stadt": "[name='stadt']",
			"project": "[name='project']",
			"flugel": "[name='flugel']",
		};


		belegunTableServer = leadsTableNotSortable = [];
		var filterArray = [];
		var ContractsServerParams = {};
		$.each($('._hidden_inputs._filters input'), function () {
			ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
		});

		var _table_api = renderDataTable(table_client, admin_url + 'client/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

		$.each(LeadsServerParams, function (i, obj) {
			$('#' + i).on('change', function () {
				table_mieter.DataTable().ajax.reload()
						.columns.adjust()
						.responsive.recalc();
			});
		});
	}


	//---------------------------------------------------



</script>
















