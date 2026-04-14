<?php
session_start();
include_once 'phpconnect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $result = mysqli_query($connect,"SELECT * FROM customer where Customer_Email='" . $_POST['email'] . "'");
    $row = mysqli_fetch_assoc($result);
	$fetch_user_mail=$row['Customer_Email'];
	
	
	if($email==$fetch_user_mail) {
    //Server settings 
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;           //Enable SMTP authentication
    $mail->Username   = '1211201713@student.mmu.edu.my';   //SMTP username
    $mail->Password   = 'gqaeikkdidywcgbg';   //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;      

				$_SESSION["uemail"] = $email;
				$to = $fetch_user_mail;
				
                $subject = "Reset Password";
                $txt = "You can change your password by using the link at below:\n\nhttp://localhost/Online%20Secondhand%20Store%20(FYP)/Online%20Secondhand%20Store%20(FYP)/user/newpass.php?email=$email";
                $headers = "From: Top 1 Thrift Store";
                //$abc=mail($to,$subject,$txt,$headers);

$mail->setFrom( "1211201713@student.mmu.edu.my","OSS"); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email  
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $subject;   // email subject headings
    $mail->Body    = $txt; //email message
      
    // Success sent message alert
    $mail->send();				echo "Email successfully sent to $to...";
			}
				else{
					echo 'invalid userid';
				}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
function validation()
{
	var email = document.verification.email; 
	
		if (email.value == "") 
		{ 
            window.alert( "E-mail address cannot be blank."); 
            email.focus(); 
            return false; 
        } 
		
        return true; 

}
</script>
<style>
#reset{width:250px;
	height:25px;
	padding-top:0px;
    padding-bottom:70px;
    padding-right:5px;
    padding-left:60px;
}


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
	background-color:#DDDDDD;
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
  font-style: oblique;
}

.line
{
  border:1px solid #FAFAFA;
  background-color:black;
  background-repeat:repeat;
}
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}
a{color:#000000;
font-weight: bold;
font-style: oblique;
text-decoration:none;}



.button {
  background-color: #dddddd;
  border-radius: 5px;
  color: black;
  
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

input[type=text] {
  
 
  
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
  background-color: #dddddd;
}

input[type=text]:focus {
  background-color: #dddddd;
}
</style>
</head>
<body>
<div style="width:400px;
            padding:0px;
			margin:200px auto;
			border:1px solid #DDD;
			border-radius:10px;
			background-color:white;
			background-position:center;box-shadow: 5px 10px 98px 18px #888888;">
			
			<h1 style="color:black;
		    font-family:Arial;
			margin:0px;
			padding-left:30px;
			font-style:italic;">Forgot Password</h1><hr>

	<div id="reset" >
	<form name="verification" onsubmit="return validation()" method="post" ;>
		<table>
			<tr>
				<td><input type="text" name="email" placeholder="Enter your email"</td>
			</tr>
			<tr>
				<td><button name="submit" class="button button1">Check</button></td>
			</tr>
			<tr>
				<td><button class="button button1"><a href="login.php">Back</a></button></td>
			</tr>
        </table>	
	</form>
	</div>
</div>
</body>
</html>