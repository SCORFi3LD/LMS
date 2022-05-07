<?php
include '../configs/PDBC.php';

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query1 = "UPDATE `scheduled_event` SET eventstatus='ended' WHERE idscheduled_event='$id'";
    $update = mysqli_query($con, $query1) or die();
    if ($update) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}