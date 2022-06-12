<?php 
class notiContr extends Noti {

    private $user_to;
    private $user_from;
    private $postID;
    private $com_ID;
    
    public function __construct($user_to,$user_from,$postID,$com_ID,$status) {
        $this->user_to = $user_to;
        $this->user_from = $user_from;
        $this->postID = $postID;
        $this->com_ID = $com_ID;
        $this->status = $status;
        
    }

    public function setPostNoti(){
        return $this->insertPostNoti($this->user_to,$this->user_from, $this->postID,$this->com_ID,$this->status);
    }

    public function setReplyNoti(){
        return $this->insertReplyNoti($this->user_to,$this->user_from, $this->postID,$this->com_ID,$this->status);
    }










}