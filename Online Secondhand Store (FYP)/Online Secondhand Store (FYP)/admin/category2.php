<?php
include("dataconnection2.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
$search_condition = $search != '' ? "WHERE Product_ID LIKE '%$search%' OR Product_Name LIKE '%$search%'" : '';

$query = "SELECT * FROM product $search_condition WHERE ProductCategory_ID = 2";
$result = mysqli_query($connect, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .product-image {
            max-width: 100px;
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

        input[type="search"] {
            padding: 10px;
            margin: 10px;
            width: 300px;
        }

        button[type="submit-search"] {
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit-search"]:hover {
            background-color: #297fb8;
        }
    </style>
</head>

<body>
    <header>
        <h2>Category->Novels</h2>
    </header>


    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="animate__animated animate__fadeIn">
            <tr>
                <th>Product Category ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Product Stock</th>

            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['ProductCategory_ID']; ?></td>
                    <td><?php echo $row['Product_ID']; ?></td>
                    <td><?php echo $row['Product_Name']; ?></td>
                    <td><img src="image/<?php echo $row['image']; ?>" alt="Product Image" class="product-image"></td>
                    <td><?php echo $row['Product_Price']; ?></td>
                    <td><?php echo $row['Product_Stock']; ?></td>

                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.location.href = 'category.php';
        }
    </script>
</body>

</html>

<?php
mysqli_close($connect);
?>