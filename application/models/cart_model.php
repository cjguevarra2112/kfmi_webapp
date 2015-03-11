<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this -> load -> model ('item_model');
	}


	/**
	*	Records an order. Fills a record in the orders and orderproducts database
	*   @param array order => order details array
	*   @param array cartDetails => cart session array
	*
	*/
	public function recordOrder ($order, $cartDetails) {
		$this -> db -> insert('orders', $order);

		// Get the last order id
		$last_order = $this -> db -> query('SELECT id AS lastid FROM orders ORDER BY id DESC LIMIT 1')->row();

		// Loop though the cart array and use the product ids to fill in the order products table
		foreach ($cartDetails as $cart) {
			$product_id = $cart['id']; // get item id

			$data = array(
				'order_id'   => $last_order->lastid,
				'product_id' => $product_id
			);

			// insert orderproduct entry
			$this -> db -> insert('orderproducts', $data);
		}

		// Loop through cart array to update quantity
		foreach ($cartDetails as $cart) {
			$product_id = $cart['id'];
			$current_qty = $this -> item_model -> getQuantity($product_id);

			$this -> db -> where ('id', $product_id);
			$this -> db -> update('product', array('quantity' => $current_qty - $cart['qty']) );
		}


	}

}