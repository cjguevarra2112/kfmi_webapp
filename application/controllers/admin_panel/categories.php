<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function __construct () {
        parent::__construct();

        // Load the app_model model
        $this->load->model('category_model');

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
    
    // Display categories in paginated form
    public function index() {
        if ($this->session->userdata('is_logged_in')) {
            
            // Create pagination config array
            $config = array (
                'base_url'         => base_url() . 'admin/categories',
                'per_page'         => 10,
                'num_links'        => 10,
                'total_rows'       => $this->db->get('category')->num_rows(),
                'use_page_numbers' => FALSE
            );
            
            // initialize pagination 
            $this->pagination->initialize($config);
            
            // Grab a paginated result
            $this->data['categs'] = $this->category_model->getCategories('', $config['per_page'], $this->uri->segment(3));
            
            $this->load->view('admin/categories', $this->data);
        } else {
            redirect('app/');
        }
    }
}