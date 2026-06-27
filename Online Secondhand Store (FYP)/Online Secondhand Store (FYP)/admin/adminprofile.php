<?php
session_start();
include("dataconnection2.php");

if (!isset($_SESSION['admin_username'])) {
    header("Location: adminregisterlogin.html");
    exit();
}

$admin_username = $_SESSION['admin_username'];

$query = "SELECT * FROM admin WHERE username = '$admin_username'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Error: " . mysqli_error($connect));
}

$row = mysqli_fetch_assoc($result);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('image/adminbackground.png'); 
            background-size: cover;
        }

        .profile-container {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.8); 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            position: relative;
        }

        .profile-container h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 30px;
        }

        .profile-info p {
            color: #333;
            margin: 8px 0;
        }

        .edit-profile-link,
        .go-back-button {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .edit-profile-link:hover,
        .go-back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h3>Admin Profile</h3>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
          
        </div>

        <a href="editprofile.php" class="edit-profile-link">Edit Profile</a>
        

        <button class="go-back-button" onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.location.href = 'panel.html'; 
        }
    </script>
</body>
</html>