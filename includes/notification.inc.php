<?php 
include 'dbh.inc.php';
include '../classes/notifications/noti.classes.php';
include '../classes/notifications/noti-view.classes.php';
//check notifications

session_start();
$username = $_SESSION['username'];
$notiCount = new notiView();

$notiCount->NotiNum($_SESSION['username']);