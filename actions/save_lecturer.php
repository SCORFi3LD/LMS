<?php

include '../configs/PDBC.php';

if (isset($_GET['name']) &&
        isset($_GET['subject']) &&
        isset($_GET['email']) &&
        isset($_GET['password']) &&
        isset($_GET['confirmpassword'])) {
    
    $name = $_REQUEST['name'];
    $subject = $_REQUEST['subject'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirmpassword = $_REQUEST['confirmpassword'];
    
    if ($confirmpassword != $password) {
        header("location: ../create_lecturer.php");
        exit();
    }
    
    // check mail exist
    $flag = false;
    $query = "SELECT * FROM `user` WHERE email='$email'";
    $result = mysqli_query($con, $query) or die();
    while ($row = mysqli_fetch_array($result)) {
        if ($row["email"] == $email) {
           $flag = true;
        }
    }
    if ($flag) {
        header("location: ../create_lecturer.php");
        exit();
    }
    
    $query1 = "INSERT INTO `user` VALUE('0','$email','$password','$name','lecturer','active')";
    mysqli_query($con, $query1) or die();
    $query2 = "SELECT iduser FROM `user` WHERE email='$email'";
    $result1 = mysqli_query($con, $query2) or die();
    $rows = mysqli_fetch_array($result1);
    $query3 = "INSERT INTO `lecturer` VALUE('0','".$rows[0][0]."','$subject')";
    mysqli_query($con, $query3) or die();
    
    
}

header("location: ../create_lecturer.php");