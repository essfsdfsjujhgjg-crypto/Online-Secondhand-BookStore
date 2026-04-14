<?php
session_start();
include("dataconnection2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = mysqli_real_escape_string($connect, $_POST['superadminUsername']);
    $enteredPassword = mysqli_real_escape_string($connect, $_POST['superadminPassword']);

    $query = "SELECT * FROM superadmin WHERE username = '$enteredUsername'";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("Error: " . mysqli_error($connect));
    }

    $adminInfo = mysqli_fetch_assoc($result);

    if ($adminInfo) {
        
        if (trim($enteredPassword) === $adminInfo['password']) {
         
            $_SESSION['admin_username'] = $enteredUsername;
            echo "Error: " . $_SESSION['login_error'];
            header("Location: panel2.html");
            exit();
        } else {
      
            $_SESSION['login_error'] = "Invalid password";
            echo "Error: " . $_SESSION['login_error'];
            header("Location: superadminlogin.php");
            exit();
        }
    } else {
       
        $_SESSION['login_error'] = "Invalid username";
        header("Location: superadminlogin.php");
        exit();
    }
}
?>