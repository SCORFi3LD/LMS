<?php
include '../configs/PDBC.php';

$examID = $_POST['id'];
$tmpName = $_FILES['csv']['tmp_name'];
$csvAsArray = array_map('str_getcsv', file($tmpName));

foreach ($csvAsArray as $key=>$array) {
    if($key != "0"){
        $query = "UPDATE exam_result SET marks='" . $array[2] . "' WHERE idresult='" . $array[0] . "'";
        mysqli_query($con, $query) or die();
    }
}

$query1 = "UPDATE exam SET examstatus='done' WHERE idexam='" . $examID . "'";
mysqli_query($con, $query1) or die();

header('location: ../manage_exam_results.php');
