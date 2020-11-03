<?php

defined('BASEPATH') or exit('No direct script access allowed');

//$hasPermissionDelete = has_permission('customers', '', 'delete');
$hasPermissionDelete = true;

//$custom_fields = get_table_custom_fields('customers');
$this->ci->db->query("SET sql_mode = ''");

$aColumns = [
	db_prefix() . 'subscriptions.id as id',
	db_prefix() . 'companies.company as company',
	db_prefix() . 'packs.name as package',
	db_prefix() . 'packs.price as price',
	"concat(".db_prefix() . "admin.firstname,' ',".db_prefix() . "admin.firstname) as fullname",
	db_prefix() . 'subscriptions.created_at as created_at',
];

$sIndexColumn = 'id';
$sTable = db_prefix() . 'subscriptions';
$where=[];
//array_push($where, 'AND company_id='.get_user_company_id());

// Add blank where all filter can be stored
$filter = [];


$join = [];
$join[] = 'LEFT JOIN ' . db_prefix() . 'admin ON ' . db_prefix() . 'admin.admin_id = ' . db_prefix() . 'subscriptions.user_id';
$join[] = 'LEFT JOIN ' . db_prefix() . 'companies ON ' . db_prefix() . 'companies.id = ' . db_prefix() . 'subscriptions.company_id';
$join[] = 'LEFT JOIN ' . db_prefix() . 'packs ON ' . db_prefix() . 'packs.id = ' . db_prefix() . 'subscriptions.id_pack';


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];
$i=1;
foreach ($rResult as $aRow) {
	$row = [];

	// Bulk actions
	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';
	// User id

	$row[]=$aRow['id'];
	// Company
	$row[] = $aRow['company'];
	$row[] = $aRow['package'];
	$row[] = "€".$aRow['price'];
	$row[] = $aRow['fullname'];
	$row[] = $aRow['created_at'];
	$output['aaData'][] = $row;
	$i++;
}
