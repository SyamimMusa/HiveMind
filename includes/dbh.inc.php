<?php

class Dbh {
 
    protected function connect () {
        try {
            $username = 'b47741e3414a56';
            $password = 'b417722b';
            $dbh = new PDO('mysql:host=eu-cdbr-west-02.cleardb.net;dbname=heroku_102bad143b54525', $username,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        }
        catch (PDOEception $e){
            print "Error!: " . $e->getMessage(). "<br/>";
            die();
        }
    }

    
}
    