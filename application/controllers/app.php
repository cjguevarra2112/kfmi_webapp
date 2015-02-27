<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Disable browser caching
		$this -> output -> set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this -> output -> set_header("Pragma: no-cache");

		// Load main model
		$this -> load -> model('app_model');

		// Load libraries and helpers
		// form and url helpers
		$this -> load -> helper(array('form', 'url'));

		// form validation library
		$this -> load -> library('form_validation');
	}

	// Shows Login form
	public function index() {
		$this -> login();
	}

	// Members only page (admin page)
	public function members() {
		if ($this -> session -> userdata('is_logged_in')) {
			redirect('admin_panel/admin');
		} else {
			redirect('app/');
		}
	}

	// Displays login form
	public function login() {

		// if user is logged in redirect to members page
		if ($this -> session -> userdata('is_logged_in')) {
			redirect('app/members');
		}

		// By default, display login form
		$data = array('title' => 'Login', 'header' => 'KFMI Login');
		$this -> load -> view('signin', $data);
	}

	/**
         * Checks if login credentials. If the uname/upass combination is valid,
         * it will redirect user to the admin panel.
         */
	public function login_validation() {

		// Set up validation rules
		$this -> form_validation -> set_rules('uname', 'Username', 'required|xss_clean|callback_validate_credentials');
		$this -> form_validation -> set_rules('upass', 'Password', 'required');

		// If validation is successful create user session
		// and redirect to members page
		if ($this -> form_validation -> run()) {

			$user = $this -> input -> post('uname');

			$data = array('user' => $this->input->post('uname'), 'is_logged_in' => 1, 'role' => $this->app_model->getRole($user), 'last_login' => $this->app_model->getLastLogin($user));

			// create user session
			$this -> session -> set_userdata($data);

			// set the last login value
			$this -> app_model -> setLastLogin($user);

			// redirect user to the inventory page
			redirect('app/members');

		} else {

			$data = array('title' => 'Login', 'header' => 'KFMI Login');
			$this -> load -> view('signin', $data);
		}
	}

	/**
         * Logs out the current user
         * This will destroy all session data in the sessions db
         */
	public function logout() {
		if ($this -> session -> userdata('is_logged_in')) {

			$data = array('user' => $this -> session -> userdata('user'), 'title' => 'Logout');
			$this -> session -> sess_destroy();
			$this -> load -> view('admin/logout_view', $data);
		} else {
			redirect('app/');
		}
	}

	// Callback for checking login credentials
	// Uses model method can_log_in()
	public function validate_credentials() {
		if ($this -> app_model -> can_log_in()) {
			return true;
		} else {
			$this -> form_validation -> set_message('validate_credentials', 'Incorrect username/password');
			return false;
		}
	}

}
