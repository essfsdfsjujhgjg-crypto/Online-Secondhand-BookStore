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

        .add-orders-button {
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
            width: 300px;
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

        .chart-button {
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

    </style>
</head>

<body>
    <header>
        <h2>Sales Report</h2>
    </header>
    <?php include("sidebar.php") ?>
    <?php
        include("dataconnection2.php");

        $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
        $search_condition = $search != '' ? "WHERE Product_Name LIKE '%$search%'" : '';

        $query = "SELECT c.Product_ID, p.Product_Name, SUM(c.Quantity) AS Total_Quantity, p.Product_Price, SUM(c.Quantity * p.Product_Price) AS Total_Sales
          FROM cart c
          INNER JOIN product p ON c.Product_id = p.Product_ID
          $search_condition
          GROUP BY c.Product_id";

        $result = mysqli_query($connect, $query);

        $productQuantities = []; 

        $totalSales = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $productQuantities[$row['Product_ID']] = $row['Total_Quantity'];
            $totalSales += $row['Total_Sales'];
        }
    ?>

    <div class="search-container">
        <form method="GET" action="">
            <input type="search" name="search" class="search-input" placeholder="Search by Product Name" value="<?php echo $search; ?>">
            <button type="submit" name="submit-search" class="search-button">Search</button>
        </form>
    </div>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="animate__animated animate__fadeIn">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Order Quantity</th>
                <th>Product Price</th>
                <th>Sales</th>
            </tr>
            <?php
           
            mysqli_data_seek($result, 0);
            
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['Product_ID']; ?></td>
                    <td><?php echo $row['Product_Name']; ?></td>
                    <td><?php echo $row['Total_Quantity']; ?></td>
                    <td><?php echo $row['Product_Price']; ?></td>
                    <td><?php echo $row['Total_Sales']; ?></td>
                </tr>
            <?php endwhile; ?>

           
            <tr>
                <td colspan="4" style="text-align: right;"><b>Total Sales:</b></td>
                <td><b><?php echo $totalSales; ?></b></td>
            </tr>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <button class="chart-button" onclick="chart()">
        <i class="fas fa-chart-bar"></i> Chart
    </button>

    <script>

        function chart() {
            window.location.href = 'chart.php';
        }

    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>
