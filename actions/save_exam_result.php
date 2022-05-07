<?php

include '../configs/PDBC.php';
$state = "";
$examID = $_GET['id'];
$arr = json_decode($_GET['json'], true);
for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i]['value'] == '') {
        $state = 'fail';
        break;
    }
}

if ($state != "fail") {
    for ($i = 0; $i < count($arr); $i++) {
        $query = "UPDATE exam_result SET marks='" . $arr[$i]['value'] . "' WHERE idresult='" . $arr[$i]['name'] . "'";
        mysqli_query($con, $query) or die();
    }
    $query1 = "UPDATE exam SET examstatus='done' WHERE idexam='" . $examID . "'";
    mysqli_query($con, $query1) or die();
    $state = "success";
}

echo $state;
