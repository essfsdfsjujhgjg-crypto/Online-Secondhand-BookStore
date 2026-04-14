<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    header("Location: adminregisterlogin.html?error=emptyfields");
    exit();
  }

  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "oss";

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $checkEmailQuery = "SELECT * FROM admin WHERE email = ?";
  $checkStmt = $conn->prepare($checkEmailQuery);
  $checkStmt->bind_param("s", $email);
  $checkStmt->execute();
  $result = $checkStmt->get_result();

  if ($result->num_rows > 0) {
    $checkStmt->close();
    $conn->close();
    header("Location: adminregisterlogin.html?error=emailtaken");
    exit();
  }


  $insertQuery = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($insertQuery);
  $stmt->bind_param("sss", $username, $email, $password);

  if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: loader3.html");
    exit();
  } else {
    $stmt->close();
    $conn->close();
    header("Location: adminregisterlogin.html?error=registrationfailed");
    exit();
  }
}
?>
