<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Categories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
            animation: fadeIn 1s ease-in-out;
            font-family: 'Arial', sans-serif;
            background-image: url('image/gojo.png'); 
            background-size: 600px 550px; 
            background-position: left top 250px; 
            background-repeat: no-repeat; 
        }
        
   
        header {
            font-family: "Montserrat", sans-serif;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .category-button {
            display: inline-block;
            padding: 20px 40px;
            font-size: 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #4B70E2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .category-button i {
            margin: 0; /* Adjust as needed */
        }

        .category-button:hover {
            background-color: darkblue;
        }

        .add-category-button {
            display: inline-block;
            padding: 20px 40px;
            font-size: 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745; /* Green color, you can change it */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-category-button i {
            margin: 0; /* Adjust as needed */
        }

        .add-category-button:hover {
            background-color: #218838; /* Darker green on hover, you can change it */
        }

        .go-back-button i {
            margin-right: 10px;
        }

        .go-back-button:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>

    <header>
        <h1>Book Categories</h1>
    </header>

    <a href="category1.php" class="category-button">
        <i class="fas fa-book-open"></i> Comics
    </a>
    <a href="category2.php" class="category-button">
        <i class="fas fa-book"></i> Novels
    </a>
    <a href="category3.php" class="category-button">
        <i class="fas fa-rocket"></i> Science Fiction
    </a>

    <a href="addcategory.php" class="add-category-button">
        <i class="fas fa-plus"></i> Add Category
    </a>

    <a href="panel.html" class="go-back-button">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>

</body>
</html>