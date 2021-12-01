<?php 
require_once ("DBController.php");
class Customer
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }

    function getAllUser(){
		$sql = "SELECT * FROM tbl_customer ORDER BY user_id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function deleteUser($id){
        $query = "DELETE FROM tbl_customer WHERE user_id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
}
?>