<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Name Forms</title>
        <style type="text/css">
           
            html, body {
                background-color:#ff9966;
                text-align: center;
               font-family: sans-serif;
            }
            
            label {
                color:#660000;
                font-weight:bold;
                font-size: 2em;
            }
            
             .welcome {
                font-size: 3em;
            }
            
            form {
                

                width: 50%;
                margin-left: auto;
                margin-right: auto;
                 
            }
            button {
                font-size: 3em;
            }
            
        </style>    
    </head>
    <body>
        <?php
        // put your code here
        
        if (empty($_POST)){
            print "Please tell me your name.<br\>";
                  
        } else {
            print "Welcome, ". $_POST['firstName'] ." ". $_POST['lastName'] ;
               
        }
        print "<br/> Items in the \$_POST array are:<br/>";
        foreach($_POST as $key => $value) {
            print "$key : $value <br/>";
        }
        

        ?>
        
        <form action="formEg2.php" method="POST">
    <label for="firstName">First Name</label>
    <input id="firstName" type="text" name="firstName" value="" />
    </br>
    
    <label for="firstName">Last Name</label>
    <input id="lastName" type="text" name="lastName" value="" />
    </br>
    <select name="title">
        <option value="mr">Mister</option>
        <option value="miss">Miss</option>
    </select>
 
    
    
    <select name="Age">
        <option value="young">0-15yrs</option>
        <option value="middle">16-50yrs</option>
        <option value="retired">51-120yrs</option>
    </select>
      <select>
          <option value="Rock">Rock and Roll</option>
        <input type="radio" name="Favourite Music" value="Rock" />
    </select>
    <br/>
   <span class="button"><input type="submit" value="Go" name="Submit" />
   </span>
</form>
    </body>
</html>
