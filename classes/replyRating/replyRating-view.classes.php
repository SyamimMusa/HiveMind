<?php 


class replyRatingView extends replyRating {

    
    public function userLiked($username,$reply_id){
        return $this->userRate($username,$reply_id);
    }

    public function displayLikes($reply_id) {
        return $this->likeCounter($reply_id);
    }
}   