<?php
include '../configs/PDBC.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query1 = "UPDATE `user` SET status='$status' WHERE iduser='$id'";
    $update = mysqli_query($con, $query1) or die();
    if ($update) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}