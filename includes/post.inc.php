<?php
if(isset($_POST['submitPost'])){
  session_start();
  //include needed files
  include 'dbh.inc.php';
  include '../classes/postclass/post.classes.php';
  include '../classes/postclass/post-contr.classes.php';


  //get userID
  $userID =  $_SESSION["username"];

  //Instantiate default post like count and ban status
  $likes = 0;
  $banned = false;

  date_default_timezone_set('Asia/Kuala_Lumpur');
  $date = date("Y-m-d H:i:s");

  //get post details
  $title = $_POST["title"];
  $flair = $_POST["flair"];
  $content = $_POST["content"];
  
  echo $title;
  echo "<br>";
  echo $flair;
  echo "<br>";
  echo $content;

  //instantiate object
  $post = new PostContr($userID,$title,$flair,$date,$content,$likes,$banned);
  // //call method to insert post details into db
   $post->createPost();
  
}

 
  ?>