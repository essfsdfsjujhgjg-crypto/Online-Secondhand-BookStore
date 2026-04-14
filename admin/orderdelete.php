<?php
include("dataconnection2.php");

if (isset($_GET['Order_ID'])) {
    $Order_ID = $_GET['Order_ID'];
    mysqli_query($connect, "DELETE FROM c_order WHERE Order_ID='$Order_ID'");
    header("location:ordermanagement.php");
    exit();
}
?>