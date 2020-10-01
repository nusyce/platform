<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Paypal_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/* This function create new Service. */

	function create($Total,$SubTotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State) {
		$codeIgniter =& get_instance();
		$pack_data = $codeIgniter->session->userdata('pack_data');
		$this->db->set('id_pack',$codeIgniter->session->userdata('pack_data')['id']);
		$this->db->set('type',$codeIgniter->session->userdata('pack_data')['type']);
		$this->db->set('total',$Total);
		$this->db->set('created_at',$CreateTime);
		$this->db->insert('mar_subscriptions');
        $this->db->set('txn_id',$saleId);
        $this->db->set('PaymentMethod',$PaymentMethod);
        $this->db->set('PayerStatus',$PayerStatus);
        $this->db->set('PayerMail',$PayerMail);
        $this->db->set('Total',$Total);
        $this->db->set('SubTotal',$SubTotal);
        $this->db->set('Tax',$Tax);
        $this->db->set('Payment_state',$State);
		$this->db->set('CreateTime',$CreateTime);
		$this->db->set('UpdateTime',$UpdateTime);
		$this->db->insert('mar_payments');
		$id = $this->db->insert_id();
		return $id;
	}

}
