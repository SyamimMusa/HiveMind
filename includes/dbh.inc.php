<?php

class Dbh {
 
    protected function connect () {
        try {
            $username = 'root';
            $password = '';
            $dbh = new PDO('mysql:host=localhost;dbname=studenthive', $username,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        }
        catch (PDOEception $e){
            print "Error!: " . $e->getMessage(). "<br/>";
            die();
        }
    }

    
}
    