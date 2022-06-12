<?php 
class notiView extends Noti {

  public function NotiNum($username){
      echo $this->countNoti($username);
  }

 
  public function readPostNoti($username){
    return $this->updatePostNoti($username);
  }

  public function readReplyNoti($username){
    return $this->updateReplyNoti($username);
  }

  public function displayPostNoti($username){
    return $this->getPostNoti($username);
  }

  public function displayReplyNoti($username){
    return $this->getReplyNoti($username);
  }







}