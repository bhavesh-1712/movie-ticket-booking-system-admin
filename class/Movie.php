<?php 
require_once ("DBController.php");
class Movie
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }

    function getDashboardData(){
        $data = [];
        $sql = "SELECT COUNT(*) FROM tbl_movie";
        $result = $this->db_handle->runBaseQuery($sql);
        $data['totalMovie'] = $result[0]['COUNT(*)'];

        $sql = "SELECT COUNT(*) FROM tbl_customer";
        $result = $this->db_handle->runBaseQuery($sql);
        $data['totalCustomer'] = $result[0]['COUNT(*)'];

        $sql = "SELECT COUNT(*) FROM tbl_slot";
        $result = $this->db_handle->runBaseQuery($sql);
        $data['totalSlot'] = $result[0]['COUNT(*)'];

        $sql = "SELECT movie_charges,COUNT(*) FROM tbl_movie,tbl_booking WHERE tbl_movie.id=tbl_booking.movie_id;";
        $result = $this->db_handle->runBaseQuery($sql);
        $data['totalIncome'] =  $result[0]['movie_charges'] * $result[0]['COUNT(*)'];

        return $data;
    }

    function getBookingDataByMovie(){
        $data = [];
        // all Movie
        $sql = "SELECT * FROM tbl_movie ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        $data['movie'] = $result;
        // all Time slot
        $sql = "SELECT * FROM tbl_slot";
        $result = $this->db_handle->runBaseQuery($sql);
        $slotData = $result;
        
        $returnData=[];
        $i=0;
        foreach($data['movie'] as $movie){
            foreach($slotData as $slot){
                $sql = "SELECT * FROM tbl_booking where movie_id=".$movie['id']." AND time_slot=".$slot['id'].";";
                $result = $this->db_handle->runBaseQuery($sql);
                $movie['booking_data'] [$slot['id']]= $result;
             }
             $returnData[]=$movie;
        }
        return $returnData;
    }

    function addMovie($movieName,$movieDetails,$movieCharges,$movieImage){
        $query = "INSERT INTO tbl_movie(movie_name, movie_details, movie_charges, movie_image)values(?,?,?,?)";
        $paramType = "ssis";
        $paramValue = array(
            $movieName, $movieDetails, $movieCharges, $movieImage
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function getAllMovie(){
		$sql = "SELECT * FROM tbl_movie ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function deleteMovie($id){
        $query = "DELETE FROM tbl_movie WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function addSlot($startTime, $endTime){
        $query = "INSERT INTO tbl_slot(start_time, end_time)values(?,?)";
        $paramType = "ii";
        $paramValue = array(
            $startTime, $endTime
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function getAllSlots(){
        $sql = "SELECT * FROM tbl_slot ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function deleteSlot($id){
        $query = "DELETE FROM tbl_slot WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function getMainCategoryById($id){
		$query = "SELECT * FROM category_main WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
	}

    function updateMainCategoryName($id,$categoryName){
        $query = "UPDATE category_main SET category_name = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
           $categoryName ,$id
        );
        
        return $this->db_handle->update($query, $paramType, $paramValue);
    }

    function updateMainCategory($id,$categoryName,$categoryImg){
        $query = "UPDATE category_main SET category_name = ?,category_img = ? WHERE id = ?";
        $paramType = "ssi";
        $paramValue = array(
           $categoryName,$categoryImg ,$id
        );
        
        return $this->db_handle->update($query, $paramType, $paramValue);
    }
    


    function addSubCategory($mainCatId,$categoryName,$mentorName,$description,$price){
        $query = "INSERT INTO category_sub(sub_cat_name, mentor, description, price, ref_main_cat_id)values(?,?,?,?,?)";
        $paramType = "sssss";
        $paramValue = array(
            $categoryName,$mentorName,$description,$price,$mainCatId
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function getAllSubCategory(){
		$sql = "SELECT * FROM category_sub ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function getSubCategoryById($id){
		$query = "SELECT * FROM category_sub WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
	}

    function deleteCategorySub($id){
        $query = "DELETE FROM category_sub WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function addVideo($mainCatId,$subCatId,$description,$filePath){
        $query = "INSERT INTO course_video(main_cat_id,sub_cat_id,description,video_path)values(?,?,?,?)";
        $paramType = "ssss";
        $paramValue = array(
            $mainCatId,$subCatId,$description,$filePath
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function updateVideo($id,$videoFilePath){
        $query = "UPDATE course_video SET video_path = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
           $videoFilePath,$id
        );
        
        return $this->db_handle->update($query, $paramType, $paramValue);
    }
   
    function getAllVideos(){
		$sql = "SELECT * FROM course_video ORDER BY main_cat_id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function getVideosById($id){
		$query = "SELECT * FROM course_video WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
	}

    function deleteVideo($id){
        $query = "DELETE FROM course_video WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function getSalesReports(){
        $sql = "SELECT * FROM purchased_course ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        if (!empty($result)) {
            for($k = 0; $k < COUNT($result); $k++){
                $courseId = $result[$k]['course_id'];
                $courseDetails = $this->getSubCategoryById($courseId);
                
            }
        }
        return $result;
    }
}
?>