<?php
include("dataconnection2.php");

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    mysqli_query($connect, "DELETE FROM admin WHERE username='$username'");
    header("location:adminmanagement.php");
    exit();
}
?>