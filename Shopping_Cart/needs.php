<?php

/*
 *One USER will have multiple order
 * One order belongs to one USER
 * 
 * Each order can have multiple items
 * Each item can have multiple orders (execpt in limited items such as ebay)
 *
 * What information do we need to store?

 * Item ID,
 * Item Name, 
 * Item unit price, 
 * Item picture, file name of the picture

ORDER ID
ORDER STATE
ORDER VALUE

 * States Required:
 
 Open 
 * Items being added to cart (what added but not purchased)
            Can be abandoned
            Order total value is null
           
 
 After Opened: Inprogress stage, order submitted 
 * (digital no shipping)
 * order ttaol value is not NIULL
 * 
 Not yet Shipped state
 * 
 Shipped State sent to customers
 * 
 Refunded or Returned state.

USER ID
 * Item IDs in the users shopping car (cartItems)
 
Details Page
 * Users Name
 * Users Address   (Use two addresses building for a real site)
 * Users City
 * Users Postcode
 * User Country
  
 * (payment details - later)
 */
?>
