<?php 
session_start();
include 'dbh.inc.php';
include '../classes/profile/profile.classes.php';
include '../classes/profile/profile-contr.classes.php';
include '../classes/profile/profile-view.classes.php';

$id =  $_SESSION["username"];
$name = null;
$dob = null;
$course = null;
$year = null;
$sem = null;
$fileActualExt = null;


//edit profile picture logic
if(isset($_POST['editPic'])){ 

   
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //explode file name at (.)
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');
    

    // Uploading/moving image into root folder
    if(in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if($fileSize < 500000) {
              
                $fileNameNew = $id."dp.jpeg";
                $fileDestination = '../Images/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                header("Location: ../Profile.php?username=$id");
         

            } else {
                echo "Image size is too big!";
                header("Location: ../ImageEdit.php?event=toobig");
            }

        } else {
            echo "There was an error uploading your images!";
            header("Location: ../ImageEdit.php?event=error");
        }   
    } else {
        echo "You cannot upload files  of this type!";
        header("Location: ../ImageEdit.php?event=invalid");
    }
    
}

//Edit profile details logic 
if(isset($_POST['isProfile'])){ 
   

    
    if($_POST["name"] || $_POST["batch"] || $_POST["course"] || $_POST["bio"]) {
      
        if($_POST["name"] ) {
            $profileEdit = new ProfileContr($_POST["name"],$id,$_POST["batch"],$_POST["course"] ,$_POST["bio"]);
            $profileEdit->editProfile();
           
        }

        
        if($_POST["course"]) {
          
            $profileEdit = new ProfileContr($_POST["name"],$id,$_POST["batch"],$_POST["course"] ,$_POST["bio"]);
            $profileEdit->editProfile();
        }

        if($_POST["batch"]) {
            
            $profileEdit = new ProfileContr($_POST["name"],$id,$_POST["batch"],$_POST["course"] ,$_POST["bio"]);
            $profileEdit->editProfile();
        }

        if($_POST["bio"]) {
         
            $profileEdit = new ProfileContr($_POST["name"],$id,$_POST["batch"],$_POST["course"] ,$_POST["bio"]);
            $profileEdit->editProfile();
        }
        
        header("Location: ../Profile.php?username=$id");

    } else {
        $results = array();

        $results = [
            'error' => 1,
        ];
        
        echo json_encode($results);
    }
       

    
}