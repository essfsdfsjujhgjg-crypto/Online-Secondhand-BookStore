<?php
include("dataconnection2.php");

if (isset($_GET['Customer_Name'])) {
    $Customer_Name = $_GET['Customer_Name'];
    $result = mysqli_query($connect, "SELECT * FROM customer WHERE Customer_Name='$Customer_Name'");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["editbtn"])) {

    $newCustomer_Name = $_POST["Customer_Name"];
    $Customer_ID = $_POST["txtCustomer_ID"];
    $Customer_Address = $_POST["txtCustomer_Address"];
    $Customer_Email = $_POST["txtCustomer_Email"];
    $Customer_Password = $_POST["txtCustomer_Password"];
    $Customer_Phone_No = $_POST["txtCustomer_Phone_No"];

    $stmt = $connect->prepare("UPDATE customer SET Customer_Name=?, Customer_ID=?, Customer_Address=?, Customer_Email=?, Customer_Password=?, Customer_Phone_No=? WHERE Customer_Name=?");
    $stmt->bind_param("sssssss", $newCustomer_Name, $Customer_ID, $Customer_Address, $Customer_Email, $Customer_Password, $Customer_Phone_No, $Customer_Name);
    $stmt->execute();

    header("location:customermanagement.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
    <form name="editfrm" method="POST">
        <h2>Edit Customer</h2>
        <label for="Customer_Name">Customer Name:</label>
        <input type="text" name="Customer_Name" value="<?php echo isset($row['Customer_Name']) ? $row['Customer_Name'] : ''; ?>">

        <label for="txtCustomer_ID">Customer ID:</label>
        <input type="text" name="txtCustomer_ID" value="<?php echo isset($row['Customer_ID']) ? $row['Customer_ID'] : ''; ?>">

        <label for="txtCustomer_Address">Customer Address:</label>
        <input type="text" name="txtCustomer_Address" value="<?php echo isset($row['Customer_Address']) ? $row['Customer_Address'] : ''; ?>">

        <label for="txtCustomer_Email">Customer Email:</label>
        <input type="text" name="txtCustomer_Email" value="<?php echo isset($row['Customer_Email']) ? $row['Customer_Email'] : ''; ?>">

        <label for="txtCustomer_Password">Customer Password:</label>
        <input type="text" name="txtCustomer_Password" value="<?php echo isset($row['Customer_Password']) ? $row['Customer_Password'] : ''; ?>">

        <label for="txtCustomer_Phone_No">Customer Phone:</label>
        <input type="text" name="txtCustomer_Phone_No" value="<?php echo isset($row['Customer_Phone_No']) ? $row['Customer_Phone_No'] : ''; ?>">

        <input type="submit" value="Edit" name="editbtn">
        <a href="customermanagement.php" class="go-back-button">Go Back</a>
    </form>

    
</body>

</html>