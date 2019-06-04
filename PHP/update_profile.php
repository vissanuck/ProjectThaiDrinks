<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$oldpassword = $_POST['opassword'];
$newpassword = $_POST['npassword'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$location = $_POST['newloc'];

$sqlcheck = "SELECT * FROM user WHERE phone = '$phone' AND password = '$oldpassword'";
$result = $conn->query($sqlcheck);
if ($result->num_rows > 0) {
 $sqlupdate = "UPDATE user SET email = '$email', password = '$newpassword', name = '$name', location = '$location' WHERE phone = '$phone' AND password = '$oldpassword'";
  if ($conn->query($sqlupdate) === TRUE){
        echo 'success';
  }else{
      echo 'failed';
  }   
}else{
    echo "failed";
}

 
?>