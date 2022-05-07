<?php

include '../configs/PDBC.php';

$idNotif = $_GET['unreadnotification'];
$query = "UPDATE `unread_notification` SET status='read' WHERE idunreadnotification='$idNotif'";
mysqli_query($con, $query) or die();

header("location: ../home.php");