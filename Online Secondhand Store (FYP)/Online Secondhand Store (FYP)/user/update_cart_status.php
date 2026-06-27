<?php
include("phpconnect.php");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// 检查是否设置了 POST 请求中的 CartID
if (isset($_POST['CartID'])) {
    $cartID = $_POST['CartID']; // 请替换成您实际的购物车ID

    // 更新购物车状态
    updateCartStatus($connect, $cartID);
} else {
    echo "Error: CartID not set in POST request.";
}

mysqli_close($connect);

function updateCartStatus($connect, $cartID) {


    $cartID = mysqli_real_escape_string($connect, $cartID);
    $update_query = "UPDATE cart SET Is_Purchased = 1 WHERE Cart_ID = '$cartID'";
    
    // 输出调试信息
    echo "Update Query: " . $update_query;

    $result = mysqli_query($connect, $update_query);

    if (!$result) {
        // 输出错误信息并终止脚本
        die("Query failed: " . mysqli_error($connect));
    }
}
?>
