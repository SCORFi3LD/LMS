<?php

session_start();
include '../configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
}

$user = $_SESSION["LoggedUser"];

if (isset($_POST['name']) &&
        isset($_POST['msg']) &&
        isset($_POST['url']) &&
        isset($_POST['date']) &&
        isset($_POST['start']) &&
        isset($_POST['end'])) {

    $name = $_REQUEST['name'];
    $msg = $_REQUEST['msg'];
    $url = $_REQUEST['url'];
    $date = $_REQUEST['date'];
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];

    $query = "SELECT * FROM lecturer WHERE iduser='" . $user['iduser'] . "' LIMIT 1";
    $result = mysqli_query($con, $query) or die();
    $row = mysqli_fetch_assoc($result);
    if (count($row) > 0) {
        $query1 = "INSERT INTO `scheduled_event` VALUES('0','" . $row['idlecturer'] . "','" . $row['idsubject'] . "','$name','$msg','$url','$date','$start','$end','active')";
        mysqli_query($con, $query1) or die();
    }
}

header("location: ../create_event.php");
