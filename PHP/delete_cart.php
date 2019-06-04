<?php
error_reporting(0);
include_once("dbconnect.php");
$userid = $_POST['userid'];
$foodid = $_POST['foodid'];
    $sqldelete = "DELETE FROM cart WHERE userid = '$userid' AND foodid='$foodid'";
    if ($conn->query($sqldelete) ===TRUE){
       echo "success";
    }else {
        echo "failed";
    }
?>