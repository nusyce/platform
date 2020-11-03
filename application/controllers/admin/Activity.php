<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Activity extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	public function index()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['title'] = 'User Activity Log';
		$this->load->view('admin/activity/activity-list', $data);

	}
	public function clear()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$result=$this->activity_model->clear_log();
		if($result){
			set_alert('error','Successfully Emptied.');
			redirect('admin/activity/');

		}

	}
	public function render($activity = '')
	{
		$this->app->get_renderable_data('activity/table', ['activity' => $activity]);
	}

	public function datatable_json()
	{
		$records['data'] = $this->activity_model->get_activity_log();

		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$data[]= array(

				$row['description'],
				date('F d, Y H:i',strtotime($row['created_at'])),
				($row['username']) ? $row['username'] : $row['adminname'],
			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
}

?>	
