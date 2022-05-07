<?php
session_start();
include '../configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION["LoggedUser"];
if (isset($_POST['password']) && isset($_POST['confirm'])) {

    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    if($confirm != $password){
        header("location: ../profile.php?err=PasswordDoesntMatch");
        exit();
    }
    
    $query1 = "UPDATE `user` SET password='$password' WHERE iduser='".$user['iduser']."'";
    $update = mysqli_query($con, $query1) or die();
    if($update){
        $_SESSION['LoggedUser']['password'] = $password;
    }
}

header("location: ../profile.php");