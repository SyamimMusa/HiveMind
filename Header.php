<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/Header/Header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&family=Nunito&family=Varela+Round&display=swap"
        rel="stylesheet">
    <!-- Font -->
</head>

<body>

    <div class="header_container">
        <div class="header_body">

            <div class="header_left">

                <img src="Images/Hivemind.png" onclick="javascript:window.location='Home.php'">
                <span class="logo-text">Hive Mind</span>
            </div>

            <nav class="header_center">

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input id="search-bar">
            </nav>

            <div class="header_right">

                <?php if(isset($_SESSION['username'])) {?>
                <a href="includes/logout.inc.php"><i class="fa-solid fa-door-open"></i></a>
                <a href="Notifications.php?active=coms"> <i class="fa-solid fa-envelope">
                    </i> </a>


                <?php
                  echo '<img src ="Images/'.$_SESSION["username"].'dp.jpeg?"'.mt_rand().' alt="Not Found" onerror=this.src="Images/default.jpeg" class="header-prof"/>';
                 
                ?>

                <a class="visit" href="Profile.php?username=<?php echo $_SESSION['username'] ?>">
                    <div class="overlay"></div>
                </a>

                <?php } else {?>

                <div class="lgn-btn">
                    <a href="index.php">Login</a>
                </div>

                <?php }?>

            </div>


        </div>
    </div>



</body>

</html>