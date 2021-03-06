<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
    public function __construct () {
        parent::__construct();
        
    }
    
    // Fetches all or several categories base on the query string
    // @param  queryStr - string for searching
    // @param  per_page - items per page (for pagination)
    // @param  offset   - starting point for every page (for pagination)
    // @return query    - resultset object
    public function getCategories ($queryStr = '', $per_page = 10, $offset = 0) {
        if ($queryStr == '') {
            $query = $this->db->get('category', $per_page, $offset);
            
            if ($query->num_rows() == 0) {
                return FALSE;    
            }
            return $query;
        } else {
            $this->db->select('id, name');
            $this->db->like('name', $queryStr);
            $query = $this->db->get('category', $per_page, $offset);
            
            if ($query->num_rows() == 0) {
                return false;
            }
            return $query;
        }
    }
    
    /**
     * Get a single category
     * @param int $categId
     */
    public function getCategory ($categId) {
         $query = $this->db->get_where('category', array('id' => $categId));
         if ($query->num_rows() > 0) {
             return $query->row();
         }
    }
    
    /**
     * Updates a category based off of its Id
     * @param int $categId   - id of the category
     * @param str $categName - new category name
     * @return void
     */
    public function updateCategory($categId, $categName) {
        $this->db->where('id', $categId);
        $this->db->update('category', array('name' => $categName));
    }
    
    /**
     * Adds a new category
     * @param str $categName - category name
     */
    public function addCategory ($categName) {
        $this->db->insert("category", array("name" => $categName));
    }
    
    /**
     * Deletes a category and all items under that category
     * @param int $categId - category id
     */
    public function deleteCategory ($categId) {
        $this -> db -> delete('product', array('category_id' => $categId));
        $this -> db->delete('category', array('id' => $categId));
    }
    
}