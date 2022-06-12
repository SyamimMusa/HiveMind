<?php
//send the data here from the form 

//instantiate reg controller

if(isset($_POST["isReg"])) {

    //Grab data from form
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["password"];


    include 'dbh.inc.php';
    include '../classes/account/register.classes.php';
    include '../classes/account/register-contr.classes.php';

    //instantiate register-controller object
    $register = new RegisterContr($email,$username,$pwd);
    
    $register->registerUser();
    

}   