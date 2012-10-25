
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
        require_once("Includes/db.php");

        $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_GET["user"]);
if (!$wisherID) {
    exit("The person " .$_GET["user"]. " is not found. Please check the spelling and try again" );
}
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
            
          $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
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
