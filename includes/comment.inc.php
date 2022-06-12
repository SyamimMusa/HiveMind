<?php
session_start();

include 'dbh.inc.php';
include '../classes/comment/comment.classes.php';
include '../classes/comment/comment-contr.classes.php';
include '../classes/comment/comment-view.classes.php';
include '../classes/notifications/noti.classes.php';
include '../classes/notifications/noti-contr.classes.php';
include '../classes/notifications/noti-view.classes.php';

if(isset($_POST['isMain'])) {

    

    if($_POST['isMain'] == 1){
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $post_id = $_POST['post_id'];
        $username =  $_SESSION["username"]; 
        $date = date("Y-m-d H:i:s");
        $content = $_POST['content'];
        $OP = $_POST['post_creator'];

        $com_obj = new commentContr($post_id,$username, $content,$date);
        

        echo $com_obj->addComment($OP);

    }
}

if(isset($_POST['isReply'])) {

    if($_POST['isReply'] == 1){
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $parent_id = $_POST['parent_id'];
        $posted_to = $_POST['posted_to'];
        $posted_by =  $_SESSION["username"]; 
        $repliedOn = date("Y-m-d H:i:s");
        $content = $_POST['content'];
        $OP = $_POST['post_creator'];


        
        $com_obj = new commentContr($parent_id,$posted_by,$content,$repliedOn);

        $com_obj->addReply($posted_to,$OP);

        //add reply notification
    }

}

if(isset($_POST['isPostNoti'])) {
    $post_creator = $_POST['post_creator'];
    $username =  $_SESSION["username"]; 
    $post_id = $_POST['post_id'];
    $com_id = $_POST['com_id'];
    $status = 0;

 
    if(strcmp($post_creator,$username)== 0) {
        // Dont insert into the databse because a user is not supposed to get a notification for reply and commenting to their own posts
    } else {
        $postNoti = new notiContr($post_creator,$username,$post_id,$com_id,$status);

        $postNoti->setPostNoti();
    }

 
    
}

if(isset($_POST['isReplyNoti'])) {
    $post_creator = $_POST['post_creator'];
    $username =  $_SESSION["username"]; 
    $post_id = $_POST['post_id'];
    $reply_id = $_POST['reply_id'];
    $status = 0;

    if(strcmp($post_creator,$username)== 0) {
            // Dont insert into the databse because a user is not supposed to get a notification for reply and commenting to their own posts
    } else {
        $postNoti = new notiContr($post_creator,$username,$post_id,$reply_id,$status);

        $postNoti->setReplyNoti();
    }

  
}