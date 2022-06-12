<?php 


class replyRatingContr extends replyRating {
    private $username;
    private $reply_id;
    private $action;
  
    

    public function __construct($username,$reply_id,$action) {
        $this->username = $username;
        $this->reply_id = $reply_id;
        $this->action = $action;
      
    }

    public function likeUnlike(){ 

        $this->replyAction($this->reply_id,$this->username,$this->action);
    }

     public function getLikes($reply_id) {
        
            $this->countLikes($reply_id);
    }
}