<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hive Mind</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Index/HomeCreate.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" id="mce-u0"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/content.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u1"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/content/default/content.min.css">
    <script src="js/prism.js"></script>
    <script src="js/searchFilter.js"></script>
    <script src="js/share.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Index/HomePost.css">


</head>

<body>
    <?php
        include "Header.php";
        include 'includes/dbh.inc.php';
        include 'classes/profile/profile.classes.php';
        include 'classes/profile/profile-view.classes.php';
        include 'classes/postclass/post.classes.php';
        include 'classes/postclass/post-view.classes.php';

        
        include 'classes/postRating/postRating.classes.php';
        include 'classes/postRating/postRating-view.classes.php';
        include 'classes/postRating/postRating-contr.classes.php';

        if(isset($_SESSION['username'])) {
            $LoggedUser = $_SESSION['username'];
        }
        else {
            $LoggedUser = "";
        }
      
    ?>


    <div class="feed">

        <div class="post-something">
            <a href="post.php"><input placeholder="Post Something!"></a>
        </div>

        <div class="filter-function">

            <div class="radio-bttn">
                <input type="radio" name="flair" id="flair-all" value="All" checked="checked">
                <label class="flair-all" for="flair-all">All</label>
            </div>

            <div class="radio-bttn">
                <input type="radio" name="flair" id="flair-general" value="General">
                <label class="flair-general" for="flair-general">General</label>
            </div>

            <div class="radio-bttn">
                <input type="radio" name="flair" id="flair-help" value="Help">
                <label class="flair-help" for="flair-help">Help</label>
            </div>

            <div class="radio-bttn">
                <input type="radio" name="flair" id="flair-info" value="Info">
                <label class="flair-info" for="flair-info">Info</label>
            </div>


        </div>

        <div class="feed-right">
            <?php
            $flair = 'All';
            
            $post = new postView();
            
            $details = $post->displayAllPosts($flair);
           

            $ratingView = new postRatingView();
            

        ?>

            <?php foreach($details as $detail) { ?>

            <!-- post wrapper -->
            <div class="post-wrapper">
                <a href="comments.php?post_id=<?php echo $detail['postID']?>" class="redirect"></a>
                <!-- post header -->
                <div class="post-header">
                    <div class="poster-img">
                        <?php 
                        

                        echo '<img src="Images/'.$detail['username'].'dp.jpeg" loading="lazy" alt="Not Found" onerror=this.src="Images/default.jpeg"/>'
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
                        <i <?php if ($ratingView->userLiked($LoggedUser,$detail['postID'])): ?>
                            class="fa-solid fa-heart like-btn" <?php else: ?> class="fa-regular fa-heart like-btn"
                            <?php endif ?> data-id="<?php echo $detail['postID']?>">
                            <span class="likes"><?php echo $ratingView->displayLikes($detail['postID'])?></span>
                        </i>

                    </div>
                    <div class="post-interaction comment">
                        <i class="fa-regular fa-comments"><span>Comments</span></i>
                        <a href="comments.php?post_id=<?php echo $detail['postID']?>"></a>
                    </div>
                    <div class="post-interaction share">
                        <input type="hidden"
                            value="https://hive-mind-ump.herokuapp.com/comments.php?post_id=<?php echo $detail['postID'] ?>"
                            class="link">
                        <i class="fa-regular fa-share-from-square"><span>Share</span></i>
                    </div>
                </div>
                <!-- likes/comments/share -->

            </div>
            <!-- post wrapper -->

            <?php  }?>

        </div>



    </div>



    <!-- <script src="js/wordlimit.js"></script> -->
    <script src="js/rating.js" async defer></script>
</body>

</html>