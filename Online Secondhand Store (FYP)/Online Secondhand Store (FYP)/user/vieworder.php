<?php
session_start();
include("phpconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product</title>

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- <link rel="stylesheet" href="assets/css/custom.css"> -->
    
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
    </html>
    <?php 
include("phpconnect.php");
?>


<?php if(isset($_SESSION['login_user'])) { 
    if(isset($_SESSION["temp_name"])) { ?>
        <script>console.log(<?php echo json_encode($_SESSION["temp_name"]);?>)</script>
    <?php } ?>


    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div style="clear:both"></div>
                    
                    <h3><strong>Shopping Cart</strong></h3>
                    <div class="table-responsive">
                    <?php
$customer_ID = $_SESSION['user_id'];
$cart = "SELECT * FROM cart WHERE Customer_ID = $customer_ID AND Is_Purchased = 0";
$result_cart = mysqli_query($connect, $cart);
$num_cart = mysqli_num_rows($result_cart);

if ($num_cart >= 1) {
    ?>
        <table class="table" id="cart_table">
        <tr>
            <th scope="col">Item Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
            <th scope="col">Action</th>
        </tr>
        <?php
        $total = 0;
        $exceedqtyproduct = [];
        $removedproduct = [];
        while ($row_cart = mysqli_fetch_assoc($result_cart)) {
            if($row_cart['Is_Purchased'] == 0 && $row_cart['Customer_ID'] == $customer_ID){
                $product_id = $row_cart['Product_id'];
                $product = "SELECT * FROM product WHERE Product_ID='$product_id'";
                $result_product = mysqli_query($connect, $product);
                $num_product = mysqli_num_rows($result_product);
                $row_product = mysqli_fetch_assoc($result_product);
                if($row_product["product_isDelete"] == 1){
                    $removedproduct[] = $row_product["Product_Name"];
                    mysqli_query($connect, "DELETE FROM cart WHERE Product_id = $product_id AND Is_Purchased = 0 AND Customer_ID = $customer_ID");
                    continue;
                }
                if($row_product['Product_Stock'] < $row_cart['Quantity']){
                    $exceedqtyproduct[] = $row_product["Product_Name"];
                    $stockqty = $row_product["Product_Stock"];
                    mysqli_query($connect, "UPDATE cart SET Quantity = $stockqty WHERE Product_id = $product_id AND Is_Purchased = 0 AND Customer_ID = $customer_ID");
                    $result_cart = mysqli_query($connect, $cart);
                    continue;
                }
                ?>
                    <tr>
                        <td class="purchaseditem_id" hidden><?php echo $row_product['Product_ID']; ?></td>
                        <td class="purchaseditem_name"><?php echo $row_product["Product_Name"]; ?></td>
                        <td class="purchaseditem_qty">
                            <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(<?php echo $row_product['Product_ID']; ?>, 'decrement')">-</button>
                            <span class="item-quantity" id="itemquantity<?php echo $row_product["Product_ID"]; ?>"><?php echo $row_cart["Quantity"]; ?></span>
                            <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(<?php echo $row_product['Product_ID']; ?>, 'increment')">+</button>
                        </td>
                        <td class="purchaseditem_priceperunit">RM <span id="itemprice<?php echo $row_product["Product_ID"]; ?>"> <?php echo number_format($row_product["Product_Price"], 2); ?></span></td>
                        <td class="purchaseditem_totalprice">RM <span id="totalprice<?php echo $row_product["Product_ID"]; ?>" class="totalprice"> <?php echo number_format($row_cart["Quantity"] * $row_cart["Price"], 2); ?></span></td>
                        <td>
                            <span class="text-danger" id="remove_product_btn" onclick="confirm_remove_product(<?php echo $row_product['Product_ID']; ?>)">
                            <i class="fas fa-trash-alt"></i> Remove
                            </span>
                        </td>
                    </tr>
                    <?php
                    $total = $total + ($row_cart["Quantity"] * $row_cart["Price"]);
                    ?>
                <?php
            }
        }
        if(!empty($exceedqtyproduct) || !empty($removedproduct)){
            if(!empty($exceedqtyproduct) && !empty($removedproduct)){
            ?>
            <script>
                var productsRemoved = <?php echo json_encode($removedproduct); ?>;
                var removedproductHTML = '<p style="font-weight:bold; color:red">These products quantity has been removed due to product is unavailable.</p><ul>';
                productsRemoved.forEach(function(product) {
                    removedproductHTML += '<li>' + product + '</li>';
                });
                removedproductHTML += '</ul>';
                removedproductHTML += '</ul>';
                var productsWithChanges = <?php echo json_encode($exceedqtyproduct); ?>;
                var productListHTML = '<p style="font-weight:bold; color:blue">These products quantity has been adjusted due to insufficient available stock.</p><ul>';
                productsWithChanges.forEach(function(product) {
                    productListHTML += '<li>' + product + '</li>';
                });
                productListHTML += '</ul>';
                productListHTML += '</ul>';
                productListHTML = removedproductHTML + productListHTML;
                document.getElementById("cart_table").style.display = "none";
                swal.fire({
                    title: "Product Availability Changed",
                    html: productListHTML,
                    icon: "info"
                }).then(() => {
                    window.location.assign("vieworder.php");
                })
            </script>
            <?php
            }
            else if(!empty($exceedqtyproduct) && empty($removedproduct)){
            ?>
            <script>
                var productsWithChanges = <?php echo json_encode($exceedqtyproduct); ?>;
                var productListHTML = '<p style="font-weight:bold; color:blue">These products quantity has been adjusted due to insufficient available stock.</p><ul>';
                productsWithChanges.forEach(function(product) {
                    productListHTML += '<li>' + product + '</li>';
                });
                productListHTML += '</ul>';
                productListHTML += '</ul>';
                document.getElementById("cart_table").style.display = "none";
                swal.fire({
                    title: "Product Availability Changed",
                    html: productListHTML,
                    icon: "info"
                }).then(() => {
                    window.location.assign("vieworder.php");
                })
            </script>
            <?php
            }
            else{
            ?>
            <script>
                var productsRemoved = <?php echo json_encode($removedproduct); ?>;
                var removedproductHTML = '<p style="font-weight:bold; color:red">These products quantity has been removed due to product is unavailable.</p><ul>';
                productsRemoved.forEach(function(product) {
                    removedproductHTML += '<li>' + product + '</li>';
                });
                removedproductHTML += '</ul>';
                removedproductHTML += '</ul>';
                document.getElementById("cart_table").style.display = "none";
                swal.fire({
                    title: "Product Availability Changed",
                    html: removedproductHTML,
                    icon: "info"
                }).then(() => {
                    window.location.assign("vieworder.php");
                })
            </script>
            <?php
            }
        }
        ?>
        <tr>
            <td colspan="3" align="right">Total</td>
            <td align="right">RM <span id="grandtotalprice"><?php echo number_format($total, 2); ?></span></td>
            <td></td>
        </tr>
        </table>
    <div class="right">
        <button type="button" name="edit" class="btn btn-success mb-3"  onclick="proceed_payment()">Checkout</button>
    </div>
    <?php
    $_SESSION['totalp'] = $total;
} else {
    ?>
    <p style="font-size:30px; text-align:center;">Your Shopping Cart Is Empty</p>
    <?php
}
?>

                        <a href="shoppingcart.php" class="btn btn-success">Continue Shopping</a>

                    </div>
                </div>
            </div>
            <br />
        </div>
    </section>
</body>
</html>

<script>

function confirm_remove_product(productID){
    swal.fire({
        title: "Remove Item",
        text: "Are you sure to remove this product from your cart? This cannot be UNDO",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
    if (result.isConfirmed) {
        // AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deletecartitem.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the server
        xhr.onload = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                swal.fire({
                    title: "Success",
                    text: "Item removed from your cart",
                    icon:"success"
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.assign("vieworder.php");
                    }
                });
            }
            else{
                swal.fire({
                    title: "Oops",
                    text: "Something went wrong, please try again",
                    icon:"error"
                });
            }
        };
        xhr.send("ProductID=" + encodeURIComponent(productID));
    } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
    ) {
        // do nothing
    }
    })
}

