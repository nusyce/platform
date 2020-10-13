<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model{

	public function get_weekly_tickets_opening_statistics()
	{
		$departments_ids = [];
		/*if (!is_admin()) {
			if (get_option('staff_access_only_assigned_departments') == 1) {
				$this->load->model('departments_model');
				$staff_deparments_ids = $this->departments_model->get_staff_departments(get_staff_user_id(), true);
				$departments_ids      = [];
				if (count($staff_deparments_ids) == 0) {
					$departments = $this->departments_model->get();
					foreach ($departments as $department) {
						array_push($departments_ids, $department['departmentid']);
					}
				} else {
					$departments_ids = $staff_deparments_ids;
				}
			}
		}*/

		$chart = [
			'labels'   => get_weekdays(),
			'datasets' => [
				[
					'label'           => _l('home_weekend_ticket_opening_statistics'),
					'backgroundColor' => 'rgba(197, 61, 169, 0.5)',
					'borderColor'     => '#c53da9',
					'borderWidth'     => 1,
					'tension'         => false,
					'data'            => [
						0,
						0,
						0,
						0,
						0,
						0,
						0,
					],
				],
			],
		];

		$monday = new DateTime(date('Y-m-d', strtotime('monday this week')));
		$sunday = new DateTime(date('Y-m-d', strtotime('sunday this week')));

		$thisWeekDays = get_weekdays_between_dates($monday, $sunday);

		$byDepartments = count($departments_ids) > 0;
		if (isset($thisWeekDays[1])) {
			$i = 0;
			foreach ($thisWeekDays[1] as $weekDate) {
				$this->db->like('DATE(date)', $weekDate, 'after');
				if ($byDepartments) {
					$this->db->where('department IN (SELECT departmentid FROM ' . db_prefix() . 'staff_departments WHERE departmentid IN (' . implode(',', $departments_ids) . ') AND staffid="' . get_staff_user_id() . '")');
				}
				$chart['datasets'][0]['data'][$i] = $this->db->count_all_results(db_prefix() . 'tickets');

				$i++;
			}
		}

		return $chart;
	}
	public function get_tickets_assignes_disctinct()
	{
		return $this->db->query('SELECT DISTINCT(assigned) as assigned FROM ' . db_prefix() . 'tickets WHERE assigned != 0')->result_array();
	}
	public function get_service($id = '')
	{
		if (is_numeric($id)) {
			$this->db->where('serviceid', $id);

			return $this->db->get(db_prefix() . 'services')->row();
		}

		$this->db->order_by('name', 'asc');

		return $this->db->get(db_prefix() . 'services')->result_array();
	}

	public function get_priority($id = '')
	{
		if (is_numeric($id)) {
			$this->db->where('priorityid', $id);

			return $this->db->get(db_prefix() . 'tickets_priorities')->row();
		}

		return $this->db->get(db_prefix() . 'tickets_priorities')->result_array();
	}

	public function get_ticket_status($id = '')
	{
		if (is_numeric($id)) {
			$this->db->where('ticketstatusid', $id);

			return $this->db->get(db_prefix() . 'tickets_status')->row();
		}
		$this->db->order_by('statusorder', 'asc');

		return $this->db->get(db_prefix() . 'tickets_status')->result_array();
	}
}

?>
