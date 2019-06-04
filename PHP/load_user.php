<?php
error_reporting(0);
include_once("dbconnect.php");
$userid = $_POST['userid'];
$sql = "SELECT * FROM user WHERE phone = '$userid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response["user"] = array();
    while ($row = $result ->fetch_assoc()){
        $userarray = array();
        $userarray[email] = $row["email"];
        $userarray[phone] = $row["phone"];
        $userarray[name] = $row["name"];
        $userarray[location] = $row["location"];
         array_push($response["user"], $userarray);
    }
    echo json_encode($response);
}

?>