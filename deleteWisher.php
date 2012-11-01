<?php
  require_once("Includes/db.php");
  
  WishersDB::getInstance()->delete_wishers ($_POST['wishID']);
  header('Location: editWishList.php' );
?>
