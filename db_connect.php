<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "chatroom";

// creating datbase connection
$conn = mysqli_connect($servername, $username, $password, $database);

// connection check

if(!$conn)           // if not connected, display above message
{
    die("Failed to connect". mysqli_connect_error());
}
else                 // if get connected, display below message
{
    
    
}
?>