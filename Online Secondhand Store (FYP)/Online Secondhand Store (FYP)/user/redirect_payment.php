<?php session_start(); ?>
<?php
    #store all the data to database
    $_SESSION["temp_name"] = $_GET["username"];
?>
<script>window.location.assign("vieworder.php");</script>