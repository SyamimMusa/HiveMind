$(document).ready(function () {
  //post rating logic
  $(".like-btn").on("click", function () {
    console.log("liked");
    var post_id = $(this).data("id");
    $clicked_btn = $(this);

    if ($clicked_btn.hasClass("fa-regular")) {
      action = "like";
    } else if ($clicked_btn.hasClass("fa-solid")) {
      action = "unlike";
    }

    $.ajax({
      type: "post",
      url: "includes/rating.inc.php",
      data: {
        post_rating: 1,
        action: action,
        post_id: post_id,
      },
      success: function (data) {
        res = JSON.parse(data);

        if (action == "like") {
          $clicked_btn.removeClass("fa-regular");
          $clicked_btn.addClass("fa-solid");
          console.log("liked");
        } else if (action == "unlike") {
          $clicked_btn.removeClass("fa-solid");
          $clicked_btn.addClass("fa-regular");
          console.log("unliked");
        }

        console.log(res.likes);

        $clicked_btn.children("span.likes").text(res.likes);
      },
    });
  });
  //post rating logic

  //comment rating logic
  $(".comment-section").on("click", ".com-like", function () {
    var com_id = $(this).data("cid");
    $clicked_btn = $(this);

    console.log(com_id);
    console.log($clicked_btn);

    if ($clicked_btn.hasClass("fa-regular")) {
      action = "like";
    } else if ($clicked_btn.hasClass("fa-solid")) {
      action = "unlike";
    }

    $.ajax({
      type: "post",
      url: "includes/rating.inc.php",
      data: {
        com_rating: 1,
        action: action,
        com_id: com_id,
      },
      success: function (data) {
        res = JSON.parse(data);

        if (action == "like") {
          $clicked_btn.removeClass("fa-regular");
          $clicked_btn.addClass("fa-solid");
          console.log(action);
        } else if (action == "unlike") {
          $clicked_btn.removeClass("fa-solid");
          $clicked_btn.addClass("fa-regular");
          console.log(action);
        }

        $clicked_btn.children("span.likes").text(res.likes);
      },
    });
  });
  //comment rating logic

  //reply rating logic
  $(".comment-section").on("click", ".rep-like", function () {
    var reply_id = $(this).data("cid");
    $clicked_btn = $(this);
    console.log(reply_id);
    console.log($clicked_btn);

    if ($clicked_btn.hasClass("fa-regular")) {
      action = "like";
    } else if ($clicked_btn.hasClass("fa-solid")) {
      action = "unlike";
    }

    $.ajax({
      type: "post",
      url: "includes/rating.inc.php",
      data: {
        reply_rating: 1,
        action: action,
        reply_id: reply_id,
      },
      success: function (data) {
        res = JSON.parse(data);

        if (action == "like") {
          $clicked_btn.removeClass("fa-regular");
          $clicked_btn.addClass("fa-solid");
          console.log(action);
        } else if (action == "unlike") {
          $clicked_btn.removeClass("fa-solid");
          $clicked_btn.addClass("fa-regular");
          console.log(action);
        }

        $clicked_btn.children("span.likes").text(res.likes);
      },
    });
  });
  //reply rating logic
});
