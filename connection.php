<?php
session_set_cookie_params(0);
session_start();
$servername = "localhost";
$username = "admin";
$password = "12345678";
$dbname = "youngAdventurers";
$con = new mysqli($servername, $username, $password, $dbname) or die(mysqli_error($con));

if ($con->connect_error) 
{
 die("Connection failed: " . $con->connect_error); 
 exit();
}
?>