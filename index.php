<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/LogReg/login.scss">
    <script src="https://kit.fontawesome.com/0f3bba9cb1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/LogReg.js"></script>


    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&family=Varela+Round&display=swap"
        rel="stylesheet">
    <!-- Font -->
</head>

<body>

    <form class="log-form" action="" type="POST">
        <div class="web-title">
            <img src="Images/HMText.png">
        </div>

        <div class="login-box">

            <div class="login-user">
                <input type="text" id="email" class="login__form" autocomplete="off" placeholder=" ">
                <label for="email" class="login__label">Email</label>
            </div>
            <div class="login-pass">
                <input type="password" id="pass" class="pass__form" autocomplete="off" placeholder=" ">
                <label for="pass" class="pass__label">Password</label>
            </div>

            <button class="login-btn">
                <span>Login</span>
            </button>
        </div>

        <div class="register">
            <a href="register.php">Don't have an account?</a>
        </div>
    </form>

    <div class="errors">
        <p class="cred">Email and password did not match!</p>
        <p class="exist">Account does not exist!</p>
        <p class="email">Invalid Email!</p>
        <p class="input">Inputs can't be empty</p>
    </div>
    <script src="" async defer></script>
</body>

</html>

</html>