<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    private $data = array();
    
    // Default constructor
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
    
    // Index page shows home page
    public function index () {
        $this->home();
    }
    
    
    public function home() {
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 'Admin') {
            $this->load->view('admin/home', $this->data);
        } else {
            redirect('app/');
        }
    }
    
    // Items page
    public function items () {
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 'Admin') {
            $this->load->view('admin/items', $this->data);
        } else {
            redirect('app/');
        }
    }
    
    // Categories page 
    public function categories () {
        if ($this->session->userdata('is_logged_in') ) {
           
            // Load pagination library
            $this->load->library('pagination');
            
            // Create configuration
            $config = array (
                'base_url'         => base_url() . 'admin/categories',
                'per_page'         => 10,
                'num_links'        => 10,
                'total_rows'       => $this->db->get('category')->num_rows(),
                'use_page_numbers' => FALSE
            );
            
            $this->pagination->initialize($config);
            // $categs = $this->app_model->getCategories('', $config['per_page'], $this->uri->segment(3));
            
            // Grab a paginated
            $this->data['categs'] = $this->app_model->getCategories('', $config['per_page'], $this->uri->segment(3));
            
            $this->load->view('admin/categories', $this->data);
        } else {
            redirect('app/');
        }
    }
    
    
}