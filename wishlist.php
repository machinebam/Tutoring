
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Wishlist</title>
    </head>
    <body>

        Wish List of <?php
//wishlist owner

echo htmlentities($_GET["user"]) . "<br/>";
?>

        <?php
        //open connection to data base

        $con = mysqli_connect("localhost", "phpuser", "phpuserpw");

        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }

        //set the default client character set 

        mysqli_set_charset($con, 'utf-8');


        //Retrieve ID of the wisher whose wish list was requested. 
        //If the wisher is not in the database, 
        //code kills/exits the process and displays an error message.

        mysqli_select_db($con, "wishlist");

        $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));

        $wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");

        if (mysqli_num_rows($wisher) < 1) {
            exit("The person " . htmlentities($_GET["user"]) .
                    " is not found. Please check the spelling and try again.");
        }
        $row = mysqli_fetch_row($wisher);
        $wisherID = $row[0];
        mysqli_free_result($wisher);
        ?>

        <!-- Displaying Table of Wishes-->

        <table border="black">
            <tr>
                <th>Item</th>
                <th>Due Date</th>
            </tr>

            <?php
            //retreive wishes, due date using SELECT query
            // stores wishes and due date in an array $result
            //loop displays the items of the $result array as rows in the table while the array is not empty.
            //htmlentitie help prevent cross site scripting
            //Functions at the end free all resources(mysqli results and OCI8 statements) and close the database connection
            
            $result = mysqli_query($con, "SELECT description, 
                     due_date FROM wishes WHERE wisher_id=" . $wisherID);
            while ($row = mysqli_fetch_array($result)) {
                print "<tr><td>" . htmlentities($row["description"]) . "</td>";
                print "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
            }
            mysqli_free_result($result);
            mysqli_close($con);
            ?>
        </table>
    </body>
</html>
