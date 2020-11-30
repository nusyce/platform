<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leistung_model extends CI_Model
{



    public function __construct()
    {
        parent::__construct();

    }
    public function get()
    {
		$this->db->where('company_id',get_user_company_id());
        return $this->db->get(db_prefix() . 'leistung')->result_array();;

    }
    // Not used?
    public function insert($data,$item)
    {
		$data['company_id']=get_user_company_id();
        $this->db->insert(db_prefix() . 'leistung', $data);
        $id= $this->db->insert_id();

        $my_data = array(
            'name' => serialize($item),
            'leistung' => $id,
        );
        $this->db->insert(db_prefix() . 'item_leist', $my_data);
        return $this->db->insert_id();
    }
    public function update($id,$data,$item)
    {
        $this->db->where('id',$id);
        $this->db->update(db_prefix() . 'leistung', $data);

        $my_data = array(
            'name' => serialize($item),
            'leistung' => $id,
        );
        $this->db->where('leistung',$id);
        $this->db->update(db_prefix() . 'item_leist', $my_data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete(db_prefix() . 'leistung');

        $this->db->where('leistung',$id);
        $this->db->delete(db_prefix() . 'item_leist');
        return true;
    }
    public function insert_unit($data)
    {

        $my_data = array(
            'name' => $data['unit_name'],
			'company_id' => get_user_company_id(),
        );
        $this->db->insert(db_prefix() . 'leistung_unit', $my_data);
        return $this->db->insert_id();
    }
    public function insert_einheit($data)
    {

        $my_data = array(
            'name' => $data['unit_name'],
			'company_id' => get_user_company_id(),
        );
        $this->db->insert(db_prefix() . 'leistung_einheit', $my_data);
        return $this->db->insert_id();
    }
    public function get_unit()
    {
		$data['company_id']=get_user_company_id();
       return $this->db->get(db_prefix() . 'leistung_unit')->result_array();;

    }
    public function get_einheit()
    {

		$data['company_id']=get_user_company_id();
        return $this->db->get(db_prefix() . 'leistung_einheit')->result_array();;

    }
    public function get_item_leist($id)
    {
        $this->db->select(db_prefix() . 'item_leist.leistung as id,'.db_prefix() . 'leistung.name as name,'.db_prefix() . 'item_leist.name as item');
        $this->db->where(db_prefix() . 'item_leist.leistung', $id);
        $this->db->join(db_prefix() . 'leistung', db_prefix() . 'leistung.id ='. db_prefix() . 'item_leist.leistung', 'left');
        return $this->db->get(db_prefix() . 'item_leist')->row();
    }


}
