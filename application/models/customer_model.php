<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {
	public function __construct () {
		parent::__construct();

	}

	public function getCustomers ($queryStr='', $per_page=10, $offset=0, $simple=FALSE) {
		$this -> db -> select('fname, lname, home_address, contact, regdate');

		if ($queryStr != '') {
			$this -> db -> like('fname', $queryStr);
			$this -> db -> or_like('lname', $queryStr);
		}

		$this -> db -> limit ($per_page, $offset);
		$query = $this -> db -> get('customer');

		if ($simple) {
			return $query -> num_rows();
		} else {
			if ($query -> num_rows() == 0) {
				return FALSE;
			} else {
				return $query;
			}
		}
	}

	/**
	* Adds a single customer
	*
	*/
	public function addCustomer ($customerData) {
		$this -> db -> insert('customer', $customerData);
	}	


}