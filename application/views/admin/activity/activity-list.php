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

					<h3 class="card-title nomb" ><span>Activity Log</span>

					</h3>
					<a style="margin-left: 10px" href="<?php echo base_url('admin/activity/clear'); ?>"
					   class="btn btn-danger btntrans pull-left display-block"><?php echo 'LOG LEEREN'; ?></a>
				</div>
			</div>

<div style="width: 25%">
	<?php echo render_input('activity_log_date', 'Filter by date', "",'date'); ?>

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
				get_transl_field('tsl_activity', 'bescheribung', 'Bescheribung'),
				get_transl_field('tsl_activity', 'datum', 'Datum'),
				get_transl_field('tsl_activity', 'mitarbeiter', 'Mitarbeiter'),
			);


			render_datatable($table_data, (isset($class) ? $class : 'activity'), [], [
				'data-last-order-identifier' => 'activity',
				'data-default-order' => '',
			]);

			?>
		</div>
	</div>
</div>
<?php init_tail(); ?>


<script>

    // Init the table
    var table_activity = $('.table-activity');
    if (table_activity.length) {
        // Add additional server params $_POST
        var LeadsServerParams = {
            "activity_log_date": "[name='activity_log_date']",

        };


        belegunTableServer = leadsTableNotSortable = [];
        var filterArray = [];
        var ContractsServerParams = {};
        $.each($('._hidden_inputs._filters input'), function () {
            ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });

        var _table_api = renderDataTable(table_activity, admin_url + 'activity/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

        $.each(LeadsServerParams, function (i, obj) {
            $('#' + i).on('change', function () {
                table_activity.DataTable().ajax.reload()
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
















