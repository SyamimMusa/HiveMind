<?php

//model package
//queries database 

class Register extends Dbh {

    protected function setUser($email,$username,$password){
        $sql='INSERT INTO users (usersUid,usersEmail,usersPwd,ProfileStat) VALUES (?,?,?,0);';
        $stmt = $this->connect()->prepare($sql);

        $hashedpwd = password_hash($password,PASSWORD_DEFAULT);


        if(!$stmt->execute(array($username, $email, $hashedpwd))) {
            $stmt = null;
            header("location: ../Index.php?error=stmtfailed");
            exit();
        }

        $sql2 = 'INSERT into userprofile(username) VALUES (?);';
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2->execute(array($username));

        $stmt = null;

    }

    protected function checkUser($username,$email) {
        $sql='SELECT usersUid FROM users WHERE usersUid = ? OR usersEmail = ?;';
        $stmt = $this->connect()->prepare($sql);

        //execute method will return true or false
        if(!$stmt->execute(array($username,$email))) {
            $stmt = null;
            header("location: ../Index.php?error=stmtfailed");
            exit();
        }

        $result;
        if($stmt->rowCount() > 0) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }
    
}