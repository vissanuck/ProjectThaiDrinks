<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_POST['email'];
$oldpass = $_POST['key'];
$newpassword =$_POST['newpass'];
 $sqlupdate = "UPDATE user SET password = '$newpassword' WHERE email = '$email' AND password = '$oldpass'";
  if ($conn->query($sqlupdate) === TRUE){
        echo "<font color='purple'><h2><br><br>SUCCESS. PLEASE LOGIN USING NEW PASSWORD</h2></font>";
  }else{
      echo "<font color='red'><h2><br><br>FAILED!!!</h2></font>";;
  }

 
?>