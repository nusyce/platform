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
	$this->db->insert('mar_admin', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_admin($data, $id){
	$this->db->where('admin_id', $id);
	$this->db->update('mar_admin', $data);
	return true;
}

	//-----------------------------------------------------
function change_status()
{
	$this->db->set('active',$this->input->post('status'));
	$this->db->where('admin_id',$_POST['id']);
	$this->db->update('mar_admin');

} 

	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('admin_id',$id);
	$this->db->delete('mar_admin');
} 

}

?>
