<?php
session_start();
include '../configs/PDBC.php';
if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $query = "SELECT * FROM `user` WHERE email='$username' and password='$password'";
    $result = mysqli_query($con, $query) or die();
    // echo $query;
    // die('a');
    while ($row = mysqli_fetch_array($result)) {
        echo $row;
        if ($row["email"] == $username) {
            if ($row["status"] == "active") {
                $_SESSION["LoggedUser"] = $row;
                // Redirect user to index.php
                header("Location: ../home.php");
                exit();
            } else {
                header("Location: ../index.php?msg=". base64_encode("Please wait for admin confirmation!"));
                exit();
            }
        }
    }

    header("Location: ../index.php?msg=". base64_encode("Please try again! Invalid username or password!"));
    exit();
}

