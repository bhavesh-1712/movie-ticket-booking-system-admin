<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();


$sql="SELECT * FROM tbl_movie ORDER BY id";
$indata=$db->selectAll($sql,"Selected information is.","Operartion failed, try again.");

echo json_encode($indata);
?>