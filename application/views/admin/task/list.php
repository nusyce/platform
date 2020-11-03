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

					<h3 class="card-title nomb" ><span>Aufgabenplanung</span>
						<a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
					</h3>
					<a href="#" onclick="new_task()"
					   class="btn btn-success"><?php echo 'Aufgabe erstellen'; ?></a>
				</div>
			</div>
            <div id="_task"></div>

			<?php
			$total = ''; ?>

		</div>
		<div class="card">
		<div class="row " id="tasks-table">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<p class="bold"><?php echo _l(get_transl_field('tsl_tasks', 'filterenach', 'Filtere nach')); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 leads-filter-column">
						<?php echo render_select('status', $statuses, array('id', 'name'), '', '', array('data-width' => '100%', 'data-none-selected-text' => get_transl_field('tsl_tasks', 'status', 'Status')), array()); ?>
					</div>
					<div class="col-md-2 leads-filter-column">
						<?php echo render_date_input('start_date', '', '', array('placeholder' => get_transl_field('tsl_tasks', 'startdatum', 'Start Datum'))); ?>
					</div>
					<div class="col-md-2 leads-filter-column">
						<?php echo render_date_input('end_date', '', '', array('placeholder' => get_transl_field('tsl_tasks', 'falligkeitsdatum', 'Fälligkeitsdatum'))) ?>
					</div>
					<div class="col-md-3 leads-filter-column">
						<?php echo render_select('member', $member, array('admin_id', 'full_name'), '', '', array('data-width' => '100%', 'data-none-selected-text' => get_transl_field('tsl_tasks', 'mitarbeiter', 'Mitarbeiter')), array(), '', '', true); ?>
					</div>
					<div class="col-md-2 leads-filter-column">
						<?php echo render_select('priority', get_tasks_priorities(), array('id', 'name'), '', '', array('data-width' => '100%', 'data-none-selected-text' => get_transl_field('tsl_tasks', 'prioritat', 'Priorität')), array()); ?>
					</div>

				</div>
			</div>

			<div class="clearfix"></div>
			<hr class="hr-panel-heading"/>
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
				'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="ticket"><label></label></div>',
				'#',
				get_transl_field('tsl_tasks', 'name', 'Name'),
				//get_transl_field('tsl_tickets', 'tags', 'Tags'),
				//get_transl_field('tsl_tickets', 'abteilung', 'Abteilung'),
				get_transl_field('tsl_tasks', 'status', 'Status'),
				get_transl_field('tsl_tasks', 'start_datum', 'Start Datum'),
				get_transl_field('tsl_tasks', 'falligkeitsdatum', 'Fälligkeitsdatum'),
				get_transl_field('tsl_tasks', 'mieter', 'Mieter'),
				get_transl_field('tsl_tasks', 'Zugewiesen', 'Zugewiesen'),
				get_transl_field('tsl_tasks', 'Aufgaben', 'Aufgaben'),
				get_transl_field('tsl_tasks', 'Erledigt', 'Erledigt'),
				get_transl_field('tsl_tasks', 'Projekt', 'Projekt'),
				get_transl_field('tsl_tasks', 'Priorität', 'Priorität'),

			);


			render_datatable($table_data, (isset($class) ? $class : 'task'), [], [
				'data-last-order-identifier' => 'task',
				'data-default-order' => '',
			]);

			?>
		</div>
	</div>
</div>
<?php init_tail(); ?>


<script>

    // Init the table
    var table_task = $('.table-task');
    if (table_task.length) {
        // Add additional server params $_POST
        var LeadsServerParams = {
            "priority": "[name='priority']",
            "member": "[name='member']",
            "end_date": "[name='end_date']",
            "start_date": "[name='start_date']",
            "status": "[name='status']",

        };


        belegunTableServer = leadsTableNotSortable = [];
        var filterArray = [];
        var ContractsServerParams = {};
        $.each($('._hidden_inputs._filters input'), function () {
            ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });

        var _table_api = renderDataTable(table_task, admin_url + 'task/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

        $.each(LeadsServerParams, function (i, obj) {
            $('#' + i).on('change', function () {
                table_task.DataTable().ajax.reload()
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
















