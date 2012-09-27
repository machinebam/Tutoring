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
        
       
        
       function displayImage ($img, $alt="Boy With Dolphin", $hight = "148", $wide = "224")
                
                {

 
           
     $displayImage = "<img src=\"$img\"
     height=\"$hight\"
     width=\"$wide\"
     alt=\"$alt\" />";
     
     print "$displayImage";
  
       }     
       
        
        displayImage("http://www.qikr.co/images/img01.jpg");
        displayImage("http://www.qikr.co/images/img01.jpg", "Boy With Dolphin");
        displayImage("http://www.qikr.co/images/img01.jpg", "Boy With Dolphin", 148);
        displayImage("http://www.qikr.co/images/img01.jpg",
                        "Boy With Dolphin",
                        148,
                        224);
        
     
        
        

        
       // print "http://www.qikr.co/images/img01.jpg";
         
        
        
        ?>
        
      
        
    </body>
</html>
