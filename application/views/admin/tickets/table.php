<?php

defined('BASEPATH') or exit('No direct script access allowed');

//$hasPermissionDelete = has_permission('customers', '', 'delete');
$hasPermissionDelete = true;

//$custom_fields = get_table_custom_fields('customers');
$this->ci->db->query("SET sql_mode = ''");

$aColumns = [
	'ticketid',
	'subject',
	'service',
	'assigned',
	'status',
	'priority',
	'lastreply',
	'date',


];

$sIndexColumn = 'ticketid';
$sTable = db_prefix() . 'tickets';
$where=[];
array_push($where, 'AND company_id='.get_user_company_id());
// Add blank where all filter can be stored
$filter = [];


$join = [

];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];
$i=1;
foreach ($rResult as $aRow) {
	$row = [];

	// Bulk actions
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['ticketid'] . '"><label></label></div>';
	// User id
	$row[] = $i;

	// Company
	$subjectOutput = '<a href="' . admin_url('ticket/ticket/' . $aRow['ticketid']) . '">' . $aRow['subject'] . '</a>';
	$subjectOutput .= '<div class="row-options">';
	$subjectOutput .= '  <a href="' . admin_url('ticket/ticket/' . $aRow['ticketid']) . '">' . _l('Bearbeiten') . '</a>';

	/*    if (has_permission('mieter', '', 'delete')) {*/
	$subjectOutput .= ' | <a href="' . admin_url('ticket/delete/' . $aRow['ticketid']) . '" class="text-danger _delete">' . _l('löschen') . '</a>';
	/* }*/

	$subjectOutput .= '</div>';
	$row[] = $subjectOutput;
	$row[] = $aRow['service'];
	$row[] = $aRow['assigned'];
	$status='<span class="label inline-block ticket-status-3" style="padding: 3px 6px;border:1px solid '.ticket_status_color($aRow['status']).';color: '.ticket_status_color($aRow['status']).'">'.ticket_status_translate($aRow['status']).'</span>';
	$row[] = $status;
	$row[] = $aRow['priority'];
	$row[] = $aRow['lastreply'];
	$row[] = $aRow['date'];


	$output['aaData'][] = $row;
	$i++;
}
