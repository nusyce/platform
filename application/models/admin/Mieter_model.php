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
	function is_duplicate($where = [])
	{
		$this->db->where($where);
		$res = $this->db->get(db_prefix() . 'mieters')->row();
		if ($res) {
			return true;
		}
		return false;
	}
	public
	function add_import($data)
	{
		if ($data) {

			if (isset($data['a_qty'])){
				$a_qty = $data['a_qty'];
				unset($data['a_qty']);
			}
			if (isset($data['austattung'])){
				$austattung = $data['austattung'];
				unset($data['austattung']);
			}
			if (isset($data['delete'])){
				$deleteData = $data['delete'];
				unset($data['delete']);
			}
			if (isset($data['sqr'])){
				$sqr = $data['sqr'];
				unset($data['sqr']);
			}
			if (isset($data['reasons'])){
				$reasons = $data['reasons'];
				unset($data['reasons']);
			}

			$data['beraumung'] = $data['beraumung'];
			$data['baubeginn'] = $data['baubeginn'];
			$data['ruckraumung'] = $data['ruckraumung'];
			$data['bauende'] = $data['bauende'];
			$data['k_ruckraumung'] = $data['k_ruckraumung'];
			$data['k_baubeginn'] = $data['k_baubeginn'];
			$data['fenstereinbau'] = $data['fenstereinbau'];

			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			if (isset($data['haustiere'])) {
				$data['haustiere'] = $data['haustiere'] == 'on' ? 1 : 0;
				$data['raucher'] = $data['raucher'] == 'on' ? 1 : 0;
			}
			//$data['userid'] = get_staff_user_id();
			$data['userid'] =1;
			$data['active'] = 1;

			$this->db->insert(db_prefix() . 'mieters', $data);
			$insert_id = $this->db->insert_id();
			if ($insert_id) {
				/*foreach ($austattung as $k => $item) {
					if ($a_qty[$k] == 0 && $item < 1)
						continue;
					$data = array('reason' => $reasons[$k],
						'is_deleted' => (int)$deleteData[$k],
						'for' => 1,
						'qty' => $a_qty[$k], 'sqr' => $sqr[$k]);
					if (!$this->wohnungen_inventar_model->exist($insert_id, $item, 1)) {
						$data['aq_id'] = $insert_id;
						$data['inventar_id'] = $item;
						$this->wohnungen_inventar_model->add($data);
					} else {
						$this->wohnungen_inventar_model->update($data, $insert_id, $item);
					}
				}*/
			}
		}
		return false;
	}

	function change_status()
	{
		$this->db->set('active',$this->input->post('status'));
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('mar_mieters');
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
