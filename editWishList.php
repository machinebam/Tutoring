<?php
    session_start();
    if (array_key_exists("user", $_SESSION)) {
        echo "Hello " . $_SESSION['user'];
    } else {
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>

       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form name="addNewWish" action="editWish.php">            
            <input type="submit" value="Add Wish">
        </form>
    </body>
</html>