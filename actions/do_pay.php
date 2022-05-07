<?php
include '../configs/PDBC.php';

$studentId = $_GET['student'];
$subjectId = $_GET['subject'];
$amount = $_GET['amount'];

$query = "INSERT INTO payroll VALUES ('0','$amount','$studentId','$subjectId')";
mysqli_query($con, $query) or die();

header("location: ../do_payment.php");