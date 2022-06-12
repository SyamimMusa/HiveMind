<?php 


class replyRating extends Dbh {
    protected function replyAction($reply_id,$username,$action){

        switch ($action) {
            case 'like':
    
                $sql = 'INSERT INTO reply_rating (reply_id,username) VALUE (?,?);';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($reply_id,$username))){
                    $stmt = null;
                    header("location:test.php?somethingwentwrong");
                    exit();
                }else {
                   
                }
    
                break;
    
            case 'unlike':
    
                $sql = 'DELETE FROM reply_rating WHERE username= ? AND reply_id = ?;';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($username,$reply_id))){
                    $stmt = null;
                    header("location:test.php?somethingwentwrong");
                    exit();
                }else{
                   
                }
    
                break;
            
            default: 
                break;
        }
    
      }//function 

      protected function userRate($username,$reply_id){

        $sql = "SELECT * FROM reply_rating WHERE username = ? AND reply_id = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($username,$reply_id))){
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

        protected function countLikes($reply_id){

            $results = array();
    
            $sql = "SELECT COUNT(*) from reply_rating WHERE reply_id = $reply_id";
            $stmt = $this->connect()->query($sql);
        
            $likes = $stmt->fetch();
        
            $results = [
                'likes' => $likes[0]
            ];
        
            echo json_encode($results);
        }

        protected function likeCounter($reply_id){
            $sql = "SELECT count(*) FROM reply_rating WHERE reply_id = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$reply_id]);
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