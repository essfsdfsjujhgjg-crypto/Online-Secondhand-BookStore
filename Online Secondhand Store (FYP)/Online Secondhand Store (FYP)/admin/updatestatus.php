<?php
include("dataconnection2.php");

$productID = isset($_GET['Product_ID']) ? mysqli_real_escape_string($connect, $_GET['Product_ID']) : '';
$status = isset($_GET['Status']) ? mysqli_real_escape_string($connect, $_GET['Status']) : '';

$query = "UPDATE product SET Status = '$status' WHERE Product_ID = '$productID'";
mysqli_query($connect, $query);

mysqli_close($connect);
?>