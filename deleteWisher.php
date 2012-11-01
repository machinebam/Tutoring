<?php
  require_once("Includes/db.php");
  
  WishersDB::getInstance()->delete_wisher ($_POST['wisherID']);
  header('Location: editWishList.php' );
  
  //change header to login page once user deletion is working
?>