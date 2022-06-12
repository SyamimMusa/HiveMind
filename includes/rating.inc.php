<?php

session_start();
$username =  $_SESSION["username"];
include 'dbh.inc.php';
include '../classes/postRating/postRating.classes.php';
include '../classes/postRating/postRating-contr.classes.php';

include '../classes/comRating/comRating.classes.php';
include '../classes/comRating/comRating-contr.classes.php';

include '../classes/replyRating/replyRating.classes.php';
include '../classes/replyRating/replyRating-contr.classes.php';

if (isset($_POST['post_rating'])) {


$post_id = $_POST['post_id'];
$action = $_POST['action'];



//create object 
$rate = new postRatingContr($username,$post_id,$action);

//call method to insert or delete rating based on user action
$rate->likeUnlike();

//call method to 
$rate->getLikes($post_id);




} 

if (isset($_POST['com_rating'])) {

     $com_rating = $_POST['com_rating'];
     $action = $_POST['action'];
     $com_id = $_POST['com_id'];


   //create object
  $commentRating = new comRatingContr($username,$com_id,$action);

   $commentRating->likeUnlike();

   $commentRating->getLikes($com_id);
}

if (isset($_POST['reply_rating'])) {

  $reply_rating = $_POST['reply_rating'];
  $action = $_POST['action'];
  $reply_id = $_POST['reply_id'];


 
  
//create object
$replyRating = new replyRatingContr($username,$reply_id,$action);

$replyRating->likeUnlike();

$replyRating->getLikes($reply_id);
}

?>