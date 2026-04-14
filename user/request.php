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

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
	
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
    </html>
<?php

    $msg = "";

    if (isset($_POST['submit'])) {
        $Email = mysqli_real_escape_string($connect, $_POST['Email']); 
        $Phone = mysqli_real_escape_string($connect, $_POST['PhoneNo']); 
        $productImage = mysqli_real_escape_string($connect, $_FILES['productImage']['name']); 
        $productName = mysqli_real_escape_string($connect, $_POST['productName']);
        $productcategory = mysqli_real_escape_string($connect, $_POST['category']);
        $productPrice = mysqli_real_escape_string($connect, $_POST['productPrice']);
        $productDescription = mysqli_real_escape_string($connect, $_POST['productDescription']);
        $productQuantity = mysqli_real_escape_string($connect, $_POST['productQuantity']);

    
        $targetDir = "assets/img/";
        $targetFile = $targetDir . basename($_FILES['productImage']['name']);
        move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile);

        $sqlproduct = "INSERT INTO Product (Product_Name, image, ProductCategory_ID, Product_Description, Product_Price, Product_Stock)
        VALUES ( '$productName', '$productImage', $productcategory, '$productDescription', '$productPrice', '$productQuantity')";

        if (mysqli_query($connect, $sqlproduct)) {
            $product_id = mysqli_insert_id($connect);
        } else {
            $msg = "Failed to request to add the product";
        }

        $sqlrequest = "INSERT INTO request (Customer_ID, Product_ID, Email, Phone_No)
        VALUES ($_SESSION[user_id], $product_id, '$Email', '$Phone')";

        if (mysqli_query($connect, $sqlrequest)) {
            $msg = "Product Request Successfully";
        } else {
            $msg = "Failed to request to add the product";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <?php
    $sqlcustomer="select * from customer where Customer_ID='$_SESSION[user_id]'";
    $qrycustomer=mysqli_query($connect,$sqlcustomer);
    $rowcustomer=mysqli_fetch_assoc($qrycustomer);
    ?>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-light mt-5 rounded">
                <h2 class="text-center p-2 text-success">Add Product Information</h2>

                <form action="" method="post" class="p-2" enctype="multipart/form-data" id="form-box">

                    <div class="form-group">
                        <input type="text" name="Email" class="form-control" placeholder="Email" value="<?php echo $rowcustomer['Customer_Email']; ?>"
                        required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="PhoneNo" class="form-control" placeholder="Phone No" value="<?php echo $rowcustomer['Customer_Phone_No']; ?>"	 required>
                    </div>
    
                    <div class="form-group">
                        <input type="text" name="productName" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">

                    <select class="form-control" id="category" name="category">
                        <option>Select a category </option>
                    <?php
                        $sqlcategory="select * from category";
                        $qrycategory=mysqli_query($connect,$sqlcategory);

                        while($rowcategory = mysqli_fetch_assoc($qrycategory)) {
                    ?>
                        <option value="<?php echo $rowcategory['Category_ID'] ?>"><?php echo $rowcategory['Category_Name'] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productPrice" class="form-control" placeholder="Product Price" required>
                    </div>
        
                    <div class="form-group">
                        <input type="text" name="productDescription" class="form-control" placeholder="Product Description" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productQuantity" class="form-control" placeholder="Product Quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image:</label>
                        <div class="custom-file">
                            <input type="file" name="productImage" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose Product Image</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-success btn-block" value="Request to add product">
                    </div>
                    <div class="form-group">
                        <h4 class="text-center text-success"><?= $msg; ?></h4>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3 bg-light rounded">
                <a href="index.php" class="btn btn-success btn-block btn-lg">Go to main page</a>
            </div>
        </div>
    </div>
</body>

</html>
    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Follow Us</h1>
                    
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 1.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 2.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 3.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 5.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 1.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 2.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 3.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 5.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 1.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 2.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 3.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand 5.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->
    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">OSS</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">018-3560621</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">onlinesecondhandstore@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="shoppingcart.php">Comic</a></li>
                        <li><a class="text-decoration-none" href="shoppingcart1.php">Novel</a></li>
                        <li><a class="text-decoration-none" href="shoppingcart2.php">Science Fiction</a></li>
                        
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="index.php">Home</a></li>
                        <li><a class="text-decoration-none" href="about.php">About Us</a></li>                   
                        <li><a class="text-decoration-none" href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a rel="nofollow" class="text-light text-decoration-none" target="_blank" href="http://fb.com/templatemo"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Company Name 
                            | Designed by <a rel="sponsored" href="https://templatemo.com/page/1" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

