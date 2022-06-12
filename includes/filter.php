<?php 
  include 'dbh.inc.php';
  include '../classes/postclass/post.classes.php';
  include '../classes/postclass/post-view.classes.php';
  include '../classes/postRating/postRating.classes.php';
  include '../classes/postRating/postRating-view.classes.php';
  include '../classes/postRating/postRating-contr.classes.php';
  session_start();
if(isset($_POST['isFilter'])) { 
    $flair = $_POST['flair'];
    $post = new postView();
    $ratingView = new postRatingView();
            
    $details = $post->displayAllPosts($flair);
    $check = $post->checkPost($flair);


?>

<?php 
    if($check == true || $flair == 'All') {

?>

<?php foreach($details as $detail) { ?>


<!-- post wrapper -->
<div class="post-wrapper">
    <a href="comments.php?post_id=<?php echo $detail['postID']?>" class="redirect"></a>
    <!-- post header -->
    <div class="post-header">
        <div class="poster-img">
            <?php 
                        

                        echo '<img src="Images/'.$detail['username'].'dp.jpeg" />'
                        ?>
            <a href="Profile.php?username=<?php echo $detail['username'] ?>"></a>
        </div>
        <div class="poster-info">
            <a href="Profile.php?username=<?php echo $detail['username'] ?>"
                class="username"><?php echo $detail['username']?></a>
            <span class="time-posted"><?php echo $post->timeAgo($detail['postedDate'])?></span>
        </div>




    </div>
    <!-- post header -->

    <!-- post body -->
    <div class="post-body">

        <div class="post-info">
            <span class="post-title"><?php echo $detail['title']?></span>
            <?php 
                        switch ($detail['flair']) {
                            case "Help":
                                echo '<span class="post-flair help">'.$detail['flair'].'</span>';
                                break;
                            case "Question":
                                echo '<span class="post-flair question">'.$detail['flair'].'</span>';
                                break;
                            case "Info":
                                echo '<span class="post-flair info">'.$detail['flair'].'</span>';
                                break;
                            case "General":
                                echo '<span class="post-flair general">'.$detail['flair'].'</span>';
                                 break;
                        }
                    ?>
        </div>
        <div class="post-content">
            <?php echo $detail['content']?>
        </div>
    </div>
    <!-- post body -->

    <!-- likes/comments/share -->
    <div class="post-interaction">
        <div class="post-interaction like">
            <i <?php if ($ratingView->userLiked($_SESSION["username"],$detail['postID'])): ?>
                class="fa-solid fa-heart like-btn" <?php else: ?> class="fa-regular fa-heart like-btn" <?php endif ?>
                data-id="<?php echo $detail['postID']?>">
                <span class="likes"><?php echo $ratingView->displayLikes($detail['postID'])?></span>
            </i>

        </div>
        <div class="post-interaction comment">
            <i class="fa-regular fa-comments"><span>Comments</span></i>
            <a href="comments.php?post_id=<?php echo $detail['postID']?>"></a>
        </div>
        <div class="post-interaction share">
            <i class="fa-regular fa-share-from-square"><span>Share</span></i>
        </div>
    </div>
    <!-- likes/comments/share -->

</div>
<!-- post wrapper -->
<?php
      }
    }
    else if($check == false){ ?>

<div class="nothing">
    <p>There are no posts with this flair!</p>
</div>



<?php

    }
}
?>


<?php 
    if(isset($_POST['isSearch'])) { 
        $search = $_POST['search'];
        $ratingView = new postRatingView();
        $post = new postView();
        //search for posts with similar title
        $searchResults = $post->searchPosts($search);

        function highlightWords($text, $word){
            $text = preg_replace('#'.preg_quote($word).'#i','<span class="hlw">\\0</span>',$text);
            return $text;
        }
        
?>


<?php foreach($searchResults as $searchResult) { 
        $title = highlightWords($searchResult['title'],$search);
        $content = highlightWords($searchResult['content'],$search);
    
    ?>

<!-- post wrapper -->
<div class="post-wrapper">
    <a href="comments.php?post_id=<?php echo $searchResult['postID']?>" class="redirect"></a>
    <!-- post header -->
    <div class="post-header">
        <div class="poster-img">
            <?php 
                        
                        echo '<img src="Images/'.$searchResult['username'].'dp.jpeg" />'
                        ?>
            <a href="Profile.php?username=<?php echo $searchResult['username'] ?>"></a>
        </div>
        <div class="poster-info">
            <a href="Profile.php?username=<?php echo $searchResult['username'] ?>"
                class="username"><?php echo $searchResult['username']?></a>
            <span class="time-posted"><?php echo $post->timeAgo($searchResult['postedDate'])?></span>
        </div>




    </div>
    <!-- post header -->

    <!-- post body -->
    <div class="post-body">

        <div class="post-info">
            <span class="post-title"><?php echo  $title?></span>
            <?php 
                        switch ($searchResult['flair']) {
                            case "Help":
                                echo '<span class="post-flair help">'.$searchResult['flair'].'</span>';
                                break;
                            case "Question":
                                echo '<span class="post-flair question">'.$searchResult['flair'].'</span>';
                                break;
                            case "Info":
                                echo '<span class="post-flair info">'.$searchResult['flair'].'</span>';
                                break;
                            case "General":
                                echo '<span class="post-flair general">'.$searchResult['flair'].'</span>';
                                 break;
                        }
                    ?>
        </div>
        <div class="post-content">
            <?php echo  $content?>
        </div>
    </div>
    <!-- post body -->

    <!-- likes/comments/share -->
    <div class="post-interaction">
        <div class="post-interaction like">
            <i <?php if ($ratingView->userLiked($_SESSION["username"],$searchResult['postID'])): ?>
                class="fa-solid fa-heart like-btn" <?php else: ?> class="fa-regular fa-heart like-btn" <?php endif ?>
                data-id="<?php echo $searchResult['postID']?>">
                <span class="likes"><?php echo $ratingView->displayLikes($searchResult['postID'])?></span>
            </i>

        </div>
        <div class="post-interaction comment">
            <i class="fa-regular fa-comments"><span>Comments</span></i>
            <a href="comments.php?post_id=<?php echo $searchResult['postID']?>"></a>
        </div>
        <div class="post-interaction share">
            <i class="fa-regular fa-share-from-square"><span>Share</span></i>
        </div>
    </div>
    <!-- likes/comments/share -->

</div>
<!-- post wrapper -->

<?php  }
}?>