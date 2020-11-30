<?php

defined('BASEPATH') or exit('No direct script access allowed');
$CI= get_instance();
$CI->load->model('admin/tasks_model');
$task_statuses = $CI->tasks_model->get_statuses();
$tasksPriorities = get_tasks_priorities();

$aColumns = [
	'1', // bulk actions
	db_prefix() . 'tasks.id as id',
	db_prefix() . 'tasks.name as task_name',
	db_prefix() . 'tasks.status as status',
	'startdate',
	'duedate',
	db_prefix() . 'mieters.fullname as fullname',
	get_sql_select_task_asignees_full_names() . ' as assignees',
	'(SELECT count(' . db_prefix() . 'task_checklist_items.taskid) FROM ' . db_prefix() . 'task_checklist_items WHERE ' . db_prefix() . 'task_checklist_items.taskid=' . db_prefix() . 'tasks.id) as checkpoint',
	'datefinished',
	db_prefix() . 'tasks.project as project',
	'priority',
	db_prefix() . 'mieters.id as idm',
];

$sIndexColumn = 'id';
$sTable = db_prefix() . 'tasks';

$where=[];
array_push($where, 'AND mar_tasks.company_id='.get_user_company_id());
$join = [];
//$join[] = 'LEFT JOIN ' . db_prefix() . 'projects ON ' . db_prefix() . 'projects.id = ' . db_prefix() . 'tasks.project';
$join[] = 'LEFT JOIN ' . db_prefix() . 'mieters ON ' . db_prefix() . 'mieters.id = ' . db_prefix() . 'tasks.mieters';
$join[] = 'LEFT JOIN ' . db_prefix() . 'task_assigned ON ' . db_prefix() . 'task_assigned.taskid = ' . db_prefix() . 'tasks.id';

/*$staff = get_staff();
if (isset($staff->projects) && !empty($staff->projects)) {
	$stf_project = unserialize($staff->projects);
	if (is_array($stf_project)&&count($stf_project) > 0) {
		$stf_project = implode(",", $stf_project);
		array_push($where, ' AND ' . db_prefix() . 'tasks.project IN  (' . $stf_project . ') ');
	}
}
*/
/*include_once(APPPATH . 'views/admin/tables/includes/tasks_filter.php');

array_push($where, 'AND CASE WHEN rel_type="project" AND rel_id IN (SELECT project_id FROM ' . db_prefix() . 'project_settings WHERE project_id=rel_id AND name="hide_tasks_on_main_tasks_table" AND value=1) THEN rel_type != "project" ELSE 1=1 END');
*/
/*$custom_fields = get_table_custom_fields('tasks');

foreach ($custom_fields as $key => $field) {
	$selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
	array_push($customFieldsColumns, $selectAs);
	array_push($aColumns, '(SELECT value FROM ' . db_prefix() . 'customfieldsvalues WHERE ' . db_prefix() . 'customfieldsvalues.relid=' . db_prefix() . 'tasks.id AND ' . db_prefix() . 'customfieldsvalues.fieldid=' . $field['id'] . ' AND ' . db_prefix() . 'customfieldsvalues.fieldto="' . $field['fieldto'] . '" LIMIT 1) as ' . $selectAs);
}
*/
/*$aColumns = hooks()->apply_filters('tasks_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
	@$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}
*/
if ($this->ci->input->post('status')) {
	array_push($where, 'AND '.db_prefix() . 'tasks.status ="' . $this->ci->db->escape_str($this->ci->input->post('status')) . ' " ');
}

if ($this->ci->input->post('start_date')) {
	array_push($where, 'AND startdate ="' . date('Y-m-d', strtotime($this->ci->input->post('start_date'))) . ' " ');
}


if ($this->ci->input->post('end_date')) {
	array_push($where, 'AND duedate ="' . date('Y-m-d', strtotime($this->ci->input->post('end_date'))) . ' " ');
}
if ($this->ci->input->post('member')) {
	array_push($where, 'AND ' . db_prefix() . 'task_assigned.user_id ="' . $this->ci->db->escape_str($this->ci->input->post('member')) . ' " ');
}


if ($this->ci->input->post('priority')) {
	array_push($where, 'AND priority ="' . $this->ci->db->escape_str($this->ci->input->post('priority')) . ' " ');
}

$result = data_tables_init(
	$aColumns,
	$sIndexColumn,
	$sTable,
	$join,
	$where,
	[
	]
);

$output = $result['output'];
$rResult = $result['rResult'];

