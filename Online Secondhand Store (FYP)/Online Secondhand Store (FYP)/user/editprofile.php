<?php
session_start();
include("phpconnect.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OSS</title>
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
<script>
    function validation() {
        var name = document.user_form.txtname.value;
        var email = document.user_form.txtemail;
        var phone = document.user_form.phnum.value;
        var address = document.user_form.txtaddress.value;
        var password = document.user_form.txtpass.value;

        if (name == "") {
            window.alert("Please enter your name.");
            document.user_form.txtname.focus();
            return false;
        }

        if (!isNaN(name)) {
            window.alert("Please Enter Only Characters");
            document.user_form.txtname.select();
            return false;
        }

        if ((name.length < 5) || (name.length > 25)) {
            window.alert("Your Character must be 5 to 15 Character");
            document.user_form.txtname.select();
            return false;
        }

        if (address == "") {
            window.alert("Please enter your address.");
            document.user_form.txtaddress.focus();
            return false;
        }

        if ((address.length < 20) || (address.length > 100)) {
            window.alert(" Your textarea must be 20 to 100 characters");
            document.user_form.txtaddress.select();
            return false;
        }



        if (phone == "") {
            window.alert("Please enter your phone number.");
            document.user_form.phnum.focus();
            return false;
        }

        if (isNaN(phone)) {
            window.alert("Enter the valid Mobile Number(Like : 9566137117)");
            document.user_form.phnum.focus();
            return false;
        }

        if ((phone.length < 10) || (phone.length > 11)) {
            window.alert(" Your Mobile Number must be 10/11 Integers");
            document.user_form.phnum.select();
            return false;
        }
        if (password == "") {
            window.alert("Please enter your password");
            document.user_form.txtpass.focus();
            return false;
        }

        if ((password.length < 4) || (password.length > 8)) {
            window.alert("Your Password must be 4 to 8 Character");
            document.user_form.txtpass.select();
            return false;
        }

        if (password.search(/[0-9]/) < 0) {
            window.alert("Your password must contain at least one digit.");
            document.user_form.txtpass.select();
            return false;
        }

        if (password.search(/[a-z]/i) < 0) {
            window.alert("Your password must contain at least one letter.");
            document.user_form.txtpass.select();
            return false;
        }

        if (email.value == "") {
            window.alert("E-mail address cannot be blank.");
            email.focus();
            return false;
        } else {
            var product_price = document.getElementById("email").value;
            var pattern = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            if (pattern.test(product_price)) {

            } else {
                alert("enter valid email");
                return false;
            }

        }


        return true;
    }

    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

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

    <!-- Start Categories of The Month -->
    <?php include("phpconnect.php"); ?>

    <html>

    <head>

    </head>

    <body>
        <?php
        if (isset($_SESSION['user_id'])) {
            $cid = $_SESSION['user_id'];

            $result = mysqli_query($connect, "SELECT * FROM customer where Customer_ID='$cid'");

            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="container py-3">
            <h1>Update Personal Detail</h1>

            <form name="user_form" onsubmit="return validation()" method="POST" action="">
                <div class="form-group">
                    <p>Name: <input type="text" class="form-control" name="txtname" value="<?php echo $row['Customer_Name']; ?>">
                </div>
                <p>Address: <input type="text" class="form-control" name="txtaddress" value="<?php echo $row['Customer_Address']; ?>">
                <p>Email: <input type="email" class="form-control" name="txtemail" value="<?php echo $row['Customer_Email']; ?>"readonly>

                <p>Phone No: <input type="text" class="form-control" name="phnum" value="<?php echo $row['Customer_Phone_No']; ?>">
                <p>Password: <input type="password" class="form-control" name="txtpass" value="<?php echo $row['Customer_Password']; ?>">
                <p><input type="submit" class="btn btn-success" name="savebtn" value="Update Detail">
        </div>
        </form>
    </body>

    </html>

    <?php

    if (isset($_POST["savebtn"])) {
        $username = $_POST["txtname"];
        $caddress = $_POST["txtaddress"];
        $email = $_POST["txtemail"];
        $password = $_POST["txtpass"];
        $phone = $_POST["phnum"];

        mysqli_query($connect, "UPDATE customer SET Customer_Name='$username',Customer_Address='$caddress', Customer_Email='$email', Customer_Password='$password', Customer_Phone_No='$phone' WHERE Customer_ID='$cid'");

        header("location:profile.php");
    }
    ?>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->

    <!-- End Featured Product -->


<?php include("footer.php") ?>
</body>

</html>