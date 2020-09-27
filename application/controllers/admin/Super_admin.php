<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin extends MY_Controller
{
    function __construct(){

        parent::__construct();
		$this->load->library('mailer');
		$this->load->model('admin/auth_model', 'auth_model');
		$this->load->model('admin/admin_roles_model', 'admin_roles');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/Activity_model', 'activity_model');
    }
	function index(){

			if($this->session->has_userdata('is_admin_login')){
				redirect('admin/dashboard');
			}
			else{
				$data['title'] = 'Super AdminLogin';
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;


				$this->load->view('admin/auth/super_login');

			}

	}
	public function login(){

		if($this->input->post('submit')){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				if($this->input->post('superadmin') )
				{
					redirect(base_url('admin/super_admin'),'refresh');

				}else{
					redirect(base_url('admin/auth/login'),'refresh');
				}

			}
			else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$result = $this->auth_model->login($data);
				if($result){
					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(base_url('admin/auth/login'));
						exit();
					}
					if($result['is_active'] == 0){
						$this->session->set_flashdata('error', 'Account is disabled by Admin!');
						redirect(base_url('admin/auth/login'));
						exit();
					}
					if($result['is_supper'] !=1){
						if($this->input->post('superadmin')) {
							$this->session->set_flashdata('error', 'Account is not Super Admin!');
							redirect(base_url('admin/super_admin/'));
							exit();
						}

					}
					if($result['is_admin'] == 1){
						$admin_data = array(
							'admin_id' => $result['admin_id'],
							'username' => $result['username'],
							'admin_role_id' => $result['admin_role_id'],
							'admin_role' => $result['admin_role_title'],
							'is_supper' => $result['is_supper'],
							'is_admin_login' => TRUE
						);
						$this->session->set_userdata($admin_data);
						$this->rbac->set_access_in_session(); // set access in session

						if($result['is_supper'])
							//redirect(base_url('admin/dashboard/index_1'), 'refresh');
							redirect(base_url('admin/dashboard'), 'refresh');
						else
							redirect(base_url('admin/dashboard'), 'refresh');

					}
				}
				else{
					$this->session->set_flashdata('errors', 'Invalid Username or Password!');
					if($this->input->post('superadmin') )
					{
						redirect(base_url('admin/super_admin'));

					}else{
						redirect(base_url('admin/auth/login'));
					}

				}
			}
		}
		else{
			$data['title'] = 'Login';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/auth/login');
			$this->load->view('admin/includes/_footer', $data);
		}
	}
	//-----------------------------------------------------		

	
}

?>
