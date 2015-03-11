<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PurchaseLog extends CI_Controller {

	public function __construct() {
            parent::__construct();

            // Load the app_model model
            $this -> load -> model('app_model');

            // Load purchase log model
            $this -> load -> model('purchaselog_model');

            // Disable browser caching
            $this -> output -> set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
            $this -> output -> set_header("Pragma: no-cache");

            // Role of the current user
            $role = $this -> session -> userdata('role');

            // default view variables for title, heading, and subheading
            $this -> data = array('title' => 'Admin Panel', 'heading' => 'Welcome, ' . $role, 'subheading' => 'This is the admin panel for KFMI inventory app. You currently have no activities yet.', 'role' => $role);
	       
            // Get all customers info for purchases log search
            $this -> data['customers'] = $this -> db -> get('customer');
    }

	// Display purchases in paginated form
	//
	public function index() {
        if ($this -> session -> userdata('is_logged_in')) {
            if ($this -> session -> userdata('role') == 'Admin') {

                $this -> load -> library('pagination');
                $config = array (
                    'base_url'   => base_url() . 'purchaselog/index',
                    'per_page'   => 15,
                    'num_links'  => 7,
                    'total_rows' => $this -> db -> get('orders') -> num_rows()
                ); 

                $this -> pagination -> initialize($config);

                $this -> data['query'] = $this -> purchaselog_model -> getPurchases('', $config['per_page'], $this -> uri -> segment(3));

                $this -> load -> view('admin/purchaselog', $this -> data);
            } else {
                $this -> load -> view('other/adminonly', $this -> data);
            }
        } else { 
            redirect('app/');
        }
	}

    public function viewSearch () {
        if ($this -> session -> userdata('is_logged_in')) {
            if ($this -> session -> userdata('role') == 'Admin') {
                $this -> load -> library('pagination');

                $config = array (
                    'base_url'   => base_url() . 'purchaselog/index',
                    'per_page'   => 15,
                    'num_links'  => 7,
                    'total_rows' => $this -> db -> get('orders') -> num_rows()
                ); 

                $customerId = $this -> input -> post('customerId');

                $this -> pagination -> initialize($config);

                $this -> data['query'] = $this -> purchaselog_model -> getPurchases($customerId, $config['per_page'], $this -> uri -> segment(3));
                $this -> load -> view('admin/purchaselog', $this -> data);
            } else {
                $this -> load -> view('other/adminonly', $this -> data);
            }
        }else {
            redirect('app/');
        }
    }

}
