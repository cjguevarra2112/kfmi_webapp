<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public function __construct () {
        parent::__construct();

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

        // Load the app_model model
        $this->load->model('item_model');

        // Load pagination library
        $this -> load -> library('pagination');
    }
    
    // Display categories in paginated form
    // 
    public function index() {
        if ($this->session->userdata('is_logged_in')) {
            // if ($this->session->userdata('role') == 'Admin') {
                
                $config = array(
                    'base_url' => base_url() . 'items/index',
                    'per_page' => 10,
                    'num_links' => 5,
                    'total_rows' => $this -> db -> get('product') -> num_rows()
                );

                $this -> pagination -> initialize ($config);
                $this -> data['query'] = $this -> item_model -> getItems ('', '', $config['per_page'], $this -> uri -> segment(3) );

                $this->load->view('admin/items.php', $this->data);

            /* } else {
                // Show restricted page!
                // $this->load->view('admin/items.php', $this->data);
               $this->load->view('other/adminonly', $this->data);
            } */
                
        } else {
            redirect('app/');
        }
    }
    
}