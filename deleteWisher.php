<?php
  require_once("Includes/db.php");
  
  WishDB::getInstance()->delete_wish ($_POST['wishID']);
  header('Location: editWishList.php' );
?><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
