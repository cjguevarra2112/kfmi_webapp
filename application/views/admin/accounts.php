<?php $this->load->view('admin/layout/header'); ?>

<h1> Accounts Management </h1>

<?php
	$cart = '
		{                                           
		  "orderID": 12345,                         
		  "shopperName": "John Smith",              
		  "shopperEmail": "johnsmith@example.com",  
		  "contents": [                             
		    {                                       
		      "productID": 34,                      
		      "productName": "SuperWidget",         
		      "quantity": 1                        
		    },
		    {                                   
		      "productID": 56,                      
		      "productName": "WonderWidget",        
		      "quantity": 3                         
		    }                                       
		  ],                                        
		  "orderCompleted": true                    
		}                                           
	';
	
	$cart = json_decode( $cart );
	echo $cart->shopperEmail . "<br/>";
	echo $cart->contents[1]->productName . "<br/>";
	
	
?>

<?php $this->load->view('admin/layout/footer'); ?>