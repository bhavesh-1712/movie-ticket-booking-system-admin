<?php
class DBController{
    private $con;
    public $queryObject;
    
    private $host = "localhost";
    // private $user = "root";
    // private $password = "";
    // private $database = "movie_ticket_booking";

    private $user = "u799378581_movie_booking";
    private $password = "MovieBooking@2021";
    private $database = "u799378581_movie_booking";
    
    function __construct() {
        $this->con = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $this->queryObject="NO";
    }   
    function bindQueryParamsExecute($sql, $param_type, $param_value_array) {
        //Prepared Query
        $this->queryObject=$this->con->prepare($sql);

        //Binding Parameter
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $this->queryObject,
            'bind_param'
        ), $param_value_reference);
        
        //Execute Query
        $this->queryObject->execute();
    }

    function setSelectData($successMessage,$failMessage){
        $listOfData=$this->queryObject->get_result()->fetch_all(MYSQLI_ASSOC); // fetch an array of rows
        if (count( $listOfData)>0) {
                $returnData['status']=TRUE;
                $returnData['data']=$listOfData;
                $returnData['message']=$successMessage;
        } else {
            $returnData['status']=FALSE;
            $returnData['data']=[];
            $returnData['message']=$failMessage;
        }
        $this->queryObject->close();
        return $returnData;
    }
    function setUpdateDeleteData($successMessage,$failMessage){
        if ($this->queryObject->affected_rows>0) {
            $returnData['status']=TRUE;
            $returnData['data']=[];
            $returnData['message']=$successMessage;
        } else {
            $returnData['status']=FALSE;
            $returnData['data']=[];
            $returnData['message']=$failMessage;
        }
        $this->queryObject->close();
        return $returnData;
    }
    function setInsertData($successMessage,$failMessage){
        if ($this->queryObject->affected_rows>0) {
            $returnData['status']=TRUE;
            $returnData['data']=["insertedId"=>$this->queryObject->insert_id];
            $returnData['message']=$successMessage;
        } else {
            $returnData['status']=FALSE;
            $returnData['data']=[];
            $returnData['message']=$failMessage;
        }
        $this->queryObject->close();
        return $returnData;
    }

    function insert($sql,$param_types,$param_values,$successMessage,$failMessage){
        $this->bindQueryParamsExecute($sql, $param_types, $param_values);
        return $this->setInsertData($successMessage,$failMessage);
    }

    function update($sql,$param_types,$param_values,$successMessage,$failMessage){
        $this->bindQueryParamsExecute($sql, $param_types, $param_values);
        return $this->setUpdateDeleteData($successMessage,$failMessage);
    }

    function delete($sql,$param_types,$param_values,$successMessage,$failMessage){
        $this->bindQueryParamsExecute($sql, $param_types, $param_values);
        return $this->setUpdatedeleteData($successMessage,$failMessage);
    }

    function select($sql,$param_types,$param_values,$successMessage,$failMessage){
        $this->bindQueryParamsExecute($sql, $param_types, $param_values);
        return $this->setSelectData($successMessage,$failMessage);
    }

    function selectAll($sql,$successMessage,$failMessage){
        $this->queryObject=$this->con->prepare($sql);
        $this->queryObject->execute();
        return $this->setSelectData($successMessage,$failMessage);
    }
}




// $db=new DBController($con);
//for insert
// $sql="INSERT INTO users(user_name,user_contactNo,user_mail) VALUES (?,?,?)";
// $param_type="sis";
// $var=$db->insert($sql,$param_type,["AMol",258963,"abc@gmail.com"],"success full","failed");

//for select with parameter
// $sql="SELECT * FROM users WHERE user_id=?";
// $param_type="i";
// $var=$db->select($sql,$param_type,[3],"success full","failed");

//for select without parameter OR select All
// $sql="SELECT * FROM users";
// $var=$db->selectAll($sql,"success full","failed");

//for Update
// $sql="UPDATE users SET user_name=?,user_contactNo=?,user_mail=? WHERE user_Id=?";
// $param_type="sssi";
// $var=$db->update($sql,$param_type,["rahul",852365,"ccc@gmail.com",1],"success full","failed");


//for Delete
// $sql="DELETE FROM users WHERE user_Id=?";
// $param_type="i";
// $var=$db->delete($sql,$param_type,[18],"success full","failed");







// var_dump($var);
class UploadFile {
  function uploadFile1($path,$fileTypes,$fileSize,$file) {
     $dummyPath= uniqid().basename($_FILES["file1"]["name"]);
    $target_file = $path.$dummyPath;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(FALSE==array_search($imageFileType,$fileTypes)){
      $returnData['status']=FALSE;
      $returnData['message']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      return $returnData;
    }
    // Check file size
    if ($_FILES["file1"]["size"] > ($fileSize*1000)) {
      $returnData['status']=FALSE;
      $returnData['message']="file Size Must less than ".$fileSize."KB";
      return $returnData;
    }
    if(move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file)) {
        $returnData['status']=TRUE;
        $returnData['data']=["fileURL"=>$dummyPath];
        $returnData['message']="The file ". htmlspecialchars( basename( $_FILES["file1"]["name"])). " has been uploaded.";
        return $returnData;
      } else {
        $returnData['status']=FALSE;
        $returnData['message']="Sorry, there was an error uploading your file.";
        return $returnData;
      }
  }
    function get_name() {
      return $this->name;
    }
    function deleteFile($file_pointer){
        if (!unlink($file_pointer)) {
          $returnData['status']=true;
          $returnData['data']=["fileURL"=>$file_pointer];
          $returnData['message']="File has been deleted.";
          return $returnData;
        }
        else {
          $returnData['status']=false;
          $returnData['data']=["fileURL"=>$file_pointer];
          $returnData['message']="File has not been deleted.";
          return $returnData;
        }

    }
}
?>