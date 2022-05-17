<?php

include '../configs/PDBC.php';

if (isset($_GET['subject'])) {

    $subject = $_REQUEST['subject'];
    // idsubject  subjectname  status 
    $query0 = "INSERT INTO `subject` VALUE('0','$subject','active')";
    mysqli_query($con, $query0) or die();

    $query = "SELECT idsubject FROM `subject` where status='active' ORDER BY idsubject DESC";
    $result = mysqli_query($con, $query) or die();
    if ($row = mysqli_fetch_array($result)) {

        // idlecturer  iduser  idsubject
        $query2 = "INSERT INTO `lecturer` VALUE('0','1','$row[0]')";
        mysqli_query($con, $query2) or die();
    }
}

header("location: ../register_subjects.php");