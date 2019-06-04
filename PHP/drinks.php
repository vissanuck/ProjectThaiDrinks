<?php
error_reporting(0);
include_once("dbconnect.php");
$restid = $_POST['restid'];

$sql = "SELECT * FROM drink WHERE restid = '$restid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response["food"] = array();
    while ($row = $result ->fetch_assoc()){
        $foodlist = array();
        $foodlist[foodid] = $row["foodid"];
        $foodlist[foodname] = $row["foodname"];
        $foodlist[foodprice] = $row["foodprice"];
        $foodlist[quantity] = $row["quantity"];
        array_push($response["food"], $foodlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}
?>