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

	public function getItems ($queryStr='', $categoryId='', $per_page=10, $offset=0, $simple=FALSE) {
            
        $this -> db -> select('product.id, product.name, product.price, product.quantity, product.category_id, category.name AS category');
        $this -> db -> from('product');
        $this -> db -> join('category', 'product.category_id = category.id');
        
        if ($queryStr != '') {
        	$this -> db -> like ('product.name', $queryStr);
        }

        if ($categoryId !== '') {
        	$this -> db -> where ('category.id', $categoryId);
        }

        $this -> db -> limit($per_page, $offset);
        $query = $this -> db -> get();
        

        if ($simple) {
        	return $query->num_rows();
        } else {

        	if ($query->num_rows() == 0) {
            	return FALSE;
        	} else {
        		return $query;
        	}
        }
 
	}

	/**
	* Deletes an item based off of itemId
	* @param $itemId 
	*/
	public function deleteItem($itemId) {
		$this -> db -> delete('product', array('id' => $itemId) );
	}


	/**
	* Updates a single item based off of item id
	* @param int   $itemId   => id of the item to be updated
	* @param array $editData => array containing new item data
	*/
	public function updateItem ($itemId, $editData) {
		$this -> db -> where('id', $itemId);
		$this -> db -> update('product', $editData);
	}

	/**
	*	Adds a new item
	*   @param array $itemData
	*/
	public function addItem($itemData) {
		$this -> db -> insert('product', $itemData);
	}

}	