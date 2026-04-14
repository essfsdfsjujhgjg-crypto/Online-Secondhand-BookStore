<?php
include("dataconnection2.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
$search_condition = $search != '' ? "WHERE username LIKE '%$search%'" : '';


$totalAdminsQuery = "SELECT COUNT(DISTINCT username) as totalAdmins FROM admin $search_condition";
$totalAdminsResult = mysqli_query($connect, $totalAdminsQuery);
$totalAdminsData = mysqli_fetch_assoc($totalAdminsResult);
$totalAdmins = $totalAdminsData['totalAdmins'];


header('Content-Type: application/json');
echo json_encode(['totalAdmins' => $totalAdmins]);
?>