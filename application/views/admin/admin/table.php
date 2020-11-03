<?php

defined('BASEPATH') or exit('No direct script access allowed');


$aColumns = [
	'admin_id',
	'firstname',
	'lastname',
	2,
	'email',
	'mobile_no',
	'updated_at',
	db_prefix() . 'admin.active as active',
	db_prefix() . 'admin_roles.admin_role_title as role'
];
$where=[];
array_push($where, 'AND company_id='.get_user_company_id());
$sIndexColumn = 'admin_id';
$sTable = db_prefix() . 'admin';

$join = ['INNER JOIN ' . db_prefix() . 'admin_roles ON ' . db_prefix() . 'admin_roles.admin_role_id = ' . db_prefix() . 'admin.admin_role_id'];
$i = 0;


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

	$row = [];
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';


	$_data = ' <a href="' . admin_url('admin/edit/' . $aRow['admin_id']) . '">' . $aRow['firstname'] . '</a>';

	$row[] = $_data;
	$row[] = $aRow['lastname'];
	$row[] = $aRow['role'];
	$_data = '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>';
	$row[] = $_data;
	$row[] = $aRow['mobile_no'];
	$row[] = $aRow['updated_at'];
	if ($aRow['active'] == 1 || $aRow['active'] == '1') {
		$checked = 'checked';
	}else
	{
		$checked = '';
	}

	$_data = '<div class="onoffswitch">
                <input type="checkbox"  data-switch-url="' . admin_url() . 'admin/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['admin_id'] . '" data-id="' . $aRow['admin_id'] . '" ' . $checked . '>
                <label class="onoffswitch-label" for="c_' . $aRow['admin_id'] . '"></label>
            </div>';
	$row[] = $_data;
	$row['DT_RowClass'] = 'has-row-options';
	$output['aaData'][] = $row;
}
