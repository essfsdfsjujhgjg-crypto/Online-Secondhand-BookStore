<?php
include("dataconnection2.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customerID = mysqli_real_escape_string($connect, $_POST['customerID']);
    $customerName = mysqli_real_escape_string($connect, $_POST['customerName']);
    $customerAddress = mysqli_real_escape_string($connect, $_POST['customerAddress']);
    $customerEmail = mysqli_real_escape_string($connect, $_POST['customerEmail']);
    $customerPassword = mysqli_real_escape_string($connect, $_POST['customerPassword']);
    $customerPhoneNo = mysqli_real_escape_string($connect, $_POST['customerPhoneNo']);

    
    $query = "INSERT INTO customer (Customer_ID, Customer_Name, Customer_Address, Customer_Email, Customer_Password, Customer_Phone_No) 
              VALUES ('$customerID', '$customerName', '$customerAddress', '$customerEmail', '$customerPassword', '$customerPhoneNo')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        
        header("Location: customermanagement.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 8px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .go-back-button {
            background-color: #e74c3c;
        }

        .go-back-button:hover {
            background-color: #c0392b;
        }

        .icon {
            margin-right: 8px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <header>
        <h2>Add Customer</h2>
    </header>

    
    <form method="post" action="">
        <label for="customerID">Customer ID:</label>
        <input type="text" id="customerID" name="customerID" required>

        <label for="customerName">Customer Name:</label>
        <input type="text" id="customerName" name="customerName" required>

        <label for="customerAddress">House Address:</label>
        <input type="text" id="customerAddress" name="customerAddress" required>

        <label for="customerEmail">Email:</label>
        <input type="email" id="customerEmail" name="customerEmail" required>

        <label for="customerPassword">Password:</label>
        <input type="password" id="customerPassword" name="customerPassword" required>

        <label for="customerPhoneNo">Phone Number:</label>
        <input type="text" id="customerPhoneNo" name="customerPhoneNo" required>

        
        <div class="button-container">
            <button type="submit" class="go-back-button">
                <i class="icon fas fa-user-plus"></i> Add Customer
            </button>
            <button class="go-back-button" onclick="goBack()">Go Back</button>
        </div>
    </form>

    <script>
        function goBack() {
            window.location.href = 'customermanagement.php';
        }
    </script>
</body>
</html>