<?php 
class comment extends Dbh {


    protected function insertReply($posted_by, $posted_to, $parent_id,$content,$repliedOn,$OP){

        function createCommentRow($posted_by, $posted_to,$parent_id,$content,$repliedOn,$reply_id,$OP){

        
            if(strcmp($OP,$posted_by)==0) {
                $class = "creator";
            }
            else {
                $class = "";
            }
            $response = ' 
          
            <div class="main reply" id="repsec'.$reply_id.'">
            <div class="com-detail">
                <div class="com-img">
                    <img class="com-img" src="Images/'.$posted_by.'dp.jpeg" />
                    <a href="Profile.php?username='.$posted_by.'"></a>
                </div>

              
                
                    <a href="Profile.php?username='.$posted_by.'" class="username '.$class.'"><span data-creator="OP"></span>'.$posted_by.'</a>
                    
   
                <i class="fa-solid fa-caret-right"></i>
                <a href="Profile.php?username='.$posted_to.'"
                    class="username to">'.$posted_to.'</a>
                <span class="dot">.</span>
                <span class="timeAgo">'.comment::calculateTimeAgo($repliedOn).'</span>
            </div>
            <div class="comment-content">
                '.$content.'
            </div>


            <div class="comment-interaction">

                <div class=" rating">
                    <i class="fa-regular fa-heart rep-like"
                        data-cid="<'.$reply_id.'"><span class="likes"></span></i>
                </div>

                <div class=" reply">
                    <a class="reply-btn" href="javascript:void(0)" onclick="moveEditor(this)"
                        data-uid="'.$posted_by.'"
                        data-cid="'.$reply_id.'">Reply</a>
                </div>


            </div>

        </div>
    
            
            ';
            $data = [
                "response" => $response,
                "reply_id" => $reply_id,
             ];

             echo json_encode($data);
        }
        $connect = $this->connect();

        $sql = 'INSERT INTO replies(posted_by,posted_to,parent_id,content,repliedOn) VALUE (?,?,?,?,?);';
        $stmt = $connect->prepare($sql);

        if(!$stmt->execute(array($posted_by, $posted_to, $parent_id,$content,$repliedOn))) {
            $stmt = null;
            echo "Fail";
        }else {
            $reply_id = $connect->lastInsertId();
            exit(createCommentRow($posted_by, $posted_to,$parent_id,$content,$repliedOn,$reply_id,$OP));
        }

     
    }

    protected function insertComment($postID, $username, $content,$createdOn,$OP){

        function createCommentRow($username, $content,$createdOn,$com_id,$OP){

            
            if(strcmp($OP,$username)==0) {
                $class = "creator";
            }
            else {
                $class = "";
            }
            $array = array();
            $response = ' 
            <div class="main">
            <div class="com-detail">
                <div class="com-img">
                    <img src="Images/'.$username.'dp.jpeg" />
                    <a href="Profile.php?username='.$username.'"></a>
                </div>
            
        
               
            <a href="Profile.php?username='.$username.'" class="username '.$class.'">'.$username.'</a>
                

           
          

            <span class="timeAgo">'.comment::calculateTimeAgo($createdOn).'</span>
            </div>
            <div class="comment-content">
            '.$content.'
            </div>

            <div class="comment-interaction">
                <div class=" rating">
                <i class="fa-regular fa-heart com-like" data-cid="'.$com_id.'"><span
                class="likes"></span></i>
                </div>
                <div class="reply">
                    <a class="reply-btn" href="javascript:void(0)" onclick="moveEditor(this)"
                        data-uid="'.$username.'" data-cid="'.$com_id.'">Reply</a>
                </div>

                            </div>

                            <!-- reply section -->
                            <div class="replies-section">
                            </div>
                            </div>
            ';
    
             $data = [
                "response" => $response,
                "com_id" => $com_id,
             ];

             echo json_encode($data);
        }
        $connect = $this->connect();

        $sql = 'INSERT INTO maincomment(postID,username,content,createdOn) VALUE (?,?,?,?);';
        $stmt = $connect->prepare($sql);
        

        $stmt->execute(array($postID, $username, $content,$createdOn));
        $com_id = $connect->lastInsertId();
      
        exit(createCommentRow($username, $content,$createdOn,$com_id,$OP));

     
    }


    protected function getAllComments($postID){
        $sql = "SELECT * FROM maincomment where postID = $postID ORDER BY commentID DESC";
        $stmt = $this->connect()->query($sql);
        
        if(!$stmt) {
            $stmt = null;
            echo("oops");
            exit();
    
        }
        else {
            $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $data;
        }// else
    }

    

    public static function calculateTimeAgo($date_posted) {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $time_ago = strtotime($date_posted);
        $cur_time   = time();
    
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
    
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            }else{
    
                return "$hours hours ago";
                
        
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
      }

      protected function countReplies($commentID){
        $sql = "SELECT COUNT(*) from replies WHERE parent_ID = $commentID";
        $stmt = $this->connect()->query($sql);
        $replies = $stmt->fetchColumn();
        return $replies;
      } 

      protected function getAllReplies($commentID){
        $sql = "SELECT * FROM replies WHERE parent_ID = $commentID ORDER BY reply_id DESC";
        $stmt = $this->connect()->query($sql);
        
        if(!$stmt) {
            $stmt = null;
            echo("oops");
            exit();
    
        }
        else {
            $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $data;
        }// else

      }
    

}