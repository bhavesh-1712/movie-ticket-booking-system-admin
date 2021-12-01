<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();

$user_gmail=$value->gmail;
$password=$value->password;

//for select
$sql="SELECT * FROM tbl_customer WHERE (gmail=? OR mobile_no=?) AND password=?";
$param_type="ss";
$indata=$db->select($sql,$param_type,[$user_gmail,$user_gmail,$password],"User successfully login.","Please provide correct Id and Password.");

echo json_encode($indata);
?>