<?php 

class LoginContr extends Login {

    private $username;
    private $password;

    public function __construct($username, $password) {

        $this->username = $username;
        $this->password = $password;
    }

    public function loginUser() {
        $this->getUser($this->username, $this->password);
    }
}