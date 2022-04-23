<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();

$user_id = $value->user_id;

//for insert
$sql="SELECT *,COUNT(seat_no) FROM tbl_booking WHERE customer_id=?";
$param_type="i";
$indata=$db->select($sql,$param_type,[$user_id],"Success","Failure");

echo json_encode($indata);

?>