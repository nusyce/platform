<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		
		$this->load->model('admin/setting_model', 'setting_model');
	}

	//-------------------------------------------------------------------------
	// General Setting View
	public function index()
	{
		
		$data['general_settings'] = $this->setting_model->get_general_settings();

		$data['languages'] = $this->setting_model->get_all_languages();

		$data['title'] = 'General Setting';

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/general_settings/setting', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-------------------------------------------------------------------------
	public function add()
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$data = array(
			'company' => $this->input->post('company'),
			'email' => $this->input->post('email'),
			'vorname' => $this->input->post('vorname'),
			'phonenumber' => $this->input->post('phonenumber'),
			'nachname' => $this->input->post('nachname'),
			'phonenumber_1' => $this->input->post('phonenumber_1'),
			'strabe' => $this->input->post('strabe'),
			'mobil' => $this->input->post('mobil'),
			'hausnummer' => $this->input->post('hausnummer'),
			'website' => $this->input->post('website'),
			'zip' => $this->input->post('zip'),
			'firm_id' => $this->input->post('firm_id'),
			'city' => $this->input->post('city'),
			'updated_at' => date('Y-m-d : h:m:s'),
		);
		update_option('f_company', $_POST['company']);
		update_option('f_vorname', $_POST['vorname']);
		update_option('f_nachname', $_POST['nachname']);
		update_option('f_strabe', $_POST['strabe']);
		update_option('f_hausnummer', $_POST['hausnummer']);
		update_option('f_zip', $_POST['zip']);
		update_option('f_city', $_POST['city']);
		update_option('f_email', $_POST['email']);
		update_option('f_phonenumber_1', $_POST['phonenumber_1']);
		update_option('f_mobil', $_POST['mobil']);
		update_option('f_website', $_POST['website']);
		update_option('f_firm_id', $_POST['firm_id']);
		update_option('name_der_bank', $_POST['name_der_bank']);
		update_option('iban', $_POST['iban']);
		update_option('bic', $_POST['bic']);


		update_option('name_der_bank', $_POST['name_der_bank']);
		update_option('iban', $_POST['iban']);
		update_option('bic', $_POST['bic']);

		$old_logo = $this->input->post('old_logo');
		$old_favicon = $this->input->post('old_favicon');

		$path="assets/img/";

		if(!empty($_FILES['logo']['name']))
		{
			$this->functions->delete_file($old_logo);

			$result = $this->functions->file_insert($path, 'logo', 'image', '9097152');
			if($result['status'] == 1){
				$data['logo'] = $path.$result['msg'];
			}
			else{
				$this->session->set_flashdata('error', $result['msg']);
				redirect(base_url('admin/dashboard/general_settings'));
			}
		}

		// favicon
		if(!empty($_FILES['favicon']['name']))
		{
			$this->functions->delete_file($old_favicon);

			$result = $this->functions->file_insert($path, 'favicon', 'image', '197152');
			if($result['status'] == 1){
				$data['favicon'] = $path.$result['msg'];
			}
			else{
				$this->session->set_flashdata('error', $result['msg']);
				redirect(base_url('admin/general_settings'), 'refresh');
			}
		}

		$data = $this->security->xss_clean($data);
		$result = $this->setting_model->update_general_setting($data);
		if($result){
			$this->session->set_flashdata('success', 'Setting has been changed Successfully!');
			redirect(base_url('admin/dashboard/general_settings'), 'refresh');
		}
	}

		/*--------------------------
	   Email Template Settings
	--------------------------*/

	// ------------------------------------------------------------
	public function email_templates()
	{
		$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post()){
			$this->form_validation->set_rules('subject', 'Email Subject', 'trim|required');
			$this->form_validation->set_rules('content', 'Email Body', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
			}
			else{

				$id = $this->input->post('id');
				
				$data = array(
					'subject' => $this->input->post('subject'),
					'body' => $this->input->post('content'),
					'last_update' => date('Y-m-d H:i:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->setting_model->update_email_template($data, $id);
				if($result){
					echo "true";
				}
			}
		}
		else
		{
			$data['title'] = '';
			$data['templates'] = $this->setting_model->get_email_templates();

			$this->load->view('admin/includes/_header');
			$this->load->view('admin/general_settings/email_templates/templates_list', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	// ------------------------------------------------------------
	// Get Email Template & Related variables via Ajax by ID
	public function get_email_template_content_by_id()
	{
		$id = $this->input->post('template_id');

		$data['template'] = $this->setting_model->get_email_template_content_by_id($id);
		
		$variables = $this->setting_model->get_email_template_variables_by_id($id);

		$data['variables'] = implode(',',array_column($variables, 'variable_name'));

		echo json_encode($data);
	}

	//---------------------------------------------------------------
    //
    public function email_preview()
    {
        if($this->input->post('content'))
        {
            $data['content'] = $this->input->post('content');
            $data['head'] = $this->input->post('head');
            $data['title'] = 'Send Email to Subscribers';
            echo $this->load->view('admin/general_settings/email_templates/email_preview', $data,true);
        }
    }

}

?>	