$rResult = unique_multidim_array($rResult, 'id');
foreach ($rResult as $aRow) {
	if ($this->ci->input->post('member') && !hisMember($this->ci->input->post('member'), $aRow['id']))
		continue;

	$row = [];

	$row[] = '<div class="checkbox multiple_action"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

	$row[] = '<a href="' . admin_url('tasks/view/' . $aRow['id']) . '" onclick="init_task_modal(' . $aRow['id'] . '); return false;">' . $aRow['id'] . '</a>';

	$outputName = '';

	if ($aRow['not_finished_timer_by_current_staff']) {
		$outputName .= '<span class="pull-left text-danger"><i class="fa fa-clock-o fa-fw"></i></span>';
	}

	$outputName .= '<a href="' . admin_url('tasks/view/' . $aRow['id']) . '" class="display-block main-tasks-table-href-name' . (!empty($aRow['rel_id']) ? ' mbot5' : '') . '" onclick="init_task_modal(' . $aRow['id'] . '); return false;">' . $aRow['task_name'] . '</a>';

	if ($aRow['rel_name']) {
		$relName = task_rel_name($aRow['rel_name'], $aRow['rel_id'], $aRow['rel_type']);

		$link = task_rel_link($aRow['rel_id'], $aRow['rel_type']);

		$outputName .= '<span class="hide"> - </span><a class="text-muted task-table-related" data-toggle="tooltip" data-original-title="' . _l('task_related_to') . '" href="' . $link . '">' . $relName . '</a>';
	}

	if ($aRow['recurring'] == 1) {
		$outputName .= '<br /><span class="label label-primary inline-block mtop4"> ' . _l('recurring_task') . '</span>';
	}

	$outputName .= '<div class="row-options">';

	$class = 'text-success bold';
	$style = '';

	$tooltip = '';
	if ($aRow['billed'] == 1 || !$aRow['is_assigned'] || $aRow['status'] == Tasks_model::STATUS_COMPLETE) {
		$class = 'text-dark disabled';
		$style = 'style="opacity:0.6;cursor: not-allowed;"';
		if ($aRow['status'] == Tasks_model::STATUS_COMPLETE) {
			$tooltip = ' data-toggle="tooltip" data-title="' . format_task_status($aRow['status'], false, true) . '"';
		} elseif ($aRow['billed'] == 1) {
			$tooltip = ' data-toggle="tooltip" data-title="' . _l('task_billed_cant_start_timer') . '"';
		} elseif (!$aRow['is_assigned']) {
			$tooltip = ' data-toggle="tooltip" data-title="' . _l('task_start_timer_only_assignee') . '"';
		}
	}

//    if ($aRow['not_finished_timer_by_current_staff']) {
//        $outputName .= '<a href="#" class="text-danger tasks-table-stop-timer" onclick="timer_action(this,' . $aRow['id'] . ',' . $aRow['not_finished_timer_by_current_staff'] . '); return false;">' . _l('task_stop_timer') . '</a>';
//    } else {
//        $outputName .= '<span' . $tooltip . ' ' . $style . '>
//        <a href="#" class="' . $class . ' tasks-table-start-timer" onclick="timer_action(this,' . $aRow['id'] . '); return false;">' . _l('task_start_timer') . '</a>
//        </span>';
//    }


	$outputName .= '<a href="#" onclick="edit_task(' . $aRow['id'] . '); return false">' . _l('Bearbeiten') . '</a>';


	$outputName .= '<span class="text-dark"> | </span><a href="#" onclick="similar_task(' . $aRow['id'] . '); return false" class="text-success   task-copy">' . _l('Create similar') . '</a>';
	//      $outputName .= '<span class="text-dark"> | </span><a href="'.admin_url('tasks/copy_task/').'" onclick="similar_task(' . $aRow['id'] . '); return false" class="text-success   task-copy">' . _l('Create similar') . '</a>';



	$outputName .= '<span class="text-dark"> | </span><a href="' . admin_url('task/delete_task/' . $aRow['id']) . '" class="text-danger _delete task-delete">' . _l('löschen') . '</a>';

	$outputName .= '</div>';

	$row[] = $outputName;
	$canChangeStatus = ($aRow['current_user_is_creator'] != '0' || $aRow['current_user_is_assigned'] || has_permission('tasks', '', 'edit'));
	$status = get_task_status_by_id($aRow['status']);
	$outputStatus = '<div class="dropdown">';

	$outputStatus .= '<a class="btn  dropdown-toggle" style="color:' . $status['color'] . '; border: 1px solid;
    padding-top: 0px;
    padding-bottom: 0px;
    font-size: 12px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$status['name'].'
  </a>';


	$outputStatus .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
	if ($canChangeStatus) {

		foreach ($task_statuses as $taskChangeStatus) {
			if ($aRow['status'] != $taskChangeStatus['id']) {
				$outputStatus .= '<a class="dropdown-item" href="#" style="color:black" onclick="task_mark_as(' . $taskChangeStatus['id'] . ',' . $aRow['id'] . ');">'.$taskChangeStatus['name'].'</a>';
			}
		}

	}

	$outputStatus .= '</div></div>';
	$row[] = $outputStatus;
	$row[] = $aRow['startdate'];

	$row[] = $aRow['duedate'];
	$row[]= '  <a href="' . admin_url('mieter/mieter/' . $aRow['idm']) . '">' .  $aRow['fullname']. '</a>';
	$row[] = format_members_by_ids_and_names($aRow['assignees_ids'], $aRow['assignees']);
	$row[] = '<div class="text-center">' . $aRow['checkpoint'] . '</div>';

	if ($aRow['datefinished']) {
		$row[] = date('d.m.Y H:i', strtotime($aRow['datefinished']));
	} else {

		$row[] = '';
	}
	//$row[] = render_tags($aRow['tags']);
	$row[] = $aRow['project'];



	$outputPriority = '<div class="dropdown">';

	$outputPriority .= '<a class="btn  dropdown-toggle" style="color:' . task_priority_color($aRow['priority']) . '; border: 1px solid;
    padding-top: 0px;
    padding-bottom: 0px;
    font-size: 12px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.task_priority($aRow['priority']).'
  </a>';


	$outputPriority .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';


		foreach ($tasksPriorities as $priority) {
			if ($aRow['priority'] != $priority['id']) {
				$outputPriority .= '<a class="dropdown-item" href="#" style="color:black" onclick="task_change_priority(' . $priority['id'] . ',' . $aRow['id'] . ');">'.$priority['name'].'</a>';
			}
		}



	$outputPriority .= '</div></div>';
	$row[] = $outputPriority;

	// Custom fields add values
	foreach ($customFieldsColumns as $customFieldColumn) {
		$row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
	}

	$row['DT_RowClass'] = 'has-row-options';

	if ((!empty($aRow['duedate']) && $aRow['duedate'] < date('Y-m-d')) && $aRow['status'] != Tasks_model::STATUS_COMPLETE) {
		$row['DT_RowClass'] .= ' text-danger';
	}

	$output['aaData'][] = $row;
}
