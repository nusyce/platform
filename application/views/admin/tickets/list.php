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

					<h3 class="card-title nomb" ><span>Ticketsystem</span>
						<a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
					</h3>
					<a href="<?php echo base_url('admin/ticket/add'); ?>"
					   class="btn btn-success"><?php echo 'Erstellen'; ?></a>
				</div>
			</div>


			<?php
			$total = ''; ?>

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
				'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="ticket"><label></label></div>',
				'ID',
				get_transl_field('tsl_tickets', 'betreff', 'Betreff'),
				//get_transl_field('tsl_tickets', 'tags', 'Tags'),
				//get_transl_field('tsl_tickets', 'abteilung', 'Abteilung'),
				get_transl_field('tsl_tickets', 'service', 'Service'),
				get_transl_field('tsl_tickets', 'kunde', 'Kunde'),
				get_transl_field('tsl_tickets', 'status', 'Status'),
				get_transl_field('tsl_tickets', 'Priorität', 'Priorität'),
				get_transl_field('tsl_tickets', 'Letzte Antwort', 'Letzte Antwort'),
				get_transl_field('tsl_tickets', 'Erstelldatum', 'Erstelldatum'),

			);


			render_datatable($table_data, (isset($class) ? $class : 'ticket'), [], [
				'data-last-order-identifier' => 'ticket',
				'data-default-order' => '',
			]);

			?>
		</div>
	</div>
</div>
<?php init_tail(); ?>


<script>

    // Init the table
    var table_ticket = $('.table-ticket');
    if (table_ticket.length) {
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

        var _table_api = renderDataTable(table_ticket, admin_url + 'ticket/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

        $.each(LeadsServerParams, function (i, obj) {
            $('#' + i).on('change', function () {
                table_ticket.DataTable().ajax.reload()
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
















