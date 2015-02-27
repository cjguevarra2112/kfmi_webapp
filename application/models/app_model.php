<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model {

    public function __construct () {
        parent::__construct();
        
        // Initialize date helper
        $this->load->helper('date');
        
        // Load pagination library
        $this->load->library('pagination');

    }
    
    // Gets salt and hash of a user (Admin or Auditor)
    public function get_salt_and_hash ($user = FALSE) {
        $this->db->select('hash, salt');
        $this->db->where('uname', $user);
        $query = $this->db->get('account');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return array (
                'hash' => $row->hash,
                'salt' => $row->salt
            );
        } else {
            return FALSE;   
        }
    }
    
    /* Gets the role of a user based off of username
    *  @param1  username - username
    *  @return  role     - user role (either Admin or Auditor)
    *  @return2 null     - if no role is found
    */
    public function getRole ($username = NULL) {
        if ($username != NULL) {
            $this->db->select('role');
            $this->db->where('uname', $username);
            $query = $this->db->get('account');

            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->role;
            }
        } else {
            return null;
        }
    }
    
    // Gets last_login string value (human readable) of user (Used for Last Login info on header)
    // @param  username   - username of the user
    // @return last_login - date of latest login
    // @return null       - null, if user not found
    public function getLastLogin ($username = null) {
        if ($username != null) {
            $this->db->select('last_login');
            $this->db->where('uname', $username);
            $query = $this->db->get('account');
            
            
            if ($query->num_rows() > 0) {
                $row = $query->row();
                
                $dateString = "%d %F %Y @ %h:%i %a";
                $timestamp = $row->last_login;
                
                return mdate($dateString, $timestamp);
                
            }
        } else {
            return null;
        }
    }
    
    // Sets last access date on login
    // This updates the last_login column and sets it with an updated unix timestamp
    public function setLastLogin ($username = null) {
        if ($username != null) {
            $this->db->update('account', array('last_login' => time() + (7 * 3600) ));
            $this->db->where('user', $username);
        }
    }
    
    
    // Validates account for login
    // Fetches POST request values from the login form
    public function can_log_in () {
        
        // Fetch username and password from the POST Request         
        $username = $this->input->post('uname');
        $password = $this->input->post('upass');

        // Getting the hash and salt for the username
        // this is to be used for the user entered password
        $hash_and_salt = $this->get_salt_and_hash($username);
        
        $hashed_password_input = hash('sha256', $hash_and_salt['salt'] . $password);
        
        if ($hash_and_salt != FALSE && ($hashed_password_input == $hash_and_salt['hash'])) {
            return TRUE;
        } else {
            return FALSE;   
        }
        
    }
    
    // Generates secure password using CSPRING algorithm
    // @param length - length of the encrypted plain text
    public function generate_password($length = 24) {

        if(function_exists('openssl_random_pseudo_bytes')) {
            $password = base64_encode(openssl_random_pseudo_bytes($length, $strong));
            if($strong == TRUE)
                return substr($password, 0, $length); //base64 is about 33% longer, so we need to truncate the result
        }

        # fallback to mt_rand if php < 5.3 or no openssl available
        $characters = '0123456789';
        $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/+'; 
        $charactersLength = strlen($characters)-1;
        $password = '';

        # select some random characters
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[mt_rand(0, $charactersLength)];
        }        
        return $password;
    }
    
    /*
    // CATEGORIES management
    
    // Fetches all or several categories base on the query string
    // @param  queryStr - string for searching
    // @return query    - resultset object
    public function getCategories ($queryStr = '', $per_page = 10, $offset = 0) {
        if ($queryStr == '') {
            $query = $this->db->get('category', $per_page, $offset);
            return $query;
        } else {
            $this->db->select('id, name');
            $this->db->like('name', $queryStr);
            $query = $this->db->get('category', $per_page, $offset);
            return $query;
        }
    }
    */
    
}
