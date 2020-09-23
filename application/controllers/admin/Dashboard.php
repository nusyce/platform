<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		/*if($this->uri->segment(3) != '')
		$this->rbac->check_operation_access();*/
		$this->load->model('admin/module_model', 'module_model');
		$this->load->model('admin/dashboard_model', 'dashboard_model');

		$this->load->model('admin/setting_model', 'setting_model');
	}

	//--------------------------------------------------------------------------

	public function edit_my_menu(){

		$data = array(
			'id_admin' => $this->session->userdata('admin_id'),
			'id_module' => $this->input->post('id_module'),
			'module_name' => $this->input->post('module_name')
		);
		$this->module_model->save_module_name($data);
		redirect(base_url('admin/dashboard'));

	}
	public function index(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/general');

    	$this->load->view('admin/includes/_footer');

	}
	public function general_settings(){

		$data['general_settings'] = $this->setting_model->get_general_settings();
		$data['languages'] = $this->setting_model->get_all_languages();

		$data['title'] = 'General Setting';

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/general_settings/setting', $data);
		$this->load->view('admin/includes/_footer');

	}
	//--------------------------------------------------------------------------

	public function index_1(){

		$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_2(){

		$data['title'] = 'Dashboard';


		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index2');

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}


}
?>	
