<?php

$dbhost = "db.be-mons1.bengt.wasmernet.com:3306";
$dbuser = "f7eedbb474f58000df79fd1d33cc";
$dbpass = "0685f7ee-dbb5-7157-8000-19d4bb55126a";
$dbname = "dbk68QB8CHqkc9J5cG5Rau9o";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_error()) {
    die("Connection failed: " . $conn->$connect_error());
}

?>