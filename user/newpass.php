<?php
include("phpconnect.php");
session_start();

if(!isset($_SESSION['uemail']))
{
	?>
	<script>
	alert("Please log in!");
	</script>
	<?php
	header("refresh:0.5;url=login.php");
}

if(isset($_POST['submit']))
{
	$newpass=$_POST['newpass'];
	$email=$_SESSION["uemail"];
	
	
	$changepass=mysqli_query($connect,"UPDATE customer SET Customer_Password='".$newpass."' WHERE Customer_Email='".$email."' ");
	if($changepass)
	{
		echo 'your password is Changed ! ';
		header('Refresh:1;url=passdestroy.php');
	}
	else
	{
		echo 'error';
	}
}

mysqli_close($connect);
?>


<html>
<head>
<script>
function validation()
{
	var password = document.Reset.newpass.value;
	
	    if (password == "") { 
            window.alert("Please enter your password"); 
            document.Reset.newpass.focus(); 
            return false; 
        } 
		
		var password = document.getElementById("1").value;
        var confirmPassword = document.getElementById("2").value;
        if (password != confirmPassword) 
		{
            alert("Passwords do not match.");
            return false;
        }
		
		if ((password.length < 4) || (password.length > 8))
		{
			window.alert("Your Password must be 4 to 8 Character");
			document.Reset.newpass.select();
			return false;
		}
		
		if (password.search(/[0-9]/) < 0)
        {
         window.alert("Your password must contain at least one digit.");
         document.Reset.newpass.select();
        return false;
        }
		
		if (password.search(/[a-z]/i) < 0)
        {
         window.alert("Your password must contain at least one letter.");
         document.Reset.newpass.select();
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
  font-style:oblique;
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
<title>
resetpassword
</title>
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
			padding-left:59px ;font-style:italic; ">New Password</h1><hr>

	<div id="reset">
	<form name="Reset" onsubmit="return validation()" method="post">
		<table>
			<tr>
				<td><input type="text" name="newpass" id="1" placeholder="Enter your new pass"</td>
			</tr>
			<tr>
				<td><input type="text" name="confirmpass" id="2" placeholder="Confirm your password "</td>
			</tr>
			<tr>
				<td><button class="button button1" name="submit">Change </button></td>
			</tr>
		
        </table>	
	</form>
	</div>
</div>
</body>
</html>