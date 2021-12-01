<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();

$userId=$value->user_id;
$seatNo = $value->seat_no;
$slotId=$value->slot_id;
$movieId=$value->movie_id;
$date = date('Y-m-d');

//for insert
$sql="INSERT INTO tbl_booking(seat_no, time_slot, customer_id, movie_id, date) VALUES (?,?,?,?,?)";
$param_type="sssss";
$indata=$db->insert($sql,$param_type,[$seatNo,$slotId,$userId,$movieId,$date],"Seat Booked","Operation failed, Please try again.");

echo json_encode($indata);

?>