<?php 


class comRatingView extends comRating {

    
    public function userLiked($username,$com_id){
        return $this->userRate($username,$com_id);
    }

    public function displayLikes($com_id) {
        return $this->likeCounter($com_id);
    }
}   