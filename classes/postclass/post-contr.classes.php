<?php 

class PostContr extends Post {

    private $userID;
    private $title;
    private $flair;
    private $date;
    private $content;
    private $likes;
    private $banned;
    

    public function __construct($userID,$title,$flair,$date,$content,$likes,$banned) {
        $this->userID = $userID;
        $this->title = $title;
        $this->flair = $flair;
        $this->date = $date;
        $this->content = $content;
        $this->likes = $likes;
        $this->banned = $banned;
        
    }

    public function createPost() {
        $this->setPostContent($this->userID,$this->title, $this->flair, $this->date,$this->content, $this->likes,$this->banned);
    }



    public function banPost(){
        
    }

   

}