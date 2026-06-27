<?php
include("dataconnection2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productName = mysqli_real_escape_string($connect, $_POST['productName']);
    $image = mysqli_real_escape_string($connect, $_POST['image']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $price = mysqli_real_escape_string($connect, $_POST['price']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);

   
    $insertQuery = "INSERT INTO product (Product_Name, Image, Product_Description, Product_Price, Product_Stock)
                    VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connect, $insertQuery);

    
    mysqli_stmt_bind_param($stmt, "sssss", $productName, $image, $description, $price, $quantity);

   
    if (mysqli_stmt_execute($stmt)) {
        
        $productId = mysqli_insert_id($connect);

        $response = array(
            'status' => 'success',
            'message' => "Product approved and added to the product table with Product_ID: $productId."
        );
    } else {
        
        $response = array(
            'status' => 'error',
            'message' => "Error: " . mysqli_error($connect)
        );
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Prepare JSON response for invalid request
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request.'
    );
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($connect);
?>