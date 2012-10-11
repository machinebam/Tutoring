
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Looney Addresses</title>

        <style type="text/css">

            html body {

                text-align: center;
                color: midnightblue;
                font-family: Georgia;
                background-color: aliceblue;
            }

            table {

                border: thin solid black;

            }


        </style>
    </head>
    <body>
        <?php
        $customerID = $_GET['customerID'];

$conn = mysqli_connect('localhost', 'root', '', 'customers', '3307');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');
echo '<table>';
echo '<tr>';
echo '<th>First Name</th>';
echo '<th>Street</th>';
echo '<th>Town</th>';
echo '<th>Postcode</th>';
echo '<th>State</th>';
echo '<th>Country</th>';
echo '<th>Address Type</th>';
echo '</tr>';
$selectStatement = "SELECT customers.`FIRSTNAME`,
`STREET`, 
`TOWN`, 
`POSTCODE`, 
`STATE`, 
`COUNTRY`, 
`TYPE` 
FROM addresses
    INNER JOIN customers 
        ON addresses.`CUSTOMER_ID` = customers.id
WHERE `CUSTOMER_ID` = $customerID";

$result = mysqli_query($conn, $selectStatement);
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    echo '<td>' . $row['FIRSTNAME'] . '</td>';
    echo '<td>' . $row['STREET'] . '</td>';
    echo '<td>' . $row['TOWN'] . '</td>';
    echo '<td>' . $row['POSTCODE'] . '</td>';
    echo '<td>' . $row['STATE'] . '</td>';
    echo '<td>' . $row['COUNTRY'] . '</td>';
    echo '<td>' . $row['TYPE'] . '</td>';
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';
mysqli_close($conn);
        ?>
    </body>
</html>

