<?php
include("dataconnection2.php");

if (isset($_GET['Product_ID'])) {
    $Product_ID = $_GET['Product_ID'];
    $result = mysqli_query($connect, "SELECT * FROM product WHERE Product_ID='$Product_ID'");
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["editbtn"])) {
    $newProduct_ID = $_POST["Product_ID"];
    $Product_Name = $_POST["txtProduct_Name"];
    $image = $_POST["txtimage"];
    $ProductCategory_ID = $_POST["txtProductCategory_ID"];
    $Product_Description = $_POST["txtProduct_Description"];
    $Product_Price = $_POST["txtProduct_Price"];
    $Product_Stock = $_POST["txtProduct_Stock"];
    $Product_Approved = $_POST["selApproved"];

    $stmt = $connect->prepare("UPDATE product SET Product_ID=?, Product_Name=?, image=?, ProductCategory_ID=?, Product_Description=?, Product_Price=?, Product_Stock=?, product_isDelete=? WHERE Product_ID=?");
    $stmt->bind_param("ssssssssi", $newProduct_ID, $Product_Name, $image, $ProductCategory_ID, $Product_Description, $Product_Price, $Product_Stock, $Product_Approved, $newProduct_ID);

    if ($stmt->execute()) {
        header("location: productmanagement.php");
        exit();
    } else {
        die("Update failed. Error: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            color:black;
            font-family: 'Montserrat', sans-serif;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,select {
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
        <h2>Edit Product</h2>
        <label for="Product_ID">Product ID:</label>
        <input type="text" name="Product_ID" value="<?php echo isset($row['Product_ID']) ? $row['Product_ID'] : 'No ID fetched'; ?>" readonly>

        <label for="txtProduct_Name">Product Name:</label>
        <input type="text" name="txtProduct_Name" value="<?php echo isset($row['Product_Name']) ? $row['Product_Name'] : 'No Name fetched'; ?>">

        <label for="txtimage">Image:</label>
        <input type="text" name="txtimage" value="<?php echo isset($row['image']) ? $row['image'] : ''; ?>">

        <label for="txtProductCategory_ID">Product Category:</label>
        <select class="form-control" id="category" name="txtProductCategory_ID">
        <?php
                        $sqlcategory="select * from category";
                        $qrycategory=mysqli_query($connect,$sqlcategory);

                        while($rowcategory = mysqli_fetch_assoc($qrycategory)) {
                    ?>
                        <option value="<?php echo $rowcategory['Category_ID'] ?>"
                         <?php if ($rowcategory['Category_ID'] == $row['ProductCategory_ID']) echo "selected" ?>>
                        <?php echo $rowcategory['Category_Name'] ?></option>
                        <?php } ?>
                    </select>

        <label for="txtProduct_Description">Product Description:</label>
        <input type="text" name="txtProduct_Description" value='<?php echo isset($row['Product_Description']) ? $row['Product_Description'] : ''; ?>'>

        <label for="txtProduct_Price">Product Price:</label>
        <input type="text" name="txtProduct_Price" value="<?php echo isset($row['Product_Price']) ? $row['Product_Price'] : ''; ?>">

        <label for="txtProduct_Stock">Product Stock:</label>
        <input type="text" name="txtProduct_Stock" value="<?php echo isset($row['Product_Stock']) ? $row['Product_Stock'] : ''; ?>">

        <select class="form-control" id="category" name="selApproved">
        <option value="0" 
        <?php if ($row['product_isDelete'] == 0) echo "selected" ?>
        >Approved</option>
        <option value="1" 
        <?php if ($row['product_isDelete'] == 1) echo "selected" ?>
        >Not Approved</option>
        </select>

        <input type="submit" value="Edit" name="editbtn">
        <a href="productmanagement.php" class="go-back-button">Go Back</a>
    </form>
</body>

</html>