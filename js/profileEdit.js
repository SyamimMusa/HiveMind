$(document).ready(function () {
  $(".prof-form").submit(function (e) {
    e.preventDefault(e);
    //Clear all warnings
    $(".msg").css("display", "none");
    $(".field").removeClass("invalid");

    var name = $("#name").val();
    var course = $("#course").val();
    var batch = $("#batch").val();
    var bio = $("#bio").val();
    var username = $("#username").val();

    var nameValid = true;
    var bioValid = true;
    var batchValid = true;

    //Check empty inputs
    if (name == "") {
      $(".name__form").addClass("invalid");
      $(".empty").css("display", "block");
      nameValid = false;
    }
    if (bio == "") {
      $(".bio__form").addClass("invalid");
      $(".empty").css("display", "block");
      bioValid = false;
    }
    if (batch == "") {
      $(".batch__form").addClass("invalid");
      $(".empty").css("display", "block");
      batchValid = false;
    }

    //check name length
    var nameClean = name.replace(/\s+/g, " ");
    if (nameClean.length > 20) {
      $(".name__form").addClass("invalid");
      $(".username").css("display", "block");
      var nameValid = false;
    }

    //check bio length
    var bioClean = bio.replace(/\s+/g, " ");
    if (bioClean.length > 100) {
      $(".bio__form").addClass("invalid");
      $(".bio").css("display", "block");
      var bioValid = false;
    }

    //check batch value
    if (batch > 2999 || batch < 2017) {
      console.log("NO");
      batch = false;
      console.log(batch);
    }

    if (nameValid && bioValid && batchValid) {
      $.ajax({
        type: "POST",
        url: "includes/profile.inc.php",
        data: {
          isProfile: 1,
          name: nameClean,
          course: course,
          batch: batch,
          bio: bioClean,
        },
        success: function () {
          console.log("profile edited");
          window.location.href = "Profile.php?username=" + username;
        },
      });
    }
  });
});
