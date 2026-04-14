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



    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/comic banner.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>OSS</b> Online Secondhand     Store</h1>
                                <h3 class="h2">Our Purpose</h3>
                                <p>
                                We aim to foster a love for reading by providing a seamless and enjoyable online shopping experience, catering to diverse literary tastes while promoting knowledge, imagination, and lifelong learning.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/novel banner.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-success">Our Positioning</h1>
                                
                                <p>
                                we stand as your trusted gateway to a world of stories, offering an extensive range of carefully selected books tailored to suit every reader's unique journey. With a commitment to quality, convenience, and personalized service, we strive to be the premier destination for book enthusiasts seeking their next literary treasure.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/sc banner.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-success">Our Personality</h1>
                                
                                <p>
                                our personality embodies a delightful blend of literary passion, warmth, and expertise. We aim to be approachable, knowledgeable, and enthusiastic, creating a welcoming space where book lovers of all kinds can explore, discover, and indulge in their reading adventures with ease.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories</h1>
                <p>
                   
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shoppingcart.php"><img src="./assets/img/comic logo.jpg"class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Comics</h5>
             
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shoppingcart1.php"><img src="./assets/img/novel logo.png" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Novels</h2>
                
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shoppingcart2.php"><img src="./assets/img/sc logo.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Science Fiction</h2>
               
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    
    <!-- End Featured Product -->


<?php include("footer.php") ?>
</body>

</html>