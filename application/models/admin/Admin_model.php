<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	public function get_user_detail(){
		$id = $this->session->userdata('admin_id');
		$query = $this->db->get_where('mar_admin', array('admin_id' => $id));
		return $result = $query->row_array();
	}
	//--------------------------------------------------------------------
	public function update_user($data){
		$id = $this->session->userdata('admin_id');
		$this->db->where('admin_id', $id);
		$this->db->update('mar_admin', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function change_pwd($data, $id){
		$this->db->where('admin_id', $id);
		$this->db->update('mar_admin', $data);
		return true;
	}
	//-----------------------------------------------------
	function get_admin_roles()
	{
		$this->db->from('mar_admin_roles');
		$this->db->where('active',1);
		$query=$this->db->get();
		return $query->result_array();
	}


	//-----------------------------------------------------
	function get_admin_by_id($id)
	{
		$this->db->from('mar_admin');

		$this->db->where('admin_id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}
	public function get($id = '', $where = [], $withHidden = false)
	{
		$select_str = '*,CONCAT(firstname," ",lastname) as full_name';
		// Used to prevent multiple queries on logged in staff to check the total unread notifications in core/AdminController.php

		$this->db->select($select_str);



		$this->db->where($where);
		if (is_numeric($id)) {
			$this->db->where('admin_id', $id);
			$admin= $this->db->get(db_prefix() . 'admin')->row();


			return $admin;
		}
		$this->db->order_by('firstname', 'desc');

		return $this->db->get(db_prefix() . 'admin')->result_array();
	}

	//-----------------------------------------------------
	function get_all()
	{

		$this->db->from('mar_admin');

		$this->db->join('mar_admin_roles','mar_admin_roles.admin_role_id=mar_admin.admin_role_id');

		if($this->session->userdata('filter_type')!='')

			$this->db->where('mar_admin.admin_role_id',$this->session->userdata('filter_type'));

		if($this->session->userdata('filter_status')!='')

			$this->db->where('mar_admin.is_active',$this->session->userdata('filter_status'));


		$filterData = $this->session->userdata('filter_keyword');

		$this->db->like('mar_admin_roles.admin_role_title',$filterData);
		$this->db->or_like('mar_admin.firstname',$filterData);
		$this->db->or_like('mar_admin.lastname',$filterData);
		$this->db->or_like('mar_admin.email',$filterData);
		$this->db->or_like('mar_admin.mobile_no',$filterData);
		$this->db->or_like('mar_admin.username',$filterData);

		$this->db->where('mar_admin.is_supper !=', 1);

		$this->db->order_by('mar_admin.admin_id','desc');

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}

		return $module;
	}

	//-----------------------------------------------------
public function add_admin($data){
	$data['company_id']=get_user_company_id();
	$this->db->insert('mar_admin', $data);
	$this->Activity_model->add_log('New User [ID: ' . $this->db->insert_id() . ']');
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_admin($data, $id){
	$this->db->where('admin_id', $id);
	$this->db->update('mar_admin', $data);
	$this->Activity_model->add_log('User Updated [ID: ' . $id. ']');
	return true;
}

	//-----------------------------------------------------
function change_status()
{
	$this->db->set('active',$this->input->post('status'));
	$this->db->where('admin_id',$_POST['id']);
	$this->db->update('mar_admin');
	$this->Activity_model->add_log('User Status Changed [ID: ' . $_POST['id']. ']');

} 

	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('admin_id',$id);
	$this->db->delete('mar_admin');
	$this->Activity_model->add_log('User Deleted [ID: ' . $id. ']');
} 

}

?>
