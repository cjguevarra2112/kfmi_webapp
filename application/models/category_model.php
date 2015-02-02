<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
    public function __construct () {
        parent::__construct();
        
        // Load pagination library
        $this->load->library('pagination');
    }
    
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
}