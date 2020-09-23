<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Mieter extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Mieter_model', 'mieter_model');
	}
	public function mieter($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['mieter'] = $this->mieter_model->get_by_id($id);
		$data['title'] = 'Mieter';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/mieter/mieter', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function index()
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['title'] = 'Mieter';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/mieter/mieter-list', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function delete($id='')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$this->mieter_model->delete($id);

	}
	public function translation()
	{
		if ($this->input->post()) {
			$success = save_transl('tsl_mieter', $this->input->post());
			if ($success)
				//set_alert('success', _l('updated_successfully', get_menu_option('clients', 'Translation')));
				redirect(admin_url('mieter/translation'));

		}


		$data['title'] = 'Translate';
		$data['bodyclass'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/mieter/translation', $data);
		$this->load->view('admin/includes/_footer');

	}
	public function save()
	{
		if(!empty($_POST)) {


			$this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
			//$this->form_validation->set_rules('strabe', 'strabe', 'trim|required');
			//$this->form_validation->set_rules('country', 'country', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				if(isset($_POST['id']) && !empty($_POST['id']))
			{
				redirect(base_url('admin/mieter/mieter/'.$_POST['id']), 'refresh');
			}else
			{
				redirect(base_url('admin/mieter/mieter'), 'refresh');
			}
				
			}
			if(isset($_POST['id']) && !empty($_POST['id']))
			{
				
				$this->mieter_model->update($_POST['id'],$_POST);
			}else
			{
				
				$this->mieter_model->add($_POST);
			}

		}

	}
	public function datatable_json()
	{
		$records['data'] = $this->mieter_model->get_mieter();

		$data = array();
		$i=0;
		$text_comfirm="return confirm('are you sure to delete?')";
		foreach ($records['data']  as $row) 
		{  
			$data[]= array(
				++$i,
				$row['fullname'],
				$row['projektname'],
				$row['strabe_m'],
				$row['nr_p'],
				$row['wohnungsnummer'],
				$row['etage'],
				$row['flugel'],
				$row['plz'],
				$row['stadt'],
				$row['telefon_1'],

				'<a href="'.base_url('admin/mieter/mieter/'.$row['id']).'" class="btn btn-warning btn-xs mr5">
<i class="fa fa-edit"></i>
</a>
<a href="'.base_url('admin/mieter/delete/'.$row['id']).'" onclick="'.$text_comfirm.'"  class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>',
				$row['fulger_p'],
				$row['umsetzwohnung'],
				$row['betreuer'],
				$row['vorname'],
				$row['nachname'],
				


			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
}

?>	
