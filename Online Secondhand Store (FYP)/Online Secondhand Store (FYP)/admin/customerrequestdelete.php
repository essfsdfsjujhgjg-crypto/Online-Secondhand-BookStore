<?php
include("dataconnection2.php");

if (isset($_GET ['Product_ID'])) {
    $Product_ID= $_GET['Product_ID'];
    mysqli_query($connect, "DELETE FROM request WHERE Product_ID='$Product_ID'");
    header("location:viewrequest.php");
    exit();
}
?>

