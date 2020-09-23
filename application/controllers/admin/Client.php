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
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/client/client-list', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function client($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['client'] = $this->client_model->get_by_id($id);
		$data['title'] = 'Kunder';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/client/client', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function delete($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$this->client_model->delete($id);

	}
	public function save()
	{
		if(!empty($_POST)) {


			$this->form_validation->set_rules('company', 'company', 'trim|required');
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
				
			}
			if(isset($_POST['userid']) && !empty($_POST['userid']))
			{
				$this->client_model->update($_POST['userid'],$_POST);
			}else
			{
				$this->client_model->add($_POST);
			}

		}

	}
	public function datatable_json()
	{
		$records['data'] = $this->client_model->get_client();

		$data = array();
		$i=0;
		$text_comfirm="return confirm('are you sure to delete?')";
		foreach ($records['data']  as $row) 
		{  
			$data[]= array(
				++$i,
				$row['company'],
				1,
				1,
				$row['email'],
				$row['phonenumber'],
				'<a href="'.base_url('admin/client/client/'.$row['userid']).'" class="btn btn-warning btn-xs mr5">
<i class="fa fa-edit"></i>
</a>
<a id="delete_link" href="'.base_url('admin/client/delete/'.$row['userid']).'" onclick="'.$text_comfirm.'" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>',
			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
}

?>	
