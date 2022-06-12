<?php 


class comRatingContr extends comRating {
    private $username;
    private $com_id;
    private $action;
  
    

    public function __construct($username,$com_id,$action) {
        $this->username = $username;
        $this->com_id = $com_id;
        $this->action = $action;
      
    }

    public function likeUnlike(){ 

        $this->comAction($this->com_id,$this->username,$this->action);
    }

     public function getLikes($com_id) {
        
            $this->countLikes($com_id);
    }
}