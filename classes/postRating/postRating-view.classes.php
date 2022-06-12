<?php 

class postRatingView extends postRating{

    public function userLiked($username,$post_id){
        return $this->userRate($username,$post_id);
    }

    public function displayLikes($post_id) {
        return $this->likeCounter($post_id);
    }
}