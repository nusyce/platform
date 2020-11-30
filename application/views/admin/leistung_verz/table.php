<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    '1',
    db_prefix() . 'leistung.id as id',
    db_prefix() . 'leistung.name as name',
    '(SELECT COUNT(*) FROM ' . db_prefix() . 'item_leist WHERE ' . db_prefix() . 'item_leist.leistung = ' . db_prefix() . 'leistung.id) as checkpoints'
];


$sIndexColumn = 'id';
$sTable = db_prefix() . 'leistung';
$where = [];
array_push($where, 'AND company_id='.get_user_company_id());
$join = [];
$filter = [];

//$join[] = 'LEFT JOIN ' . db_prefix() . 'item_leist ON ' . db_prefix() . 'item_leist.leistung = ' . db_prefix() . 'leistung.id';


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix() . 'leistung.id']);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    $row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';
    $row[] = $aRow['id'];

    $subjectOutput = '<a href="#" onclick="edit_leistung(event,'.$aRow['id'].'); return false;">' . $aRow['name'] . '</a>';

    $subjectOutput .= '<div class="row-options">';
    $subjectOutput .= '  <a href="#" onclick="edit_leistung(event,'.$aRow['id'].'); return false;">' . _l('edit') . '</a>';

    /*    if (has_permission('leistung', '', 'delete')) {*/
    $subjectOutput .= ' | <a href="'.admin_url("leistung_verz/delete/").$aRow['id'].'" class="text-danger _delete">' . _l('delete') . '</a>';
    /* }*/

    $subjectOutput .= '</div>';
    $row[] = $subjectOutput;
    $row[] = $aRow['checkpoints'];
    if (!empty($aRow['dateend'])) {
        $_date_end = date('Y-m-d', strtotime($aRow['dateend']));
        if ($_date_end < date('Y-m-d')) {
            $row['DT_RowClass'] = 'alert-danger';
        }
    }

    if (isset($row['DT_RowClass'])) {
        $row['DT_RowClass'] .= ' has-row-options';
    } else {
        $row['DT_RowClass'] = 'has-row-options';
    }



    $output['aaData'][] = $row;
}
