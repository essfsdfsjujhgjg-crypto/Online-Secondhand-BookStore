<?php
include("dataconnection2.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
$search_condition = $search != '' ? "WHERE Product_Name LIKE '%$search%'" : '';

$query = "SELECT * FROM request $search_condition";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
          body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            background-size: 200px 200px; 
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

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }

        .approve-button {
        background-color: blue;
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
       }

       .approve-button:hover {
        background-color: darkblue; 
     }

    </style>
</head>

<body>
    <header>
        <h2>Customer add product requests</h2>
    </header>

    <?php include("sidebar.php") ?>

    <div class="search-container">
        <form method="GET" action="">
            <input type="search" name="search" class="search-input" placeholder="Search by Product Name" value="<?php echo $search; ?>">
            <button type="submit" name="submit-search" class="search-button">Search</button>
        </form>
    </div>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="animate__animated animate__fadeIn">
            <tr>

                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Email</th>
                <th>Phone Number</th>
                
       
                <th>Delete</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                   
                    <td><?php echo $row['Customer_ID']; ?></td>
                    <td><?php echo $row['Product_ID']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Phone_No']; ?></td>
                    
                    

                    <td><a href="customerrequestdelete.php?Product_ID=<?php echo $row['Product_ID']; ?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <div class='no-records'>No records found.</div>
    <?php endif; ?>

    <button class="add-product-button" onclick="addProduct()">
        <i class="fas fa-list"></i> Product
    </button>
    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var table = document.querySelector("table");
            table.style.opacity = "1";
            table.style.transform = "translateY(0)";
        });

        function addProduct() {
            window.location.href = 'productmanagement.php';
        }

        function goBack() {
            window.location.href = 'panel.html';
        }

        function approveProduct(button, productName, image, description, price, quantity) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'approveproduct.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                button.innerText = 'Approved';
                button.disabled = true; 
            } else {
                console.error(response.message);
            }
        }
    };
    xhr.send('productName=' + productName + '&image=' + image + '&description=' + description + '&price=' + price + '&quantity=' + quantity);
   }

    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>