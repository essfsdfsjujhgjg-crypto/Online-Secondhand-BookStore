

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
    </style>
</head>
<?php
        include("dataconnection2.php");

        $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
        $search_condition = $search != '' ? "WHERE cart.Order_ID LIKE '%$search%' OR Product_Name LIKE '%$search%'" : '';

        $query = "SELECT c_order.*, customer.*, savepayment.* FROM c_order INNER JOIN savepayment ON c_order.Payment_ID = savepayment.Payment_ID INNER JOIN customer ON c_order.Customer_ID = customer.Customer_ID  $search_condition";
        $result = mysqli_query($connect, $query);
        ?>
<body>
    <header>
        <h2>Orders Management</h2>
    </header>
    <?php include("sidebar.php") ?>
    <div class="search-container">
        <form method="GET" action="">
            <input type="search" name="search" class="search-input" placeholder="Search by Order ID or Product Name" value="<?php echo $search; ?>">
            <button type="submit" name="submit-search" class="search-button">Search</button>
        </form>
    </div>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="animate__animated animate__fadeIn">
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Payment ID</th>
                <th>Paid Amount</th>
                <th>Order Status</th>
                <th>Edit</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['Order_ID']; ?></td>
                    <td><?php echo $row['Customer_ID']; ?></td>
                    <td><?php echo $row['Customer_Name']; ?></td>
                    <td><?php echo $row['Payment_ID']; ?></td>
                    <td><?php echo $row['Amount']; ?></td>
                    <td><?php echo $row['Order_Status']; ?></td>
                    <td><a href="orderedit.php?Order_ID=<?php echo $row['Order_ID']; ?>">Edit</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var table = document.querySelector("table");
            table.style.opacity = "1";
            table.style.transform = "translateY(0)";
        });

        function addOrder() {
            window.location.href = 'addorders.php';
        }

        function goBack() {
            window.location.href = 'panel.html';
        }
    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>

