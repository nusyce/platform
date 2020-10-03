<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Client extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Client_model', 'client_model');
	}

	public function index()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['title'] = 'Kunder';

		$this->load->view('admin/client/client-list', $data);

	}
	public function client($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['client'] = $this->client_model->get_by_id($id);
		$data['title'] = 'Kunder';

		$this->load->view('admin/client/client', $data);

	}
	function change_status(){

		$this->rbac->check_operation_access(); // check opration permission

		$this->client_model->change_status();
	}
	public function delete($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$this->client_model->delete($id);

	}
	public function render($client = '')
	{
		$this->app->get_renderable_data('client/table', ['client' => $client]);
	}

	public function save()
	{
		if(!empty($_POST)) {


			/*$this->form_validation->set_rules('company', 'company', 'trim|required');
			$this->form_validation->set_rules('strabe', 'strabe', 'trim|required');
			$this->form_validation->set_rules('country', 'country', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				if(isset($_POST['userid']) && !empty($_POST['userid']))
			{
				redirect(base_url('admin/client/client/'.$_POST['userid']), 'refresh');
			}else
			{
				redirect(base_url('admin/client/client'), 'refresh');
			}
				
			}*/
			unset($_POST['ci_csrf_token']);
			if(isset($_POST['userid']) && !empty($_POST['userid']))
			{

				$this->client_model->update($_POST['userid'],$_POST);
			}else
			{

				$this->client_model->add($_POST);
			}

		}

	}
	public function translation()
	{
		if ($this->input->post()) {
			$success = save_transl('tsl_clients', $this->input->post());
			if ($success)
				//set_alert('success', _l('updated_successfully', get_menu_option('clients', 'Translation')));
			redirect(admin_url('client/translation'));

		}


		$data['title'] = 'Translate';
		$data['bodyclass'] = '';

		$this->load->view('admin/client/translation', $data);


	}
	public function datatable_json()
	{
		$records['data'] = $this->client_model->get_client();

		$data = array();
		$i=0;
		$text_comfirm="return confirm('are you sure to delete?')";
		foreach ($records['data']  as $row) 
		{
			$checked="";
			if($row['active']==1)
			{
				$checked="checked";
			}

			$data[]= array(
				++$i,
				'<a href="'.base_url('admin/client/client/'.$row['userid']).'" class="">
		'.$row['company'].'
</a><div class="row-options"><a href="'.base_url('admin/client/client/'.$row['userid']).'" class="">
Bearbeiten
</a> |
<a href="'.base_url('admin/client/delete/'.$row['userid']).'"   class="text-danger _delete"> löschen</a></div>',
				1,
				1,
				$row['email'],
				$row['phonenumber'],
			'<div class="custom-control custom-switch"><input data-switch-url="'.base_url("admin/client/change_status").'" class="tgl tgl-ios tgl_checkbox custom-control-input" 
                    data-id="'.$row['userid'].'"
                    id="cb_'.$row['userid'].'"
                    type="checkbox"'.$checked.'/>
                    <label class="tgl-btn custom-control-label" for="cb_'.$row['userid'].'"></label></div>',

			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
}

?>	
