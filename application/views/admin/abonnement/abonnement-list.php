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

					<h3 class="card-title nomb" ><span>ABONNEMENT</span>
						<a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
					</h3>

				</div>
			</div>
			<div class="d-inline-block float-right" style="margin-top: 10px">



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
					get_transl_field('tsl_abonnements', 'firma', 'Firma'),
					get_transl_field('tsl_abonnements', 'pack', 'Package'),
					get_transl_field('tsl_abonnements', 'price', 'Price'),
					get_transl_field('tsl_abonnements', 'paid_by', 'Bezahlt von'),
					get_transl_field('tsl_abonnements', 'created_at', 'Created at'),


			);


			render_datatable($table_data, (isset($class) ? $class : 'abonnement'), [], [
					'data-last-order-identifier' => 'abonnement',
					'data-default-order' => '',
			]);

			?>
		</div>
	</div>
</div>
<?php init_tail(); ?>


<script>

	// Init the table
	var table_abonnement = $('.table-abonnement');
	if (table_abonnement.length) {
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

		var _table_api = renderDataTable(table_abonnement, admin_url + 'abonnement/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

		$.each(LeadsServerParams, function (i, obj) {
			$('#' + i).on('change', function () {
				table_abonnement.DataTable().ajax.reload()
						.columns.adjust()
						.responsive.recalc();
			});
		});
	}


	//---------------------------------------------------
	$("body").on("change", ".onoffswitch-checkbox", function () {
		console.log('checked');
		$.post('<?=base_url("admin/client/change_status")?>',
				{
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
					id: $(this).data('id'),
					status: $(this).is(':checked') == true ? 1 : 0
				},
				function (data) {
					//$.notify("Status Changed Successfully", "success");
				});
	});


</script>
















