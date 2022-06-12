<?php 


class comRating extends Dbh {
    protected function comAction($com_id,$username,$action){

        switch ($action) {
            case 'like':
    
                $sql = 'INSERT INTO com_rating (commentID,username) VALUE (?,?);';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($com_id,$username))){
                    $stmt = null;
                    header("location:test.php?somethingwentwrong");
                    exit();
                }else {
                    // header("location:Home.php?liked");
                }
    
                break;
    
            case 'unlike':
    
                $sql = 'DELETE FROM com_rating WHERE username= ? AND commentID= ?;';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($username,$com_id))){
                    $stmt = null;
                    header("location:test.php?somethingwentwrong");
                    exit();
                }else{
                    //  header("location:test.php?unliked");
                }
    
                break;
            
            default: 
                break;
        }
    
      }//function 

      protected function userRate($username,$com_id){

        $sql = "SELECT * FROM com_rating WHERE username = ? AND commentID = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($username,$com_id))){
            $stmt = null;
            header("location:../test.php?somethingwentwrong");
            exit();
        }
        else {
            $result = $stmt->fetch();
            if(!$result) {
                return false;
            }
            else if($result){
                return true;
            }
        }
      }

        protected function countLikes($com_id){

            $results = array();
    
            $sql = "SELECT COUNT(*) from com_rating WHERE commentID = $com_id";
            $stmt = $this->connect()->query($sql);
        
            $likes = $stmt->fetch();
        
            $results = [
                'likes' => $likes[0]
            ];
        
            echo json_encode($results);
        }

        protected function likeCounter($com_id){
            $sql = "SELECT count(*) FROM com_rating WHERE commentID = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$com_id]);
            $num_rows = $stmt->fetchColumn();
            
            if ($num_rows == 0){
                $null = "";
                return $null;
            }
            else {
                return $num_rows;
            }
            
       }
}