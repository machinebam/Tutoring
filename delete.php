<?php // sqltest.php
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
or die("Unable to select database: " . mysql_error());

if (isset($_POST['author']) &&
isset($_POST['title']) &&
isset($_POST['category']) &&
isset($_POST['year']) &&
isset($_POST['isbn']))
{
$author = get_post('author');
$title = get_post('title');
$category = get_post('category');
$year = get_post('year');
$isbn = get_post('isbn');

if (isset($_POST['delete']) && $isbn != "")
{
$query = "DELETE FROM classics WHERE isbn='$isbn'";

if (!mysql_query($query, $db_server))
echo "DELETE failed: $query<br />" .
mysql_error() . "<br /><br />";
}
else
{
$query = "INSERT INTO classics VALUES" .
"('$author', '$title', '$category', '$year', '$isbn')";

if (!mysql_query($query, $db_server))
echo "INSERT failed: $query<br />" .
mysql_error() . "<br /><br />";
}
}
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
