<?php
session_start();
include("phpconnect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Secondhand Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta charset="UTF-8">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <link rel="stylesheet" href="assets/css/custom.css">

	<!-- Sweetalert CDN-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<!--
		
	TemplateMo 559 Zay Shop

	https://templatemo.com/tm-559-zay-shop

	-->

</head>

<body>
    
    <!-- Start Top Nav -->
    <?php include_once("topnav.php"); ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include_once("header.php"); ?>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- End Categories of The Month -->
<?php 
// if(isset($_POST['add_to_cart'])) {
//     $customer_ID = $_SESSION['user_id']; // 使用登录用户的 ID，确保你已在其他地方设置了该值
//     $Product_ID = $_GET["id"];
//     $Product_Quantity = $_POST["quantity"];
//     $Product_Price = $_POST["hidden_price"];
//     $Product_Total = $Product_Quantity * $Product_Price; // 计算总价

//     $insert_products = mysqli_query($connect, "INSERT INTO `cart` (Customer_ID, Product_id, Quantity, Price, Total) VALUES ('$customer_ID', '$Product_ID', '$Product_Quantity', '$Product_Price', '$Product_Total')");
// }
if(isset($_POST['add_to_cart']))
{
	if(isset($_SESSION['login_user']))
	{
	$id = $_GET["id"];
	$check = mysqli_query($connect, "SELECT * FROM product WHERE Product_ID = '$id'");
	$checkstock = mysqli_fetch_assoc($check);
	$stock = $checkstock["Product_Stock"];

		if($stock<$_POST["quantity"] && $stock!=0)
		{
?>
		<script>
		alert("Sorry, your order quantity is more than the stock we have!");
		</script>
<?php
		}
		else if($stock==0)
		{
?>
		<script>
		alert("Sorry, this product is out of stock!");
		</script>
<?php
    	} else {

        $customer_ID = $_SESSION["user_id"];
        $Product_ID = $_GET["id"];
        $Product_Quantity = $_POST["quantity"];
        $Product_Price = $_POST["hidden_price"];
        $Product_Total = $Product_Quantity * $Product_Price;
		$findorderID = mysqli_query($connect, "SELECT * FROM cart WHERE Customer_ID = $customer_ID AND Is_Purchased = 0 ORDER BY order_ID DESC LIMIT 1");
		$row = mysqli_fetch_assoc($findorderID);
		if(mysqli_num_rows($findorderID) == 0){
			$neworderID = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM cart ORDER BY order_ID DESC LIMIT 1"));
			$orderID = $neworderID["Order_ID"] + 1;
		}
		else{
			$orderID = $row["Order_ID"];
		}
        $checkcart = mysqli_query($connect, "SELECT * FROM cart WHERE Customer_ID = $customer_ID AND Product_id = $Product_ID AND Is_Purchased = 0");
        $checkcart_num_rows = mysqli_num_rows($checkcart);

		if($checkcart_num_rows==0)
		{
			echo '<script>console.log("running 1")</script>';
			mysqli_query($connect, "INSERT INTO `cart` (Order_ID, Customer_ID, Product_id, Quantity, Price, Total) VALUES ('$orderID', '$customer_ID', '$Product_ID', '$Product_Quantity', '$Product_Price', '$Product_Total')");
		?>
		<?php
		} else {
			echo '<script>console.log("running 2")</script>';
			mysqli_query($connect, "UPDATE cart SET Quantity = Quantity + $Product_Quantity WHERE Customer_ID = $customer_ID AND Product_id = $Product_ID");
		}
		?>
    <script>
        swal.fire({
            title: "Success",
            text: "Item added to your cart",
            icon:"success"
        }).then(() => {
			window.location.assign("shoppingcart.php");
		})
    </script>

    <?php
	// if(isset($_SESSION["shopping_cart"]))
	// {
    //     var_dump($_SESSION["shopping_cart"]);
	// 	$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
	// 	if(!in_array($_GET["id"], $item_array_id))
	// 	{
	// 		$count = count($_SESSION["shopping_cart"]);
	// 		$item_array = array(
	// 			'item_id'			=>	$_GET["id"],
	// 			'item_name'			=>	$_POST["hidden_name"],
	// 			'item_price'		=>	$_POST["hidden_price"],
	// 			'item_quantity'		=>	$_POST["quantity"]
	// 		);
	// 		$_SESSION["shopping_cart"][$count] = $item_array;
	// 		// echo '<script>window.location="vieworder.php"</script>';
	// 	}
	// 	else
	// 	{
	// 		// echo '<script>alert("Item Already Added")</script>';
	// 	}
	// }
	// else
	// {
	// 	$item_array = array(
	// 		'item_id'			=>	$_GET["id"],
	// 		'item_name'			=>	$_POST["hidden_name"],
	// 		'item_price'		=>	$_POST["hidden_price"],
	// 		'item_quantity'		=>	$_POST["quantity"]
	// 	);
	// 	$_SESSION["shopping_cart"][0] = $item_array;
	// }
	}
	} else {
			?>
			<script type="text/javascript">
			alert("You must login first to buy your product.");
            window.location = 'login.php';
			</script>
			<?php
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="vieworder.php"</script>';
			}
		}
	}
}

