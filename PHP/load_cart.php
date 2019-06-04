<?php
error_reporting(0);
include_once("dbconnect.php");
$userid = $_POST['userid'];

$sql = "SELECT * FROM cart WHERE userid = '$userid' AND status = 'not paid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response["cart"] = array();
    while ($row = $result ->fetch_assoc()){
        $cartlist = array();
        $cartlist[foodid] = $row["foodid"];
        $cartlist[foodname] = $row["foodname"];
        $cartlist[foodprice] = $row["price"];
        $cartlist[quantity] = $row["quantity"];
        $cartlist[status] = $row["status"];
        $cartlist[restid] = $row["restid"];
        $cartlist[orderid] = $row["orderid"];
        array_push($response["cart"], $cartlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}
?>