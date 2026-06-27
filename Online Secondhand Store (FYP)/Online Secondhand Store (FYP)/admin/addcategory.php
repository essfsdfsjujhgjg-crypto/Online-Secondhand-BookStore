<?php
include("dataconnection2.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
$search_condition = $search != '' ? "WHERE Category_ID LIKE '%$search%'" : '';

$query = "SELECT * FROM category $search_condition";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: center;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:first-child {
            background-color: #3498db;
            color: white;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .go-back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3498db; 
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .add-category-button {
            position: fixed;
            bottom: 20px;
            right: 150px; 
            background-color: #FFD700;
            color: white;
            padding: 15px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .icon {
            margin-right: 8px;
        }

        table.animated {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        table.animated.show {
            opacity: 1;
            transform: translateY(0);
        }

        input[type="text"] {
            padding: 10px;
            margin: 10px;
            width: 300px; 
        }

        button[type="submit"] {
            padding: 12px;
            background-color: #ff4d4d; 
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #ff1a1a; 
        }
        
    </style>
</head>
<body>
    <header>
        <h2>Categories</h2>
    </header>

    <?php include("sidebar.php") ?>

    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <table class="animated">
            <tr>
                <th style="background-color: #4CAF50; color: white;">Category Id</th>
                <th style="background-color: #4CAF50; color: white;">Category Name</th>
    
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['Category_ID']; ?></td>
                    <td><?php echo $row['Category_Name']; ?></td>

             
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<div class='no-records'>No records found.</div>";
    }

    mysqli_close($connect);
    ?>

    <button class="add-category-button" onclick="addCategory()">
        <i class="icon fas fa-user-plus"></i> Add Category
    </button>

    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        function addCategory() {
            window.location.href = 'addingcategory.php';
        }

        function goBack() {
            window.location.href = 'panel.html';
        }

        window.onload = function() {
            var table = document.querySelector("table.animated");
            table.classList.add("show");
        };

    </script>
</body>
</html>