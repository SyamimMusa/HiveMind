$(document).ready(function () {
  $(".reg-form").submit(function (e) {
    //Clear all warnings
    $(".msg").css("display", "none");
    $(".field").removeClass("invalid");
    //Prevent form submission and page reload
    e.preventDefault(e);

    //Get user input
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#pass").val();
    var confirmPwd = $("#cfrm").val();

    //email string validation logic
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var emailValidation = regex.test(email);

    //Check if inputs are empty
    if (email == "") {
      $(".email__form").addClass("invalid");
    }
    if (username == "") {
      $(".username__form").addClass("invalid");
    }
    if (password == "" || confirmPwd == "") {
      $(".pass__form").addClass("invalid");
      $(".cfrm__form").addClass("invalid");
    }
    //Check if inputs are empty

    //username validation
    if (/\s/g.test(username)) {
      $(".username__form").addClass("invalid");
      $(".space").css("display", "block");
    } else {
      if (username.length > 0 && username.length < 5) {
        $(".username__form").addClass("invalid");
        $(".short").css("display", "block");
        var short = true;
      }
      if (username.length > 13) {
        $(".username__form").addClass("invalid");
        $(".long").css("display", "block");
        var long = true;
      }

      if (!short || !long) {
        var userValid = true;
      }
    }
    //username validation

    if (email) {
      //email validation
      if (emailValidation) {
        var emailValid = true;
      } else if (!emailValidation) {
        $(".email__form").addClass("invalid");
        $(".email").css("display", "block");
      }
    }
    //email validation

    //password validation
    if (password !== "" || confirmPwd !== "") {
      if (password === confirmPwd) {
        //check password length
        if (password.length < 5) {
          $(".pass__form").addClass("invalid");
          $(".cfrm__form").addClass("invalid");
          $(".pass").css("display", "block");
        } else {
          var passValid = true;
        }
      } else {
        $(".pass__form").addClass("invalid");
        $(".cfrm__form").addClass("invalid");
        $(".match").css("display", "block");
      }
    }
    //password validation

    //If all variables pass, then send to server
    if (passValid && emailValid && userValid) {
      $.ajax({
        type: "POST",
        url: "includes/register.inc.php",
        data: {
          isReg: 1,
          email: email,
          username: username,
          password: password,
        },
        success: function (data) {
          res = JSON.parse(data);

          if (res.taken == 1) {
            $(".username").css("display", "block");
            $(".username__form").addClass("invalid");
            $(".email__form").addClass("invalid");
          } else {
            //empty input fields
            $("#email").val("");
            $("#username").val("");
            $("#pass").val("");
            $("#cfrm").val("");

            //Alert for sucessfull registration
            alert("You have sucessfully registered an account!");
          }
        },
      });
    }
    //If all variables pass, then send to server
  });

  $(".log-form").submit(function (e) {
    e.preventDefault(e);
    //Reset warnings
    $(".email").css("display", "none");
    $(".cred").css("display", "none");
    $(".exist").css("display", "none");
    $(".input").css("display", "none");

    $(".login__form").removeClass("invalid");
    $(".pass__form").removeClass("invalid");
    //Reset warnings
    var email = $("#email").val();
    var password = $("#pass").val();

    console.log(email);
    console.log(password);

    //check empty inputs
    if (email == "" || password == "") {
      $(".login__form").addClass("invalid");
      $(".pass__form").addClass("invalid");
      $(".input").css("display", "block");
    }

    //check if valid email
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var emailValidation = regex.test(email);

    if (!emailValidation && email != "") {
      $(".login__form").addClass("invalid");
      $(".email").css("display", "block");
    } else if (emailValidation) {
      $.ajax({
        type: "POST",
        url: "includes/login.inc.php",
        data: {
          isLog: 1,
          email: email,
          password: password,
        },
        success: function (data) {
          res = JSON.parse(data);

          if (res.exist == 1 && res.match == 1) {
            //redirect
            console.log("redirect");
            window.location.href = "Home.php";
          } else {
            if (res.exist == 0) {
              $(".login__form").addClass("invalid");
              $(".pass__form").addClass("invalid");
              $(".exist").css("display", "block");
            }

            if (res.match == 0) {
              $(".login__form").addClass("invalid");
              $(".pass__form").addClass("invalid");
              $(".cred").css("display", "block");
            }
          }
        },
      });
    }
  });
});
