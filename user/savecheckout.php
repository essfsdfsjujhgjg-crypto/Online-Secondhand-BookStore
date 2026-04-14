<?php include("phpconnect.php"); session_start();?>


<?php
    // 从POST请求获取数据
    $customerID = $_SESSION["user_id"];
    $currentdate = date("Y-m-d");
    $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM cart WHERE Customer_ID = $customerID AND Is_Purchased = 0"));
    $orderID = $row["Order_ID"];

    // 解码URL编码的数据
    $decodedPurchaseditems_id = urldecode($_POST["Id"]);
    $decodedPurchaseditems_name = urldecode($_POST["Itemname"]);
    $decodedPurchaseditems_price = urldecode($_POST["Itemprice"]);
    $decodedPurchaseditems_quantity = urldecode($_POST["Itemquantity"]);
    $decodedPurchaseditems_total = urldecode($_POST["Itemtotal"]);
    $decodedPayment_id = urldecode($_POST["PaymentId"]);
    $decodedPayee_name = urldecode($_POST["PayeeName"]);
    $decodedPayee_email = urldecode($_POST["PayeeEmail"]);
    $decodedPayee_address = urldecode($_POST["PayeeAddress"]);
    $decodedPayee_status = urldecode($_POST["PayeeStatus"]);

    // 解码JSON字符串以获取原始数组
    $Purchaseditems_id_array = json_decode($decodedPurchaseditems_id);
    $Purchaseditems_name_array = json_decode($decodedPurchaseditems_name);
    $Purchaseditems_price_array = json_decode($decodedPurchaseditems_price);
    $Purchaseditems_quantity_array = json_decode($decodedPurchaseditems_quantity);
    $Purchaseditems_total_array = json_decode($decodedPurchaseditems_total);

    $Purchaseditems_total = 0;

    // Update 'isPurchased' column in cart table
    if(!empty($Purchaseditems_id_array)){
        for($i=0; $i<count($Purchaseditems_id_array); $i++){
            // Update the isDeleted flag in the database
            $Purchaseditems_total += $Purchaseditems_total_array[$i];
            $updateProductStatus = "UPDATE cart SET Is_Purchased = 1 WHERE Product_id = $Purchaseditems_id_array[$i] AND Customer_ID = $customerID";
            mysqli_query($connect, $updateProductStatus);
            mysqli_query($connect, "UPDATE product SET Product_Stock = Product_Stock - $Purchaseditems_quantity_array[$i] WHERE Product_ID = $Purchaseditems_id_array[$i]");
        }
        mysqli_query($connect, "INSERT INTO savepayment (Payment_ID, Payee_Name, Payee_Email, Payee_ShippingAddress, Payment_Status) VALUES ('$decodedPayment_id', '$decodedPayee_name'
        , '$decodedPayee_email', '$decodedPayee_address', '$decodedPayee_status')");
        mysqli_query($connect, "INSERT INTO c_order (Order_ID, Order_Date, Payment_ID, Amount, Customer_ID, Order_Status) VALUES ('$orderID', '$currentdate', '$decodedPayment_id',
        '$Purchaseditems_total', '$customerID', '$decodedPayee_status')");
    }
    if (mysqli_error($connect)) {
        die('fail' . mysqli_error($connect));
    }
?>
