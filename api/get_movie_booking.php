<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();

$movie_id = $value->movie_id;
$time_slot_id = $value->time_slot_id;
$date = date('Y-m-d');

//for insert
$sql="SELECT * FROM tbl_customer WHERE movie_id=? AND time_slot=? AND date=?";
$param_type="iis";
$indata=$db->select($sql,$param_type,[$movie_id,$time_slot_id,$date],"Success","Failure");

echo json_encode($indata);

?>