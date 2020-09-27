<!-- Content Wrapper. Contains page content -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- For Messages --><div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-header row">
		</div>

		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; <?= $title ?></h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/admin_roles/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_role') ?></a>
				</div>
			</div>

			<div class="table-responsive">

				<table id="na_datatable" class="table zero-configuration dataTable"  role="grid" >
					<thead>
						<tr>
							<th width="50"><?= trans('id') ?></th>
							<th><?= trans('admin_role') ?></th>
							<th><?= trans('status') ?></th>
							<th><?= trans('permission') ?></th>

						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $record): ?>
						<?php if($_SESSION["admin_role_id"] <= $record['admin_role_id']): ?>
							<tr>
								<td><?php echo $record['admin_role_id']; ?></td>
								<td><?php echo $record['admin_role_title']; ?>
									<div class="row-options"><a href="<?php echo site_url("admin/admin_roles/edit/".$record['admin_role_id']); ?>" class="">
											Bearbeiten
										</a> |
										<a href="<?php echo site_url("admin/admin_roles/delete/".$record['admin_role_id']); ?>"  class="text-danger _delete"> löschen</a></div></td>
								<td><div class="custom-control custom-switch"><input data-switch-url="<?=base_url("admin/admin_roles/change_status")?>" class='tgl tgl-ios tgl_checkbox custom-control-input'
																					 data-id="<?=$record['admin_role_id']?>"
																					 id='cb_<?=$record['admin_role_id']?>'
																					 type='checkbox' <?php echo ($record['admin_role_status'] == 1)? "checked" : ""; ?> />
										<label class="tgl-btn custom-control-label" for='cb_<?=$record['admin_role_id']?>'></label></div>
								</td>
								<td>
									<a href="<?php echo site_url("admin/admin_roles/access/".$record['admin_role_id']); ?>" class="btn btn-info btn-xs mr5" >
										<i class="fa fa-sliders"></i>
									</a>
								</td>

							</tr>
							<?php endif;?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
<?php init_tail(); ?>
<script>
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable( {
		"processing": true,
		"serverSide": false,
		'responsive': true,});



</script>

