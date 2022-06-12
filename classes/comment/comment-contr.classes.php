<?php 
class commentContr extends comment {

    private $postID;
    private $username;
    private $content;
    private $createdOn;

    public function __construct($postID, $username, $content,$createdOn){

         $this->postID = $postID;
         $this->username = $username;
         $this->content = $content;
         $this->createdOn = $createdOn;
    }

    public function addComment($OP){
        $this->insertComment($this->postID, $this->username, $this->content,$this->createdOn,$OP);
    }

    public function addReply($posted_to,$OP){
        $this->insertReply($this->username,$posted_to,$this->postID,$this->content,$this->createdOn,$OP);
    }   
}