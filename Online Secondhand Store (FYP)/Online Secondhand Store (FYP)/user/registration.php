<?php include("phpconnect.php"); 
session_start();

if(isset($_POST["signup"]))
{
	$username = $_POST["txtname"];
	$caddress = $_POST["txtaddress"];
	$email = $_POST["txtemail"];
	$password = $_POST["txtpass"];
    $confirmPassword = $_POST["confirmpass"]; // Add this line for confirm password
	$phone = $_POST["phnum"];
	
    // Check if passwords match
    if ($password !== $confirmPassword) {
        ?>
        <script>
            alert("Passwords do not match. Please try again.");
        </script>
        <?php
    } else {
        // Check if email already exists
           $mail = "SELECT * FROM customer WHERE Customer_Email='$email'";
            $result = mysqli_query($connect, $mail);
            $count = mysqli_num_rows($result);

	$mail="select * from customer where Customer_Email='$email'";
	
	$result=mysqli_query($connect,$mail);
	
	$count=mysqli_num_rows($result);
	
	if($count !=0)
	{
		?>
		<script>
		alert("This email is already in use. Please try others");
		</script>
		<?php
	}	
	else
	{
		mysqli_query($connect,"INSERT INTO customer(Customer_Name,Customer_Address,Customer_Email,Customer_Password,Customer_Phone_No)
		VALUES('$username','$caddress','$email','$password','$phone')");
		?>
		<script>
		alert('Register success.Please login');
		</script>
		
		<?php
		
		header('refresh:0.5; url=login.php');
	}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
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
		
		if(!isNaN(name))
		{
			window.alert("Please Enter Only Characters");
			document.user_form.txtname.select();
			return false;
		}
		
		if ((name.length < 5) || (name.length > 25))
		{
			window.alert("Your Character must be 5 to 15 Character");
			document.user_form.txtname.select();
			return false;
		}
		
        if (address == "") { 
            window.alert("Please enter your address."); 
            document.user_form.txtaddress.focus();
            return false; 
        } 
		
		if((address.length < 20) || (address.length > 100))
		{
			window.alert(" Your textarea must be 20 to 100 characters");
			document.user_form.txtaddress.select();
		  return false;
		}
  
        
  
        if (phone == "") 
		{ 
            window.alert( "Please enter your phone number."); 
            document.user_form.phnum.focus(); 
            return false; 
        } 
		
		if(isNaN(phone))
        {
			window.alert("Enter the valid Mobile Number(Like : 9566137117)");
			document.user_form.phnum.focus(); 
			return false;
		}
		
		if((phone.length < 10) || (phone.length > 11))
		{
			window.alert(" Your Mobile Number must be 10/11 Integers");
			document.user_form.phnum.select();
			return false;
		}
		
		if (email.value == "") { 
            window.alert( "E-mail address cannot be blank."); 
            email.focus(); 
            return false; 
        } 
		else
		{
		var product_price = document.getElementById("email").value;
          var pattern =/(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
          if (pattern.test(product_price)) 
		  {
            
		  }
		  else
		  {
			  alert("enter valid email");
			  return false;
		  }
       
		}
		 if (password == "") { 
            window.alert("Please enter your password"); 
            document.user_form.txtpass.focus(); 
            return false; 
        } 
		
		if ((password.length < 4) || (password.length > 8))
		{
			window.alert("Your Password must be 4 to 8 Character");
			document.user_form.txtpass.select();
			return false;
		}
		
		if (password.search(/[0-9]/) < 0)
        {
         window.alert("Your password must contain at least one digit.");
         document.user_form.txtpass.select();
        return false;
        }
		
		if (password.search(/[a-z]/i) < 0)
        {
         window.alert("Your password must contain at least one letter.");
         document.user_form.txtpass.select();
        return false;
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

    <div class="main">

        <!-- Sign up form -->
		
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form name="user_form" onsubmit="return validation()" method="POST" action="">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="txtname" id="name" placeholder="Your Name"/ >
                            </div>
							
							<div class="form-group">
                                <label for="address"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="txtaddress" id="adress" placeholder="Address"/ >
                            </div>
							<div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="txtemail" id="email" placeholder="Your Email"/ >
                            </div>
							
							<div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="phnum" id="phone_number"  placeholder="Phone_number"/ >
                            </div>
                            
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="txtpass" id="myInput" placeholder="Password"/ >
								
                            </div>
                            <div class="form-group">
                                <label for="confirmpass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" />
                                <span onclick="toggleConfirmPassword()" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            </div>
                                         											
							
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
							
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
		
			<!-- JS -->
            <script>

function toggleConfirmPassword() {
    var x = document.getElementById("confirmpass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
    
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
<html>

        

