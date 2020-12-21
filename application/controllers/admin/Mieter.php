<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mieter extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Mieter_model', 'mieter_model');
	}
	public function delete_attach($id)
	{
		$this->mieter_model->delete_attachment($id);
		echo 1;
	}

	public function index()
	{
		$data['title'] = 'Mieter';

		$data['plz'] = $this->mieter_model->get_grouped('plz');
		$data['stadt'] = $this->mieter_model->get_grouped('stadt');
		$data['strabe'] = $this->mieter_model->get_grouped('strabe_m');
		$data['flugel'] = $this->mieter_model->get_grouped('flugel');
		$data['hausnummer'] = $this->mieter_model->get_grouped('hausnummer_m');
		$data['wohnungsnummer'] = $this->mieter_model->get_grouped('wohnungsnummer');
		$data['etage'] = $this->mieter_model->get_grouped('etage');

		$data['project'] = $this->mieter_model->get_projekte();
		$this->load->view('admin/mieter/mieter-list', $data);

	}

	public function mieter($id = '')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$data['mieter'] = $this->mieter_model->get_by_id($id);
		$data['mieter']->attachments = $this->mieter_model->get_attachments($id);
		$data['title'] = 'Mieter';

		$this->load->view('admin/mieter/mieter', $data);

	}

	public function render($project = '')
	{
		$this->app->get_renderable_data('mieter/table', ['project' => $project]);
	}

	function change_status_old()
	{

		$this->rbac->check_operation_access(); // check opration permission

		$this->mieter_model->change_status();
	}

	public function delete($id = '')
	{
		// $records = $this->activity_model->get_activity_log();
		// var_dump($records);exit();
		$result=$this->mieter_model->delete($id);
			if($result){
				set_alert('error', 'Deleted Successfully.');
				redirect('admin/mieter/');

			}

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

		$this->load->view('admin/mieter/translation', $data);


	}
	public function ajax_save()
	{
		unset($_POST['ci_csrf_token']);
		$a_data = $_POST;

		if (empty($a_data['id'])) {
			unset($a_data['id']);

			$id = $this->mieter_model->add($a_data);
			if ($id) {
				set_alert('success', _l('added_successfully', get_menu_option('mieter', 'Mieter')));
			}
		} else {
			$id = $a_data['id'];
			$success = $this->mieter_model->update($id,$a_data);
			if ($success) {
				set_alert('success', _l('updated_successfully', get_menu_option('mieter', 'Mieter')));
			}
		}
		if (isset($_FILES['files'])){
			// Count total files
			$countfiles = count($_FILES['files']['name']);
			for ($i = 0; $i < $countfiles; $i++) {

				if (!empty($_FILES['files']['name'][$i])) {
					// Define new $_FILES array - $_FILES['file']
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
					// Set preference
					if (!file_exists('uploads/mieter/' . $id)) {
						mkdir('uploads/mieter/' . $id, 0777, true);
					}
					$config['upload_path'] = 'uploads/mieter/' . $id;
					$config['allowed_types'] = '*';
					$config['max_size'] = '500000'; // max_size in kb
					$config['file_name'] = $_FILES['files']['name'][$i];

					//Load upload library
					$this->load->library('upload', $config);
					// File upload
					if ($this->upload->do_upload('file')) {
						// Get data about the file
						$uploadData = $this->upload->data();
						$this->mieter_model->add_attachment($id, $uploadData);
					}
				}
			}
		}
		echo admin_url('mieter');
	}

	public function save()
	{

		if (!empty($_POST)) {


			//$this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
			//$this->form_validation->set_rules('strabe', 'strabe', 'trim|required');
			//$this->form_validation->set_rules('country', 'country', 'trim|required');

            unset($_POST['ci_csrf_token']);
			/*if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				if (isset($_POST['id']) && !empty($_POST['id'])) {
					redirect(base_url('admin/mieter/mieter/' . $_POST['id']), 'refresh');
				} else {
					redirect(base_url('admin/mieter/mieter'), 'refresh');
				}

			}*/
			if (isset($_POST['id']) && !empty($_POST['id'])) {

				$result=$this->mieter_model->update($_POST['id'], $_POST);
				if($result){
					set_alert('success', 'Updated Successfully.');
					redirect('admin/mieter/');

				}
			} else {

				$result=$this->mieter_model->add($_POST);
				if($result){
					set_alert('success', 'Added Successfully.');
					redirect('admin/mieter/');

				}
			}

		}

	}

	public function import()
	{

		$dbFields = $this->db->list_fields(db_prefix() . 'mieters');

		$this->load->library('import/import_mieter', [], 'import');

		$this->import->setDatabaseFields($dbFields);

		if ($this->input->post()
			&& isset($_FILES['file_excel']['name']) && $_FILES['file_excel']['name'] != '') {
			$data_a = $this->import->setSimulation($this->input->post('simulate'))
				->setTemporaryFileLocation($_FILES['file_excel']['tmp_name'])
				->setFilename($_FILES['file_excel']['name'])
				->perform();
			$data['data_a'] = $data_a;

		}


		$data['title'] = 'import';

		$data['bodyclass'] = 'dynamic-create-groups';
		$this->load->view('admin/mieter/import', $data);
	}

	public function import_perform_data()
	{
		if (isset($_POST)) {
			$data = unserialize($_POST['data']);
			unset($_POST['data']);
			$Posted = $_POST;
			$imported = 0;
			foreach ($data as $rowNumber => $row) {
				$insert = [];
				foreach ($Posted as $i => $columFields) {
					if (isset($row[$columFields]) && !empty($row[$columFields]))
						$insert[$i] = $row[$columFields];
					else
						$insert[$i] = '';
				}
				if (count($insert) > 0) {
					if ($this->mieter_model->is_duplicate(['fullname' => $insert['fullname'], 'vorname' => $insert['vorname'], 'nachname' => $insert['nachname']]))
						continue;
					$this->mieter_model->add_import($insert);
					$imported++;
				}
			}
			if ($imported > 0) {
				$this->session->set_flashdata('success', $imported . ' row has been exported Successfully.');
			}
			redirect(admin_url('mieter'));
		}
	}


	/* Change client status / active / inactive */
	public function change_status()
	{

			$this->mieter_model->change_status();

	}


	public function datatable_json()
	{
		$records['data'] = $this->mieter_model->get_mieter();

		$data = array();
		$i = 0;
		//$text_comfirm="return confirm('are you sure to delete?')";
		foreach ($records['data'] as $row) {
			$checked = "";
			if ($row['active'] == 1) {
				$checked = "checked";
			}
			$data[] = array(
				$row['id'],
				'<a href="' . base_url('admin/mieter/mieter/' . $row['id']) . '" class="">
		' . $row['fullname'] . '
</a><div class="row-options"><a href="' . base_url('admin/mieter/mieter/' . $row['id']) . '" class="">
Bearbeiten
</a> |
<a href="' . base_url('admin/mieter/delete/' . $row['id']) . '"   class="text-danger _delete"> löschen</a></div>',
				$row['projektname'],
				$row['strabe_m'],
				$row['nr_p'],
				$row['wohnungsnummer'],
				$row['etage'],
				$row['flugel'],
				$row['plz'],
				$row['stadt'],
				$row['telefon_1'],
				'<div class="custom-control custom-switch"><input data-switch-url="' . base_url("admin/mieter/change_status") . '" class="tgl tgl-ios tgl_checkbox custom-control-input" 
                    data-id="' . $row['id'] . '"
                    id="cb_' . $row['id'] . '"
                    type="checkbox"' . $checked . '/>
                    <label class="tgl-btn custom-control-label" for="cb_' . $row['id'] . '"></label></div>'


			);
		}
		$records['data'] = $data;
		echo json_encode($records);
	}
}

?>	
