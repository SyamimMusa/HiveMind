<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hive Mind</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Notifications/Notifications.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/notifications.js"></script>
</head>

<body>
    <?php 
    
    include 'Header.php';
    include 'includes/dbh.inc.php';
    include 'classes/notifications/noti.classes.php';
    include 'classes/notifications/noti-view.classes.php';
    include 'classes/comment/comment.classes.php';
    include 'classes/comment/comment-view.classes.php';

    $Notification = new notiView();
    $Notification->readPostNoti($_SESSION['username']);
    $Notification->readReplyNoti($_SESSION['username']);
    $time = new commentView();

    if($_GET['active'] == 'coms') {
        $postNotifications = $Notification->displayPostNoti($_SESSION['username']);
    }
    else if ($_GET['active'] == 'reps'){
        $postNotifications = $Notification->displayReplyNoti($_SESSION['username']);
    }

    ?>
    <h3>Notifications</h3>
    <div class="noti-section">
        <?php if($_GET['active'] == 'coms') {?>
        <a class="noti-bttn coms active" href="Notifications.php?active=coms">Comments</a>
        <a class="noti-bttn reps" href="Notifications.php?active=reps">Replies</a>
        <?php } else if ($_GET['active'] == 'reps') { ?>
        <a class="noti-bttn coms" href="Notifications.php?active=coms">Comments</a>
        <a class="noti-bttn reps active" href="Notifications.php?active=reps">Replies</a>
        <?php } ?>
    </div>
    <div class="noti-container">



        <?php foreach($postNotifications as $postNotification) {?>
        <div class=" noti-feed">

            <?php if($_GET['active'] == 'coms') { ?>
            <span class="noti-title"><?php echo $postNotification['title']?></span>
            <div class="noti-user">
                <img src="Images/<?php echo $postNotification['user_from']?>dp.jpeg">
                <span class="noti-user"><span class="username"><?php echo $postNotification['user_from']?>
                    </span>commented on your post .</span>
                <span class="noti-timeago"><?php echo $time->timeAgo($postNotification['createdOn']); ?> :</span>
            </div>
            <span class="noti-content"><?php echo $postNotification['content']?></span>
            <a class="goto"
                href="comments.php?post_id=<?php echo $postNotification['postID'];?>#comsec<?php echo $postNotification['commentID'];?>"></a>

            <?php } else if($_GET['active'] == 'reps') {?>
            <span class="noti-title"><?php echo $postNotification['title']?></span>
            <div class="noti-user">
                <img src="Images/<?php echo $postNotification['user_from']?>dp.jpeg">
                <span class="noti-user"><span class="username"><?php echo $postNotification['user_from']?>
                    </span>commented on your post .</span>
                <span class="noti-timeago"><?php echo $time->timeAgo($postNotification['repliedOn']); ?> :</span>
            </div>
            <span class="noti-content"><?php echo $postNotification['content']?></span>
            <a class="goto"
                href="comments.php?post_id=<?php echo $postNotification['postID'];?>#repsec<?php echo $postNotification['reply_id'];?>"></a>
        </div>

        <?php 
        }
         ?>
    </div>
    <?php 
}?>

    <script src="" async defer></script>
</body>

</html>