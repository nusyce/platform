<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mieter_model extends CI_Model{

	public function get_mieter(){

		/*$this->db->join('ci_activity_status','ci_activity_status.id=ci_activity_log.activity_id');
		$this->db->join('ci_users','ci_users.id=ci_activity_log.user_id','left');
		$this->db->join('ci_admin','ci_admin.admin_id=ci_activity_log.admin_id','left');
		$this->db->order_by('ci_activity_log.id','desc');*/
		return $this->db->get('mar_mieters')->result_array();
	}
	public function get_by_id($id){
		$query = $this->db->get_where('mar_mieters', array('id' => $id));
		return $result = $query->row();


	}
	public function add($data)
	{
		
			
			$data['created_at']=date('d-m-y h:i:s');
			$this->db->insert('mar_mieters', $data);
			$this->session->set_flashdata('success','Mieter has been Added Successfully.');	
		redirect('admin/mieter/');

	}
	public function delete($id){



		$this->db->delete('mar_mieters', array('id' => $id));
		$this->session->set_flashdata('success','Mieter has been Deleted Successfully.');	
		redirect('admin/mieter/');

	}
	public function update($id,$data){
		
		    $this->db->where(array('id' => $id));
			$this->db->update('mar_mieters', $data);

			$this->session->set_flashdata('success','Mieter has been Updated Successfully.');	
		redirect('admin/mieter/');





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
