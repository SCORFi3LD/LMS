<?php

include '../configs/PDBC.php';

$subjectId = $_POST['subject'];
$msg = $_POST['msg'];

$query = "INSERT INTO notification VALUES ('0','$msg')";
$result = mysqli_query($con, $query) or die();

$query0 = "SELECT * FROM notification WHERE notif='$msg'";
$result0 = mysqli_query($con, $query0) or die();
$row = mysqli_fetch_assoc($result0);

$query1 = "SELECT * FROM student_subjects WHERE idsubject='$subjectId'";
$result1 = mysqli_query($con, $query1) or die();
while ($row1 = mysqli_fetch_assoc($result1)) {
    $query2 = "INSERT INTO unread_notification VALUES ('0','" . $row["idnotification"] . "','" . $row1["idstudent"] . "','active')";
    mysqli_query($con, $query2) or die();
}

header("location: ../create_announcements.php");
