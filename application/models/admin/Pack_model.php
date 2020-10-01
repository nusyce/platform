<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pack_model extends CI_Model{


	public function get_pack(){

		/*$this->db->join('ci_activity_status','ci_activity_status.id=ci_activity_log.activity_id');
		$this->db->join('ci_users','ci_users.id=ci_activity_log.user_id','left');
		$this->db->join('ci_admin','ci_admin.admin_id=ci_activity_log.admin_id','left');
		$this->db->order_by('ci_activity_log.id','desc');*/
		return $this->db->order_by('order', 'ASC')->get('mar_packs')->result_array();
	}

	//--------------------------------------------------------------------


	

	
}

?>
