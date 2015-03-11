<?php

class Purchaselog_model extends CI_Model {


	public function __construct() {
		parent::__construct();
	}

	/**
	* Fetches all or specific purchases based on customer
	*
	*/
	public function getPurchases($customer='', $per_page=15, $offset=0) {

		if ($customer !== '') {
			$this -> db -> where ('customer_id', $customer);
		}

		$query = $this -> db -> get('orders', $per_page, $offset);

		if ($query -> num_rows() == 0) {
			return FALSE;
		}
		return $query;
	}

	public function getOrderProducts ($orderKey) {
		$orderId = $this -> db -> get_where('orders', array('order_key' => $orderKey) ) -> row() -> id;
		
		// products 
		$products = array();

		$this -> db -> select ('product.name, product.price');
		$this -> db -> from ('product');
		$this -> db -> join ('orderproducts', 'orderproducts.product_id = product.id');
		$this -> db -> where ('orderproducts.order_id', $orderId);

		$query = $this -> db -> get();

		return $query;
	}

}