<?php
include '../configs/PDBC.php';

$recId = $_GET['recId'];

$query = "SELECT * FROM recording WHERE idrecording='$recId'";
$result = mysqli_query($con, $query) or die();
$row = mysqli_fetch_assoc($result);

$filePath = "../". $row['urlstring'];
echo $filePath;
if (file_exists($filePath)){
    unlink($filePath);
}

$query1 = "DELETE FROM recording WHERE idrecording='$recId'";
$result1 = mysqli_query($con, $query1) or die();

header('location: ../recordings.php');