<?php

$servername = "localhost";
$username   = "githubbe_vissanuck";
$password   = "3Gh(M!ac(~sQ";
$dbname     = "githubbe_thaidrinks";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error)
{
    die("Connection failed: " . $conn -> connect_error);
}


?>
