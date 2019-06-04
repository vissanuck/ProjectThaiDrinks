<?php
error_reporting(0);
include_once("dbconnect.php");
$location = $_POST['location'];
if (strcasecmp($location, "All") == 0){
    $sql = "SELECT * FROM restaurant"; 
}else{
    $sql = "SELECT * FROM restaurant WHERE location = '$location'";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response["rest"] = array();
    while ($row = $result ->fetch_assoc()){
        $restlist = array();
        $restlist[restid] = $row["restid"];
        $restlist[name] = $row["name"];
        $restlist[phone] = $row["phone"];
        $restlist[address] = $row["address"];
        $restlist[location] = $row["location"];
        array_push($response["rest"], $restlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}
?>