<?php
include("dataconnection2.php");

$msg = "";

if (isset($_POST['submit'])) {
    $productID = mysqli_real_escape_string($connect, $_POST['productID']);
    $productName = mysqli_real_escape_string($connect, $_POST['productName']);
    $productPrice = mysqli_real_escape_string($connect, $_POST['productPrice']);
    $productCategoryID = mysqli_real_escape_string($connect, $_POST['productCategoryID']);
    $productDescription = mysqli_real_escape_string($connect, $_POST['productDescription']);
    $productStock = mysqli_real_escape_string($connect, $_POST['productStock']);

    $targetDir = "";
    $targetFile = $targetDir . basename($_FILES['productImage']['name']);
    move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile);

    $sql = "INSERT INTO product (Product_ID, Product_Name, image, ProductCategory_ID, Product_Description, Product_Price, Product_Stock)
    VALUES ('$productID', '$productName', '$targetFile', '$productCategoryID', '$productDescription', '$productPrice', '$productStock')";

    if (mysqli_query($connect, $sql)) {
        $msg = "Product Added to the database successfully";
    } else {
        $msg = "Failed to add the product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; 
        }

        .container {
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            padding: 30px;
        }

        h2 {
            color: #007bff; 
        }

        .btn-primary {
            background-color: #007bff; 
            border-color: #007bff;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 rounded">
                <h2 class="text-center p-2">Add Product Information</h2>

                <form action="" method="post" class="p-2" enctype="multipart/form-data" id="form-box">
                <div class="form-group">
                        <input type="text" name="productID" class="form-control" placeholder="Product ID" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productName" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productPrice" class="form-control" placeholder="Product Price" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productCategoryID" class="form-control" placeholder="Product Category ID" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productDescription" class="form-control" placeholder="Product Description" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productStock" class="form-control" placeholder="Product Stock" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image:</label>
                        <div class="custom-file">
                            <input type="file" name="productImage" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose Product Image</label>
                        </div>
                    </div>
              
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add">
                    </div>
                    <div class="form-group">
                        <h4 class="text-center"><?= $msg; ?></h4>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3 rounded">
                <a href="productmanagement.php" class="btn btn-warning btn-block btn-lg">Go to product page</a>
                <a href="viewrequest.php" class="btn btn-warning btn-block btn-lg">Go to customer request page</a>
            </div>
        </div>
    </div>
</body>

</html>