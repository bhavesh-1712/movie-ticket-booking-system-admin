<?php
header('Content-Type: application/json; charset=utf-8');
include "class/config.php";
$value = json_decode(file_get_contents('php://input'));
$db=new DBController();

$user_name=$value->user_name;
$gmail=$value->gmail;
$mobile=$value->mobile;
$password=$value->password;

//for insert
$sql="INSERT INTO tbl_customer(user_name, gmail, mobile_no, password) VALUES (?,?,?,?)";
$param_type="ssis";
$indata=$db->insert($sql,$param_type,[$user_name,$gmail,$mobile,$password],"User has been registered.","Operation failed, Please try again.");

$data=[];
if($indata){
    $data['status']=TRUE;
    $data['data']=$indata;
    $data['message']="Selected information is...";
}else{
    $data['status']=TRUE;
    $data['data']=[];
    $data['message']="Something went wrong.";
}

echo json_encode($data);

?>