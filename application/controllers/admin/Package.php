<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Package extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Pack_model', 'pack_model');
	}

	public function index()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['title'] = 'Kunder';
		$data['packs'] = $this->pack_model->get_pack();
		$this->load->view('admin/pack/pack-list', $data);

	}

}

?>	
