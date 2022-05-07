<?php

include '../configs/PDBC.php';

$id = $_GET['id'];

$query1 = "SELECT * FROM `exam_result` INNER JOIN `exam` ON (`exam_result`.`idexam` = `exam`.`idexam`) INNER JOIN `student` ON (`exam_result`.`idstudent` = `student`.`idstudent`) INNER JOIN `user` ON (`student`.`iduser` = `user`.`iduser`) WHERE `exam`.`idexam`='" . $id . "'";
$result1 = mysqli_query($con, $query1) or die();

$list = array (array("ID", "NAME" ,"MARKS"));

while ($row = mysqli_fetch_assoc($result1)) {
    array_push($list, array($row['idresult'],$row['name'],"0"));
}

$file = fopen("exam_result_sheet.csv","w");

foreach ($list as $line) {
  fputcsv($file, $line);
}

fclose($file);
