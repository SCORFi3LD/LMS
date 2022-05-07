<?php
session_start();
include '../configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION["LoggedUser"];
if (isset($_POST['name'])) {

    $name = $_POST['name'];

    $query1 = "UPDATE `user` SET name='$name' WHERE iduser='".$user['iduser']."'";
    $update = mysqli_query($con, $query1) or die();
    if($update){
        $_SESSION['LoggedUser']['name'] = $name;
    }
}

header("location: ../profile.php");
