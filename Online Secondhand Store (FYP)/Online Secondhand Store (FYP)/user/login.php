<?php 
session_start();
include("phpconnect.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Online Secondhand Store</title>

    <!-- Font Icon -->


    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Main css -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

</head>
<body>

    <!-- Start Top Nav -->
    <?php include_once("topnav.php"); ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include_once("header.php"); ?>
    <!-- Close Header -->

<!-- Sing in  Form -->
        <section class="sign-in">
         <div class="container py-3">
            <div class="row">
                <div class="signin-content col-md-6">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="registration.php" class="signup-image-link">Create an account</a>
                    </div>
                </div>
                <div class="signin-form col-md-6 py-5">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group row">
                                <label for="email" class="col-sm-1 col-form-label"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <div class="col-sm-11">
                                  <input type="email" class="form-control col-sm-10" name="email" id="email" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="your_pass" class="col-sm-1 col-form-label"><i class="zmdi zmdi-lock"></i></label>
                                <div class="col-sm-11">
                                  <input type="password" class="form-control col-sm-10"  name="your_pass" id="your_pass" placeholder="Password"/>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                            <div class="col-sm-10">
                                <input type="checkbox" name="remember-me" id="remember-me" class="form-check-input agree-term" />
                                <label for="remember-me" class="label-agree-term"><span></span>Remember me</label>
                            </div>
                            </div>
                            <div class="form-group form-button row pt-3">
                              <div class="col-sm-10">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                              </div>
                            </div>
                        </form>
						<p><a href="forgotpass.php">Forgot your password?</a></p>
                        
                    </div>
                </div>
            </div>
         </div>
        </section>

<?php include("footer.php") ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<?php
if(isset($_POST['signin']))
{

 $email = $_POST['email'];
 $password = $_POST['your_pass'];
 
 $mail="select * from customer where Customer_Email='$email' && Customer_Password= '$password'";
 
 $result = mysqli_query($connect,$mail);
 
 $num = mysqli_num_rows($result);
 
 if($num==1)
 {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['user_id']=$row['Customer_ID'];
  $_SESSION['login_user'] = $email;
?>
<script type="text/javascript">
alert('Login Success!!!');
window.location = 'index.php'
</script>
<?php
 } else {
?>
<script type="text/javascript">
alert('Wrong input!!!');
</script>
<?php
 }
}
?>