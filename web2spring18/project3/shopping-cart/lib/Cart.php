<!--
    This file handles all the action requested by the user from view page. 
    The code blocks would be executed based on the requested action. The following operations can 
    happen based on the action.
    addToCart – Fetches the product details from the products table by the specified product 
        ID and insert the item into the cart using Cart class. After successful operation, the user is redirected to the viewCart.php page.
    updateCartItem – Updates the cart by specific rowid using Cart 
        class and returns the status message.
    removeCartItem – Removes the item from the cart by the specific 
        item id using Cart class. After successful operation, the user is redirected to the viewCart.php page.
    placeOrder – Inserts the cart items data to the orders and order_items 
        table and destroy the cart data from the session. using Cart class. After successful operation, 
        the user is redirected to the orderSuccess.php page.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: Cart.php
    Author 1: CodexWorld
    Author 2: ...
-->
<?php

include 'lib/DomainCollection.class.php'

session_start();

class Cart {
    
    protected $contents = null;
    
}

/*
session_start();
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        // get the shopping cart array from the session
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
		if ($this->cart_contents === NULL){
			// set some base values
			$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		}
    }
    
    /////
	 // Cart Contents: Returns the entire cart array
	 // @param	bool
	 // @return	array
	 ///
	public function contents(){
		// rearrange the newest first
		$cart = array_reverse($this->cart_contents);

		// remove these so they don't create a problem when showing the cart table
		unset($cart['total_items']);
		unset($cart['cart_total']);

		return $cart;
	}
    
    /////
	 // Total Items: Returns the total item count
	 // @return	int
	 ///
	public function total_items(){
		return $this->cart_contents['total_items'];
	}
    
    /////
	 // Cart Total: Returns the total price
	 // @return	int
	 ///
	public function total(){
		return $this->cart_contents['cart_total'];
	}
    
    /////
	 // Insert items into the cart and save it to the session
	 // @param	array
	 // @return	bool
	 ///
	public function insert($item = array()){
		if(!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
            if(!isset($item['id'], $item['name'], $item['price'], $item['quantity'])){
                return FALSE;
            }else{
                ///
                 // Insert Item
                 ///
                // prep the quantity, then save
                $item['quantity'] = (float) $item['quantity'];
                if($item['quantity'] == 0){
                    return FALSE;
                }
                // prep the price
                $item['price'] = (float) $item['price'];
                // create a unique identifier for the item being inserted into the cart
                $row_id = $item['id'];
                // get quantity if it's already there and add it on
                $old_quantity = isset($this->cart_contents[$row_id]['quantity']) ? (int) $this->cart_contents[$row_id]['quantity'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['row_id'] = $row_id;
                $item['quantity'] += $old_quantity;
                $this->cart_contents[$row_id] = $item;
                // save Cart Item
                if($this->save_cart()){
                    return isset($item['id']) ? $item['id'] : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
	}
    
    /////
	 // Update the cart
	 // @param	array
	 // @return	bool
	 ///
	public function update($item = array()){
		if (!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
			if (!isset($item['row_id'], $this->cart_contents[$item['row_id']])){
				return FALSE;
			}else{
				// prep the quantity
				if(isset($item['quantity'])){
					$item['quantity'] = (float) $item['quantity'];
					// remove the item from the cart, if quantity is zero
					if ($item['quantity'] == 0){
						unset($this->cart_contents[$item['row_id']]);
						return TRUE;
					}
				}
				
				// find updatable keys
				$keys = array_intersect(array_keys($this->cart_contents[$item['row_id']]), array_keys($item));
				// prep the price
				if(isset($item['price'])){
					$item['price'] = (float) $item['price'];
				}
				// product id & name shouldn't be changed
				foreach(array_diff($keys, array('id', 'name')) as $key){
					$this->cart_contents[$item['row_id']][$key] = $item[$key];
				}
				// save cart data
				$this->save_cart();
				return TRUE;
			}
		}
	}
    
    /////
	 // Save the cart array to the session
	 // @return	bool
	 ///
	protected function save_cart(){
		$this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
		foreach ($this->cart_contents as $key => $val){
			// make sure the array contains the proper indexes
			if(!is_array($val) OR !isset($val['price'], $val['quantity'])){
				continue;
			}
	 
			$this->cart_contents['cart_total'] += ($val['price'] * $val['quantity']);
			$this->cart_contents['total_items'] += $val['quantity'];
			$this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['quantity']);
		}
		
		// if cart empty, delete it from the session
		if(count($this->cart_contents) <= 2){
			unset($_SESSION['cart_contents']);
			return FALSE;
		}else{
			$_SESSION['cart_contents'] = $this->cart_contents;
			return TRUE;
		}
    }
    
    /////
	 // Remove Item: Removes an item from the cart
	 // @param	int
	 // @return	bool
	 ///
	 public function remove($row_id){
		// unset & save       
		unset($this->cart_contents[$row_id]);
		$this->save_cart();
		return TRUE;
	 }
     
    /////
	 // Destroy the cart: Empties the cart and destroy the session
	 // @return	void
	 ///
	public function destroy(){
		//Reset cart_contents
        //destroy session
		$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		unset($_SESSION['cart_contents']);
	}*/
//}

?>