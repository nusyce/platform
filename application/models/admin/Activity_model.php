<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends CI_Model{

	public function get_activity_log(){
		$this->db->select('
			mar_activity_log.id,
			description,
			mar_activity_date,
			mar_admin.username
		');

		$this->db->join('mar_admin','mar_admin.admin_id=mar_activity_log.admin_id');
		$this->db->order_by('mar_activity_log.id','desc');
		return $this->db->get('ci_activity_log')->result_array();
	}

	//--------------------------------------------------------------------
	public function add_log($description){
		$data = array(
			'description' => $description,
			'admin_id' => ($this->session->userdata('admin_id') != '') ? $this->session->userdata('admin_id') : 0,
			'date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('mar_activity_log',$data);
		return true;
	}
	

	
}

?>
