<?php
include("dataconnection2.php");

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    mysqli_query($connect, "DELETE FROM superadmin WHERE username='$username'");
    header("location:superadminform.php");
    exit();
}
?>