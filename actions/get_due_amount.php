<?php
include '../configs/PDBC.php';

$studentId = $_GET['student'];
$subjectId = $_GET['subject'];

$query = "SELECT SUM(amount) AS total FROM `payroll` WHERE idStudent='$studentId' AND idSubject='$subjectId'";
$result = mysqli_query($con, $query) or die();
$row = mysqli_fetch_assoc($result);

$totalAmount = $row["total"];

$query1 = "SELECT amount FROM due_payment WHERE idStudent='$studentId' AND idSubject='$subjectId'";
$result1 = mysqli_query($con, $query1) or die();
$row1 = mysqli_fetch_assoc($result1);

$totalDue = $row1["amount"];

$subTotal = $totalDue - $totalAmount;

echo $subTotal;