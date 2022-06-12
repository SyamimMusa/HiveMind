<?php

class postView extends Post {


    public function displayAllPosts($flair){
        return $this->getAllPost($flair);
    }
    
    public function displayUserPosts($username){
        return $this->getUserPosts($username);
    }
    
    public function displayPost($postID){
        $this->getPost($postID);
    }

    public function setCreator($postID){
        return $this->getCreator($postID);
    }

    public function timeAgo($date){
        return $this->calculateTimeAgo($date);
    }

    public function searchPosts($search){
        return $this->querySearch($search);
    }

    public function checkPost($flair){
        return $this->countPost($flair);
    }

   
}