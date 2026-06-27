<?php include("phpconnect.php"); session_start();?>


<?php
    $customerID = $_SESSION["user_id"];
    $cart = "SELECT * FROM cart WHERE Customer_ID = $customerID AND Is_Purchased = 0";
    $result_cart = mysqli_query($connect, $cart);
    $num_cart = mysqli_num_rows($result_cart);
    $exceedqtyproduct = [];
    while ($row_cart = mysqli_fetch_assoc($result_cart)) {
        if($row_cart['Is_Purchased'] == 0 && $row_cart['Customer_ID'] == $customerID){
            $product_id = $row_cart['Product_id'];
            $product = "SELECT * FROM product WHERE Product_ID='$product_id'";
            $result_product = mysqli_query($connect, $product);
            $num_product = mysqli_num_rows($result_product);
            $row_product = mysqli_fetch_assoc($result_product);
            if(isset($_POST['proceed_payment']) && $_POST['proceed_payment']==1){
                if($row_product['Product_Stock'] < $row_cart['Quantity']){
                    $exceedqtyproduct[] = $row_product["Product_Name"];
                    $stockqty = $row_product["Product_Stock"];
                    mysqli_query($connect, "UPDATE cart SET Quantity = $stockqty WHERE Product_id = $product_id AND Is_Purchased = 0 AND Customer_ID = $customerID");
                }
            }
            else{
                if($row_product['Product_Stock'] <= $row_cart['Quantity']){
                    $exceedqtyproduct[] = $row_product["Product_Name"];
                    $stockqty = $row_product["Product_Stock"];
                    mysqli_query($connect, "UPDATE cart SET Quantity = $stockqty WHERE Product_id = $product_id AND Is_Purchased = 0 AND Customer_ID = $customerID");
                }
            }
        }
    }
    echo json_encode($exceedqtyproduct);
?>
