<?php
 require_once("Includes/db.php");
 
 WishDB::getInstance()->delete_wishes ($_POST['wishID']);
  header('Location: editWishList.php' ); 
 
 
  

 
?>
