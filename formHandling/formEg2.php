<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        if (empty($_POST)){
            print "Please tell me your name.";
        } else {
            print "Welcome, ". $_POST['firstName'] ." ". $_POST['lastName'];
               
        }
        print "<!--";
        var_dump($_POST);
        print "-->";
        
        ?>
        
        <form action="formEg2.php" method="POST">
    <label for="firstName">First Name</label>
    <input id="firstName" type="text" name="firstName" value="" />
    </br>
    
    <label for="firstName">Last Name</label>
    <input id="lastName" type="text" name="lastName" value="" />
    </br>
    
    <input type="submit" value="Go" name="Submit" />
    
    
    
    
    
</form>
    </body>
</html>
