<?php include("phpconnect.php"); session_start();?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    // 从POST请求获取数据
    $customerID = $_SESSION["user_id"];
    $productID = $_POST["ProductID"];

    // Delete specific product from cart
    if(isset($productID)){
       mysqli_query($connect, "DELETE FROM cart WHERE Product_ID = $productID AND Customer_ID = $customerID");
    }
?>
