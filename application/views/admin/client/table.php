<?php

defined('BASEPATH') or exit('No direct script access allowed');

//$hasPermissionDelete = has_permission('customers', '', 'delete');
$hasPermissionDelete = true;

//$custom_fields = get_table_custom_fields('customers');
$this->ci->db->query("SET sql_mode = ''");

$aColumns = [
	'1',
	'company',
	1,
	1,
	db_prefix() . 'clients.email as email',
	db_prefix() . 'clients.phonenumber as phonenumber',
	'active',
	db_prefix() . 'clients.userid as userid',
	1,
	db_prefix() . 'clients.datecreated as datecreated',
];

$sIndexColumn = 'userid';
$sTable = db_prefix() . 'clients';
$where = [];
// Add blank where all filter can be stored
$filter = [];


$join = [

];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
	$row = [];

	// Bulk actions
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['userid'] . '"><label></label></div>';
	// User id
	$row[] = $aRow['userid'];

	// Company
	$company = $aRow['company'];
	$isPerson = false;

	if ($company == '') {
		$company = _l('no_company_view_profile');
		$isPerson = true;
	}

	$url = admin_url('clients/client/' . $aRow['userid']);

	if ($isPerson && $aRow['contact_id']) {
		$url .= '?contactid=' . $aRow['contact_id'];
	}

	$company = '<a href="' . $url . '">' . $company . '</a>';

	$company .= '<div class="row-options">';
	$company .= '<a href="' . admin_url('client/client/' . $aRow['userid'] . ($isPerson && $aRow['contact_id'] ? '?group=contacts' : '')) . '">' . _l('Bearbeiten') . '</a>';

	/*if ($aRow['registration_confirmed'] == 0 && is_admin()) {
		$company .= ' | <a href="' . admin_url('clients/confirm_registration/' . $aRow['userid']) . '" class="text-success bold">' . _l('confirm_registration') . '</a>';
	}
	if (!$isPerson) {
		$company .= ' | <a href="' . admin_url('clients/client/' . $aRow['userid'] . '?tab=customer_admins') . '">' . _l('customer_contacts') . '</a>';
	}*/
	if ($hasPermissionDelete) {
		$company .= ' | <a href="' . admin_url('client/delete/' . $aRow['userid']) . '" class="text-danger _delete">' . _l('löschen') . '</a>';
	}

	$company .= '</div>';

	$row[] = $company;

	$row[] = 1;
	$row[] = 1;
	//$row[] = '<span style="text-align: center; display: block">'.$this->ci->clients_model->get_mieter_number($aRow['userid']).'</span>';

	// Primary contact
	//  $row[] = ($aRow['contact_id'] ? '<a href="' . admin_url('clients/client/' . $aRow['userid'] . '?contactid=' . $aRow['contact_id']) . '" target="_blank">' . $aRow['firstname'] . ' ' . $aRow['lastname'] . '</a>' : '');

	// Primary contact email
	$row[] = ($aRow['email'] ? '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>' : '');

	// Primary contact phone
	$row[] = ($aRow['phonenumber'] ? '<a href="tel:' . $aRow['phonenumber'] . '">' . $aRow['phonenumber'] . '</a>' : '');

	// Toggle active/inactive customer
	if ($aRow['active'] == 1) {
		$checked = 'checked';
	}
	$toggleActive = '<div class="onoffswitch" >
    <input type="checkbox" data-switch-url="' . admin_url() . 'client/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . $checked. '>
    <label class="onoffswitch-label" for="c_' . $aRow['userid'] . '"></label>
    </div>';

	// For exporting


	$row[] = $toggleActive;

	// Customer groups parsing
	$groupsRow = '';
	if ($aRow['customerGroups']) {
		$groups = explode(',', $aRow['customerGroups']);
		foreach ($groups as $group) {
			$groupsRow .= '<span class="label label-default mleft5 inline-block customer-group-list pointer">' . $group . '</span>';
		}
	}

	// $row[] = $groupsRow;

	//  $row[] = _dt($aRow['datecreated']);

	// Custom fields add values
	foreach ($customFieldsColumns as $customFieldColumn) {
		$row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
	}

	/*$row['DT_RowClass'] = 'has-row-options';

	if ($aRow['registration_confirmed'] == 0) {
		$row['DT_RowClass'] .= ' alert-info requires-confirmation';
		$row['Data_Title'] = _l('customer_requires_registration_confirmation');
		$row['Data_Toggle'] = 'tooltip';
	}*/



	$output['aaData'][] = $row;
}
