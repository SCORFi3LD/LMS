<?php

session_start();
include '../configs/PDBC.php';

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $confirm_password = stripslashes($_REQUEST['confirm_password']);
    $confirm_password = mysqli_real_escape_string($con, $confirm_password);


    $msg = "";
    // check password equals
    if ($password != $confirm_password) {
        $msg = "Password not matching!";
    }
    if ($msg != "") {
        header("location: ../create-account.php?msg=" . base64_encode($msg));
        exit();
    }

    // check mail exist
    $query = "SELECT * FROM `user` WHERE email='$username'";
    $result = mysqli_query($con, $query) or die();
    while ($row = mysqli_fetch_array($result)) {
        if ($row["email"] == $username) {
            $msg = "User already exist!";
        }
    }
    if ($msg != "") {
        header("location: ../create-account.php?msg=" . base64_encode($msg));
        exit();
    }

    // register as student
    $query1 = "INSERT INTO `user` VALUE('0','$username','$password','$username','student','pending')";
    mysqli_query($con, $query1) or die();
    $query2 = "SELECT iduser FROM `user` WHERE email='$username'";
    $result1 = mysqli_query($con, $query2) or die();
    $rows = mysqli_fetch_array($result1);
    $query3 = "INSERT INTO `student` VALUE('0','" . $rows[0][0] . "')";
    mysqli_query($con, $query3) or die();

    $msg = "Successfuly registered! Please wait for admin confirmation!";
    if ($msg != "") {
        header("location: ../create-account.php?msg=" . base64_encode($msg) . "&success=1");
        exit();
    }
}