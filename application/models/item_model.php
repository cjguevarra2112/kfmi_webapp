<?php

class Item_model extends CI_Model {

	public function __contruct(){
		parent::__construct();
	}

	/**
	* Fetch all or several items based on the query string or the category
	* @param queryStr   - Search string
	* @param categoryId - Id of the category (for faster searching)
	* @param per_page   - items per page (for pagination)
	* @param offset     - starting point (starting item) for every page
	* 
	* @return query     - result set object
	*/

	public function getItems ($queryStr='', $categoryId='', $per_page=10, $offset=0) {
            if ($queryStr == '' && $categoryId == '') {
                $this->db->select('product.id, product.name, product.price, product.quantity, category.name AS category');
                $this->db->from('product');
                $this->db->join('category', 'product.category_id = category.id');
                $this->db->limit($per_page, $offset);
                // $this->db->where('product.category_id', 1);
                
                $query = $this->db->get();
                
                if ($query->num_rows() == 0) {
                    return FALSE;
                }
                return $query;
            } else {

            }
	}
}	