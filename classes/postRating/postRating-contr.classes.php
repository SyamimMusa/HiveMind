<?php 

class postRatingContr extends postRating {

    private $username;
    private $post_id;
    private $action;
  
    

    public function __construct($username,$post_id,$action) {
        $this->username = $username;
        $this->post_id = $post_id;
        $this->action = $action;
      
    }


    public function likeUnlike(){ 

    $this->postAction($this->post_id,$this->username,$this->action);
    }
    
    public function getLikes($post_id) {
        
        $this->countLikes($post_id);
    }
    

}