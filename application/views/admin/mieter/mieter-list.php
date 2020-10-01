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
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
		  <div id="page-header">
        <div class="d-inline-block" style="display: flex !important;">

          <h3 class="card-title"><span>MIETER</span></h3>
			<a style="margin-left: 10px" href="<?php echo base_url('admin/mieter/translation'); ?>" class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>
		</div>
		  </div>
        <div class="d-inline-block float-right" style="margin-top: 10px">
			  <a href="<?php echo base_url('admin/mieter/mieter');?>" class="btn btn-success"><?php echo 'Erstellen'; ?></a>

			<a href="<?php echo admin_url('mieter/import'); ?>"
			   class="btn btn-info ">importieren</a>
		  </div>

		  <?php
		  $total = ''; ?>
		  <div class="col-md-4" style="padding-right: 0px;  padding-left: 0px;margin-top: 10px">
			  <div class="panel_s">
				  <div class="panel-body" style="padding: 15px  15px;">
					  <?= widget_status_stats('mieters', $title); ?>

				  </div>
			  </div>
		  </div>
      </div>
    </div>
    <div class="card">
		<div class="table-responsive">

			<table id="na_datatable" class="table zero-configuration dataTable"  role="grid" >

          <thead>
            <tr>

              <th>ID</th>
              <th><?php echo get_transl_field('tsl_mieter', 'fullname', 'Vollständiger Name')?></th>
              <th><?php echo get_transl_field('tsl_mieter', 'projekt', 'Projekt:')?></th>
              <th><?php echo get_transl_field('tsl_mieter', 'strabe_m', 'Straße')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'nr', 'Nr.')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'wohnungsnummer', 'wohnungsnummer')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'etage', 'Etage')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'flugel', 'Flügel')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'plz', 'PLZ')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'stadt', 'Stadt')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'telefon_1', 'Telefon 1')?></th>
				<th><?php echo get_transl_field('tsl_mieter', 'aktiv','Aktiveeee')?></th>

            </tr>
          </thead>
        </table>
			<div class="row">
				<div class="col-md-12">
					<p class="bold"><?php echo _l('Filtere nach'); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('project', $project, array('id', 'name'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Projekt'), array()); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('strabe', $strabe, array('strabe_m', 'strabe_m'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Straße'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('hausnummer', $hausnummer, array('hausnummer_m', 'hausnummer_m'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Nr.'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('etage', $etage, array('etage', 'etage'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Etage'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('flugel', $flugel, array('flugel', 'flugel'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Flügel'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('wohnungsnummer', $wohnungsnummer, array('wohnungsnummer', 'wohnungsnummer'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Wohnungsnummer'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('plz', $plz, array('plz', 'plz'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'PLZ'), array()); ?>
				</div>
				<div class="col-md-2 leads-filter-column">
					<?php echo render_select('stadt', $stadt, array('stadt', 'stadt'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Stadt'), array()); ?>
				</div>
			</div>
			<?php

			$table_data = array(
					'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="mieter"><label></label></div>',
					'ID',
					get_transl_field('tsl_mieter', 'fullname','Vollständiger Name'),
					get_transl_field('tsl_mieter', 'projekt','Projekt'),
					get_transl_field('tsl_mieter', 'strabe_m','Straße'),
					get_transl_field('tsl_mieter', 'nr','Nr.'),
					get_transl_field('tsl_mieter', 'wohnungsnummer','Wohnungsnummer'),
					get_transl_field('tsl_mieter', 'etage','Etage'),
					get_transl_field('tsl_mieter', 'flugel','Flügel'),
					get_transl_field('tsl_mieter', 'plz','PLZ'),
					get_transl_field('tsl_mieter', 'stadt','Stadt'),
					get_transl_field('tsl_mieter', 'telefon_1','Telefon'),
					get_transl_field('tsl_mieter', 'kundenbetreuer','Kundenbetreuer'),
					get_transl_field('tsl_mieter', 'belegt?','Belegt?'),
					get_transl_field('tsl_mieter', 'aktiviert','Aktiviert')

			);


			render_datatable($table_data, (isset($class) ? $class : 'mieter'), [], [
					'data-last-order-identifier' => 'mieter',
					'data-default-order' => '',
			]);

			?>
      </div>
    </div>
	</div>
</div>
</div>
<?php init_tail(); ?>




<script>

	// Init the table
	var table_mieter = $('.table-mieter');
	if (table_mieter.length) {
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

		var _table_api = renderDataTable(table_mieter, admin_url + 'mieter/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

		$.each(LeadsServerParams, function (i, obj) {
			$('#' + i).on('change', function () {
				table_mieter.DataTable().ajax.reload()
						.columns.adjust()
						.responsive.recalc();
			});
		});
	}


	//---------------------------------------------------
  var table = $('#na_datatable').DataTable( { "language": {
		  "info": "Zeige _START_ bis _END_ von _TOTAL_ Einträge",
		  "searchPlaceholder": "Suchen",
  	       "search": "",
		  "sLengthMenu": "_MENU_",
		  "paginate": {
			  "previous": "zurück",
			  "next": "vor",

		  }
	  },
	  'responsive': true,
    "ajax": "<?=base_url('admin/mieter/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "username", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "description", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "created_at", 'searchable':true, 'orderable':true},
    ]
  });




</script>
