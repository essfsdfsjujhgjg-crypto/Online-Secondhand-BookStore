<?php
session_start();
include("dataconnection2.php");


if (!isset($_SESSION['admin_username'])) {
    header("Location: superadminlogin.php");
    exit();
}

$admin_username = $_SESSION['admin_username'];


$query = "SELECT * FROM superadmin WHERE username = '$admin_username'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Error: " . mysqli_error($connect));
}

$row = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = mysqli_real_escape_string($connect, $_POST['newUsername']);
    $newEmail = mysqli_real_escape_string($connect, $_POST['newEmail']);

   
    $updateQuery = "UPDATE superadmin SET username='$newUsername', email='$newEmail' WHERE username='$admin_username'";
    $updateResult = mysqli_query($connect, $updateQuery);

    if ($updateResult) {

        $_SESSION['admin_username'] = $newUsername;
        header("Location: superadminprofile.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        }

        .edit-profile-container {
            width: 400px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
        }

        .edit-profile-container h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .edit-profile-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-input {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
        }

        .submit-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h3>Edit Profile</h3>
        <form class="edit-profile-form" method="POST" action="">
            <input class="form-input" type="text" name="newUsername" placeholder="New Username" value="<?php echo $row['username']; ?>" required>
            <input class="form-input" type="email" name="newEmail" placeholder="New Email" value="<?php echo $row['email']; ?>" required>
            
            <button class="submit-button" type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>