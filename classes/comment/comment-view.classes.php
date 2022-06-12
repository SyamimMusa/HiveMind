<?php 

class commentView extends comment {

    public function displayAllComments($postID){
        return $this->getAllComments($postID);
    }

    public function timeAgo($createdOn){
        return $this->calculateTimeAgo($createdOn);
    }

    public function checkReplies($commentID){
        return $this->countReplies($commentID);
    }

    public function displayReplies($commentID) {
        return $this->getAllReplies($commentID);
    }
}