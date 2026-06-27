<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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

        th,
        td {
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

        .add-product-button {
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

        .search-container {
            margin: 20px;
            text-align: left;
        }

        .search-input {
            padding: 10px;
            font-size: 14px;
            width: 300px; /* Adjust the width as needed */
        }

        .search-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <header>
        <h2>Product Management</h2>
    </header>
    <?php include("sidebar.php") ?>
    <?php
        include("dataconnection2.php");

        $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
        $search_condition = $search != '' ? "WHERE Product_ID LIKE '%$search%' OR Product_Name LIKE '%$search%'" : '';

        $query = "SELECT product.*, category.Category_Name FROM product INNER JOIN  category ON ProductCategory_ID = Category_ID $search_condition";
        $result = mysqli_query($connect, $query);
    ?>
    <div class="search-container">
        <form method="GET" action="">
            <input type="search" name="search" class="search-input" placeholder="Search by Product ID or Product Name" value="<?php echo $search; ?>">
            <button type="submit" name="submit-search" class="search-button">Search</button>
        </form>
    </div>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="animate__animated animate__fadeIn">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Product Category ID</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Stock</th>
                <th>Product Status</th>
                <th>Edit</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['Product_ID']; ?></td>
                    <td><?php echo $row['Product_Name']; ?></td>
                    <td><img src="..\user\assets\img\<?php echo $row['image']; ?>" alt="productImage" class="product-image"></td>
                    <td><?php echo $row['Category_Name']; ?></td>
                    <td><?php echo $row['Product_Description']; ?></td>
                    <td><?php echo $row['Product_Price']; ?></td>
                    <td><?php echo $row['Product_Stock']; ?></td>
                    <td><?php if ($row['product_isDelete'] == 0) 
                    echo "Approved";  else 
                    echo "Not Approved"; ?></td>
                    <td><a href="productedit.php?Product_ID=<?php echo $row['Product_ID']; ?>">Edit</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var table = document.querySelector("table");
            table.style.opacity = "1";
            table.style.transform = "translateY(0)";
        });
    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>