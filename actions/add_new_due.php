<?php

session_start();
include '../configs/PDBC.php';

$user = $_SESSION["LoggedUser"];
$subjectId = $_GET['subject'];
$amount = $_GET['amount'];

$query = "SELECT * FROM student_subjects WHERE idsubject='$subjectId'";
$result = mysqli_query($con, $query) or die();
while ($row = mysqli_fetch_assoc($result)) {
    $studentId = $row["idstudent"];
    $query1 = "SELECT * FROM due_payment WHERE idSubject='$subjectId' AND idStudent='$studentId'";
    $result1 = mysqli_query($con, $query1);

    $query2 = "";
    if (mysqli_num_rows($result1) == 0) {
        $query2 = "INSERT INTO due_payment VALUES ('0','$amount','$studentId','$subjectId')";
    } else {
        $row1 = mysqli_fetch_assoc($result1);
        $prviousAmount = $row1['amount'];
        $newAmount = $prviousAmount + $amount;
        $query2 = "UPDATE due_payment SET amount='$newAmount' WHERE idDuePayment='" . $row1['idDuePayment'] . "'";
    }
    mysqli_query($con, $query2) or die();
}

header("location: ../add_new_due.php");