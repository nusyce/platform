<?php

defined('BASEPATH') or exit('No direct script access allowed');

class leistung_verz extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Leistung_model');
    }


    /* List all contracts */
    public function index()
    {
        close_setup_menu();
        $data['title'] = 'Leistung-verz';
        $this->load->view('admin/leistung_verz/manage', $data);
    }


    public function render($leistung_verz = '')
    {
		$this->app->get_renderable_data('leistung_verz/table', ['leistung_verz' => $leistung_verz]);
    }

    public function leistung_verz()
    {


        $data = array(
            'name' => $this->input->post('name'),

            'create_at' => date('Y-m-d : h:m:s'),
            'active' => 1,
        );
       $result= $this->Leistung_model->insert($data,$_POST['mes_intervalles']);
        set_alert('success',"Added Successfuly");
        redirect(admin_url('leistung_verz'));
    }
    public function add_unit()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
            $result = $this->Leistung_model->insert_unit($_POST);
                if ($result) {
                 echo json_encode([
                    'response' => true,
                     'id' => $result,
                     'name'=>$_POST['unit_name']
                 ]);
                } else {
                    echo json_encode([
                    'response' => false,
                 ]);
            }
          }
         }
    }
    public function add_einheit()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $result = $this->Leistung_model->insert_einheit($_POST);
                if ($result) {
                    echo json_encode([
                        'response' => true,
                        'id' => $result,
                        'name'=>$_POST['unit_name']
                    ]);
                } else {
                    echo json_encode([
                        'response' => false,
                    ]);
                }
            }
        }
    }
    public function get_unit()
    {


                $result = $this->Leistung_model->get_unit();

                    echo json_encode([
                        'response' => $result,
                    ]);



    }
    public function get_einheit()
    {


        $result = $this->Leistung_model->get_einheit();

        echo json_encode([
            'response' => $result,
        ]);



    }
    public function get()
    {

        $result = $this->Leistung_model->get();

        echo json_encode([
            'response' => $result,
        ]);

    }
    public function get_item_leist($id)
    {

        $result = $this->Leistung_model->get_item_leist($id);
        $result->item =unserialize($result->item);


        echo json_encode([
            'response' => $result,
        ]);

    }
    public function edit($id)
    {
        if($this->input->post())
        {

            $data = array(
                'name' => $this->input->post('name'),

                'create_at' => date('Y-m-d : h:m:s'),
                'active' => 1,
            );
            $result= $this->Leistung_model->update($id,$data,$_POST['mes_intervalles']);
            set_alert('success',"Updated Successfuly");
            redirect(admin_url('leistung_verz'));
        }
        $data['title'] = 'Leistung-verz';
        $data['item'] = $this->Leistung_model->get_item_leist($id);
        $data['unit'] = $this->Leistung_model->get_unit();
        $data['einheit'] = $this->Leistung_model->get_einheit();
        $this->load->view('admin/leistung_verz/edit', $data);

    }
    public function delete($id)
    {
        $result= $this->Leistung_model->delete($id);
        set_alert('success',"Deleted Successfuly");
        redirect(admin_url('leistung_verz'));

    }
    public function add()
    {
        $data['unit'] = $this->Leistung_model->get_unit();
        $data['einheit'] = $this->Leistung_model->get_einheit();
        $data['title'] = 'Leistung-verz';
        $this->load->view('admin/leistung_verz/leistung_verz',$data);

    }
}
