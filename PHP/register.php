<?php

error_reporting(0);
include_once("dbconnect.php");

$name = $_POST['name'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$location = $_POST['location'];
$email = $_POST['email'];
$password = $_POST['password'];

if (strlen($email) > 0)
{
    $sqlinsert = "INSERT INTO user(name, phone, age, location, email, password) VALUES('$name', '$phone', '$age', '$location', '$email', '$password')";

    if (mysqli_query($conn,$sqlinsert))
    {
       echo "success";
    }
    else
    {
        echo "failed";
    }
}
else
{
    echo "nodata";
}

?>