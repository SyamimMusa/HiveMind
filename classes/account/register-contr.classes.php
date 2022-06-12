<?php 

class RegisterContr extends Register{
    private $email;
    private $username;
    private $password;
    private $pwdcfrm;


    //constructor, pass in user data into the properties when instantiating object
    public  function __construct($email,$username,$password) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    
    }

    public function registerUser() {
        $results = array();
  
        if($this->usernameTaken() == true) {
            $results = [
                'taken' => 1
            ];

            echo json_encode($results);
            return;
        }

        $this->setUser($this->email, $this->username, $this->password);

        $results = [
            'taken' => 0
        ];
        

        echo json_encode($results);
        return;

    }

 
    //check invalid username or email in database
    public function usernameTaken() {
        $result;
        if($this->checkUser($this->username,$this->email) == false){
            $result=true;
        }
        else {
            $result=false;
        }

        return $result;
    }



}