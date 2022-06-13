<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hive Mind Registration</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/LogReg/register.scss">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/LogReg.js"></script>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&family=Varela+Round&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <!-- Font -->
</head>

<body>

    <form action="" type="POST" class="reg-form">
        <div class="web-title">
            <img src="Images/HMText.png">
        </div>

        <div class="reg-box">

            <div class="reg-email">
                <input type="text" id="email" class="email__form field" autocomplete="off" placeholder=" ">
                <label for="email" class="email__label">Email</label>
            </div>

            <div class="reg-username">
                <input type="text" id="username" class="username__form field" autocomplete="off" placeholder=" ">
                <label for="username" class="username__label">Username</label>
            </div>

            <div class="reg-pass">
                <input type="password" id="pass" class="pass__form field" autocomplete="off" placeholder=" ">
                <label for="pass" class="pass__label">Password</label>
            </div>

            <div class="reg-cfrm">
                <input type="password" id="cfrm" class="cfrm__form field" autocomplete="off" placeholder=" ">
                <label for="cfrm" class="cfrm__label">Confirm Password</label>
            </div>

            <button class="reg-btn">
                <span>Register</span>
            </button>
        </div>

        <div class="register">
            <a href="index.php">Already have an account?</a>
        </div>
    </form>

    <div class="errors">
        <p class="msg email">Email is invalid or taken!</p>
        <p class="msg match">Password does not match!</p>
        <p class="msg pass">Password lenght must be more than 5 characters!</p>
        <p class="msg username">Username or email is taken!</p>
        <p class="msg space">Check your username for spaces!</p>
        <p class="msg short">Username must be more than 5 characters!</p>
        <p class="msg long">Username must be less than 13 characters!</p>
    </div>

    <script src="" async defer></script>
</body>

</html>

</html>