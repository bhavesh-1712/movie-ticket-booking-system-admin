<?php
require_once ("class/DBController.php");
require_once ("class/Admin.php");
require_once ("class/Movie.php");
require_once ("class/Customer.php");

function uploadImg($filePath,$fileName,$newFileName){
    if(isset($_FILES[$fileName]) && $_FILES[$fileName]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES[$fileName]["name"];
        $filetype = $_FILES[$fileName]["type"];
        $filesize = $_FILES[$fileName]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 2MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            //Check whether file exists before uploading it
            if(file_exists($filePath . $filename)){
                echo "<script>alert('This filename already exists.');</script>";
            } else{
                move_uploaded_file($_FILES[$fileName]["tmp_name"], $filePath . $filename);
                $fileType = substr(strrchr($filename,'.'),1);
                $newFileImg1 = $newFileName.".".$fileType;
                rename($filePath."/".$filename,"$filePath"."/".$newFileImg1);
                                
                $filePathImg = $filePath.$newFileImg1;
                
                return $filePathImg;
            } 
        } else{
            echo "<script>alert('Error: There was a problem uploading your file. Please try again.');</script>";
            return 0;
        }
    } else{
        echo "<script>alert('Error: ".$_FILES[$fileName]['error']."');</script>";
        return 0;
    }
}

function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$db_handle = new DBController();
$admin = new Admin();
$movie = new Movie();
$customer = new Customer();

if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}

switch ($action) { 
    case "dashboard":
        session_start();
        $id = $_SESSION['movie-ticket-booking'];
        $bookingDetail = $movie->getBookingDataByMovie();
        $result = $admin->getUserById($id);
        $data = $movie->getDashboardData();
        require_once "pages/dashboard.php";
        break;  
    case "managed-movie":
        if(isset($_POST['add-movie'])){
            $movieName = $_POST['MovieName'];
            $movieDetails = $_POST['MovieDetails'];
            $movieCharges = $_POST['MovieCharges'];
            $filePath = "./images/movie/";
            $data = uploadImg($filePath,"files",guidv4());
            if($data != "0"){
                $result2 = $movie->addMovie($movieName,$movieDetails,$movieCharges,$data);
                if ($result2) {
                    echo "<script>alert('Movie added successfully.');</script>";
                }else{
                     echo "<script>alert('Something Went Wrong. Please try again.');</script>";
                }
            }else{
                echo "<script>alert('File Upload Error');</script>";
            }
        }
        $result = $movie->getAllMovie();
        require_once "pages/manged-movie.php";
        break;
    case "deleteMovie":
        session_start();
        $ID = $_GET["id"];
        $PATH = $_GET["path"];
        unlink($PATH);
        $movie->deleteMovie($ID);
        echo '<script>window.location.href = "index.php?action=managed-movie";</script>';
        break;
    case "managed-slot":
        session_start();
        if(isset($_POST['add-slot'])){
            $startTime = $_POST['StartTime'];
            $endTime = $_POST['EndTime'];
        
            $result2 = $movie->addSlot($startTime,$endTime);
            if ($result2) {
                echo "<script>alert('Slot added successfully.');</script>";
            }else{
                echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            }
        }
        $result = $movie->getAllSlots();
        require_once "pages/manged-slot.php";
        break;
    case "deleteSlot":
        session_start();
        $ID = $_GET["id"];
        $movie->deleteSlot($ID);
        echo '<script>window.location.href = "index.php?action=managed-slot";</script>';
        break;
    case "managed-user":
        session_start();
        $result = $customer->getAllUser();
        require_once "pages/manged-user.php";
        break;
    case "deleteCustomer":
        session_start();
        $ID = $_GET["id"];
        $customer->deleteUser($ID);
        echo '<script>window.location.href = "index.php?action=managed-user";</script>';
        break;
    case "logout":
        session_start();
        session_unset();
        session_destroy();
        header("Location:index.php?action=login");
        break;
    case "login":
        session_start();
        //error_reporting(0);
		if (isset($_POST['login'])) {
			$UserName = $_POST['UserName'];
			$UserPassword = $_POST['UserPassword'];
			if(empty($UserName) || empty($UserPassword)) {
				echo "<script>alert('Email and/or Password can not be empty');</script>";
			} else {
				$result = $admin->verifyUser($UserName,$UserPassword);
				if ($result) {
					$_SESSION['movie-ticket-booking']=$result[0]['id'];
					echo '<script type="text/javascript">'; 
					echo 'alert("Login Successfully");';
					echo 'window.location.href = "index.php?action=dashboard";';
					echo '</script>';
				} else {
					 echo "<script>alert('Incorrect id password');</script>";
				}
			}
        }
        require_once "pages/login.php";
        break;
    default: 
        header("Location:index.php?action=login");
        break;
}
