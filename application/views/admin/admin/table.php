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
	'active as active',
];
$where = [];
$sIndexColumn = 'admin_id';
$sTable = db_prefix() . 'admin';

$join = ['INNER JOIN ' . db_prefix() . 'roles ON ' . db_prefix() . 'roles.roleid = ' . db_prefix() . 'admin.admin_role_id'];
$i = 0;


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

	$row = [];
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

	for ($i = 0; $i < 0; $i++) {
		if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
			$_data = $aRow[strafter($aColumns[$i], 'as ')];
		} else {
			$_data = $aRow[$aColumns[$i]];
		}
		if ($aColumns[$i] == 'last_login') {
			if ($_data != null) {
				$_data = '<span class="text-has-action is-date" data-toggle="tooltip" data-title="' . _dt($_data) . '">' . time_ago($_data) . '</span>';
			} else {
				$_data = 'Never';
			}
		} elseif ($aColumns[$i] == 'active') {
			$checked = '';
			if ($aRow['active'] == 1) {
				$checked = 'checked';
			}

			$_data = '<div class="onoffswitch">
                <input type="checkbox"  data-switch-url="' . admin_url() . 'admin/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
                <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
            </div>';

			// For exporting
			$_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
		} elseif ($aColumns[$i] == 'firstname') {
			/*$_data = '<a href="' . admin_url('staff/profile/' . $aRow['id']) . '">' . staff_profile_image($aRow['id'], [
					'staff-profile-image-small',
				]) . '</a>';*/
			$_data = ' <a href="' . admin_url('admin/edit/' . $aRow['admin_id']) . '">' . $aRow['firstname'] . ' ' . $aRow['lastname'] . '</a>';

			$_data .= '<div class="row-options">';
			$_data .= '<a href="' . admin_url('admin/edit/' . $aRow['admin_id']) . '">' . _l('view') . '</a>';

			/*  if (($has_permission_delete && ($has_permission_delete && !is_admin($aRow['id']))) || is_admin()) {
				  if ($has_permission_delete && $output['iTotalRecords'] > 1 && $aRow['id'] != get_staff_user_id()) {
					  $_data .= ' | <a href="#" onclick="delete_staff_member(' . $aRow['id'] . '); return false;" class="text-danger">' . _l('delete') . '</a>';
				  }
			  }*/

			$_data .= '</div>';
		} elseif ($aColumns[$i] == 'email') {
			$_data = '<a href="mailto:' . $_data . '">' . $_data . '</a>';
		} else {
			if (strpos($aColumns[$i], 'date_picker_') !== false) {
				$_data = (strpos($_data, ' ') !== false ? _dt($_data) : _d($_data));
			}
		}
		$row[] = $_data;
	}
	$_data = ' <a href="' . admin_url('admin/edit/' . $aRow['admin_id']) . '">' . $aRow['firstname'] . '</a>';

	$row[] = $_data;
	$row[] = $aRow['lastname'];
	$row[] = $aRow['role'];
	$_data = '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>';
	$row[] = $_data;
	$row[] = $aRow['mobile_no'];
	$row[] = $aRow['updated_at'];
	if ($aRow['active'] == 1) {
		$checked = 'checked';
	}

	$_data = '<div class="onoffswitch">
                <input type="checkbox"  data-switch-url="' . admin_url() . 'admin/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['admin_id'] . '" data-id="' . $aRow['admin_id'] . '" ' . $checked . '>
                <label class="onoffswitch-label" for="c_' . $aRow['admin_id'] . '"></label>
            </div>';
	$row[] = $_data;
	$row['DT_RowClass'] = 'has-row-options';
	$output['aaData'][] = $row;
}
