<div class="table-responsive">

	<table id="na_datatable" class="table zero-configuration dataTable" role="grid">

		<thead>
		<tr>
			<th width="50"><?= trans('id') ?></th>
			<th><?= trans('user') ?></th>
			<th><?= trans('username') ?></th>
			<th><?= trans('email') ?></th>
			<th><?= trans('role') ?></th>
			<th width="100"><?= trans('status') ?></th>

		</tr>
		</thead>
		<tbody>
		<?php foreach ($info as $row): ?>
			<tr>
				<td>
					<?= $row['admin_id'] ?>
				</td>
				<td>
					<?= $row['firstname'] ?> <?= $row['lastname'] ?>

					<div class="row-options"><a href="<?= base_url("admin/admin/edit/" . $row['admin_id']); ?>"
												class="">
							Bearbeiten
						</a> |
						<a href="<?= base_url("admin/admin/delete/" . $row['admin_id']); ?>"
						   class="text-danger _delete"> löschen</a></div>
				</td>
				<td>
					<?= $row['username'] ?>
				</td>
				<td>
					<?= $row['email'] ?>
				</td>
				<td>
					<?= $row['admin_role_title'] ?>
				</td>
				<td>
					<div class="custom-control custom-switch"><input
								data-switch-url="<?= base_url("admin/admin/change_status") ?>"
								class='tgl tgl-ios tgl_checkbox custom-control-input'
								data-id="<?= $row['admin_id'] ?>"
								id='cb_<?= $row['admin_id'] ?>'
								type='checkbox' <?php echo ($row['is_active'] == 1) ? "checked" : ""; ?> />
						<label class="tgl-btn custom-control-label" for='cb_<?= $row['admin_id'] ?>'></label></div>
				</td>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
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
</div>


<script>

	// Init the table
	var table_admin = $('.table-admin');
	if (table_user.length) {
		// Add additional server params $_POST
		var LeadsServerParams = {};


		belegunTableServer = leadsTableNotSortable = [];
		var filterArray = [];
		var ContractsServerParams = {};
		$.each($('._hidden_inputs._filters input'), function () {
			ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
		});

		var _table_api = renderDataTable(table_admin, admin_url + 'admin/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

		$.each(LeadsServerParams, function (i, obj) {
			$('#' + i).on('change', function () {
				table_mieter.DataTable().ajax.reload()
						.columns.adjust()
						.responsive.recalc();
			});
		});
	}



			$("body").on("change", ".tgl_checkbox", function () {
				console.log('checked');
				$.post('<?=base_url("admin/users/change_status")?>',
						{
							'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
							id: $(this).data('id'),
							status: $(this).is(':checked') == true ? 1 : 0
						},
						function (data) {
							$.notify("Status Changed Successfully", "success");
						});
			});
</script>


<script>

	//---------------------------------------------------
	var table = $('#na_datatable').DataTable({
		"language": {
			"info": "Zeige _START_ bis _END_ von _TOTAL_ Einträge",
			"searchPlaceholder": "Suchen",
			"search": "",
			"sLengthMenu": "_MENU_",
			"paginate": {
				"previous": "zurück",
				"next": "vor",

			}
		},
		"processing": true,
		"serverSide": false,
		'responsive': true,
	});


	$(document).ready(function () {
		$('.dataTables_length').parent('div').addClass('div-datatable');
		$('.dataTables_filter').parent('div').addClass('div-datatable');

	})
</script>

