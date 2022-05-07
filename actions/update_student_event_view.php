<?php

session_start();
include '../configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
}

$user = $_SESSION["LoggedUser"];
if (isset($_GET['eventId'])) {

    $eventId = $_GET['eventId'];

    $query = "SELECT idstudent FROM student WHERE iduser='" . $user['iduser'] . "'";
    $result = mysqli_query($con, $query) or die();
    $rows = mysqli_fetch_array($result);

    $query1 = "SELECT * FROM viewed_event WHERE idscheduled_event='$eventId' AND idstudent='" . $rows[0][0] . "'";
    $result1 = mysqli_query($con, $query1) or die();
    $rowcount = mysqli_num_rows($result1);
    if ($rowcount == 0) {
        // idviewed_event  idscheduled_event  idstudent  date    time
        $query2 = "INSERT INTO `viewed_event` VALUES('0','$eventId','" . $rows[0][0] . "','" . date("Y-m-d") . "','" . date("h:m A") . "')";
        if (mysqli_query($con, $query2) or die()) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}