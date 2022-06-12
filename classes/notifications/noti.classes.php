<?php
class Noti extends Dbh {

    protected function insertPostNoti($user_to,$user_from,$postID,$commentID,$status) {
        
        $sql = 'INSERT INTO post_notifications(user_to,user_from,postID,commentID,read_status) VALUES (?,?,?,?,?);';
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($user_to,$user_from,$postID,$commentID,$status))) {
            $stmt = null;
        }
        else {
            
        }
    }

    protected function insertReplyNoti($user_to,$user_from,$postID,$commentID,$status) {
        $sql = 'INSERT INTO reply_notifications(user_to,user_from,postID,reply_id,read_status) VALUES (?,?,?,?,?);';
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($user_to,$user_from,$postID,$commentID,$status))) {
            $stmt = null;
            echo "oops!";
        }
        else {
            echo "Hooray!";
        }
    }
    protected function updatePostNoti($username) {
        $sql = "UPDATE post_notifications SET read_status = 1 WHERE read_status = 0 AND user_to = '$username';";
        $this->connect()->query($sql);
    }


    protected function updateReplyNoti($username) {
         $sql = "UPDATE reply_notifications SET read_status = 1 WHERE read_status = 0 AND user_to = '$username';";
        $this->connect()->query($sql);
    }


    protected function countNoti($username){
       

        $sql = "SELECT COUNT(*) FROM post_notifications WHERE user_to ='$username' AND read_status = 0;";
        $result = $this->connect()->query($sql);
        $rowCount = $result->fetchColumn();

        
        $sql2 = "SELECT COUNT(*) FROM reply_notifications WHERE user_to ='$username' AND read_status = 0;";
        $result2 = $this->connect()->query($sql2);
        $rowCount2 = $result2->fetchColumn();
        $total = $rowCount2 + $rowCount;

        if($total > 0) {
         return $span = '<span class="noti-counter">'.$total.'</span>';
        } 
        else {
            return;
        }
       

   }

   protected function getPostNoti($username){
        $sql = "SELECT  post_notifications.user_from, maincomment.content, maincomment.createdOn, maincomment.postID, maincomment.commentID, userposts.title FROM post_notifications INNER JOIN maincomment on 
        post_notifications.commentID = maincomment.commentID INNER JOIN userposts on post_notifications.postID = userposts.postID WHERE post_notifications.user_to = '$username'";

        $result = $this->connect()->query($sql);

        $notifications = $result->fetchALL(PDO::FETCH_ASSOC);

        return $notifications;
   }

   protected function getReplyNoti($username){
    $sql = "SELECT  reply_notifications.user_from, replies.repliedOn, replies.content, replies.reply_id, userposts.postID, userposts.title FROM reply_notifications INNER JOIN replies on 
    reply_notifications.reply_id = replies.reply_id INNER JOIN userposts on reply_notifications.postID = userposts.postID WHERE reply_notifications.user_to = '$username'";
    $result = $this->connect()->query($sql);

    $notifications = $result->fetchALL(PDO::FETCH_ASSOC);

    return $notifications;
}



        
    }