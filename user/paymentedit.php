<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
            width: 100%;
            display: inline-block;
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

    if (isset($_GET['Payment_ID'])) {
        $payment_id = $_GET['Payment_ID'];

        $result = mysqli_query($connect, "SELECT * FROM savepayment WHERE Payment_ID='$payment_id'");
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "Payment not found.";
            exit;
        }
    } else {
        echo "Payment_ID not provided.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editbtn'])) {

        $newStatus = mysqli_real_escape_string($connect, $_POST['Payment_Status']);

        $update_query = "UPDATE savepayment SET  
                        Payment_Status = '$newStatus'
                        WHERE Payment_ID = '$payment_id'";

        $update_result = mysqli_query($connect, $update_query);

        if ($update_result) {
            echo "Payment details updated successfully.";
        } else {
            echo "Error updating payment details: " . mysqli_error($connect);
        }
    }

    mysqli_close($connect);
    ?>

    <form method="POST">
        <h2>Edit Payment</h2>
  
        <label for="Status">Status:</label>
        <input type="text" name="Payment_Status" value="<?php echo isset($row['Payment_Status']) ? htmlspecialchars($row['Payment_Status']) : ''; ?>" required>

        <input type="submit" value="Edit" name="editbtn">
        <a href="payment.php" class="go-back-button">Go Back</a>
    </form>
</body>

</html>