<?php
include("phpconnect.php");
session_start();
function generateNewCartID() {
    return uniqid('cart_', true);
}
// 确保 $_SESSION['CartID'] 被正确设置
if (!isset($_SESSION['CartID'])) {
    // 这里设置 $_SESSION['CartID'] 的逻辑，你可以根据实际情况设置
    // 例如，你可能在用户登录后设置 $_SESSION['CartID']
    // 或者在用户访问购物车时生成一个新的 CartID
    $_SESSION['CartID'] = generateNewCartID(); // 请根据实际情况修改这个函数
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment Page</title>

    <link rel="stylesheet" href="assets/css/custom.css">
    
    <!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Payment Details Showing -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AdiU_Ib2dKQw0dXr26t0xT81HlNT6tA3sR5mFlgnUIsC5SB4jP4AsIELMkTYqIvJnAwWMkVrMeD8T3T0&currency=USD"></script>
</head>
<body>
    <!-- Start Top Nav -->
    <?php include_once("topnav.php"); ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include_once("header.php"); ?>
    <!-- Close Header -->

    <div class="container py-5">
        <!-- For demo purpose -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6">MAKE A PAYMENT</h1>
                <p><span style="font-weight: bold; color: black;">Total Payable Amount:</span>  RM  <span id="total_payable_amount" style="font-weight: bold; color: green;"></span></p>
            </div>
        </div> <!-- End -->
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Payee Name:</td>
                        <td><span class="payee_information" id="payee_username"></span></td>
                    </tr>
                    <tr>
                        <td>Paid Amount:</td>
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
                    <?php
                    $itemno = 0;
                    $customerID = $_SESSION["user_id"];
                    $result_find_cart = mysqli_query($connect, "SELECT * FROM cart WHERE Customer_ID = $customerID AND Is_Purchased = 0");

                    ?>
                    <tr>
                        <td style="font-weight:bold">ITEM No</td>
                        <td>Item name:</td>
                        <td>Item price:</td>
                        <td>Item quantity:</td>
                        <td>Total price:</td>
                    </tr>
                    <?php
                    $_SESSION['totalp'] = 0;
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
                            <td class="itemprice" data-value="<?php echo $row_product["Product_Price"];?>">RM <?php echo number_format($row_product["Product_Price"],2); ?></td>
                            <td class="itemquantity" data-value="<?php echo $row_cart["Quantity"];?>"><?php echo $row_cart["Quantity"]; ?></td>
                            <td class="itemtotal" data-value="<?php echo number_format($row_cart["Quantity"] * $row_product["Product_Price"], 2);?>">RM <?php echo number_format($row_cart["Quantity"] * $row_product["Product_Price"], 2);?></td>
                        </tr>
                    <?php
                    $_SESSION['totalp'] += number_format($row_cart["Quantity"] * $row_product["Product_Price"], 2);
                    }
                    ?>

                </table>
            </div>
        </div>

        <script>
            var totalprice = <?php echo json_encode($_SESSION['totalp']);?>;
            console.log(<?php echo json_encode($_SESSION['totalp']);?>);
            document.getElementById("total_payable_amount").innerHTML = totalprice.toFixed(2);
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: totalprice.toFixed(2),
                                currency_code: 'USD'
                            }
                        }],
                    });
                },
                onApprove: async function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        console.log(details);
                        document.getElementById("payee_username").innerHTML = details.payer.name.given_name;
                        document.getElementById("payee_email").innerHTML = details.payer.email_address;
                        var payee_address = details.purchase_units[0].shipping.address.address_line_1 + details.purchase_units[0].shipping.address.postal_code + details.purchase_units[0].shipping.address.admin_area_2
                        + details.purchase_units[0].shipping.address.admin_area_1 + details.purchase_units[0].shipping.address.country_code;
                        document.getElementById("payee_address").innerHTML = payee_address;
                        document.getElementById("paid_amount").innerHTML = details.purchase_units[0].amount.value;
                        document.getElementById("Payment_ID").innerHTML = details.id;
                        console.log(details.id);
                        swal.fire({
                            title: "Payment Successfully",
                            text: "Transaction completed by "+details.payer.name.given_name + " at "+moment(details.update_time).format('YYYY-MM-DD HH:mm:ss')+". Thank you!",
                            icon: "success"
                        });
                        submitForm();
                    });
                },
                onError: function(error) {
                    console.log(error.message);
                    if (error.message.includes("status 422")) {
                        swal.fire({
                            title: "Payment Unsuccessfully",
                            text: "Total payable amount cannot be $0.00",
                            icon: "error"
                        });
                    } else {
                        swal.fire({
                            title: "Payment Unsuccessfully",
                            text: "An unexpected error occurred, please try again later",
                            icon: "error"
                        });
                    }
                },
                onCancel: function(data) {
                    console.log("Cancelled by user");
                    swal.fire({
                        title: "Payment Unsuccessfully",
                        text: "Payment process cancelled by user",
                        icon: "error"
                    });
                },
                style: {
                    layout: 'vertical'
                }
            }).render('#checkout_button');
        </script>
        
    </div>
    <div class="container py-5">
        <button id="printButton" class="btn btn-primary" style="display:none; font-size:40px; margin:0 auto;">Print</button>
    <script>
    document.getElementById("printButton").addEventListener("click", function() {
        window.print();
    });
