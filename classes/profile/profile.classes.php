<?php 


class Profile extends Dbh {

    //method to insert into db
    protected function setUserProfile($name,$userId,$dob,$course,$year,$sem,$fileActualExt) {
        $sql = 'INSERT INTO userprofile (usersUid,fullname,birthdate,course,curyear,sem,imageExt) VALUE (?,?,?,?,?,?,?);';
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($userId,$name,$dob,$course,$year,$sem,$fileActualExt))) {
            $stmt = null;
            header("location: ../ProfileSet.php?error=stmtfailed");
            exit();
        }
        else {
            $sql = null;
            $sql = 'UPDATE users SET ProfileStat = 1 WHERE UserID = ?;';
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($userId))) {
                $stmt = null;
                header("location: ../ProfileSet.php?error=profilestatfail");
                exit();
            }
        }


    }

     //method to get user profile from Db
     protected function getUserProfile ($username) {
         $sql = 'SELECT * FROM userprofile WHERE username = ?;';
         $stmt = $this->connect()->prepare($sql);
        

         if(!$stmt->Execute(array($username))) {
             $stmt = null;
             header("location: ../Profile.php?error=stmtfailed");
             exit();
         }
        else {
            //fetch data.
            $userProfile = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userProfile;
        }
     }

     //method to update user profile details 
     protected function updateUserDetails($name,$id,$batch,$course,$bio) {

        if(!is_null($name)) {
            $sql = 'UPDATE userprofile set fullname = ? WHERE username = ?;';
            $stmt = $this->connect()->prepare($sql);  
            echo "Updated name!";

            if(!$stmt->execute(array($name,$id))) {
                $stmt = null;
                header("location: ../ProfileEdit.php?error=stmtfail");
                exit();
            }
         

        }

        if(!is_null($batch)) {
            $sql = 'UPDATE userprofile set batch = ? WHERE username = ?;';
            $stmt = $this->connect()->prepare($sql);  
            echo "Updated batch!";

            if(!$stmt->execute(array($batch,$id))) {
                $stmt = null;
                header("location: ../ProfileEdit.php?error=stmtfail");
                exit();
            }

            
        }

        if(!is_null($course)) {
            $sql = 'UPDATE userprofile set course = ? WHERE username = ?;';
            $stmt = $this->connect()->prepare($sql);  
            echo "Updated course!";
            if(!$stmt->execute(array($course,$id))) {
                $stmt = null;
                header("location: ../ProfileEdit.php?error=stmtfail");
                exit();
            }

            $_SESSION["course"] = $course;
        }

        if(!is_null($bio)) {
            $sql = 'UPDATE userprofile set about = ? WHERE username = ?;';
            $stmt = $this->connect()->prepare($sql);  

            if(!$stmt->execute(array($bio,$id))) {
                $stmt = null;
                header("location: ../ProfileEdit.php?error=stmtfail");
                exit();
            } else {
                echo "Updated bio!";
            }

         
        }

     }

     protected function updateProfileImage($fileActualExt,$id) {
        $sql = 'UPDATE userprofile set imageExt = ? WHERE usersUid = ?;';
        $stmt = $this->connect()->prepare($sql); 

        if(!$stmt->execute(array($fileActualExt,$id))) {
            $stmt = null;
            header("location: ../ProfileEdit.php?error=stmtfail");
            exit();
        }

        header("location: ../Profile.php");
     }

     protected function getProfile($username){
        $sql = 'SELECT * FROM userprofile WHERE username=?;';
        $stmt = $this->connect()->prepare($sql); 

        if(!$stmt->execute([$username])){
            $stmt = null;
            exit();
        }
        else {
            $userprofile = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userprofile;
        }
     }
}