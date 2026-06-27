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
			$customerID = $_SESSION["user_id"];
			$result = mysqli_query($connect, 
			"SELECT c_order.*,  savepayment.*
			FROM c_order INNER JOIN cart ON c_order.Order_ID = cart.Order_ID 
            INNER JOIN savepayment ON c_order.Payment_ID = savepayment.Payment_ID
            WHERE cart.Customer_ID=$customerID AND Is_Purchased = 1 
			GROUP by cart.Order_ID");
			$count = mysqli_num_rows($result);
			
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
				<table border="1" width="650px" class="table table-striped" id="pro" style="width:90%; text-align:center;">
			<tr>
				<th style="width:10%">Order ID</th>
				<th style="width:10%">Order Date</th>							
				<th style="width:15%">Payee Name</th>
				<th style="width:10%">Paid Amount</th>
				<!-- <th>Item Price</th>
				<th>Item Quantity</th> -->
				<th style="width:10%">Order Status</th>
			</tr>
			<?php
				while($row = mysqli_fetch_assoc($result))
				{
			?>			

				<tr>
					<td style="padding:10px;"><?php echo $row["Order_ID"]; ?></td>
					<td style="padding:10px;"><a href="orderdetails.php?orderid=<?php echo $row["Order_ID"]; ?>" target="_blank">
						<?php echo $row["Order_Date"]; ?></a></td>
					<td style="padding:10px;"><?php echo $row["Payee_Name"]; ?></td>
					<td style="padding:10px;"><?php echo "RM " . number_format($row["Amount"],2); ?></td>
					<td style="padding:10px;"><?php echo $row["Order_Status"]; ?></td>
				</tr>
				
			<?php
				
				}
			}
			
			?>

		</table>
		
</div>
<?php include("footer.php") ?>
</body>
</html>
