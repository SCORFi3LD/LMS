<?php

include '../configs/PDBC.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $query1 = "DELETE FROM `student_subjects` WHERE idstudent='$id'";
    mysqli_query($con, $query1) or die();

    foreach ($_POST['subjects'] as $subject) {
        $query1 = "INSERT INTO `student_subjects` VALUES('0','$id','$subject')";
        mysqli_query($con, $query1) or die();
    }   
}

header("location: ../verify_students.php");