<?php include("phpconnect.php"); 
session_start();
?>

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Order History</title>

<link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
   
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

<style>

table.center {
  margin-left: auto; 
  margin-right: auto;
}

h1
{
  text-align:center;
}
body
{
	background-color:#d9d9d9;
}

#pro
{
  margin:auto;
  margin-top:100px;
  margin-bottom:100px;
  
}

h1
{
  text-align:center;
}

.line
{
  border:1px solid green;
  background-color:black;
  background-repeat:repeat;
}
</style>
</head>
<body>
    <!-- Start Top Nav -->
    <?php include_once("topnav.php"); ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include_once("header.php"); ?>
    <!-- Close Header -->

<div class="container py-3">
			
			<?php
			$itemno = 0;
			$customerID = $_SESSION["user_id"];
			$orderid = $_GET["orderid"];
			$result_find_cart = mysqli_query($connect, 
			"SELECT cart.*, savepayment.* , c_order.*
			FROM cart INNER JOIN c_order ON cart.Order_ID = c_order.Order_ID 
			INNER JOIN savepayment ON c_order.Payment_ID = savepayment.Payment_ID
			WHERE cart.Customer_ID = $customerID AND cart.Order_ID = $orderid 
			AND Is_Purchased = 1");
			$count = mysqli_num_rows($result_find_cart);

			if ($count < 1)
			{
			?>
				<tr>
					<td colspan="6">No Records Found</td>
				</tr>
			
			<?php
			}
			else
			{
			?>
<div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Payee Name: </td>
                        <td><span class="payee_information" id="payee_username">
							
						</span></td>
                    </tr>
                    <tr>
                        <td>Paid Amount: </td>
                        <td>RM <span class="payee_information" id="paid_amount"></span></td>
                    </tr>
                    <tr>
                        <td>Payee Email Address:</td>
                        <td><span class="payee_information" id="payee_email"></span></td>
                    </tr>
                    <tr>
                        <td>Payee Shipping Address:</td>
                        <td><span class="payee_information" id="payee_address"></span></td>
                    </tr>
                    <tr>
                        <td>Payment ID</td>
                        <td><span class="payee_information" id="Payment_ID"></span></td>
                    </tr>
                </table>
            </div>


			<div class="col-md-6">
            <div id="checkout_button"></div>
            </div>
            <div class="row">
                <table class="table">

                    <tr>
                        <td style="font-weight:bold">ITEM No</td>
                        <td>Item name:</td>
                        <td>Item price:</td>
                        <td>Item quantity:</td>
                        <td>Total price:</td>
                    </tr>
                    <?php

                    while ($row_cart = mysqli_fetch_assoc($result_find_cart)){
                        $product_id = $row_cart['Product_id'];
                        $product = "SELECT * FROM product WHERE Product_ID='$product_id'";
                        $result_product = mysqli_query($connect, $product);
                        $row_product = mysqli_fetch_assoc($result_product);
                        $itemno +=1;
                    ?>
                        <tr>
                            <td class="itemID" data-value="<?php echo $row_product["Product_ID"];?>"><?php echo $itemno ?></td>
                            <td class="itemname" data-value="<?php echo $row_product["Product_Name"];?>"><?php echo $row_product["Product_Name"]; ?></td>
                            <td class="itemprice" data-value="<?php echo $row_cart["Price"];?>">RM <?php echo number_format($row_cart["Price"],2); ?></td>
                            <td class="itemquantity" data-value="<?php echo $row_cart["Quantity"];?>"><?php echo $row_cart["Quantity"]; ?></td>
                            <td class="itemtotal" data-value="<?php echo number_format($row_cart["Quantity"] * $row_cart["Price"], 2);?>">RM <?php echo number_format($row_cart["Quantity"] * $row_cart["Price"], 2);?></td>
                        </tr>
					<script>
					
					document.getElementById("payee_username").innerHTML = '<?php echo $row_cart["Payee_Name"] ?>';
					document.getElementById("paid_amount").innerHTML = '<?php echo number_format($row_cart["Amount"], 2);?>';
					document.getElementById("payee_email").innerHTML = '<?php echo $row_cart["Payee_Email"] ?>';
					document.getElementById("payee_address").innerHTML = '<?php echo $row_cart["Payee_ShippingAddress"] ?>';
					document.getElementById("Payment_ID").innerHTML = '<?php echo $row_cart["Payment_ID"] ?>';
					</script>
                    <?php

                    }
                    ?>


                </table>
            </div>
        </div>
		<?php
			} ?>
</div>
<?php include("footer.php") ?>
</body>
</html>
