<?php
$servername = "us-cdbr-east-04.cleardb.com";
$username = "b4e6a75bb6dd28";
$password = "3d694d39";
$dbname = "heroku_3df9fcaa3b2ac78";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}

?>