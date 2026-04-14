<?php
include("dataconnection2.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $CategoryID = mysqli_real_escape_string($connect, $_POST['Category_ID']);
    $CategoryName = mysqli_real_escape_string($connect, $_POST['Category_Name']);
   
    
    $query = "INSERT INTO category (Category_ID, Category_Name) VALUES ('$CategoryID', '$CategoryName ')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        
        header("Location: addcategory.php");
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
        <h2>Add Category</h2>
    </header>

    <form method="post" action="">
        <label for="Category_ID">Category ID:</label>
        <input type="text" id="Category_ID" name="Category_ID" required>

        <label for="Category_Name">Category Name:</label>
        <input type="Category_Name" id="Category_Name" name="Category_Name" required>
        
        <div class="button-container">
            <button type="submit" class="go-back-button">
                <i class="icon fas fa-user-plus"></i> Add Category
            </button>

            <button type="button" class="go-back-button" onclick="goBack()">
                Go Back
            </button>
        </div>
    </form>

    <script>
        function goBack() {
            window.location.href = 'addcategory.php';
        }
    </script>
</body>
</html>