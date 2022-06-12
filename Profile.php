<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Profile/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/prism.js"></script>
    <script src="js/rating.js"></script>
    <script src="js/share.js"></script>
    <!-- <link rel="stylesheet" type="text/css" id="mce-u0"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/content.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u1"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/content/default/content.min.css"> -->
</head>

<body>

    <?php
        include "Header.php";
        include "includes/dbh.inc.php";

        include "classes/postclass/post.classes.php";
        include "classes/postclass/post-view.classes.php";
        include "classes/postRating/postRating.classes.php";
        include "classes/postRating/postRating-view.classes.php";
        include "classes/profile/profile.classes.php";
        include "classes/profile/profile-view.classes.php";
        
        
        $userinfo = new profileView();
        $userPosts = new postView();
        if(isset($_GET['username'])) {
        $username = $_GET['username'];
        }
        else {
            header("Location: index.php");
        }
        if(isset($_SESSION['username'])){
            $user = $_SESSION['username'];
        }
        else {
            $user = "";
        }

        if(strcmp($username,$user) == 0){
            $isProfile = true;

        }
        else{
            $isProfile = false;
        }

        
        $details = $userPosts->displayUserPosts($username);

        $ratingView = new postRatingView();

        $profile = $userinfo->viewUserProfile($username);

        
    ?>

    <div class="container">

        <div class="left-container">
            <div class="profile-container">

                <?php if($isProfile) {?>
                <i class="fa-solid fa-pen-to-square"><a href="ImageEdit.php"></a></i>
                <i class="fa-solid fa-pen-to-square edit"><a class="editProf"
                        href="profileEdit.php?name=<?php echo $profile['fullname'];?>&about=<?php echo $profile['about'];?>&course=<?php echo $profile['course'];?>&batch=<?php echo $profile['batch']; ?>"></a></i>

                <?php }?>
                <div class="user-img">
                    <img src="Images/<?php echo $username?>dp.jpeg" alt="Not Found" loading="lazy"
                        onerror=this.src="Images/default.jpeg" />
                </div>
                <div class=" user-name">
                    <span><?php if(empty($profile['fullname'])){echo "Nameless";}else{echo $profile['fullname'];}
                    
    
                    ?></span>
                </div>

                <div class="bio">
                    <span class="info-title">About</span>
                    <span class="info-content"><?php 
                        if(empty($profile['about'])) {

                            echo "No bio yet"; 
                        }else {
                                echo $profile['about']; 
                                };?></span>
                </div>

                <div class="user-info">
                    <div class="profile faculty">
                        <span class="info-label">Faculty</span>
                        <span class="info-content">Faculty of Computing</span>
                    </div>
                    <div class="profile course">
                        <span class="info-label">Course</span></span>
                        <span class="info-content"><?php
                                    if(empty($profile['course'])){
                                        echo "You haven't set up your profile!";
                                    }else {
                                        echo $profile['course'];
                                    };
                            
                            ?></span>
                    </div>
                    <div class="profile batch">
                        <span class="info-label">Batch</span>
                        <span
                            class="info-content"><?php if(empty($profile['batch'])) {echo "You haven't set up your profile!";}else{echo $profile['batch'];}?></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="right-container">
            <div class="post-something">
                <a href="post.php"><input placeholder="Post Something!"></a>
            </div>

            <div class="feed">

                <?php if(empty($details)) {
                   echo "This user hasn't posted anything yet!";
               }
                   ?>

                <?php foreach($details as $detail) { ?>

                <!-- post wrapper -->
                <div class="post-wrapper">
                    <a href="comments.php?post_id=<?php echo $detail['postID']?>" class="redirect"></a>
                    <!-- post header -->
                    <div class="post-header">
                        <div class="poster-img">
                            <?php 
                        

                        echo '<img src="Images/'.$detail['username'].'dp.jpeg" loading="lazy"/>'
                        ?>
                            <a href="Profile.php?username=<?php echo $detail['username'] ?>"></a>
                        </div>
                        <div class="poster-info">
                            <a href="Profile.php?username=<?php echo $detail['username'] ?>"
                                class="username"><?php echo $detail['username']?></a>
                            <span class="time-posted"><?php echo $userPosts->timeAgo($detail['postedDate'])?></span>
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
    </div>

    <script src="" async defer></script>
</body>


</html>