<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lms';

$con = mysqli_connect($host, $user, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

