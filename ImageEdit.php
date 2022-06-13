<?php
    session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upload an Image</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Profile/imageEdit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&family=Varela+Round&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php 
    if(isset($_GET['event'])) {
        $event = $_GET['event'];

        if(strcmp($event,"toobig")==0) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Your file size is too big!');";
           echo "</script>";
       
        }
        if(strcmp($event,"error")==0) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('There was an error uploading your image!');";
           echo "</script>";
       
        }
        if(strcmp($event,"invalid")==0) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Invalid Image type!');";
           echo "</script>";
       
        }
     }
    ?>

    <?php if(isset($_SESSION['username'])) {?>
    <h1>Change your profile Image!</h1>




    <div class="wrapper">

        <div class="set">
            <!-- set -->

            <form id="form" action="includes/profile.inc.php" method="POST" enctype="multipart/form-data">
                <!-- Upload profile pic -->
                <div class="form-item-img">
                    <label for="file-input" class="label">
                        <div class="image-preview" id="imagePreview">
                            <img src="" class="image-preview__image" />
                            <?php
                  echo '<img src="Images/'.$_SESSION["username"].'dp.jpeg"   alt="Not Found" onerror=this.src="Images/default.jpeg" class="profile-img" id="profile-img"/>';
                ?>

                        </div>
                    </label>
                    <input id="file-input" type="file" name="file" class="input" />
                    <button type="submit" name="editPic"><span>Upload Picture</span></button>
                </div>

            </form>
        </div>
    </div> <!-- wrapper -->

    <?php } else {
    header("Location: index.php");
} ?>

</body>

</html>
<script>
const inpFile = document.getElementById("file-input");
const previewContainer = document.getElementById("imagePreview");
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".profile-img");

inpFile.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function() {
            console.log(this);
            previewImage.setAttribute("src", this.result);
        });

        reader.readAsDataURL(file);
    }

});
</script>