?>

		<div class="container pt-3">
				<?php
				$sql="select * from product where product_isDelete=0";
				if(isset($_POST['search'])){
					$searchKey = $_POST['search'];
					$sql= "select * from product where product_isDelete=0 AND Product_Name LIKE '%$searchKey%'";

				} 

				if(isset($_GET['catid'])){
					$catid = $_GET['catid'];
					 $sql= "select * from product where product_isDelete=0 AND ProductCategory_ID = $catid";
				}

				$result = mysqli_query($connect,$sql);
				?>
				<div class="d-flex flex-row">
				<form action="" method="POST" > 
					<div class="input-group mx-sm-3 mb-2">
						<input type="text" name="search" class='form-control' placeholder="Search By Name" value="" > 
						<div class="input-group-append">
						<button class="btn btn-outline-secondary">
							<i class="fas fa-search"></i> Search
						</button>
						</div>
					</div>
				</form>
				</div>


			<h3 align="center">
            <?php

			if(isset($_GET['catid'])){
				$catid = $_GET['catid'];
				$sqlcat="select Category_Name from category where Category_ID = '$catid'";
				$resultcat = mysqli_query($connect,$sqlcat);
				$rowcat = mysqli_fetch_array($resultcat);
				 echo $rowcat['Category_Name']; 
			}

            ?>
            </h3>
		</div>

		<div class="container">
			<div class="d-flex flex-row flex-wrap justify-content-center">
			<?php
				
				$count=1;
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>

				<div class="card p-3 m-3" style="width: 250px;">
					<form method="post" id="shopform" action="shoppingcart.php?action=add&id=<?php echo $row["Product_ID"]; ?>">

						<img class="card-img-top" src="../user/assets/img/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
						<div class="card-body">
						<h4 class="card-title"><?php echo $row["Product_Name"]; ?></h4>

						<h4 class="text-danger">RM <?php echo $row["Product_Price"]; ?>
						</h4>
						<p class="card-text"><?php echo $row["Product_Description"]; ?>
						</p>
						<p style="font-family:verdana">Stock = <?php echo $row["Product_Stock"]; ?>

						<input type="hidden" name="hidden_name" value="<?php echo $row["Product_Name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["Product_Price"]; ?>" />
						<input type="hidden" id="<?php echo $count; ?>" name="hidden_stock" 
						value="<?php echo $row["Product_Stock"]; ?>" />
						<div class="input-group">
						<input type="number" name="quantity" value="1"  min="1" class="form-control" />
						</div>
						<div class="input-group-append">
						<input type="submit" id="add_to_cart" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"/>
						</div>
					</div>
					</form>
				</div>
			<?php
						$count++;
					}
			?>
		<div>
	<div>
			<?php
				} else {
					echo "product not found";
				}
			?>
</div>
			</div>
			</div>
			</div>
    <!-- Start Featured Product -->
    
    <!-- End Featured Product -->


<?php include("footer.php") ?>
</body>

</html>