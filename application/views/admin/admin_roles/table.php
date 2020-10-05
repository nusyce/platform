<?php

defined('BASEPATH') or exit('No direct script access allowed');


$aColumns = [
	'admin_role_id',
	'admin_role_title',
	'active as active',

];
$where = [];
$sIndexColumn = 'admin_role_id';
$sTable = db_prefix() . 'admin_roles';

$join = [];
$i = 0;


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

	$row = [];
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['admin_role_id'] . '"><label></label></div>';


	$_data = ' <a href="' . admin_url('admin_roles/edit/' . $aRow['admin_role_id']) . '">' . $aRow['admin_role_title'] . '</a>';

	$row[] = $_data;

	$_data = $_data = ' <a href="' . admin_url('admin_roles/access/' . $aRow['admin_role_id']) . '"><class="btn btn-info btn-xs mr5">
										<i class="fa fa-sliders"></i>
									</a>';
	$row[] = $_data;

	$_data = '<div class="onoffswitch">
                <input type="checkbox"  data-switch-url="' . admin_url() . 'admin_roles/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['admin_role_id'] . '" data-id="' . $aRow['admin_role_id'] . '" ' . ($aRow['active'] == 1 ? 'checked' : '') . '>
                <label class="onoffswitch-label" for="c_' . $aRow['admin_role_id'] . '"></label>
            </div>';
	$row[] = $_data;



	$row['DT_RowClass'] = 'has-row-options';
	$output['aaData'][] = $row;
}
