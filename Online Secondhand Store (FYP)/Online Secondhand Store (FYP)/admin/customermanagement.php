<?php
include("dataconnection2.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
$search_condition = $search != '' ? "WHERE Customer_ID LIKE '%$search%' OR Customer_Name LIKE '%$search%'" : '';

$query = "SELECT * FROM customer $search_condition";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            background-size: 200px 300px; 
            background-position: right bottom 1px; 
            background-repeat: no-repeat; 
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

        .add-customer-button {
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
        <h2>Customer Management</h2>
    </header>
    <?php include("sidebar.php") ?>

    <form method="GET" action="">
        <input type="search" name="search" placeholder="Search by Customer ID or Name" value="<?php echo $search; ?>">
        <button type="submit" name="submit-search">Search</button>
    </form>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table>
            <tr>
                <th style="background-color: #4CAF50; color: white;">Customer ID</th>
                <th style="background-color: #4CAF50; color: white;">Customer Name</th>
                <th style="background-color: #4CAF50; color: white;">Customer Address</th>
                <th style="background-color: #4CAF50; color: white;">Customer Email</th>
                <th style="background-color: #4CAF50; color: white;">Customer Phone No</th>
                <th style="background-color: #4CAF50; color: white;">Customer Password</th>
                <th style="background-color: #4CAF50; color: white;">Edit</th>
                <th style="background-color: #4CAF50; color: white;">Delete</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Customer_ID']); ?></td>
                    <td><?php echo htmlspecialchars($row['Customer_Name']); ?></td>
                    <td><?php echo htmlspecialchars($row['Customer_Address']); ?></td>
                    <td><?php echo htmlspecialchars($row['Customer_Email']); ?></td>
                    <td><?php echo htmlspecialchars($row['Customer_Phone_No']); ?></td>
                    <td><?php echo htmlspecialchars($row['Customer_Password']); ?></td>
                    <td><a href="customeredit.php?Customer_Name=<?php echo $row['Customer_Name']; ?>">Edit</a></td>
                    <td><a href="customerdelete.php?Customer_Name=<?php echo $row['Customer_Name']; ?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <button class="add-customer-button" onclick="addCustomer()">
        <i class="icon fas fa-user-plus"></i> Add Customer
    </button>

    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                var table = document.querySelector("table");
                table.style.opacity = 1;
                table.style.transform = 'translateY(0)';
            }, 50);
        });

        function addCustomer() {
            window.location.href = 'addcustomer.php';
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