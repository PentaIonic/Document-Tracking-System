<?php

$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "doctrax";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_error()) {
    die("Connection failed: " . $conn->$connect_error());
}

?>
