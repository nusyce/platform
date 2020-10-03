<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<!-- For Messages -->
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<!-- For Messages -->
			<?php $this->load->view('admin/includes/_messages.php') ?>
			<div class="card">
				<div id="page-header">
					<div class="d-inline-block" style="display: flex !important;">

						<h3 class="card-title nomb"><span>Rollen</span>
							<a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a></h3>
						</h3>
						<a style="margin-left: 10px" href="#"
						   class="btn btn-info btntrans pull-left display-block"><?php echo 'Translate'; ?></a>
					</div>
				</div>
				<div class="d-inline-block float-right" style="margin-top: 10px">
					<a href="<?php echo base_url('admin/admin_roles/add'); ?>"
					   class="btn btn-success"><?php echo 'Erstellen'; ?></a>
				</div>

				<?php
				$total = ''; ?>
				<div class="col-md-4" style="padding-right: 0px;  padding-left: 0px;margin-top: 10px">
					<div class="panel_s">
						<div class="panel-body" style="padding: 15px  15px;">
							<?= widget_status_stats('admin_roles', $title); ?>

						</div>
					</div>
				</div>
			</div>

			<div class="card">

				<!--			<?php /*echo form_open("/", 'class="filterdata"') */ ?>
				<div class="row row-search" style="margin-left: 25px;">
					<div class="col-md-3">
						<div class="form-group">
							<select name="type" class="form-control" onchange="filter_data()">
								<option value=""><? /*= trans('all_admin_types') */ ?></option>
								<?php /*foreach ($admin_roles as $admin_role): */ ?>
									<option value="<? /*= $admin_role['admin_role_id'] */ ?>"><? /*= $admin_role['admin_role_title'] */ ?></option>
								<?php /*endforeach; */ ?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select name="status" class="form-control" onchange="filter_data()">
								<option value=""><? /*= trans('all_status') */ ?></option>
								<option value="1"><? /*= trans('active') */ ?></option>
								<option value="0"><? /*= trans('inactive') */ ?></option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="keyword" class="form-control"
								   placeholder="<? /*= trans('search_from_here') */ ?>..." onkeyup="filter_data()"/>
						</div>
					</div>
				</div>
				--><?php /*echo form_close(); */ ?>

				<?php
				$table_data = array(
						'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="staff"><label></label></div>',
						get_transl_field('tsl_roles', 'role name', 'Role Name'),
						get_transl_field('tsl_roles', 'permissions', 'Permissions'),
						get_transl_field('tsl_roles', 'aktiv', 'Aktiv'),
				);
				render_datatable($table_data, (isset($class) ? $class : 'adminroles'), [], [
						'data-last-order-identifier' => 'adminroles',
						'data-default-order' => '',
				]);
				?>

			</div>
			</section>


		</div>
	</div>
	<?php init_tail(); ?>


	<script>

		// Init the table
		var table_adminroles = $('.table-adminroles');
		if (table_adminroles.length) {
			// Add additional server params $_POST
			var LeadsServerParams = {};


			belegunTableServer = leadsTableNotSortable = [];
			var filterArray = [];
			var ContractsServerParams = {};
			$.each($('._hidden_inputs._filters input'), function () {
				ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
			});

			var _table_api = renderDataTable(table_adminroles, admin_url + '/admin_roles/render', [0], [0], LeadsServerParams, [1, 'desc'], filterArray);

			$.each(LeadsServerParams, function (i, obj) {
				$('#' + i).on('change', function () {
					table_mieter.DataTable().ajax.reload()
							.columns.adjust()
							.responsive.recalc();
				});
			});
		}
		$("body").on("change", ".onoffswitch-checkbox", function () {
			console.log('checked');
			$.post('<?=base_url("admin/admin_roles/change_status")?>',
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
		//------------------------------------------------------------------
		function filter_data() {
			$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
			$.post('<?=base_url('admin/admin/filterdata')?>', $('.filterdata').serialize(), function () {
				$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
			});
		}

		//------------------------------------------------------------------
		function load_records() {
			$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
			$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
		}

		load_records();

		//---------------------------------------------------------------------

	</script>
