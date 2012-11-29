<?php

session_start();

$cartCount = -0; //number of items in cart

if (array_key_exists('cartCount', $_SESSION)){
    
    $cartCount = $_SESSION ['cartCount'];
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
      
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cheese Shop</title>
        
        
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      
    
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
   
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
      
      
      

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="items.php">Cheese Shop</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="items.php">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><?php
        
        print $cartCount;
        
        ?>
        items in your 
        
        <a href="shoppingCart.php">Shopping Cart</a></li>
              
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
        
        
        
        

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Cheese Lovers Rejoice!</h1>
        <p>At last there is a place to delight all your cheese needs, from Alderwood to Yarg.  </p>
        <p><a href="customerDetails.php"class="btn btn-primary btn-large">Join Today &raquo;</a></p>
        
        
        
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Taste the difference</h2>
          <p>With our mouth watering mouldy cheese, you can really
          give your taste buds a workout. We really emphasis the vain in our 
          blue vein cheese and put the goud in Gouda. 
          will make  </p>
          
        </div>
        <div class="span4">
          <h2>Explore</h2>
          <p>Can't afford a trip to Paris? Neither can we! So, do what we
          do, buy every cheese you can afford, a beret and curse the price
          of traveling.
           </p>
          
       </div>
        <div class="span4">
          <h2>Search</h2>
          <form action ="searchResults.php" method="get">
            <input type="search" name="q" placeholder="Search for Cheese"/>
                <input type="submit" a class="btn"name="search" value="Search!" />
        </form>
          
        </div>
      </div>

      <hr>

      <footer>
        <p><!--&copy;-->  Don't read this check out our cheese!</p>
      </footer>

    </div> <!-- /container -->

   
        
       

       
<table>
<tr>
    
    <th>item name</th>
    <th>item desciption</th>
    <th>unit price</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>


<?php
require_once 'dbfunctions.php';



$conn = openCheeseDb(); //from dbfunctions.php

$result = mysqli_query($conn, 'SELECT id, item_name, item_desciption, unit_price, picture_file_name FROM items');
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    $itemID = $row['id'];
    
    
    echo '<td>' . $row['item_name'] . '</td>';
    echo '<td>' . $row['item_desciption'] . '</td>';
    echo '<td>' . $row['unit_price'] . '</td>';
    echo '<td><img src="Shopping_Cart/thumbnails/' . $row['picture_file_name'] . '"/></td>';
    ?>
    <td>
<form action="addItemToCart.php" method="post">
    <input type="hidden" name="itemID" value="<?php echo $itemID; ?>" />
    <input type="submit" name="addItem" value="Add" />
</form>
    </td>       

<?php
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';

mysqli_close($conn);     
       
        
        
        ?>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap-transition.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>
    <script src="bootstrap/js/bootstrap-modal.js"></script>
    <script src="bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/js/bootstrap-tab.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/bootstrap-popover.js"></script>
    <script src="bootstrap/js/bootstrap-button.js"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
    </body>
</html>
