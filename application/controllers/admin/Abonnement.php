<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Abonnement extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();


	}

	public function index()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['title'] = 'Abonnement';

		$this->load->view('admin/abonnement/abonnement-list', $data);

	}

	public function render($abonnement = '')
	{
		$this->app->get_renderable_data('abonnement/table', ['abonnement' => $abonnement]);
	}


}

?>	
