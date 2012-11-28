<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
     <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
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
              <li><a href="">About</a></li>
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
        
        <div class="jumbotron"><h1>Search Results</h1>
            <h2></h2>
        


        <?php
        if (array_key_exists('q', $_GET)) {


            $conn = mysqli_connect('localhost', 'root', '', 'cheese_shop', '3306');
            if (!$conn) {
                die('Could not connect to MySQL: ' . mysqli_connect_error());
            }
            mysqli_query($conn, 'SET NAMES \'utf8\'');

            echo '<table>';
            echo '<tr>';
            echo '<th>item_name</th>';
            echo '<th>unit_price</th>';
            echo '<th> </th>';
            echo '</tr>';
      $query = "SELECT item_id, item_name, unit_price, picture_file_name
                FROM items
                    WHERE item_name
                        LIKE '% cheese %'
        
                OR item_description
                        LIKE '%  cheese %'

                    ";

            $result = mysqli_query($conn, $query);


            while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) 
                
                {
                echo '<tr>';

                echo '<td>' . $row['item_name'] . '</td>';


                echo '<td>' . $row['unit_price'] . '</td>';
                echo '<td>' . $row['picture_file_name'] . '</td>';
                echo '</tr>';
            }
        } else {

            print "No results available";
        }
        ?>






        <!-- google code-->
    </body>
</html>