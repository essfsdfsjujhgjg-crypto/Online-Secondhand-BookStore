<?php
include("dataconnection2.php");

if (isset($_GET['Payment_ID'])) {
    $Payment_ID = $_GET['Payment_ID'];
    mysqli_query($connect, "DELETE FROM c_order WHERE Payment_ID='$Payment_ID'");
    header("location:payment.php");
    exit();
}
?>