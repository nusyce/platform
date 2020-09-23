<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model{


	//--------------------------------------------------------------------
	public function save_module_name($data){

		$this->db->where('id_admin', $data['id_admin']);
		$this->db->where('id_module', $data['id_module']);
		$query=$this->db->get('mar_module_rename');

		if($query->num_rows() > 0){
			$this->db->where('id_admin', $data['id_admin']);
			$this->db->where('id_module', $data['id_module']);
			$this->db->update('mar_module_rename', $data);
		} else {

			$this->db->insert('mar_module_rename', $data);
		}




	}
	//--------------------------------------------------------------------

	//-----------------------------------------------------




}

?>
