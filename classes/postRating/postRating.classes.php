<?php 


class postRating extends Dbh {

    protected function postAction($post_id,$username,$action){

        switch ($action) {
            case 'like':
    
                $sql = 'INSERT INTO post_rating (postID,username) VALUE (?,?);';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($post_id,$username))){
                    $stmt = null;
                    header("location:test.php?somethingwentwrong");
                    exit();
                }else {
                    // header("location:Home.php?liked");
                }
    
                break;
    
            case 'unlike':
    
                $sql = 'DELETE FROM post_rating WHERE username= ? AND postID= ?;';
                $stmt = $this->connect()->prepare($sql);
                if(!$stmt->execute(array($username,$post_id))){
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

    protected function userRate($username,$post_id){

        $sql = "SELECT * FROM post_rating WHERE username = ? AND postID = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($username,$post_id))){
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
    
    }//function 

    protected function likeCounter($post_id){
         $sql = "SELECT count(*) FROM post_rating WHERE postID = ?;";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute([$post_id]);
         $num_rows = $stmt->fetchColumn();

         return $num_rows;
    }

    protected function countLikes($post_id){

        $results = array();

        $sql = "SELECT COUNT(*) from post_rating WHERE postID = $post_id";
        $stmt = $this->connect()->query($sql);
    
        $likes = $stmt->fetch();
    
        $results = [
            'likes' => $likes[0]
        ];
    
        echo json_encode($results);
    }
}