</script>

</body>
</html>
<script>
    function getCartID() 
    {
        // 在这里实现获取购物车ID的逻辑
        // 假设你的购物车ID存储在一个名为 'cart_id' 的PHP会话变量中
        var cartId = <?php echo json_encode($_SESSION['CartID']); ?>;

        return cartId;
    }
    var allitem_id=[];
    var allitem_name=[];
    var allitem_price=[];
    var allitem_quantity=[];
    var allitem_total=[];
    var allitem = document.getElementsByClassName("itemID");
    for(var i=0; i<allitem.length; i++){
        allitem_id.push(allitem[i].getAttribute("data-value"));
        allitem_name.push(document.getElementsByClassName("itemname")[i].getAttribute("data-value"));
        allitem_price.push(document.getElementsByClassName("itemprice")[i].getAttribute("data-value"));
        allitem_quantity.push(document.getElementsByClassName("itemquantity")[i].getAttribute("data-value"));
        allitem_total.push(document.getElementsByClassName("itemtotal")[i].getAttribute("data-value"));
    }

    function submitForm() {
    // var cartId = getCartID(); // Replace 'getCartID()' with your actual method
    var payee = document.getElementById("payee_username").innerHTML;
    var email = document.getElementById("payee_email").innerHTML;
    var address = document.getElementById("payee_address").innerHTML;
    var amount = document.getElementById("paid_amount").innerHTML;
    var Payment_Id = document.getElementById("Payment_ID").innerHTML;
    var allitem_id = [];
    var allitem_name = [];
    var allitem_price = [];
    var allitem_quantity = [];
    var allitem_total = [];
    var allitem = document.getElementsByClassName("itemID");
    for (var i = 0; i < allitem.length; i++) {
        allitem_id.push(allitem[i].getAttribute("data-value"));
        allitem_name.push(document.getElementsByClassName("itemname")[i].getAttribute("data-value"));
        allitem_price.push(document.getElementsByClassName("itemprice")[i].getAttribute("data-value"));
        allitem_quantity.push(document.getElementsByClassName("itemquantity")[i].getAttribute("data-value"));
        allitem_total.push(document.getElementsByClassName("itemtotal")[i].getAttribute("data-value"));
    }
    // AJAX request
    var xhr = new XMLHttpRequest();
        xhr.open("POST", "savecheckout.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the server
        xhr.onload = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("request sent successfully");
                document.getElementById("printButton").style.display = "block";
                document.getElementById("checkout_button").style.display = "none";
                // Update cart status after payment
                // updateCartStatus(cartId); // Pass the cart_id to the updateCartStatus function
            }
        };

        // Send data as a URL-encoded string
        xhr.send("Username=" + encodeURIComponent(payee) + "&Amount=" + encodeURIComponent(amount) + "&Email=" + encodeURIComponent(email) + 
                 "&Address=" + encodeURIComponent(address) + "&Payment_ID=" + encodeURIComponent(Payment_Id) + 
                 "&Id=" + encodeURIComponent(JSON.stringify(allitem_id)) + "&Itemname=" + encodeURIComponent(JSON.stringify(allitem_name)) + 
                 "&Itemprice=" + encodeURIComponent(JSON.stringify(allitem_price)) + "&Itemquantity=" + encodeURIComponent(JSON.stringify(allitem_quantity)) + 
                 "&Itemtotal=" + encodeURIComponent(JSON.stringify(allitem_total)) + "&PaymentId=" + Payment_Id + "&PayeeName=" + payee + "&PayeeEmail=" + email +
                 "&PayeeAddress=" + address + "&PayeeStatus=Paid" );
    }

    function updateCartStatus($connect,cartID) {
        // AJAX request to update cart status
        var updateCartXhr = new XMLHttpRequest();
        updateCartXhr.open("POST", "update_cart_status.php", true);
        updateCartXhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the server
        updateCartXhr.onload = function () {
            if (updateCartXhr.readyState == 4 && updateCartXhr.status == 200) {
                console.log("Cart status updated successfully");
                // You can perform additional actions after updating the cart status
            }
        };

        // Send data as a URL-encoded string
        updateCartXhr.send("CartID=" + encodeURIComponent(cartID));
    }
</script>

