<?php

include '../configs/PDBC.php';

if (isset($_GET['subject'])) {

    $subject = $_REQUEST['subject'];
    // idsubject  subjectname  status 
    $query1 = "INSERT INTO `subject` VALUE('0','$subject','active')";
    mysqli_query($con, $query1) or die();

    // idlecturer  iduser  idsubject
    $query2 = "INSERT INTO `subject` VALUE('0','1','$subject')";
    mysqli_query($con, $query2) or die();
}

header("location: ../register_subjects.php");