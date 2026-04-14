<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: black;
            font-family: 'Montserrat', sans-serif;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            display: inline-block;
            width: 100%; 
        }

        input[type="submit"]:hover {
            background-color: #2184c9; 
        }

        .go-back-button {
            background-color: red;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            display: inline-block;
            text-decoration: none;
            margin-left: 10px;
        }

        .go-back-button:hover {
            background-color: darkred;
        }


    </style>
</head>

<body>
    <?php
    include("dataconnection2.php");

    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $result = mysqli_query($connect, "SELECT * FROM admin WHERE username='$username'");
        $row = mysqli_fetch_assoc($result);
    }

    if (isset($_POST["editbtn"])) {
        $newUsername = $_POST["username"];
        $password = $_POST["txtpassword"];

        $stmt = $connect->prepare("UPDATE admin SET username=?, password=? WHERE username=?");
        $stmt->bind_param("sss", $newUsername, $password, $username);
        $stmt->execute();

        header("location: adminmanagement2.php");
        exit();
    }
    ?>

    <form name="editfrm" method="POST">
        <h2>Edit Admin</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($row['username']) ? htmlspecialchars($row['username']) : ''; ?>">

        <label for="txtpassword">Password:</label>
        <input type="password" name="txtpassword" value="<?php echo isset($row['password']) ? htmlspecialchars($row['password']) : ''; ?>">

        <input type="submit" value="Edit" name="editbtn">
        <a href="adminmanagement2.php" class="go-back-button">Go Back</a>
    </form>
</body>

</html>