function updateQuantity(itemId, action) {
    var quantityElement = document.getElementById("itemquantity" + itemId);

    // 检查元素是否存在
    if (quantityElement) {
        var currentQuantity = parseInt(quantityElement.innerText || quantityElement.textContent);
        var itemprice = parseFloat(document.getElementById("itemprice"+itemId).textContent);
        var totalpriceElement = document.getElementById("totalprice" + itemId);
        var totalprice = parseFloat(totalpriceElement.textContent);

        if (action === 'increment') {
            checkexceedqty(itemId);
        } else if (action === 'decrement' && currentQuantity > 1) {
            quantityElement.textContent = currentQuantity - 1;
        }
        totalprice = itemprice * parseInt(quantityElement.textContent);

        // 在这里可以通过 AJAX 将新的数量发送到服务器更新购物车信息
        // 这里只是一个示例，你需要根据你的服务器端处理逻辑进行调整
        updateCartItemQuantity(itemId, quantityElement.textContent, totalprice, totalpriceElement);
    } else {
        console.error("Element with ID 'itemquantity"+itemId+"' not found");
    }
}

function checkexceedqty(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkstock.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Handle the response from the server
    xhr.onload = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.length !== 0){
                var productListHTML = '<p style="font-weight:bold; color:blue">This product order quantity cannot bigger than the stock available.</p><ul>';
                response.forEach(function(product) {
                    productListHTML += '<li>' + product + '</li>';
                });
                productListHTML += '</ul>';
                productListHTML += '</ul>';
                swal.fire({
                    title: "Product Stock Insufficient",
                    html: productListHTML,
                    icon: "warning"
                });
            }
            else{
                var quantityElement = document.getElementById("itemquantity" + itemId);
                var currentQuantity = parseInt(quantityElement.innerText || quantityElement.textContent);
                var itemprice = parseFloat(document.getElementById("itemprice"+itemId).textContent);
                var totalpriceElement = document.getElementById("totalprice" + itemId);
                var totalprice = parseFloat(totalpriceElement.textContent);
                quantityElement.textContent = currentQuantity + 1;
                totalprice = itemprice * parseInt(quantityElement.textContent);
                updateCartItemQuantity(itemId, quantityElement.textContent, totalprice, totalpriceElement);
            }
        }
    }
    xhr.send();
}

