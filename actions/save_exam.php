<?php

session_start();
include '../configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
}

$user = $_SESSION["LoggedUser"];

if (isset($_POST['subject']) &&
        isset($_POST['topic']) &&
        isset($_POST['date']) &&
        isset($_POST['start']) &&
        isset($_POST['end'])) {

    $subject = $_REQUEST['subject'];
    $topic = $_REQUEST['topic'];
    $date = $_REQUEST['date'];
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];

    // idexam idsubject exam_title date start end examstatus
    $query = "INSERT INTO `exam` VALUES('0','$subject','$topic','$date','$start','$end','active')";
    mysqli_query($con, $query) or die();

    $query1 = "SELECT idexam FROM exam WHERE idsubject='$subject' AND date='$date' AND start='$start'";
    $result1 = mysqli_query($con, $query1) or die();
    $examId = mysqli_fetch_assoc($result1)['idexam'];

    $query2 = "SELECT * FROM `student_subjects` INNER JOIN `student` ON (`student_subjects`.`idstudent` = `student`.`idstudent`) WHERE idsubject='$subject'";
    echo $query2;
    $result2 = mysqli_query($con, $query2) or die();
    while($row = mysqli_fetch_assoc($result2)){
        // idresult idexam idstudent marks
        $query3 = "INSERT INTO exam_result VALUES('0','" . $examId . "','" . $row['idstudent'] . "','0')";
        mysqli_query($con, $query3);
    }
}

header("location: ../create_exam.php");
