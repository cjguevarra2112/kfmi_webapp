<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
    
    public function __construct () {
        parent::__construct();

        // Load the app_model model
        $this->load->model('customer_model');

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

        // Load pagination library
        $this -> load -> library('pagination');

        // Load date helper
        $this -> load -> helper('date');
    }
    
    /**
    * Display all customers in paginated form
    * Display
    * 
    */ 
    public function index() {
        if ($this->session->userdata('is_logged_in')) {

            // pagination config
            $config = array(
                'base_url'   => base_url() . 'customer/index',
                'per_page'   => 10,
                'num_links'  => 5,
                'total_rows' => $this -> db -> get('customer') ->  num_rows()
            );

            $this -> pagination -> initialize($config);
            $this -> data['query'] = $this -> customer_model -> getCustomers ('', $config['per_page'], $this -> uri -> segment(3) );

            $this->load->view('admin/customer', $this->data);
        } else {
            redirect('app/');
        }
    }

    public function viewSearch () {
        if ($this -> session -> userdata('is_logged_in')) {

            $searchStr = $this -> input -> post('customerSearchStr');

            if (!$searchStr) {
                redirect('admin/customer');
            } else {
                // pagination config
                $config = array(
                    'base_url'   => base_url() . 'customer/index',
                    'per_page'   => 10,
                    'num_links'  => 5,
                    'total_rows' => $this -> customer_model -> getCustomers ($searchStr, 10, $this->uri->segment(3), true)
                );

                $this -> pagination -> initialize($config);
                $this -> data['query'] = $this -> customer_model -> getCustomers ($searchStr, $config['per_page'], $this -> uri -> segment(3));

                $this->load->view('admin/customer', $this->data);
            }
        } else {
            redirect('app/');
        }
    }

    public function addCustomer () {
        $data = array(
            'fname'        => $this -> input -> post('fname'),
            'lname'        => $this -> input -> post('lname'),
            'home_address' => $this -> input -> post('addr'),
            'contact'      => $this -> input -> post('contact'),
            'regdate'      => time() + (7 * 3600)
        );


        $this -> customer_model -> addCustomer($data);

        // View success page!
        $this -> data['message'] = 'added a customer';
        $this -> data['back']    = base_url('admin/customer');

        $this -> load -> view('other/success', $this -> data);

    }
}