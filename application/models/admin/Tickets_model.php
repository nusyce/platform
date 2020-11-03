<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model{

	public function get_weekly_tickets_opening_statistics()
	{
		$departments_ids = [];
		/*if (!is_admin()) {
			if (get_option('staff_access_only_assigned_departments') == 1) {
				$this->load->model('departments_model');
				$staff_deparments_ids = $this->departments_model->get_staff_departments(get_user_id(), true);
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
					$this->db->where('department IN (SELECT departmentid FROM ' . db_prefix() . 'staff_departments WHERE departmentid IN (' . implode(',', $departments_ids) . ') AND staffid="' . get_user_id() . '")');
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
	public function add($data, $admin = null, $pipe_attachments = false)
	{
		if ($admin !== null) {
			$data['admin'] = $admin;
			unset($data['ticket_client_search']);
		}

		if (isset($data['assigned']) && $data['assigned'] == '') {
			$data['assigned'] = 0;
		}
		if (!isset($data['department'])) {
			$data['department'] = 0;
		}
		if (isset($data['project_id']) && $data['project_id'] == '') {
			$data['project_id'] = 0;
		}

		if ($admin == null) {
			if (isset($data['email'])) {
				$data['userid']    = 0;
				$data['contactid'] = 0;
			} else {
				// Opened from customer portal otherwise is passed from pipe or admin area
				if (!isset($data['userid']) && !isset($data['contactid'])) {
					$data['userid']    = get_client_user_id();
					$data['contactid'] = get_contact_user_id();
				}
			}
			$data['status'] = 1;
		}

		if (isset($data['custom_fields'])) {
			$custom_fields = $data['custom_fields'];
			unset($data['custom_fields']);
		}

		// CC is only from admin area
		$cc = '';
		if (isset($data['cc'])) {
			$cc = $data['cc'];
			unset($data['cc']);
		}

		$data['date']      = date('Y-m-d H:i:s');
		$data['ticketkey'] = app_generate_hash();
		$data['status']    = 1;
		$data['message']   = trim($data['message']);
		$data['subject']   = trim($data['subject']);

			$data['message'] = preg_replace('/\v+/u', '<br>', $data['message']);

		// Admin can have html
		if ($admin == null) {
			$data['message'] = _strip_tags($data['message']);
			$data['subject'] = _strip_tags($data['subject']);
			$data['message'] = nl2br_save_html($data['message']);
		}
		if (!isset($data['userid'])) {
			$data['userid'] = 0;
		}
		if (isset($data['priority']) && $data['priority'] == '' || !isset($data['priority'])) {
			$data['priority'] = 0;
		}

		$tags = '';
		if (isset($data['tags'])) {
			$tags = $data['tags'];
			unset($data['tags']);
		}

		$data['message'] = remove_emojis($data['message']);

		$data['company_id']=get_user_company_id();
		$this->db->insert(db_prefix() . 'tickets', $data);
		$ticketid = $this->db->insert_id();


		$notification['message'] = $data['message'];
		my_pusher()->trigger('my-channel', 'my-event', $notification);

		if ($ticketid) {
			/*handle_tags_save($tags, $ticketid, 'ticket');

			if (isset($custom_fields)) {
				handle_custom_fields_post($ticketid, $custom_fields);
			}

			if (isset($data['assigned']) && $data['assigned'] != 0) {
				if ($data['assigned'] != get_user_id()) {
					$notified = add_notification([
						'description'     => 'not_ticket_assigned_to_you',
						'touserid'        => $data['assigned'],
						'fromcompany'     => 1,
						'fromuserid'      => null,
						'link'            => 'tickets/ticket/' . $ticketid,
						'additional_data' => serialize([
							$data['subject'],
						]),
					]);

					if ($notified) {
						pusher_trigger_notification([$data['assigned']]);
					}

					send_mail_template('ticket_assigned_to_staff', $assignedEmail, $data['assigned'], $ticketid, $data['userid'], $data['contactid']);
				}
			}
			if ($pipe_attachments != false) {
				$this->process_pipe_attachments($pipe_attachments, $ticketid);
			} else {
				$attachments = handle_ticket_attachments($ticketid);
				if ($attachments) {
					$this->insert_ticket_attachments_to_database($attachments, $ticketid);
				}
			}

			$_attachments = $this->get_ticket_attachments($ticketid);


			$isContact = false;
			if (isset($data['userid']) && $data['userid'] != false) {
				$email     = $this->clients_model->get_contact($data['contactid'])->email;
				$isContact = true;
			} else {
				$email = $data['email'];
			}

			$template = 'ticket_created_to_customer';
			if ($admin == null) {
				$template = 'ticket_autoresponse';

				$this->load->model('departments_model');
				$this->load->model('staff_model');
				$staff = $this->staff_model->get('', ['active' => 1]);

				$notifiedUsers                              = [];
				$notificationForStaffMemberOnTicketCreation = get_option('receive_notification_on_new_ticket') == 1;

				foreach ($staff as $member) {
					if (get_option('access_tickets_to_none_staff_members') == 0
						&& !is_staff_member($member['staffid'])) {
						continue;
					}
					$staff_departments = $this->departments_model->get_staff_departments($member['staffid'], true);

					if (in_array($data['department'], $staff_departments)) {
						send_mail_template('ticket_created_to_staff', $ticketid, $data['userid'], $data['contactid'], $member, $_attachments);

						if ($notificationForStaffMemberOnTicketCreation) {
							$notified = add_notification([
								'description'     => 'not_new_ticket_created',
								'touserid'        => $member['staffid'],
								'fromcompany'     => 1,
								'fromuserid'      => null,
								'link'            => 'tickets/ticket/' . $ticketid,
								'additional_data' => serialize([
									$data['subject'],
								]),
							]);
							if ($notified) {
								array_push($notifiedUsers, $member['staffid']);
							}
						}
					}
				}
				pusher_trigger_notification($notifiedUsers);
			}

			$sendEmail = true;

			if ($isContact && total_rows(db_prefix() . 'contacts', ['ticket_emails' => 1, 'id' => $data['contactid']]) == 0) {
				$sendEmail = false;
			}

			if ($sendEmail) {
				$ticket = $this->get_ticket_by_id($ticketid);
				// $admin == null ? [] : $_attachments - Admin opened ticket from admin area add the attachments to the email
				send_mail_template($template, $ticket, $email, $admin == null ? [] : $_attachments, $cc);
			}

			hooks()->do_action('ticket_created', $ticketid);
			log_activity('New Ticket Created [ID: ' . $ticketid . ']');*/

			return $ticketid;
		}

		return false;
	}
	public function get_ticket_attachments($id, $replyid = '')
	{
		$this->db->where('ticketid', $id);
		if (is_numeric($replyid)) {
			$this->db->where('replyid', $replyid);
		} else {
			$this->db->where('replyid', null);
		}
		$this->db->where('ticketid', $id);

		return $this->db->get(db_prefix() . 'ticket_attachments')->result_array();
	}
	public function delete($ticketid)
	{
		$affectedRows = 0;
		//hooks()->do_action('before_ticket_deleted', $ticketid);
		// final delete ticket
		$this->db->where('ticketid', $ticketid);
		$this->db->delete(db_prefix() . 'tickets');
		if ($this->db->affected_rows() > 0) {
			$affectedRows++;
		}
		if ($this->db->affected_rows() > 0) {
			$affectedRows++;
			$this->db->where('ticketid', $ticketid);
			$attachments = $this->db->get(db_prefix() . 'ticket_attachments')->result_array();
			if (count($attachments) > 0) {
				if (is_dir(get_upload_path_by_type('ticket') . $ticketid)) {
					if (delete_dir(get_upload_path_by_type('ticket') . $ticketid)) {
						foreach ($attachments as $attachment) {
							$this->db->where('id', $attachment['id']);
							$this->db->delete(db_prefix() . 'ticket_attachments');
							if ($this->db->affected_rows() > 0) {
								$affectedRows++;
							}
						}
					}
				}
			}

			$this->db->where('relid', $ticketid);
			$this->db->where('fieldto', 'tickets');
			$this->db->delete(db_prefix() . 'customfieldsvalues');

			// Delete replies
			$this->db->where('ticketid', $ticketid);
			$this->db->delete(db_prefix() . 'ticket_replies');

			$this->db->where('rel_id', $ticketid);
			$this->db->where('rel_type', 'ticket');
			$this->db->delete(db_prefix() . 'notes');

			$this->db->where('rel_id', $ticketid);
			$this->db->where('rel_type', 'ticket');
			$this->db->delete(db_prefix() . 'taggables');

			$this->db->where('rel_type', 'ticket');
			$this->db->where('rel_id', $ticketid);
			$this->db->delete(db_prefix() . 'reminders');

			// Get related tasks
			$this->db->where('rel_type', 'ticket');
			$this->db->where('rel_id', $ticketid);
			$tasks = $this->db->get(db_prefix() . 'tasks')->result_array();
			foreach ($tasks as $task) {
				$this->tasks_model->delete_task($task['id']);
			}
		}
		if ($affectedRows > 0) {
			$this->Activity_model->add_log('Ticket Deleted [ID: ' . $ticketid . ']');

			return true;
		}

		return false;
	}
	public function add_reply($data, $id, $admin = null, $pipe_attachments = false)
	{
		if (isset($data['assign_to_current_user'])) {
			$assigned = get_user_id();
			unset($data['assign_to_current_user']);
		}

		$unsetters = [
			'note_description',
			'department',
			'priority',
			'subject',
			'assigned',
			'project_id',
			'service',
			'status_top',
			'attachments',
			'DataTables_Table_0_length',
			'DataTables_Table_1_length',
			'custom_fields',
		];

		foreach ($unsetters as $unset) {
			if (isset($data[$unset])) {
				unset($data[$unset]);
			}
		}

		if ($admin !== null) {
			$data['admin'] = $admin;
			$status        = $data['status'];
		} else {
			$status = 1;
		}

		if (isset($data['status'])) {
			unset($data['status']);
		}

		$cc = '';
		if (isset($data['cc'])) {
			$cc = $data['cc'];
			unset($data['cc']);
		}

		$data['ticketid'] = $id;
		$data['date']     = date('Y-m-d H:i:s');
		$data['message']  = trim($data['message']);

		/*if ($this->piping == true) {
			$data['message'] = preg_replace('/\v+/u', '<br>', $data['message']);
		}*/

		// admin can have html
		if ($admin == null) {
			$data['message'] = _strip_tags($data['message']);
			$data['message'] = nl2br_save_html($data['message']);
		}

		if (!isset($data['userid'])) {
			$data['userid'] = 0;
		}

		/*  if (is_client_logged_in()) {
					$data['contactid'] = get_contact_user_id();
				}
		*/
		$data['message'] = remove_emojis($data['message']);
		//$data            = hooks()->apply_filters('before_ticket_reply_add', $data, $id, $admin);

		$this->db->insert(db_prefix() . 'ticket_replies', $data);

		$insert_id = $this->db->insert_id();

		if ($insert_id) {
			if (isset($assigned)) {
				$this->db->where('ticketid', $id);
				$this->db->update(db_prefix() . 'tickets', [
					'assigned' => $assigned,
				]);
			}
			if ($pipe_attachments != false) {
				$this->process_pipe_attachments($pipe_attachments, $id, $insert_id);
			} else {
				$attachments = handle_ticket_attachments($id);
				if ($attachments) {
					$this->tickets_model->insert_ticket_attachments_to_database($attachments, $id, $insert_id);
				}
			}

			$_attachments = $this->get_ticket_attachments($id, $insert_id);


			$this->Activity_model->add_log('New Ticket Reply [ReplyID: ' . $insert_id . ']');
			$this->db->select('status');
			$this->db->where('ticketid', $id);
			$old_ticket_status = $this->db->get(db_prefix() . 'tickets')->row()->status;

			/**
			 * When a ticket is in status "In progress" and the customer reply to the ticket it changes the status to "Open" which is not normal.
			 * The ticket should keep the status "In progress"
			 */

			$this->db->where('ticketid', $id);
			$this->db->update(db_prefix() . 'tickets', [
				'lastreply'  => date('Y-m-d H:i:s'),
				'status'     => ($old_ticket_status == 2 && $admin == null ? $old_ticket_status : $status),
				'adminread'  => 0,
				'clientread' => 0,
			]);

			/*if ($old_ticket_status != $status) {
				hooks()->do_action('after_ticket_status_changed', [
					'id'     => $id,
					'status' => $status,
				]);
			}*/

			$ticket    = $this->get_ticket_by_id($id);
			$userid    = $ticket->userid;
			$isContact = false;
			/*if ($ticket->userid != 0 && $ticket->contactid != 0) {
				$email     = $this->clients_model->get_contact($ticket->contactid)->email;
				$isContact = true;
			} else {
				$email = $ticket->ticket_email;
			}
			if ($admin == null) {
				$this->load->model('departments_model');
				$this->load->model('staff_model');
				$staff = $this->staff_model->get('', ['active' => 1]);

				$notifiedUsers                           = [];
				$notificationForStaffMemberOnTicketReply = get_option('receive_notification_on_new_ticket_replies') == 1;

				foreach ($staff as $staff_key => $member) {
					if (get_option('access_tickets_to_none_staff_members') == 0
						&& !is_staff_member($member['staffid'])) {
						continue;
					}

					$staff_departments = $this->departments_model->get_staff_departments($member['staffid'], true);

					if (in_array($ticket->department, $staff_departments)) {
						send_mail_template('ticket_new_reply_to_staff', $ticket, $member, $_attachments);

						if ($notificationForStaffMemberOnTicketReply) {
							$notified = add_notification([
								'description'     => 'not_new_ticket_reply',
								'touserid'        => $member['staffid'],
								'fromcompany'     => 1,
								'fromuserid'      => null,
								'link'            => 'tickets/ticket/' . $id,
								'additional_data' => serialize([
									$ticket->subject,
								]),
							]);
							if ($notified) {
								array_push($notifiedUsers, $member['staffid']);
							}
						}
					}
				}
				pusher_trigger_notification($notifiedUsers);
			} else {
				$sendEmail = true;
				if ($isContact && total_rows(db_prefix() . 'contacts', ['ticket_emails' => 1, 'id' => $ticket->contactid]) == 0) {
					$sendEmail = false;
				}
				if ($sendEmail) {
					send_mail_template('ticket_new_reply_to_customer', $ticket, $email, $_attachments, $cc);
				}
			}
			hooks()->do_action('after_ticket_reply_added', [
				'data'    => $data,
				'id'      => $id,
				'admin'   => $admin,
				'replyid' => $insert_id,
			]);*/

			return $insert_id;
		}

		return false;
	}
	public function get_ticket_by_id($id, $userid = '')
	{
		$this->db->select('*,'.db_prefix() . 'admin.username  as submiter ,'.db_prefix() . 'admin.email as submiter_mail  ');
		$this->db->from(db_prefix() . 'tickets');
		$this->db->join(db_prefix() . 'admin', db_prefix() . 'admin.admin_id = ' . db_prefix() . 'tickets.admin', 'left');
		/*$this->db->join(db_prefix() . 'departments', db_prefix() . 'departments.departmentid = ' . db_prefix() . 'tickets.department', 'left');
		$this->db->join(db_prefix() . 'tickets_status', db_prefix() . 'tickets_status.ticketstatusid = ' . db_prefix() . 'tickets.status', 'left');
		$this->db->join(db_prefix() . 'services', db_prefix() . 'services.serviceid = ' . db_prefix() . 'tickets.service', 'left');
		$this->db->join(db_prefix() . 'clients', db_prefix() . 'clients.userid = ' . db_prefix() . 'tickets.userid', 'left');
		$this->db->join(db_prefix() . 'staff', db_prefix() . 'staff.staffid = ' . db_prefix() . 'tickets.admin', 'left');
		$this->db->join(db_prefix() . 'contacts', db_prefix() . 'contacts.id = ' . db_prefix() . 'tickets.contactid', 'left');
		$this->db->join(db_prefix() . 'tickets_priorities', db_prefix() . 'tickets_priorities.priorityid = ' . db_prefix() . 'tickets.priority', 'left');*/
		if (strlen($id) === 32) {
			$this->db->or_where(db_prefix() . 'tickets.ticketkey', $id);
		} else {
			$this->db->where(db_prefix() . 'tickets.ticketid', $id);
		}
		if (is_numeric($userid)) {
			$this->db->where(db_prefix() . 'tickets.userid', $userid);
		}
		$ticket = $this->db->get()->row();
		if ($ticket) {
			/*if ($ticket->admin == null || $ticket->admin == 0) {
				if ($ticket->contactid != 0) {
					$ticket->submitter = $ticket->user_firstname . ' ' . $ticket->user_lastname;
				} else {
					$ticket->submitter = $ticket->from_name;
				}
			} else {
				if ($ticket->contactid != 0) {
					$ticket->submitter = $ticket->user_firstname . ' ' . $ticket->user_lastname;
				} else {
					$ticket->submitter = $ticket->from_name;
				}
				$ticket->opened_by = $ticket->staff_firstname . ' ' . $ticket->staff_lastname;
			}
*/
			$ticket->attachments = $this->get_ticket_attachments($id);
		}


		return $ticket;
	}
	public function get_ticket_replies($id)
	{


		$this->db->select(db_prefix() . 'ticket_replies.id,' . db_prefix() . 'ticket_replies.name as from_name,' . db_prefix() . 'ticket_replies.email as reply_email, ' . db_prefix() . 'ticket_replies.admin, ' . db_prefix() . 'ticket_replies.userid,' . db_prefix() . 'admin.firstname as staff_firstname, ' . db_prefix() . 'admin.lastname as staff_lastname,message,date');
		$this->db->from(db_prefix() . 'ticket_replies');
		$this->db->join(db_prefix() . 'admin', db_prefix() . 'admin.admin_id = ' . db_prefix() . 'ticket_replies.admin', 'left');
		$this->db->where('ticketid', $id);
		$this->db->order_by('date');
		$replies = $this->db->get()->result_array();
		$i       = 0;
		foreach ($replies as $reply) {
			if ($reply['admin'] !== null || $reply['admin'] != 0) {
				// staff reply
				$replies[$i]['submitter'] = $reply['staff_firstname'] . ' ' . $reply['staff_lastname'];
			} else {
				if ($reply['contactid'] != 0) {
					$replies[$i]['submitter'] = $reply['staff_firstname'] . ' ' . $reply['staff_lastname'];
				} else {
					$replies[$i]['submitter'] = $reply['from_name'];
				}
			}
			unset($replies[$i]['staff_firstname']);
			unset($replies[$i]['staff_lastname']);
			unset($replies[$i]['user_firstname']);
			unset($replies[$i]['user_lastname']);
			$replies[$i]['attachments'] = $this->get_ticket_attachments($id, $reply['id']);
			$i++;
		}

		return $replies;
	}
	public function delete_ticket_reply($ticket_id, $reply_id)
	{
		$this->db->where('id', $reply_id);
		$this->db->delete(db_prefix() . 'ticket_replies');
		$this->Activity_model->add_log('Ticket Reply Deleted [ID: ' . $reply_id . ']');
		if ($this->db->affected_rows() > 0) {
			// Get the reply attachments by passing the reply_id to get_ticket_attachments method
			$attachments = $this->get_ticket_attachments($ticket_id, $reply_id);
			if (count($attachments) > 0) {
				foreach ($attachments as $attachment) {
					$this->delete_ticket_attachment($attachment['id']);
				}
			}

			return true;
		}

		return false;
	}
}

?>
