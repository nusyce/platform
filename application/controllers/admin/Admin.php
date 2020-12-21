<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct(){

        parent::__construct();
     auth_check(); // check login auth
       $this->rbac->check_module_access();
		$this->load->model('admin/admin_roles_model', 'admin_roles');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('misc_model');
		$this->load->model('lieferanten_model');
		$this->load->model('admin/cars_model');
		$this->load->model('admin/utilities_model');
    }
	function admin_roles(){

		$data['title'] = trans('role_and_permissions');;
		$data['records'] = $this->admin_roles->get_all();


		$this->load->view('admin/admin_roles/index', $data);

	}
	public function personalplan()

	{

		if ($this->input->post()) {

			$data    = $this->input->post();

			$success = $this->utilities_model->event($data);
			$message = '';

			if ($success) {

				if (isset($data['eventid'])) {

					$message = _l('event_updated');

				} else {

					$message = _l('utility_calendar_event_added_successfully');

				}

			}

			set_alert('success', $message);

redirect(admin_url('admin/personalplan'));

		}

		//$data['google_ids_calendars'] = $this->misc_model->get_google_calendar_ids();
		$data['google_ids_calendars']=[];
		$data['staffs'] = $this->admin->get('',['active'=>1,'company_id' =>get_user_company_id()]);

		$data['google_calendar_api']  = get_option('google_calendar_api_key');

		$data['title']                = _l('Personalplan');

		$data['cars'] = $this->cars_model->get();

		$data['lieferanten'] = $this->lieferanten_model->get();





		$this->load->view('admin/utilities/calendar', $data);

	}

	//-----------------------------------------------------		
	function index($type=''){

		$this->session->set_userdata('filter_type',$type);
		$this->session->set_userdata('filter_keyword','');
		$this->session->set_userdata('filter_status','');
		
		$data['admin_roles'] = $this->admin->get_admin_roles();
		
		$data['title'] = 'Admin List';


		$this->load->view('admin/admin/index', $data);

	}
	function all_notifications(){
		$this->db->where('touserid', get_user_id());
		$notifications= $this->db->get(db_prefix() . 'notifications')->result_array();
		$data['total_pages']=round(count($notifications)/$this->misc_model->get_notifications_limit());
		$this->load->view('admin/admin/notifications',$data);

	}
	public function notifications()
	{

		if ($this->input->post()) {
			$page = $this->input->post('page');
			$offset = ($page * $this->misc_model->get_notifications_limit());
			$this->db->limit($this->misc_model->get_notifications_limit(), $offset);
			$this->db->where('touserid', get_user_id());
			$this->db->order_by('date', 'desc');
			$notifications = $this->db->get(db_prefix() . 'notifications')->result_array();
			$i = 0;
			foreach ($notifications as $notification) {
				if (($notification['fromcompany'] == null && $notification['fromuserid'] != 0) || ($notification['fromcompany'] == null && $notification['fromclientid'] != 0)) {

					if ($notification['fromuserid'] != 0) {
						$notifications[$i]['profile_image'] = user_profile_image($notification['fromuserid'], [
								'staff-profile-image-small',
								'img-circle',
								'pull-left',
							]) ;
					} else {
						$notifications[$i]['profile_image'] = '<a href="#">
                    <img class="client-profile-image-small img-circle pull-left" src="' . contact_profile_image_url($notification['fromclientid']) . '"></a>';
					}
				} else {
					$notifications[$i]['profile_image'] = '';
					$notifications[$i]['full_name'] = '';
				}
				$additional_data = '';
				if (!empty($notification['additional_data'])) {
					$additional_data = unserialize($notification['additional_data']);
					$x = 0;
					foreach ($additional_data as $data) {
						if (strpos($data, '<lang>') !== false) {
							$lang = get_string_between($data, '<lang>', '</lang>');
							$temp = _l($lang);
							if (strpos($temp, 'project_status_') !== false) {
								$status = get_project_status_by_id(strafter($temp, 'project_status_'));
								$temp = $status['name'];
							}
							$additional_data[$x] = $temp;
						}
						$x++;
					}
				}
				$notifications[$i]['description']="";
				if(!empty($notification['link'])) {
					$notifications[$i]['description']='<a href="'.admin_url($notification["link"]).'" onclick="open_link_notification(event); return false;" class="notification-top notification-link">';
				}

				$notifications[$i]['description'] = $notifications[$i]['description']._l($notification['description'], $additional_data);
				if(!empty($notification['link'])) {
					$notifications[$i]['description'] = $notifications[$i]['description'].'</a>';
				}
				$notifications[$i]['date'] = time_ago($notification['date']);
				$notifications[$i]['full_date'] = $notification['date'];
				$i++;
			} //$notifications as $notification
			echo json_encode($notifications);
			die;
		}
	}


	public function render($admins = '')
	{
		$this->app->get_renderable_data('admin/table', ['admin' => $admins]);
	}


	//---------------------------------------------------------
	function filterdata(){

		$this->session->set_userdata('filter_type',$this->input->post('type'));
		$this->session->set_userdata('filter_status',$this->input->post('status'));
		$this->session->set_userdata('filter_keyword',$this->input->post('keyword'));
	}

	//--------------------------------------------------		
	function list_data(){

		$data['info'] = $this->admin->get_all();

		$this->load->view('admin/admin/list',$data);
	}

	//-----------------------------------------------------------
	function change_status(){

		$this->rbac->check_operation_access(); // check opration permission

		$this->admin->change_status();

	}
	
	//--------------------------------------------------
	function add(){

		$this->rbac->check_operation_access(); // check opration permission

		$data['admin_roles']=$this->admin->get_admin_roles();

		if($this->input->post('submit')){
				$this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|is_unique[mar_admin.username]|required');
				$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
				$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('role', 'Role', 'trim|required');
				/*if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/admin/add'),'refresh');
				}
				*/
			$result = (preg_match('/[A-Z]+/', $_POST['password']) && preg_match('/[a-z]+/', $_POST['password']) && preg_match('/[\d!$%^&]+/', $_POST['password']) && strlen($_POST['password'])>11);
			if(!$result)
			{
				set_alert("danger","Das eingegebene Passwort ist nicht sicher.");
				redirect(admin_url('admin/add'));
			}
					$data = array(
						'admin_role_id' => $this->input->post('role'),
						'username' => $this->input->post('username'),
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						'active' => 1,
						'created_at' => date('Y-m-d : h:m:s'),
						'updated_at' => date('Y-m-d : h:m:s'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->admin->add_admin($data);
					if($result){

						// Activity Log 


						$this->session->set_flashdata('success', 'Admin has been added successfully!');
						redirect(base_url('admin/admin'));
					}

			}
			else
			{

        		$this->load->view('admin/admin/add', $data);

			}
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		$data['admin_roles'] = $this->admin->get_admin_roles();

		if($this->input->post('submit')){
			/*$this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/admin/edit/'.$id),'refresh');
			}*/

				$data = array(
					'admin_role_id' => $this->input->post('role'),
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'active' => $this->input->post('status'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				if($this->input->post('password') != '')
				{
					$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
					$result = (preg_match('/[A-Z]+/', $_POST['password']) && preg_match('/[a-z]+/', $_POST['password']) && preg_match('/[\d!$%^&]+/', $_POST['password']) && strlen($_POST['password'])>11);
					if(!$result)
					{
						set_alert("error","Das eingegebene Passwort ist nicht sicher.");
						redirect(admin_url('admin/edit/'.$id));
					}

				}


				$data = $this->security->xss_clean($data);

				$result = $this->admin->edit_admin($data, $id);

				if($result){
					// Activity Log


					$this->session->set_flashdata('success', 'Admin has been updated successfully!');
					redirect(base_url('admin/admin'));
				}

		}
		elseif($id==""){
			redirect('admin/admin');
		}
		else{
			$data['admin'] = $this->admin->get_admin_by_id($id);
			$this->load->view('admin/admin/edit', $data);

		}		
	}

	//--------------------------------------------------
	function check_username($id=0){

		$this->db->from('admin');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('admin_id !='.$id);
		$query=$this->db->get();
		if($query->num_rows() >0)
			echo 'false';
		else 
	    	echo 'true';
    }

    //------------------------------------------------------------
	function delete($id=''){
	   
		$this->rbac->check_operation_access(); // check opration permission

		$this->admin->delete($id);

		// Activity Log 


		$this->session->set_flashdata('success','User has been Deleted Successfully.');	
		redirect('admin/admin');
	}
	
}

?>
