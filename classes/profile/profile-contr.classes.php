<?php

class ProfileContr  extends Profile {

    private $name;
    private $batch;
    private $course;
    private $bio;
    private $userId;
 

    public  function __construct($name,$userId,$batch,$course,$bio) {
        $this->name = $name;
        $this->userId = $userId;
        $this->batch = $batch;
        $this->course = $course;
        $this->bio = $bio;

    }

  

    public function editProfile() {
        $this->updateUserDetails($this->name,$this->userId,$this->batch,$this->course, $this->bio);
    }
    
    public function editProfileImage() {
        $this->updateProfileImage($this->fileActualExt,$this->userId);
    }
}