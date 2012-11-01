<?php
  require_once("Includes/db.php");
  
  WishersDB::getInstance()->delete_wisher ($_POST['wisherID']);
  header('Location: editWishList.php' );
?>