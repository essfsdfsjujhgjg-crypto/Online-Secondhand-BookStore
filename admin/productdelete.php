<?php
include("dataconnection2.php");

if (isset($_GET['Product_ID'])) {
    $Product_ID = $_GET['Product_ID'];
    mysqli_query($connect, "DELETE FROM product WHERE Product_ID='$Product_ID'");
    header("location:productmanagement.php");
    exit();
}
?>
