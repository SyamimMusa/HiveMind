<?php

class ProfileView extends Profile {


    public function viewUserProfile($username) {
    return  $this->getUserProfile($username);

    }

    public function visitProfile($username){
        return $this->getProfile($username);
    }
}