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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
<style>
.dropbtn {
  background-color: green;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">onlinesecondhandstore@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">018-3560621</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
<?php
			if(isset($_SESSION['login_user'])){
			
		?>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                OSS
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                             <div class="dropdown">
  <button class="dropbtn">Product</button>
  <div class="dropdown-content">
  <?php
			$sql="select Category_Name from category ";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart.php"><?php echo $row['Category_Name']; ?></a>
  <?php
			$sql="select Category_Name from category where category_ID ='2'";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart1.php"><?php echo $row['Category_Name']; ?></a>
  <?php
			$sql="select Category_Name from category where category_ID ='3' ";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart2.php"><?php echo $row['Category_Name']; ?></a>
  </div>
</div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="request.php">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    
                    <a class="nav-icon position-relative text-decoration-none" href="vieworder.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="profile.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->
<?php
			}else{
			?>
			<nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                OSS
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
  <button class="dropbtn">Product</button>
  <div class="dropdown-content">
  <?php
			$sql="select Category_Name from category ";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart.php"><?php echo $row['Category_Name']; ?></a>
  <?php
			$sql="select Category_Name from category where category_ID ='2'";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart1.php"><?php echo $row['Category_Name']; ?></a>
  <?php
			$sql="select Category_Name from category where category_ID ='3' ";
			$q=mysqli_query($connect,$sql);
			$row=mysqli_fetch_assoc($q);
		?>
  <a href="shoppingcart2.php"><?php echo $row['Category_Name']; ?></a>
  </div>
</div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="request.php">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    
                    <a class="nav-icon position-relative text-decoration-none" href="vieworder.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="profile.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
	<?php
			}
			?>
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
if(isset($_POST['add_to_cart'])) {
    $customer_ID = $_SESSION['user_id']; // 使用登录用户的 ID，确保你已在其他地方设置了该值
    $Product_ID = $_GET["id"];
    $Product_Qauantity = $_POST["quantity"];
    $Product_Price = $_POST["hidden_price"];
    $Product_Total = $Product_Qauantity * $Product_Price; // 计算总价

    $insert_products = mysqli_query($connect, "INSERT INTO `cart` (Customer_ID, Product_id, Quantity, Price, Total) VALUES ('$customer_ID', '$Product_ID', '$Product_Qauantity', '$Product_Price', '$Product_Total')");
}
if(isset($_POST["add_to_cart"]))
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
    }
	else
	{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
			echo '<script>window.location="vieworder.php"</script>';
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
	}
	}else{
			?>
			<script type="text/javascript">
			alert("You must login first to buy your product.");
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

		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
				<div class="row">
				<?php
				if(isset($_POST['search'])){
					$searchKey = $_POST['search'];
					$sql="select * from product WHERE Product_Name LIKE '%$searchKey%' AND ProductCategory_ID = '3'";
				}else{
					
				$sql="select * from product where ProductCategory_ID = '3' and product_isDelete=0 ";
				$searchKey = "";
				}
				$result = mysqli_query($connect,$sql);
				?>
				
				
				<form action="" method="POST"> 
					<div class="col-md-6">
						<input type="text" name="search" class='form-control' placeholder="Search By Name" value="" > 
					</div>
					<div class="col-md-6 text-left">
						<button class="btn">Search</button>
					</div>
				</form>

				

	
		
		<div class="container">
			
			<h3 align="center">Science Fiction</h3><br />
			<br /><br />
			<?php
				
				$count=1;
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
			<form method="post" id="shopform" action="shoppingcart.php?action=add&id=<?php echo $row["Product_ID"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px;" align="center">
						<img src="../user/assets/img/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["Product_Name"]; ?></h4>

						<h4 class="text-danger">RM <?php echo $row["Product_Price"]; ?></h4>
						<b><?php echo $row["Product_Description"]; ?>
<p style="font-family:verdana">Stock = <?php echo $row["Product_Stock"]; ?>
						<input type="number" name="quantity" value="1"  min="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["Product_Name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["Product_Price"]; ?>" />
						
						<input type="hidden" id="<?php echo $count; ?>" name="hidden_stock" value="<?php echo $row["Product_Stock"]; ?>" />

						<input type="submit" id="add_to_cart" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"/>
                      
					</div>
					</form>
			</div>
			<?php
						$count++;
					}
				}else{
					echo "product not found";
				}
			?>

    <!-- Start Featured Product -->
    
    <!-- End Featured Product -->


   


    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>