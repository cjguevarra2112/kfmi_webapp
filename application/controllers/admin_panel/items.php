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
        $this -> data = array(
                'title'      => 'Admin Panel',
                'heading'    => 'Welcome, ' . $role,
                'subheading' => 'This is the admin panel for KFMI inventory app. You currently have no activities yet.',
                'role'       => $role
        );

        // Grab all categories for item search
        $this -> data['categories'] = $this -> db -> get ('category');

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
        } else {
            redirect('app/');
        }
    }


    // Show results for search 
    public function viewSearch () {
        if ($this -> session -> userdata('is_logged_in') ) {
            $searchStr =  $this -> input -> post('itemSearch');
            $category  =  $this -> input -> post('itemCategory');

            if (!$searchStr && !$category) {
                redirect('admin/items');
            } else {
                $config = array(
                    'base_url' => base_url() . 'items/index',
                    'per_page' => 10,
                    'num_links' => 5,
                    'total_rows' => $this -> item_model -> getItems($searchStr, $category, 10, $this -> uri -> segment(3), true)
                );

                $this -> pagination -> initialize($config);

                $this -> data['query'] = $this -> item_model -> getItems($searchStr, $category, $config['per_page'], $this -> uri -> segment(3));
                $this->load->view('admin/items.php', $this->data);
            }
        } else {
            redirect('app/');
        }
    }


    public function editItem () {
        
        $itemId = $this -> input -> post('itemId');
        $editData = array(
            'name'        => $this -> input -> post('itemName'),
            'price'       => $this -> input -> post('itemPrice'),
            'quantity'    => $this -> input -> post('itemQuantity'),
            'category_id' => $this -> input -> post('itemCategory')
        );

        $this -> item_model -> updateItem($itemId, $editData);

        // Dislay success message
        $this -> data['message'] = "updated an item";
        $this -> data['back']    = base_url('admin/items');

        $this -> load -> view ('other/success', $this -> data);
    }
}