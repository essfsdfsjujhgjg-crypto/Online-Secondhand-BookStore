<?php
include("dataconnection2.php");

$msg = "";

if (isset($_POST['submit'])) {
    $orderID = mysqli_real_escape_string($connect, $_POST['orderID']);
    $productID = mysqli_real_escape_string($connect, $_POST['productID']);
    $paymentID = mysqli_real_escape_string($connect, $_POST['paymentID']);
    $productName = mysqli_real_escape_string($connect, $_POST['productName']);
    $orderQuantity = mysqli_real_escape_string($connect, $_POST['orderQuantity']);
    $productPrice = mysqli_real_escape_string($connect, $_POST['productPrice']);

    $query = "INSERT INTO c_order (Order_ID, Product_ID, Payment_ID, Product_Name, Order_Quantity, Product_Price) 
              VALUES ('$orderID', '$productID', '$paymentID', '$productName', '$orderQuantity', '$productPrice')";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: ordermanagement.php");
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
        <h2>Add Orders</h2>
    </header>

    <form method="post" action="">
        <label for="orderID">Order ID:</label>
        <input type="text" id="orderID" name="orderID" required>

        <label for="productID">Product ID:</label>
        <input type="text" id="productID" name="productID" required>

        <label for="paymentID">Payment ID:</label>
        <input type="text" id="paymentID" name="paymentID" required>

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <label for="orderQuantity">Order Quantity:</label>
        <input type="text" id="orderQuantity" name="orderQuantity" required>

        <label for="productPrice">Product Price:</label>
        <input type="text" id="productPrice" name="productPrice" required>

        <div class="button-container">
            <button type="submit" name="submit">
                <i class="icon fas fa-shopping-bag"></i> Add Order
            </button>

            <button type="button" class="go-back-button" onclick="goBack()">
                Go Back
            </button>

        </div>
    </form>


    <script>
        function goBack() {
            window.location.href = 'ordermanagement.php';
        }
    </script>
</body>
</html>