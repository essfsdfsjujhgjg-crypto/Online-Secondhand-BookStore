<?php
session_start();
include("dataconnection2.php");


$currentAdminUsername = $_SESSION['admin_username'];

$query = "SELECT * FROM admin WHERE username = '$currentAdminUsername'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Error: " . mysqli_error($connect));
}

$adminInfo = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $superadminUsername = mysqli_real_escape_string($connect, $_POST["superadminUsername"]);
    $superadminEmail = mysqli_real_escape_string($connect, $_POST["superadminEmail"]);
    $superadminPassword = mysqli_real_escape_string($connect, $_POST["superadminPassword"]);


    $checkUniqueQuery = "SELECT * FROM superadmin WHERE username = '$superadminUsername'";
    $checkUniqueResult = mysqli_query($connect, $checkUniqueQuery);

    if (!$checkUniqueResult) {
        die("Error: " . mysqli_error($connect));
    }

    if (mysqli_num_rows($checkUniqueResult) > 0) {
     
        echo "Superadmin username already exists. Choose a different username.";
    } else {
    
        $hashedPassword = password_hash($superadminPassword, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO superadmin (username, email, password) VALUES ('$superadminUsername', '$superadminEmail', '$superadminPassword')";
        $insertResult = mysqli_query($connect, $insertQuery);

        if (!$insertResult) {
            die("Error: " . mysqli_error($connect));
        }

        
        header("Location: superadminlogin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0; /* Updated background color */
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 28px; /* Increased font size */
            margin-bottom: 20px;
            border-radius: 5px;
        }

        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4B70E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3458a7;
        }

        .go-back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background-color: #45a049;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .go-back-button i {
            margin-right: 10px;
        }

        .go-back-button:hover {
            background-color: #3c9142;
        }
    </style>
</head>
<body>
    <header>
        Superadmin Registration
    </header>

    <form method="POST" action="">
        <label for="superadminUsername">Superadmin Username:</label>
        <input type="text" id="superadminUsername" name="superadminUsername" value="<?php echo $adminInfo['username']; ?>" required readonly>

        <label for="superadminEmail">Superadmin Email:</label>
        <input type="email" id="superadminEmail" name="superadminEmail" value="<?php echo $adminInfo['email']; ?>" required readonly>

        <label for="superadminPassword">Superadmin Password:</label>
        <input type="password" id="superadminPassword" name="superadminPassword" required>

        <button type="submit">Register Superadmin</button>
    </form>

    <a href="panel.html" class="go-back-button">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>

    <script>
        function goBack() {
            window.location.href = 'panel.html'; // Adjust the destination accordingly
        }
    </script>
</body>
</html>


