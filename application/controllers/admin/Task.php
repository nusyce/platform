<?php defined('BASEPATH') or exit('No direct script access allowed');

class Task extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		//$this->load->model('admin/Mieter_model', 'mieter_model');
		$this->load->model('admin/admin_roles_model', 'admin_roles');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('/admin/tasks_model');
	}
	public function mark_as($status, $id)
	{
		if ($this->tasks_model->is_task_assignee(get_user_id(), $id)
			|| $this->tasks_model->is_task_creator(get_user_id(), $id)
			|| has_permission('tasks', '', 'edit')) {
			$success = $this->tasks_model->mark_as($status, $id);

			// Don't do this query if the action is not performed via task single
			$taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';

			$message = '';

			if ($success) {
				$message = _l('task_marked_as_success', format_task_status($status, true, true));
			}

			echo json_encode([
				'success' => $success,
				'message' => $message,
				'data' => $this->refresh_status(),
				'taskHtml' => $taskHtml,
			]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => '',
				'taskHtml' => '',
			]);
		}
	}

	public function index()
	{
		$data['title'] = 'Task';
		$this->load->model('admin/tasks_model');

		$data['statuses'] = $this->tasks_model->get_statuses();
		$data['member'] = $this->admin_model->get('',['company_id' => get_user_company_id()]);

		$this->load->view('admin/task/list', $data);

	}
	public function pdf($id)
	{
		if (!$id) {
			redirect(admin_url('tasks'));
		}

		$task = $this->tasks_model->get($id);
		$task = $this->tasks_model->get($id);
		$signature="";

		if (isset($_POST['imageData']) && !empty($_POST['imageData'])) {
			$signature = str_replace('[removed]', '', $_POST['imageData']);
		}
		try {
			$tag = isset($_GET['full']) ? 'full' : '';
			$pdf = task_pdf($task, $tag,$signature);
		} catch (Exception $e) {
			$message = $e->getMessage();
			echo $message;
			if (strpos($message, 'Unable to get the size of the image') !== false) {
				show_pdf_unable_to_get_image_size_error();
			}
			die;
		}

		$type = 'D';

		if ($this->input->get('output_type')) {
			$type = $this->input->get('output_type');
		}

		if ($this->input->get('print')) {
			$type = 'I';
		}

		$pdf->Output(mb_strtoupper(slug_it('$invoice_number')) . '.pdf', $type);
	}

	public function checkbox_action($listid, $value)
	{
		$this->db->where('id', $listid);
		$this->db->update(db_prefix() . 'task_checklist_items', [
			'finished' => $value,
		]);

		if ($this->db->affected_rows() > 0) {
			if ($value == 1) {
				$this->db->where('id', $listid);
				$this->db->update(db_prefix() . 'task_checklist_items', [
					'finished_from' => get_user_company(),
				]);

			}
		}
	}
	public function update_checklist_item()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$desc = $this->input->post('description');
				$desc = trim($desc);
				$this->tasks_model->update_checklist_item($this->input->post('listid'), $desc);
				echo json_encode(['can_be_template' => (total_rows(db_prefix() . 'tasks_checklist_templates', ['description' => $desc]) == 0)]);
			}
		}
	}
	public function update_checklist_order()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$this->tasks_model->update_checklist_order($this->input->post());
			}
		}
	}
	public function checklist($id)
	{

		if (!$id) {
			redirect(admin_url('tasks'));
		}
		$task = $this->tasks_model->get($id);
		$signature="";

		if (isset($_POST['imageData']) && !empty($_POST['imageData'])) {
			$signature = str_replace('[removed]', '', $_POST['imageData']);
		}

		try {
			task_pdf($task, 'checklist',$signature);
		} catch (Exception $e) {
			$message = $e->getMessage();
			echo $message;
			if (strpos($message, 'Unable to get the size of the image') !== false) {
				show_pdf_unable_to_get_image_size_error();
			}
			die;
		}
	}
	public function get_task_data($taskid, $return = false)
	{
		$tasks_where = [];


		//$tasks_where = get_tasks_where_string(false);


		$task = $this->tasks_model->get($taskid, $tasks_where);

		if (!$task) {
			header('HTTP/1.0 404 Not Found');
			echo 'Task not found';
			die();
		}

		$data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
		$data['task'] = $task;
		$data['id'] = $task->id;
		$data['staff'] = $this->admin_model->get('', ['active' => 1]);
		$data['reminders'] = $this->tasks_model->get_reminders($taskid);

		$data['staff_reminders'] = $this->tasks_model->get_staff_members_that_can_access_task($taskid);

		$data['project_deadline'] = null;
		if ($task->rel_type == 'project') {
			$data['project_deadline'] = get_project_deadline($task->rel_id);
		}

		if ($return == false) {
			$this->load->view('admin/task/view_task_template', $data);
		} else {
			return $this->load->view('admin/task/view_task_template', $data, true);
		}
	}
	public function init_checklist_items()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				$post_data = $this->input->post();
				$data['task_id'] = $post_data['taskid'];
				$data['checklists'] = $this->tasks_model->get_checklist_items($post_data['taskid']);
				$this->load->view('admin/task/checklist_items_template', $data);
			}
		}
	}
	public function add_checklist_item()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {
				echo json_encode([
					'success' => $this->tasks_model->add_checklist_item($this->input->post()),
				]);
			}
		}
	}
	public function delete_task($id)
	{

		$success = $this->tasks_model->delete_task($id);
		$message = _l('problem_deleting', _l('task_lowercase'));
		if ($success) {
			$message = _l('deleted', _l('task'));
			set_alert('success', $message);
		} else {
			set_alert('warning', $message);
		}

		if (strpos($_SERVER['HTTP_REFERER'], 'task/index') !== false || strpos($_SERVER['HTTP_REFERER'], 'task/view') !== false) {
			redirect(admin_url('tasks'));
		} elseif (preg_match("/projects\/view\/[1-9]+/", $_SERVER['HTTP_REFERER'])) {
			$project_url = explode('?', $_SERVER['HTTP_REFERER']);
			redirect($project_url[0] . '?group=project_tasks');
		} else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function delete_checklist_item($id)
	{
		$list = $this->tasks_model->get_checklist_item($id);

			if ($this->input->is_ajax_request()) {
				echo json_encode([
					'success' => $this->tasks_model->delete_checklist_item($id),
				]);
			}

	}
	public function change_priority($priority_id, $id)
	{
		if (has_permission('tasks', '', 'edit')) {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'tasks', ['priority' => $priority_id]);

			$success = $this->db->affected_rows() > 0 ? true : false;

			// Don't do this query if the action is not performed via task single
			$taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';
			echo json_encode([
				'success' => $success,
				'taskHtml' => $taskHtml,
			]);
		} else {
			echo json_encode([
				'success' => false,
				'taskHtml' => $taskHtml,
			]);
		}
	}
	public function remove_assignee($id, $taskid)
	{

			$success = $this->tasks_model->remove_assignee($id, $taskid);
			$message = '';
			if ($success) {
				$message = _l('task_assignee_removed');
			}
			echo json_encode([
				'success' => $success,
				'message' => $message,
				'taskHtml' => $this->get_task_data($taskid, true),
			]);

	}
	public function task($id = '')
	{

		$data = [];
		// FOr new task add directly from the projects milestones
		if ($this->input->get('milestone_id')) {
			$this->db->where('id', $this->input->get('milestone_id'));
			$milestone = $this->db->get(db_prefix() . 'milestones')->row();
			if ($milestone) {
				$data['_milestone_selected_data'] = [
					'id' => $milestone->id,
					'due_date' => _d($milestone->due_date),
				];
			}
		}
		if ($this->input->get('start_date')) {
			$data['start_date'] = $this->input->get('start_date');
		}
		if ($this->input->post()) {


			$data = $this->input->post();
			$data['description'] = $this->input->post('description', false);
			if ($id == '') {
				/*if (!has_permission('tasks', '', 'create')) {
					header('HTTP/1.0 400 Bad error');
					echo json_encode([
						'success' => false,
						'message' => _l('access_denied'),
					]);
					die;
				}*/

				$id = $this->tasks_model->add($data);

				$_id = false;
				$success = false;
				$message = '';
				if ($id) {
					$success = true;
					$_id = $id;
					$message = _l('added_successfully', _l('task'));
					$uploadedFiles = handle_task_attachments_array($id);
					if ($uploadedFiles && is_array($uploadedFiles)) {
						foreach ($uploadedFiles as $file) {
							$this->misc_model->add_attachment_to_database($id, 'task', [$file]);
						}
					}
				}
				echo json_encode([
					'success' => $success,
					'data' => $this->refresh_status(),
					'id' => $_id,
					'message' => $message,
				]);
			} else {
				/*
					header('HTTP/1.0 400 Bad error');
					echo json_encode([
						'success' => false,
						'message' => _l('access_denied'),
					]);
					die;
				}*/

				$success = $this->tasks_model->update($data, $id);

				$message = '';
				if ($success) {
					$message = _l('updated_successfully', _l('task'));
				}

				echo json_encode([
					'success' => $success,
					'data' => $this->refresh_status(),
					'message' => $message,
					'id' => $id,
				]);
			}
			//die;
			set_alert('success', $message);
			redirect('admin/task');
		}

		$data['milestones'] = [];
		$data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
		if ($id == '') {
			$title = _l('add_new', _l('task_lowercase'));
		} else {
			$data['task'] = $this->tasks_model->get($id);
			if ($data['task']->rel_type == 'project') {
				$data['milestones'] = $this->projects_model->get_milestones($data['task']->rel_id);
			}
			$title = _l('edit', _l('task_lowercase')) . ' ' . $data['task']->name;
		}

		$data['project_end_date_attrs'] = [];
		if ($this->input->get('rel_type') == 'project' && $this->input->get('rel_id') || ($id !== '' && $data['task']->rel_type == 'project')) {
			$project = $this->projects_model->get($id === '' ? $this->input->get('rel_id') : $data['task']->rel_id);

			if ($project->deadline) {
				$data['project_end_date_attrs'] = [
					'data-date-end-date' => $project->deadline,
				];
			}
		}
		$this->load->model(['admin/lieferanten_model', 'admin/misc_model', 'admin/mieter_model','admin/cars_model','admin/client_model']);
		$data['id'] = $id;
		$data['title'] = $title;
		$data['mieters'] = $this->mieter_model->get();
		$dStaff = $this->admin_model->get('', ['active' => 1], true);
		//$staffs = array();
		$staffs=$dStaff;
		/*foreach ($dStaff as $d) {
			if ($d['role'] == 9999) {
				$d['firstname'] = $this->lieferanten_model->get_by_userid($d['staffid'])->company;
			}
			array_push($staffs, $d);
		}
*/
		$data['staff'] = $staffs;
		$data['projects'] = $this->misc_model->get_project();
		$data['cars'] = $this->cars_model->get();
		$data['clients'] = $this->client_model->get('',[db_prefix().'clients.active'=>1]);

		$this->load->view('admin/task/task', $data);
	}
	public function render($task = '')
	{
		$this->app->get_renderable_data('task/table', ['task' => $task]);
	}
	public function refresh_status()
	{
		$tasks_my_where = 'id IN(SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE user_id=' . get_user_id() . ')';

		$sqlProjectTasksWhere = ' AND CASE
            WHEN rel_type="project" AND rel_id IN (SELECT project_id FROM ' . db_prefix() . 'project_settings WHERE project_id=rel_id AND name="hide_tasks_on_main_tasks_table" AND value=1)
            THEN rel_type != "project"
            ELSE 1=1
            END';
		$tasks_my_where .= $sqlProjectTasksWhere;
		ob_start();
		?>
		<div class="col-md-2 col-xs-6 border-right">
			<h3 class="bold no-mtop"><?php echo total_rows(db_prefix() . 'tasks') ?></h3>
			<p style="color:#000" class="font-medium no-mbot">
				Alle Aufgaben
			</p>
			<p class="font-medium-xs no-mbot text-muted">
				<?php echo _l('tasks_view_assigned_to_user'); ?>
				: <?php echo total_rows(db_prefix() . 'tasks', $tasks_my_where) ?>
			</p>
		</div>

		<?php foreach (tasks_summary_data((isset($rel_id) ? $rel_id : null), (isset($rel_type) ? $rel_type : null)) as $summary) { ?>
		<div class="col-md-2 col-xs-6 border-right">
			<h3 class="bold no-mtop"><?php echo $summary['total_tasks']; ?></h3>
			<p style="color:<?php echo $summary['color']; ?>" class="font-medium no-mbot">
				<?php echo $summary['name']; ?>
			</p>
			<p class="font-medium-xs no-mbot text-muted">
				<?php echo _l('tasks_view_assigned_to_user'); ?>: <?php echo $summary['total_my_tasks']; ?>
			</p>
		</div>
	<?php }
		$data = ob_get_contents();
		ob_end_clean();
		return $data;
	}

}

?>	
