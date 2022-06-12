<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/postSubmit/post.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/abigls2jsnpkaqwv45a7pxovz1p5nyz8u52gvtr9g99b51gj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript" src="js/jquery.min.js" async defer></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce/js/tinymce/tinymce.min.js" async defer></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js" async defer></script>

    <link rel="stylesheet" type="text/css" id="mce-u0"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/content.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u1"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/content/default/content.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u0"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/ui/oxide/skin.min.css">
    <link rel="stylesheet" type="text/css" id="mce-u1"
        href="http://localhost/StudentHive(v2)/plugin/tinymce/tinymce/js/tinymce/skins/content/default/skin.min.css">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <script src="js/prism.js"></script>
    <script src="js/postSubmit.js"></script>

</head>

<body>
    <?php 
         include "Header.php";
         if(isset($_SESSION['username'])) {
?>
    <div class="container">

        <div class="form-container">
            <div class="input-container">
                <input class="post_title" type="text" placeholder="Title" name="title">
                <div class="counter">0/90</div>
                <p class="error title">Title can't be emtpy!</p>
                <p class="error content">Post content can't be empty or must be more than 10 characters!</p>
            </div>
            <div class="flair_list">

                <input type="radio" name="flair" id="flair-general" value="General" checked="checked">
                <label for="flair-general">General</label>
                <input type="radio" name="flair" id="flair-help" value="Help">
                <label for="flair-help">Help</label>
                <input type="radio" name="flair" id="flair-info" value="Info">
                <label for="flair-info">Info</label>
            </div>
            <div class="editor">
                <div id="postEditor"></div>
            </div>
            <button class="submitPost">Submit</button>

        </div>

    </div>
    <?php } else {
        header("Location: index.php");
    } ?>

</body>

</html>