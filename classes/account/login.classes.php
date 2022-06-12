<?php 

class Login extends Dbh {
    
    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT usersPwd from users WHERE usersEmail = ?;');

        
        $results = array();
        //check for error when executing statement
        if(!$stmt->execute(array($uid))){
            $stmt = null;
           
             header("location: ../index.php?error=stmtfailed");
            return;
        }
    

        //check if username or email exists in db
        if($stmt->rowCount() == 0) {
            $stmt = null;
            $results = [
                'exist' => 0
            ];

         
            echo json_encode($results);
            return;
        }else {
            $results = [
                'exist' => 1,
                'match' => 0,
            ];
          
        }



        //check password user entered with hashed pass in db
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["usersPwd"]);

        //if false, send back to login with error
        if ($checkPwd == false) {
            $stmt = null;
            $results = [
                'match' => 0
            ];
          
            echo json_encode($results);
        }
        elseif($checkPwd == true){
          
            //if true, query db and get user info
            $stmt = $this->connect()->prepare('SELECT * from users WHERE usersEmail = ?;');
            
            if(!$stmt->execute(array($uid))) {
               
                $stmt = null;
                header("location: ../Index.php?error=stmtfailed");
                exit();
            }

         

            //pass user info (array) into user variable created
            $user = $stmt->fetchALL(PDO::FETCH_ASSOC);

            //start session and pass important info into session variable.
            session_start();
            $_SESSION["username"] = $user[0]["usersUid"];

            $results = [
                'exist' => 1,
                'match' => 1,
            ];
          
            echo json_encode($results);
            
        }

       
    }
}