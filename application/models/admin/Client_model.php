<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model{
   public $company;
	public $strabe;
	public $hausnummer;
	public $country;
	public $email;
	public $phonenumber;
	public $website;
	public $datecreated;
	public function add($data)
	{
		
			
			$data['datecreated']=date('d-m-y h:i:s');
		$data['company_id']=get_user_company_id();
			$this->db->insert('mar_clients', $data);
		$this->Activity_model->add_log('New client [ID: ' . $this->db->insert_id() . ']');
return true;


	}
	public function get($id = '', $where = [])
	{


		if ((is_array($where) && count($where) > 0) || (is_string($where) && $where != '')) {
			$this->db->where($where);
		}

		if (is_numeric($id)) {
			$this->db->where(db_prefix() . 'clients.userid', $id);
			$client = $this->db->get(db_prefix() . 'clients')->row();


			$GLOBALS['client'] = $client;

			return $client;
		}



		return $this->db->get(db_prefix() . 'clients')->result_array();
	}
	public function get_vault_entries($customer_id, $where = [])
	{
		//return $this->Client_vault_entries_model->get_by_customer_id($customer_id, $where);
		return [];
	}
	function change_status()
	{
		$this->db->set('active',$this->input->post('status'));
		$this->db->where('userid',$this->input->post('id'));
		$this->db->update('mar_clients');
		$this->Activity_model->add_log('Status client changed [ID: ' . $this->input->post('id') . ']');
		set_alert('success', 'changed_successfully');
	}
	public function get_by_id($id){
		$query = $this->db->get_where('mar_clients', array('userid' => $id));
		return $result = $query->row();


	}
	public function delete($id){



		$this->db->delete('mar_clients', array('userid' => $id));
		$this->Activity_model->add_log('Client deleted [ID: ' . $id . ']');
		return true;


	}
	public function update($id,$data){
		
		    $this->db->where(array('userid' => $id));
			$this->db->update('mar_clients', $data);
				$this->Activity_model->add_log('Client Updated [ID: ' . $id . ']');
		return true;






	}
	public function get_client(){

		/*$this->db->join('ci_activity_status','ci_activity_status.id=ci_activity_log.activity_id');
		$this->db->join('ci_users','ci_users.id=ci_activity_log.user_id','left');
		$this->db->join('ci_admin','ci_admin.admin_id=ci_activity_log.admin_id','left');
		$this->db->order_by('ci_activity_log.id','desc');*/
		return $this->db->get('mar_clients')->result_array();
	}

	//--------------------------------------------------------------------
	public function add_log($activity){
		$data = array(
			'activity_id' => $activity,
			'user_id' => ($this->session->userdata('user_id') != '') ? $this->session->userdata('user_id') : 0,
			'admin_id' => ($this->session->userdata('admin_id') != '') ? $this->session->userdata('admin_id') : 0,
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('ci_activity_log',$data);
		return true;
	}

	

	
}

?>
