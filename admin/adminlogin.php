User
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "oss";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $entered_username, $entered_password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        
        $_SESSION['admin_username'] = $entered_username;
        header("Location: loader.html");
        exit();
    } else {
       
        $correct_superadmin_username = "superadmin";
        $correct_superadmin_password = password_hash("superadmin", PASSWORD_DEFAULT);

        if ($entered_username == $correct_superadmin_username && password_verify($entered_password, $correct_superadmin_password)) {
           
            $_SESSION['admin_username'] = $entered_username;
            header("Location: loader.html");
            exit();
        } else {

            header("Location: wrong.php"); 
            exit();
            
      
        }
    }
}
?>