<?php
error_reporting(0);
include_once("dbconnect.php");
$userid = $_GET['userid'];
$mobile = $_GET['mobile'];
$amount = $_GET['amount'];
$orderid = $_GET['orderid'];
$status = "paid";
$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
}else{
    $paidstatus = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
 
 
$signed= hash_hmac('sha256', $signing, 'S-wzNn8FTL0endIB4wgi728w');
if ($signed === $data['x_signature']) {
    echo '<body><div><h2><center>Receipt</center></h1><table border=1 width=80% align=center><tr><td>Order id</td><td>'.$orderid.'</td></tr><tr><td>Receipt ID</td><td>'.$receiptid.'</td></tr><tr><td>Email to </td><td>'.$userid. ' </td></tr><td>Amount </td><td>RM '.$amount.'</td></tr><tr><td>Payment Status </td><td>'.$paidstatus.'</td></tr><tr><td>Date </td><td>'.date("d/m/Y").'</td></tr><tr><td>Time </td><td>'.date("h:i a").'</td></tr></table><br><p><center>Press back button to return to Food Ninja</center></p></div></body>';

    if ($paidstatus == "Success"){
        //$sqldelete = "DELETE FROM cart WHERE userid = '$userid'";
        //$conn->query($sqldelete);
        $sqlupdate = "UPDATE cart SET status = '$status' WHERE userid = '$mobile' AND orderid='$orderid'";
        $conn->query($sqlupdate);
        $sqlinsert = "INSERT INTO ordered(orderid,userid,total) VALUES ('$orderid','$mobile','$amount')";
        $conn->query($sqlinsert);
    }
} else {
    echo 'Not Match!';
}

?>