<?php

defined('BASEPATH') or exit('No direct script access allowed');

//$hasPermissionDelete = has_permission('customers', '', 'delete');
$hasPermissionDelete = true;

//$custom_fields = get_table_custom_fields('customers');
$this->ci->db->query("SET sql_mode = ''");

$aColumns = [
	'description',
	'date',
	'username',

];

$sIndexColumn = 'id';
$sTable = db_prefix() . 'activity_log';
$data['company_id']=get_user_company_id();
$where=[];
array_push($where, 'AND '.db_prefix() . 'activity_log.company_id='.get_user_company_id());
// Add blank where all filter can be stored

$filter = [];
if ($this->ci->input->post('activity_log_date')) {
	$date=date_format(date_create($this->ci->db->escape_str($this->ci->input->post('activity_log_date'))),"Y-m-d");
	array_push($where, 'AND date like "%'.$date.'%" ');
}

$join = ['INNER JOIN ' . db_prefix() . 'admin ON ' . db_prefix() . 'admin.admin_id = ' . db_prefix() . 'activity_log.admin_id'];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];
$i=1;
foreach ($rResult as $aRow) {
	$row = [];
	$row[] = $aRow['description'];
	$row[] = $aRow['date'];
	$row[] = $aRow['username'];
	// Company


	$output['aaData'][] = $row;
	$i++;
}
