<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="d-inline-block">
				<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; <?= trans('users_list') ?></h3>
			</div>
			<div class="d-inline-block float-right">
				<?php if ($this->rbac->check_operation_permission('add')): ?>
					<a href="<?= base_url('admin/users/add'); ?>" class="btn btn-success"><i
								class="fa fa-plus"></i> <?= trans('add_new_user') ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="card">
			<table id="na_datatable" class="table table-bordered table-striped" width="100%">
				<thead>
				<tr>
					<th>#<?= trans('id') ?></th>
					<th><?= trans('username') ?></th>
					<th><?= trans('email') ?></th>
					<th><?= trans('mobile_no') ?></th>
					<th><?= trans('created_date') ?></th>
					<th><?= trans('email_verification') ?></th>
					<th><?= trans('status') ?></th>
					<th width="100" class="text-right"><?= trans('action') ?></th>
				</tr>
				</thead>
			</table>
		</div>

		<div class="clearfix"></div>

		<a href="#" class="bulk-actions-btn table-btn delete-all hide" id="sqdsqd"
		   data-table=".table-user"><?php echo _l('Alle löschen'); ?></a>
		<?php
		$table_data = array(
				'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="staff"><label></label></div>',
				get_transl_field('tsl_staff', 'vorname','Vorname'),
				get_transl_field('tsl_staff', 'nachname','Nachname'),
				get_transl_field('tsl_staff', 'rolle','Rolle'),
				get_transl_field('tsl_staff', 'email','Email'),
				get_transl_field('tsl_staff', 'telefonnummer','Telefonnummer'),
				get_transl_field('tsl_staff', 'letztes_login','Letztes Login'),
				get_transl_field('tsl_staff', 'aktiv','Aktiv'),
		);
		render_datatable($table_data, 'user');
		?>
	</section>
</div>



<?php init_tail(); ?>
<script>
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable({
		"processing": true,
		"serverSide": false,
		"ajax": "<?=base_url('admin/users/datatable_json')?>",
		"order": [[4, 'desc']],
		"columnDefs": [
			{"targets": 0, "name": "id", 'searchable': true, 'orderable': true},
			{"targets": 1, "name": "username", 'searchable': true, 'orderable': true},
			{"targets": 2, "name": "email", 'searchable': true, 'orderable': true},
			{"targets": 3, "name": "mobile_no", 'searchable': true, 'orderable': true},
			{"targets": 4, "name": "created_at", 'searchable': false, 'orderable': false},
			{"targets": 5, "name": "is_active", 'searchable': true, 'orderable': true},
			{"targets": 6, "name": "is_verify", 'searchable': true, 'orderable': true},
			{"targets": 7, "name": "Action", 'searchable': false, 'orderable': false, 'width': '100px'}
		]
	});
</script>


<script>

	// Init the table
	var table_user = $('.table-user');
	if (table_user.length) {
		// Add additional server params $_POST
		var LeadsServerParams = {};


		belegunTableServer = leadsTableNotSortable = [];
		var filterArray = [];
		var ContractsServerParams = {};
		$.each($('._hidden_inputs._filters input'), function () {
			ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
		});

		var _table_api = renderDataTable(table_user, admin_url + 'users/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

		$.each(LeadsServerParams, function (i, obj) {
			$('#' + i).on('change', function () {
				table_mieter.DataTable().ajax.reload()
						.columns.adjust()
						.responsive.recalc();
			});
		});
	}


<script type="text/javascript">
	$("body").on("change", ".tgl_checkbox", function () {
		console.log('checked');
		$.post('<?=base_url("admin/users/change_status")?>',
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


</script>


