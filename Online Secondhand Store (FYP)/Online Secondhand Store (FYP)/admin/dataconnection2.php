<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oss";


$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>





