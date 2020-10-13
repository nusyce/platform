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
$where = [];
// Add blank where all filter can be stored
$filter = [];


$join = ['INNER JOIN ' . db_prefix() . 'admin ON ' . db_prefix() . 'admin.admin_id = ' . db_prefix() . 'activity_log.admin_id'];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

	$row[] = $aRow['description'];
	$row[] = $aRow['date'];
	$row[] = $aRow['username'];
	// Company


	$output['aaData'][] = $row;
}
