<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Profile/profileEdit.scss">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/profileEdit.js"></script>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&family=Varela+Round&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <!-- Font -->
</head>

<body>

    <?php session_start(); 
    if(isset($_SESSION['username'])) {

        $name = $_GET['name'];
        $batch = $_GET['batch'];
        // $course = $_GET['course'];
        $about = $_GET['about'];
    ?>

    <form action="" type="POST" class="prof-form">
        <div class="header">
            <h2>Set up your profile!</h2>
        </div>

        <div class="prof-box">
            <div class="prof-name">
                <input type="text" id="name" class="name__form field" autocomplete="off" value="<?php echo $name; ?>">
                <label for="name" class="name__label">Full Name</label>
            </div>

            <div class="prof-course">
                <!-- <input type="text" id="course" class="course__form" autocomplete="off" placeholder=" "> -->
                <label for="course" class="course__label">Course</label>

                <select name="course" id="course" class="course__form field">
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Computer Systems & Networking">Computer Systems & Networking</option>
                    <option value="Graphics & Multimedia Technology">Graphics & Multimedia Technology</option>
                </select>
            </div>

            <div class="prof-batch">
                <input type="number" id="batch" class="batch__form field" autocomplete="off"
                    value="<?php echo $batch;?>" min='2017' max='2999'>
                <label for="batch" class="batch__label">Batch</label>
            </div>

            <div class="prof-bio">
                <textarea id="bio" name="bio" class="bio__form field"><?php echo $about;?></textarea>
                <label for="bio" class="bio__label">Bio :</label>
            </div>

            <input type="hidden" id="username" class="username" value="<?php echo $_SESSION['username']; ?>">

            <button class="edit-btn">
                <span>Edit</span>
            </button>
        </div>


    </form>

    <div class="errors">
        <p class="msg bio">Your bio must be less than 100 characters!</p>
        <p class="msg username">Your name must be less than 20 characters!</p>
        <p class="msg empty">Inputs cannot be empty!</p>
    </div>

    <?php } else {
        header("Location: index.php");
    } ?>

    <script src="" async defer></script>
</body>

</html>

</html>