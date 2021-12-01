<?php 
require_once ("DBController.php");
class Admin
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function verifyUser($UserName,$UserPassword){
        $encryptPass = md5($UserPassword);
        $query = "SELECT * FROM tbl_admin WHERE email = ? AND password = ?";
        $paramType = "ii";
        $paramValue = array(
            $UserName,$encryptPass
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getUserById($id){
        $query = "SELECT * FROM tbl_admin WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function updatePassword($id,$UserPassword){
        $encryptPass = md5($UserPassword);
        $query = "UPDATE tbl_admin SET password = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
           $encryptPass,$id
        );
        return $this->db_handle->update($query, $paramType, $paramValue);
    }   
}
?>