<?php
include("dataconnection2.php");

$query = "SELECT DISTINCT c.Product_ID, p.Product_Name, SUM(c.Quantity * p.Product_Price) AS totalSales
          FROM cart c
          INNER JOIN product p ON c.Product_ID = p.Product_ID
          GROUP BY c.Product_ID";

$result = mysqli_query($connect, $query);

// Check if the query was successful
if (!$result) {
    die("Error in SQL query: " . mysqli_error($connect));
}

$salesData = [
    'labels' => [],
    'data' => []
];

// Fetch data only if the query was successful
while ($row = mysqli_fetch_assoc($result)) {
    $salesData['labels'][] = $row['Product_Name'];
    $salesData['data'][] = $row['totalSales'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart"></canvas>

    <script>
        var salesData = <?php echo json_encode($salesData); ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: salesData.labels,
                datasets: [{
                    label: 'Total Sales',
                    data: salesData.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>

<?php
mysqli_close($connect);
?>
