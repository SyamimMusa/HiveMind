<?php 

class Post extends Dbh {

    protected function setPostContent($userID,$title,$flair,$date,$content,$likes,$banned) {

        $sql = 'INSERT INTO userposts(username,title,flair,postedDate,content,likes,banned) VALUE (?,?,?,?,?,?,?);';
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($userID,$title,$flair,$date,$content,$likes,$banned))) {
            $stmt = null;
            header("location:../post.php?somethingwentwrong");
            exit();
        }
        else {
            header("location:../post.php?postsubmitted");
            exit();
            }
        }

  protected function calculateTimeAgo($date_posted) {
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

            return "$hours hrs ago";
            
    
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



  protected function getPost($postID){

    $sql = "SELECT * FROM userposts WHERE postID = ?;";
    $stmt = $this->connect()->prepare($sql);

    if(!$stmt->execute(array($postID))) {
        $stmt = null;
        header("location:displayTest.php?somethingwentwrong");
        exit();
    }
    else {
         $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comments as $comment) {
            $date = $comment['postedDate'];
            $timeAgo = $this->timeAgo($date);
            echo '
            
            <div class="post-wrapper">

            <!-- header -->
            <div class="post_header">
                <div class="userdate">
                <span>posted by @'.$comment['username'].' . '.$timeAgo.'</span>
                <input class="creator" type="hidden" value="'.$comment['username'].'">
                </div>

                <div class="title-info">
                    <span class="title">'.$comment['title'].'</span>
                    <span class="info '.$comment['flair'].'">'.$comment['flair'].'</span>
                </div>
            </div>
            <!-- header -->

            <!-- post-container -->
            <div class="post_container">
                <div class="test">
                    <div class="content">
                        '.$comment['content'].'
                    </div>
                </div>
            </div>
            <!-- post-container -->
        
        ';
         return $comment['username'];
   
    }
    
  }
}


  protected function getAllPost($flair) {

    if(strcmp($flair,'All') == 0 ) {
    $sql = "SELECT * FROM userposts ORDER BY postID DESC;";
   
    } else {
    $sql = "SELECT * FROM userposts WHERE flair ='$flair' ORDER BY postID DESC;";
    }
    
    $stmt = $this->connect()->query($sql);
    if(!$stmt) {
        $stmt = null;
        header("location:../Home.php?somethingwentwrong");
        exit();

    }
    else {
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }// else
  }// function

  protected function getUserPosts($username){
        $sql = "SELECT * FROM userposts WHERE username ='$username' ORDER BY postID DESC;";
        $stmt = $this->connect()->query($sql);

        if(!$stmt) {
            $stmt = null;
            header("location : ../profile.php?Somethingwentwrong");
        }
        else {
            $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $posts;
        }

  }

  protected function getCreator($postID){
    $sql = "SELECT username FROM userposts WHERE postID ='$postID';";
    $stmt = $this->connect()->query($sql);

    if(!$stmt){
        $stmt = null;

    }
    else {
        $creator = $stmt->fetch(PDO::FETCH_ASSOC);
        return $creator;
    }
  }

  protected function querySearch($search){
    //   $link = $this->link();
  
    //   $searchfilter = mysqli_real_escape_string($link,$search);
      $whr = "WHERE (title LIKE '%".$searchfilter ."%' OR content LIKE '%".$search ."%')";
      $sql = "SELECT * FROM userposts $whr ORDER BY postID DESC;";

      $stmt = $this->connect()->query($sql);

      if(!$stmt){
          $stmt = null;
      }
      else {
          $searchResults = $stmt->fetchALL(PDO::FETCH_ASSOC);
          return $searchResults;
      }
  }

  protected function countPost($flair){
      $check;
      $sql = "SELECT * FROM userposts WHERE flair = '$flair';";
      $stmt = $this->connect()->query($sql);

      $num_of_rows = $stmt->rowCount();

      if($num_of_rows > 0) {
          $check = true;
          return $check;
      }
      else if($num_of_rows < 1) {
          $check = false;
          return $check;
      }




}

}