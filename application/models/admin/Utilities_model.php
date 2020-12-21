<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utilities_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add new event
     * @param array $data event $_POST data
     */
    public function event($data)
    {
        $users = $data['user'];
        unset($data['user']);
        $data['userid'] = get_user_id();
        array_push($users, get_user_id());
        $data['start'] = to_sql_date($data['start'], true);
        if ($data['end'] == '') {
            unset($data['end']);
        } else {
            $data['end'] = to_sql_date($data['end'], true);
        }
        if (isset($data['public'])) {
            $data['public'] = 1;
        } else {
            $data['public'] = 0;
        }
        $data['description'] = nl2br($data['description']);
        if (isset($data['eventid'])) {
            unset($data['userid']);
            $this->db->where('eventid', $data['eventid']);
            $event = $this->db->get(db_prefix() . 'events')->row();
            if (!$event) {
                return false;
            }
            if ($event->isstartnotified == 1) {
                if ($data['start'] > $event->start) {
                    $data['isstartnotified'] = 0;
                }
            }
            $this->db->where('eventid', $data['eventid']);
            $this->db->update(db_prefix() . 'events', $data);
            $this->assignusertoevent($users, $data['eventid']); // commented By Amogh : As Event_rel_staff Table wont exist in DB
            if ($this->db->affected_rows() > 0) {
                return true;
            }

            return false;
        }



        $this->db->insert(db_prefix() . 'events', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $this->assignusertoevent($users, $insert_id); // commented By Amogh : As Event_rel_staff Table wont exist in DB
            return true;
        }

        return false;
    }

    public function getAssignToTasks($event)
    {

        $this->db->where('event_id', $event);
        return $this->db->get(db_prefix() . 'event_rel_staff')->result_array();

    }

    private function assignusertoevent($users, $event_id)
    {
        $this->db->where('event_id', $event_id);
        $this->db->delete(db_prefix() . 'event_rel_staff');

        foreach ($users as $user) {
            $this->db->where('event_id', $event_id);
            $this->db->where('user_id', $user);
            $eventRel = $this->db->get(db_prefix() . 'event_rel_staff')->row();
            if ($eventRel) {

            } else {
                $data['event_id'] = $event_id;
                $data['user_id'] = $user;
                $this->db->insert(db_prefix() . 'event_rel_staff', $data);
            }
        }
    }

    /**
     * Get event by passed id
     * @param mixed $id eventid
     * @return object
     */
    public function get_event_by_id($id)
    {
        $this->db->where('eventid', $id);

        return $this->db->get(db_prefix() . 'events')->row();
    }

    /**
     * Get all user events
     * @return array
     */
    public function get_all_events($start, $end)
    {

        $this->db->select('title,start,end,eventid,userid,color,public');
        // Check if is passed start and end date
        $this->db->join(db_prefix() . 'event_rel_staff', db_prefix() . 'event_rel_staff.event_id=' . db_prefix() . 'events.eventid', 'left'); // uncomment after relation table
        $this->db->where('(start BETWEEN "' . $start . '" AND "' . $end . '")');
        $this->db->where(db_prefix() . 'event_rel_staff.user_id',get_user_id()); //uncommented after event relation table

        return $this->db->get(db_prefix() . 'events')->result_array();
    }

    public function get_event($id)
    {
        $this->db->where('eventid', $id);
        return $this->db->get(db_prefix() . 'events')->row();
    }

    public function get_event_user($id)
    {
        $this->db->where('event_id', $id);
        $this->db->where('user_id', get_staff_user_id());

        return $this->db->get(db_prefix() . 'event_rel_staff')->row();
    }


    public function get_event_users($id)
    {
        $this->db->select('user_id');
        $this->db->where('event_id', $id);
        //$this->db->where('user_id', get_staff_user_id());

        return $this->db->get(db_prefix() . 'event_rel_staff')->result_array();
    }

    public function get_calendar_data($start, $end, $client_id = '', $contact_id = '', $filters = false)
    {
		$data=[];
        $start = $this->db->escape_str($start);
        $end = $this->db->escape_str($end);
        $client_id = $this->db->escape_str($client_id);
        $contact_id = $this->db->escape_str($contact_id);


        if ($filters) {
            // excluded calendar_filters from post
            $ff = (count($filters) > 1 && isset($filters['calendar_filters']) ? true : false);
        }


        // This module entering Task in data -- Amo
        if (get_option('show_tasks_on_calendar') == 1 && !$ff || $ff && array_key_exists('tasks', $filters) || 1 == 1 ) {

                $this->db->select(db_prefix() . 'tasks.name as title,mar_tasks.id as id,status,startdate,duedate', false);
                $this->db->from(db_prefix() . 'tasks');
                // $this->db->where('status !=', 5);
			$this->db->where(db_prefix() . 'tasks.company_id',get_user_company_id());
                //$this->db->where("CASE WHEN duedate IS NULL THEN (startdate BETWEEN '$start' AND '$end') ELSE (duedate BETWEEN '$start' AND '$end') END", null, false);

                if ($client_data) {
                    $this->db->where('rel_type', 'project');
                    $this->db->where('rel_id IN (SELECT id FROM ' . db_prefix() . 'projects WHERE clientid=' . $client_id . ')');
                    $this->db->where('rel_id IN (SELECT project_id FROM ' . db_prefix() . 'project_settings WHERE name="view_tasks" AND value=1)');
                    $this->db->where('visible_to_client', 1);
                }


                if ((!$has_permission_tasks_view && !$client_data) && 1==2) {
                    $this->db->where('(id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE admin = ' . get_user_id() . '))');

                }

				$tasks = $this->db->get()->result_array();


                foreach ($tasks as $task) {
                    $rel_showcase = '';

                    /*if (!empty($task['rel_id']) && !$client_data) {
                        $rel_showcase = ' (' . $task['rel_name'] . ')';
                    }
*/
					$task['start'] = $task['startdate'];
                    $task['end'] = $task['duedate'];
					$task['date'] = $task['date'];
                    $name = mb_substr($task['title'], 0, 60) . '...';
                    $task['_tooltip'] = _l('calendar_task') . ' - ' . $name . $rel_showcase;
                    $task['title'] = $name;
                    $status = get_task_status_by_id($task['status']);
                    $task['color'] = $status['color'];

                    if (!$client_data) {
                        $task['onclick'] = 'init_task_modal(' . $task['id'] . '); return false';
                        $task['url'] = '#';
                    } else {
                        $task['url'] = site_url('clients/project/' . $task['rel_id'] . '?group=project_tasks&taskid=' . $task['id']);
                    }
                    array_push($data, $task);
                }

        }


        //calendar_project do you understand? Oka???
// Below code creating error - Amogh
		if (!$client_data && !$ff || (!$client_data && $ff && array_key_exists('events', $filters)) || 1==1)
		{

			$events = $this->get_all_events($start, $end); // This query is creatin issue
			//return array('hg calander data');
			foreach ($events as $event) {

					$event['onclick'] = 'view_event(' . $event['eventid'] . '); return false';
					$event['url'] = '#';

				$event['_tooltip'] = _l('calendar_event') . ' - ' . $event['title'];
				$event['color'] = $event['color'];

				array_push($data, $event);
			}
		}
        //print_r($data);
        //array_push($data, '[{"date":"2020-08-15","number":"1","id":"1","clientid":"12","hash":"3d2e9085e07937283aea5e2f7140bf44","company":"Deutsche Marktfirma GmbH","_tooltip":"Rechnung - INV-000002 (Deutsche Marktfirma GmbH)","title":"INV-000001","color":"#FF6F00","url":"http:\/\/localhost\/markat\/admin\/invoices\/list_invoices\/1"},{"title":"dqsdsqdqsd...","id":"26","rel_name":null,"rel_id":null,"status":"4","date":"2020-08-29","_tooltip":"Aufgabe - dqsdsqdqsd...","color":"#03A9F4","onclick":"init_task_modal(26); return false","url":"#"},{"title":"dqsdsqdqsd...","id":"27","rel_name":null,"rel_id":null,"status":"1","date":"2020-08-29","_tooltip":"Aufgabe - dqsdsqdqsd...","color":"#989898","onclick":"init_task_modal(27); return false","url":"#"}]');
        return $data;
    }

    /**
     * Delete user event
     * @param mixed $id event id
     * @return boolean
     */
    public function delete_event($id)
    {
        $this->db->where('eventid', $id);
        $this->db->delete(db_prefix() . 'events');
        if ($this->db->affected_rows() > 0) {
            log_activity('Event Deleted [' . $id . ']');

            return true;
        }

        return false;
    }

    public function user_role_data($data)
    {

        $this->db->insert(db_prefix() . 'folder_mapping', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            // $this->assignusertoevent($users, $insert_id); // commented By Amogh : As Event_rel_staff Table wont exist in DB
            return true;
        }

        return false;
    }

    public function get_elfinder_id($dir, $name)
    {

        $sql = 'SELECT id FROM elfinder_file WHERE mtime=\'' . $dir . '\' AND name=\'' . $name . '\'';
        //$sql="Select * from my_table where 1";
        $query = $this->db->query($sql);
        $res = $query->row();
        // return $query->result_array();
        //  $this->db->where('name', $name);
        //  $this->db->where('parent_id', $dir);
        // $res = $this->db->get('elfinder_file')->row();
        if (!empty($res)) {
            return $res->id;
        }

        return false;
    }

    public function get_elfinder_id_data($dir)
    {

        $sql = 'SELECT id FROM elfinder_file WHERE mtime=\'' . $dir . '\'';
        //$sql="Select * from my_table where 1";
        $query = $this->db->query($sql);
        $res = $query->row();
        // return $query->result_array();
        //  $this->db->where('name', $name);
        //  $this->db->where('parent_id', $dir);
        // $res = $this->db->get('elfinder_file')->row();
        if (!empty($res)) {
            return $res->id;
        }

        return false;
    }

    public function media_folder_data($data)
    {
        $sql = 'SELECT id FROM tblshare_link_detail WHERE elfinder_file_id=\'' . $data['elfinder_file_id'] . '\'';
        //$sql="Select * from my_table where 1";
        $query = $this->db->query($sql);
        $res = $query->row();
        if (!empty($res)) {
            $this->db->where('elfinder_file_id', $data['elfinder_file_id']);
            $this->db->update(db_prefix() . 'share_link_detail', $data);
            return true;
        } else {
            $this->db->insert(db_prefix() . 'share_link_detail', $data);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                // $this->assignusertoevent($users, $insert_id); // commented By Amogh : As Event_rel_staff Table wont exist in DB
                return true;
            }
        }

        return false;
    }

    public function check_media_share_link($elfinder_file_id)
    {
        $sql = 'SELECT id FROM mar_share_link_detail WHERE elfinder_file_id=\'' . $elfinder_file_id . '\'';
        //$sql="Select * from my_table where 1";
        $query = $this->db->query($sql);
        $res = $query->row();
        if (!empty($res)) {
            return $res->id;
        }


        return false;
    }

    public function check_media_share_link_password($elfinder_file_id, $password)
    {
        $sql = 'SELECT id FROM tblshare_link_detail WHERE elfinder_file_id=\'' . $elfinder_file_id . '\' and password  =\'' . $password . '\'';
        //$sql="Select * from my_table where 1";
        $query = $this->db->query($sql);
        $res = $query->row();
        if (!empty($res)) {
            return $res->id;
        }


        return false;
    }
}
