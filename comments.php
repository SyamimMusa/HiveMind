<!DOCTYPE html>
<?php
include 'includes/dbh.inc.php';
include 'classes/postclass/post.classes.php';
include 'classes/postclass/post-view.classes.php';

include 'classes/comment/comment.classes.php';
include 'classes/comment/comment-contr.classes.php';
include 'classes/comment/comment-view.classes.php';

include 'classes/comRating/comRating.classes.php';
include 'classes/comRating/comRating-view.classes.php';

include 'classes/replyRating/replyRating.classes.php';
include 'classes/replyRating/replyRating-view.classes.php';


include 'Header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hive Mind</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Comment/comment.css">
    <link rel="stylesheet" href="css/prism.css">

    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <script src="js/prism.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce/js/tinymce/tinymce.min.js" async defer></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js" async defer></script>
    <script src="https://cdn.tiny.cloud/1/abigls2jsnpkaqwv45a7pxovz1p5nyz8u52gvtr9g99b51gj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" type="text/css" id="mce-u0"
        href="plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/skin.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u0"
        href="plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/content.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u1"
        href="plugin/tinymce/tinymce/js/tinymce/skins/content/default/content.min.css">

</head>

<body>


    <?php
        if(isset($_GET['post_id'])){
        $postID = $_GET['post_id'];
        $comment = new postView();

        $comment->displayPost($postID);
        $creator = $comment->setCreator($postID);
        $comRating = new comRatingView();
        $replyRating = new replyRatingView();
        }




        if(isset($_SESSION['username'])) {
            $LoggedUser = $_SESSION['username'];
        }
        else {
            $LoggedUser = "";
        }
        
    ?>
    <hr>
    <div class="comment-wrapper">
        <div class="main-comment">
            <textarea id="editor" name="editor" class="comment"></textarea>

            <?php  if(isset($_SESSION['username'])) {?>
            <button id="addComment" data-id="<?php echo $postID ?>">Comment</button>

            <?php } else {?>
            <p>Log in to comment!</p>
            <?php }?>
        </div>
    </div>

    <hr>

    <!-- comment section -->
    <div class="comment-section">
        <?php 
                // display all comments
             
                $com_view = new commentView();
                $comments = $com_view->displayAllComments($postID); 

                foreach ($comments as $comment) { 
                $checkReplies = $com_view->checkReplies($comment['commentID']);
                ?>
        <!-- main comments -->
        <div class="main" id="comsec<?php echo $comment['commentID']?>">
            <div class="com-detail">
                <div class="com-img">
                    <img src="Images/<?php echo $comment['username']?>dp.jpeg" alt="Not Found"
                        onerror=this.src="Images/default.jpeg" />
                    <a href="Profile.php?username=<?php echo $comment['username'] ?>"></a>
                </div>
                <?php 
            if (strcmp($comment['username'], $creator["username"]) == 0) { 
               
                echo '<a href="Profile.php?username='.$comment['username'].'" class="username creator">'.$comment['username'].'</a>';
                

            } else {
                echo '<a href="Profile.php?username='.$comment['username'].'" class="username">'.$comment['username'].'</a>';
            }      
            ?>

                <span class="timeAgo"><?php echo $com_view->timeAgo($comment['createdOn']) ?></span>
            </div>
            <div class="comment-content">
                <?php echo $comment['content'] ?>
            </div>

            <div class="comment-interaction">
                <div class=" rating">
                    <i <?php if ($comRating->userLiked( $LoggedUser,$comment['commentID'])): ?>
                        class="fa-solid fa-heart com-like" <?php else: ?> class="fa-regular fa-heart com-like"
                        <?php endif ?> data-cid="<?php echo $comment['commentID'] ?>"><span
                            class="likes"><?php echo $comRating->displayLikes($comment['commentID'])?></span></i>
                </div>
                <div class="reply">
                    <a class="reply-btn" href="javascript:void(0)" onclick="moveEditor(this)"
                        data-uid="<?php echo $comment['username'] ?>"
                        data-cid="<?php echo $comment['commentID'] ?>">Reply</a>
                </div>

            </div>

            <!-- reply section -->
            <div class="main-reply replies-section<?php echo $comment['commentID']?>">
                <?php
                            if ($checkReplies > 0) {
                            $replies = $com_view->displayReplies($comment['commentID']); 
                            foreach($replies as $reply) { ?>


                <div class="main reply" id="repsec<?php echo $reply['reply_id']?>">
                    <div class="com-detail">
                        <div class="com-img">
                            <img class="com-img" src="Images/<?php echo $reply['posted_by']?>dp.jpeg" alt="Not Found"
                                onerror=this.src="Images/default.jpeg" />
                            <a href="Profile.php?username=<?php echo $reply['posted_by'] ?>"></a>
                        </div>

                        <?php 
                        if (strcmp($reply['posted_by'], $creator["username"]) == 0) { 
                        
                            echo '<a href="Profile.php?username='.$reply['posted_by'].'" class="username creator"><span data-creator="OP"></span>'.$reply['posted_by'].'</a>';
                            

                        } else {
                            echo '<a href="Profile.php?username='.$reply['posted_by'].'" class="username">'.$reply['posted_by'].'</a>';
                        }      
                        ?>
                        <i class="fa-solid fa-caret-right"></i>
                        <a href="Profile.php?username=<?php echo $reply['posted_to']?>"
                            class="username to"><?php echo $reply['posted_to']?></a>
                        <span class="dot">.</span>
                        <span class="timeAgo"><?php echo $com_view->timeAgo($reply['repliedOn']) ?></span>
                    </div>
                    <div class="comment-content">
                        <?php echo $reply['content'] ?>
                    </div>


                    <div class="comment-interaction">

                        <div class=" rating">
                            <i <?php if ($replyRating->userLiked($LoggedUser,$reply['reply_id'])): ?>
                                class="fa-solid fa-heart rep-like" <?php else: ?> class="fa-regular fa-heart rep-like"
                                <?php endif ?> data-cid="<?php echo $reply['reply_id'] ?>"><span
                                    class="likes"><?php echo $replyRating->displayLikes($reply['reply_id'])?></span></i>
                        </div>

                        <div class=" reply">
                            <a class="reply-btn" href="javascript:void(0)" onclick="moveEditor(this)"
                                data-uid="<?php echo $reply['posted_by'] ?>"
                                data-cid="<?php echo $comment['commentID'] ?>">Reply</a>
                        </div>


                    </div>

                </div>



                <?php
                    }// foreach reply
                }// if check reply
            echo ' </div> <!-- reply section -->';
      
            ?>

            </div><!-- main -->
            <?php 
                      }// for each main comment
                ?>
        </div> <!-- comment section -->

    </div> <!-- post-wrapper -->




    <div class="reply-form" style="display:none">
        <textarea id="reply" class="uninit"></textarea>
        <button class="button close">Close</button>
        <?php  if(isset($_SESSION['username'])) {?>
        <button class="button add" id="addReply" data-id="<?php echo $postID ?>">Comment</button>
        <?php } else {?>
        <p>Log in to Reply!</p>
        <?php }?>

    </div>


    <!-- reply form div -->
    <script type="text/javascript" src="js/jquery.min.js" async defer></script>

    <script type="text/javascript" src="js/comment.js" async defer></script>


    <script src="js/rating.js" async defer></script>
</body>

</html>