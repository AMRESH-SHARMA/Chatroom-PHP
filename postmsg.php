<?php
//Connecting to the database
include'db_connect.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO `msgs` (`sno`, `msg`, `room`, `ip`, `stime`) VALUES (NULL, '$msg', '$room', '$ip', current_timestamp());";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>