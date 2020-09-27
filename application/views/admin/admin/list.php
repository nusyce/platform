
<div class="table-responsive">

	<table id="na_datatable" class="table zero-configuration dataTable"  role="grid" >

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
            <?php foreach($info as $row): ?>
            <tr>
            	<td>
					<?=$row['admin_id']?>
                </td>
                <td>
					<h4 class="m0 mb5"><?=$row['firstname']?> <?=$row['lastname']?></h4>
                    <small class="text-muted"><?=$row['admin_role_title']?></small>
					<div class="row-options"><a href="<?= base_url("admin/admin/edit/".$row['admin_id']); ?>" class="">
							Bearbeiten
						</a> |
						<a href="<?= base_url("admin/admin/delete/".$row['admin_id']); ?>"  class="text-danger _delete"> löschen</a></div>
                </td>
                <td>
                    <?=$row['username']?>
                </td> 
                <td>
					<?=$row['email']?>
                </td>
                <td>
                    <?=$row['admin_role_title']?>
                </td> 
                <td><div class="custom-control custom-switch"><input data-switch-url="<?=base_url("admin/admin/change_status")?>" class='tgl tgl-ios tgl_checkbox custom-control-input'
                    data-id="<?=$row['admin_id']?>"
                    id='cb_<?=$row['admin_id']?>'
                    type='checkbox' <?php echo ($row['is_active'] == 1)? "checked" : ""; ?> />
                    <label class="tgl-btn custom-control-label" for='cb_<?=$row['admin_id']?>'></label></div>
                </td>

            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable( {
		"processing": true,
		"serverSide": false,
		'responsive': true,});



</script>

