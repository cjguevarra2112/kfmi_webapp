<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); };

class Cart extends CI_Controller {
    
    public function __construct () {
        parent::__construct();

        // Load the cart_model model
        $this->load->model('cart_model');

        // Load the item model
        $this -> load -> model('item_model');

        // Disable browser caching
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        // Role of the current user
        $role = $this->session->userdata('role');

        // default view variables for title, heading, and subheading
        $this->data = array(
                'title'      => 'Admin Panel',
                'heading'    => 'Welcome, ' . $role,
                'subheading' => 'This is the admin panel for KFMI inventory app. You currently have no activities yet.',
                'role'       => $role
        );

        // Load date helper
        $this -> load -> helper('date');


    }
    
    /**
     * Displays cart
     */
    public function index() {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('admin/cart', $this->data);
        } else {
            redirect('app/');
        }
    }
    
    /**
     * Inserts an item to cart
     */
    public function addToCart () {
        
        // Fetch item info from "Add to cart" POST Request
        $cartItem = array(
            'id'    => $this -> input -> post('id'),
            'name'  => $this -> input -> post('name'),
            'price' => $this -> input -> post('price'),
            'qty'   => $this -> input -> post('qty')
        );
        
        if ($cartItem['qty'] > 0) {
            $this -> cart -> insert($cartItem);
            
            // Redirect to cart index (displays cart)
            redirect(base_url('admin/cart'));
        }
        
    }
    
    
    /**
     * TEST METHOD: displays shopping cart array
     */
    public function showCart () {
        $cart = $this -> cart -> contents();
        
        if (!$cart) {
            echo 'Your cart is empty!'; 
        
        } else {    
            echo "<h2>Your Shopping Cart </h2><br/>";
            echo "<pre>";
            print_r($cart);
            echo "</pre>";
            echo '<strong> Total: </strong>' . $this -> cart -> total();
        

        }
    }
    
    
    /**
     * Updates an item quantity
     */
    public function updateCart () {
        
        // rowid_1 qty_1
        // rowid_2 qty_2
        
        $total = $this -> input -> post('total');
        
        for ($i = 1; $i < $total; $i++) {
            
            // Check if requested qty is smaller than actual item quantity
            // If so, update the cart
            
            $itemId = $this -> input -> post('id_' . (string)$i);
            
            $data = array(
                'rowid' => $this -> input -> post('rowid_' . (string)$i),
                'qty'   => $this -> input -> post('qty_' . (string)$i)
            );
            
            if ($data['qty'] <= $this -> item_model -> getQuantity($itemId) ) {
                $this -> cart -> update($data);
            }
        }
        
        redirect(base_url('admin/cart'));
        
        
    }
    
    /**
     * Removes an item to cart
     * @param1 string $rowid = unique identifier of a cart item
     */
    public function removeFromCart ($rowid) {
        
        $data = array(
            'rowid' => $rowid,
            'qty'   => 0
        );
        
        $this -> cart -> update($data);
        redirect(base_url('admin/cart'));
    }
    
    /**
     * Clears cart
     * 
     */
    public function clearCart () {
        $this -> cart -> destroy();
        redirect(base_url('admin/cart'));
    }
    
    /**
     * Proceed with checkout
     */
    public function checkout () {

        // Need cart details for cart summary
        $this -> data['cart'] = $this -> cart -> contents();

        // Need total amount for cart summary
        $this -> data['total'] = $this -> cart -> format_number($this -> cart -> total());

        // Need list of customers for payment
        $this -> data['customers'] = $this -> db -> get('customer');


        $this -> load -> view('admin/checkout', $this->data);
    }
    
    /**
     * Finish transaction
     */
    public function finishPayment () {
        $this -> form_validation -> set_rules ('cashIn', 'Cash In', 'required|decimal|callback_validate_cashin');
        $this -> form_validation -> set_rules ('customer', 'Customer', 'required');

        // Set error delimiters
        $this->form_validation->set_error_delimiters('<p class="bg-danger text-danger" style="padding:2%;" > Error: ', '</div>');

        if ( $this -> form_validation -> run() ) {

            $orderDate = time() + (7 * 3600);
            $cashIn   = $this -> input -> post('cashIn');
            $totalAmt = $this -> cart -> format_number( $this -> cart -> total());

            // orders data array
            $order = array(
                'order_date'   => $orderDate, // current timestamp
                'customer_id'  => $this -> input -> post ('customer'),
                'cash_in'      => $cashIn,
                'cash_change'  => ($cashIn - $totalAmt),
                'total_amount' => $totalAmt,
                'order_key'    => hash('sha256', (string)$orderDate . (string)$totalAmt )
            );

            // Pass in order details and cart details
            $this -> cart_model -> recordOrder ($order, $this -> cart -> contents() );

            // Destroy current cart session
            $this -> cart -> destroy();

            echo "Payment Finished! Now do the receipts! ";

        } else {

            // Display the checkout form again

            // Need cart details for cart summary
            $this -> data['cart'] = $this -> cart -> contents();

            // Need total amount for cart summary
            $this -> data['total'] = $this -> cart -> format_number($this -> cart -> total());

            // Need list of customers for payment
            $this -> data['customers'] = $this -> db -> get('customer');


            $this -> load -> view('admin/checkout', $this->data);
        }
    }


    // Callback function for cash in
    public function validate_cashin () {
        $totalAmount = $this -> cart -> format_number( $this -> cart -> total());
        $cashIn = $this -> input -> post('cashIn');

        if ($cashIn >= $totalAmount) {
            return TRUE;
        } else {
            $this -> form_validation -> set_message('validate_cashin', 'Not enough Cash In amount!');
            return FALSE;
        }
    }
    
    
    
}