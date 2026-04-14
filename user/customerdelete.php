<?php
include("dataconnection2.php");

if (isset($_GET['Customer_Name'])) {
    $Customer_Name = $_GET['Customer_Name'];
    mysqli_query($connect, "DELETE FROM customer WHERE Customer_Name='$Customer_Name'");
    header("location:customermanagement.php");
    exit();
}
?>