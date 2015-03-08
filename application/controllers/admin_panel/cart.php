<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); };

class Cart extends CI_Controller {
    
    public function __construct () {
        parent::__construct();

        // Load the app_model model
        $this->load->model('app_model');

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
        
    }
    
    /**
     * Updates an item quantity
     */
    public function updateCart () {
        
    }
    
    /**
     * Removes an item to cart 
     */
    public function removeFromCart () {
        
    }
    
    /**
     * Clears cart
     */
    public function clearCart () {
        
    }
    
    /**
     * Proceed with checkout
     */
    public function checkout () {
        
    }
    
    public function finishTransaction () {
        
    }
    
}