function updateCartItemQuantity(itemId, newQuantity, newTotalprice, totalpriceElement) {
        // 这里可以使用 AJAX 向服务器发送更新购物车项目数量的请求
        // 你需要根据你的服务器端处理逻辑进行调整
        $.ajax({
            type: "POST",
            url: "vieworder.php", // 请替换成你的服务器端处理脚本
            data: { item_id: itemId, new_quantity: newQuantity, new_totalprice: newTotalprice },
            success: function(response) {
                // 在成功响应中，你可以根据需要进行进一步的处理
                console.log("response is" + response);
                totalpriceElement.innerHTML = newTotalprice.toFixed(2);
                updateGrandTotalPrice();
            },
            error: function(error) {
                // 处理错误情况
                console.error(error);
            }
        });
}

   // 在 updateGrandTotalPrice 函数中，将价格转换为整数进行计算
function updateGrandTotalPrice() {
    var allitemtotalprice = document.querySelectorAll(".totalprice");
    var grandtotalprice = 0;
    for (var i = 0; i < allitemtotalprice.length; i++) {
        grandtotalprice += parseFloat(allitemtotalprice[i].textContent);
    }
    // 将整数转回浮点数，并显示两位小数
    document.getElementById("grandtotalprice").innerHTML = grandtotalprice.toFixed(2);
}


function proceed_payment(){
    window.location.assign("payment.php");
}

function store_cart_information() {
        var purchaseditem_id = document.getElementsByClassName('purchaseditem_id');
        var purchaseditems_name = document.getElementsByClassName('purchaseditem_name');
        var purchaseditems_qty = document.getElementsByClassName('item-quantity');
        var purchaseditems_priceperunit = document.getElementsByClassName('purchaseditem_priceperunit');
        var purchaseditems_total = document.getElementsByClassName('purchaseditem_totalprice');
        var purchaseditem_id_array = [];
        var purchaseditems_name_array = [];
        var purchaseditems_qty_array = [];
        var purchaseditems_priceperunit_array = [];
        var purchaseditems_total_array = [];
        for (var i = 0; i < purchaseditems_name.length; i++) {
            purchaseditem_id_array.push(purchaseditem_id[i].textContent);
            purchaseditems_name_array.push(purchaseditems_name[i].textContent);
            purchaseditems_qty_array.push(purchaseditems_qty[i].textContent);
            purchaseditems_priceperunit_array.push(purchaseditems_priceperunit[i].textContent);
            purchaseditems_total_array.push(purchaseditems_total[i].textContent);
        }
        sessionStorage.setItem("purchaseditem_id", JSON.stringify(purchaseditem_id_array));
        sessionStorage.setItem("purchaseditem_name", JSON.stringify(purchaseditems_name_array));
        sessionStorage.setItem("purchaseditem_qty", JSON.stringify(purchaseditems_qty_array));
        sessionStorage.setItem("purchaseditem_priceperunit", JSON.stringify(purchaseditems_priceperunit_array));
        sessionStorage.setItem("purchaseditem_total", JSON.stringify(purchaseditems_total_array));

        // AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "savecheckout.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the server
        xhr.onload = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("request sent successfully");

                // Update cart status after payment
                // updateCartStatus(cartId); // Pass the cart_id to the updateCartStatus function
            }
        };

        // Send data as a URL-encoded string
        xhr.send("Purchaseditems_name=" + encodeURIComponent(JSON.stringify(purchaseditems_name_array)) + "&Purchaseditems_quantity=" 
        + encodeURIComponent(JSON.stringify(purchaseditems_qty_array)) + "&Purchaseditems_priceperunit=" + encodeURIComponent(JSON.stringify(purchaseditems_priceperunit_array)) 
        + "&Purchaseditems_total=" + encodeURIComponent(JSON.stringify(purchaseditems_total_array)) + "&Purchaseditems_id=" + encodeURIComponent(JSON.stringify(purchaseditem_id_array)));

        window.location.assign("payment.php");
    }
</script>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $itemid = $_POST["item_id"];
    $new_quantity = $_POST["new_quantity"];
    $new_totalprice = $_POST["new_totalprice"];
    $customerID = $_SESSION["user_id"];
    mysqli_query($connect, "UPDATE cart SET Quantity = $new_quantity, Total = $new_totalprice WHERE Customer_ID = $customerID AND Product_id = $itemid AND Is_Purchased = 0");
}
//If you have use Older PHP Version, Please Uncomment this function for removing error 
/*function array_column($array, $column_name)
{
    $output = array();
    foreach($array as $keys => $values)
    {
        $output[] = $values[$column_name];
    }
    return $output;
}*/
?>
<?php } else { ?>
    <script type="text/javascript">
        alert("You must login first to view your order.");
    </script>
    <?php header("refresh:0.5; url=login.php"); ?>
<?php } ?>

<?php

?>

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
