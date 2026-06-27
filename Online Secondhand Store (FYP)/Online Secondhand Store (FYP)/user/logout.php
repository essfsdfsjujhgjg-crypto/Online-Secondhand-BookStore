<?php
session_start();
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header("index.php");
}
session_destroy();
session_unset(); 
header("location:index.php");
?>

