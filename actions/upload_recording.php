<?php
include '../configs/PDBC.php';

$subject = $_POST['subject'];
$target_dir = "../uploads/";
$target_file = $target_dir . "recording_" . date('YmdHis') . ".mp4";
$uploadOk = 1;

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}


if ($uploadOk == 0) { // Check if $uploadOk is set to 0 by an error
    echo "Sorry, your file was not uploaded.";
} else { // if everything is ok, try to upload file
    if (!is_dir('../uploads')) {
        mkdir($target_dir);
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . $target_file . " has been uploaded.";

        $query1 = "INSERT INTO `recording` VALUES('0','" . substr($target_file, 3) . "','" . $subject . "')";
        mysqli_query($con, $query1) or die();

        header('location: ../recordings.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
