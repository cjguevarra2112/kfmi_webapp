<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load the app_model model
        $this -> load -> model('category_model');

        // Disable browser caching
        $this -> output -> set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this -> output -> set_header("Pragma: no-cache");

        // Role of the current user
        $role = $this -> session -> userdata('role');

        // default view variables for title, heading, and subheading
        $this -> data = array('title' => 'Admin Panel', 'heading' => 'Welcome, ' . $role, 'subheading' => 'This is the admin panel for KFMI inventory app. You currently have no activities yet.', 'role' => $role);
    }

    // Display categories in paginated form
    public function index() {
        if ($this -> session -> userdata('is_logged_in')) {

            if ($this-> session -> userdata('role') == 'Admin') {
                $this -> load -> library('pagination');
                $config = array(
                                'base_url' => base_url() . 'categories/index',
                                'per_page' => 10, 
                                'num_links' => 5, 
                                'total_rows' => $this -> db -> get('category') -> num_rows()
                        );

                $this -> pagination -> initialize($config);

                $this -> data['query'] = $this -> category_model -> getCategories('', $config['per_page'], $this -> uri -> segment(3));

                $this -> load -> view('admin/categories', $this -> data);
            } else {
                $this -> load -> view('other/adminonly', $this->data);
            }

        } else {
                redirect('app/');
        }
    }

    // Displays categories based on a search
    // In paginated form
    public function viewSearch() {
        if ($this -> session -> userdata('is_logged_in')) {
            $searchQuery = $this -> input -> post('categorySearch');

            $this -> load -> library('pagination');

            $config = array('base_url' => base_url() . 'categories/index', 'per_page' => 10, 'num_links' => 2, 'total_rows' => $this -> db -> get('category') -> num_rows());

            $this -> pagination -> initialize($config);

            $this -> data['query'] = $this -> category_model -> getCategories($searchQuery, $config['per_page'], $this -> uri -> segment(3));
            $this -> load -> view('admin/categories', $this -> data);

        } else {
            redirect('app/');
        }

    }

    // Performs either an edit or a delete
    // NOTE: This sucks so much because it needs to be refreshed just
    // to display the form UGH >-(
    // Better off using javascript modal through Boostrap 3 :-P
    public function deleteCategory() {
        $categId = $this -> input -> post('categId');
        $this -> category_model -> deleteCategory($categId);

        // View success page!
        $this -> data['message'] = 'deleted a category';
        $this -> data['back']    = base_url('admin/categories');

        $this -> load -> view('other/success', $this -> data);
        
    }

    // Edit a category
    public function editCategory() {
        $this->form_validation -> set_rules('newCategoryName', 'Category name', 'required|xss_clean');

        if ($this -> form_validation -> run()) {
            $categoryName = $this -> input -> post('newCategoryName');
            $categoryId   = $this -> input -> post('categoryId');

            // update category
            $this->category_model->updateCategory($categoryId, $categoryName);

            // View success page!
            $this -> data['message'] = 'update a category';
            $this -> data['back']    = base_url('admin/categories');

            $this -> load -> view('other/success', $this -> data);
        }
    }
    
    public function addCategory() {
        $categoryName = $this->input->post("categoryName");
        
        // add category
        $this->category_model->addCategory($categoryName);
        
        // view success page
        $this->data['message'] = 'added a new category';
        $this->data['back']    = base_url('admin/categories');
        
        $this->load->view('other/success', $this->data);
    }
}
?>


