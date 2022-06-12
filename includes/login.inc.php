<?php 


if(isset($_POST["isLog"])) {

//Grab data from form
$username = $_POST["email"];
$pwd = $_POST["password"];


include 'dbh.inc.php';
include '../classes/account/login.classes.php';
include '../classes/account/login-contr.classes.php';

$login = new  LoginContr($username,$pwd);
$login->loginUser($username,$pwd);



}   