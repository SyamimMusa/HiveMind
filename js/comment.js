//ADDING MAIN COMMENTS TO POSTS
$("#addComment").on("click", function () {
  var post_id = $("#addComment").data("id");
  var comment = tinyMCE.activeEditor.getContent();
  var post_creator = $(".creator").val();

  //Remove extra line breaks.
  var comment = comment.replace(/&nbsp;/g, "");
  //Remove extra spaces
  var comment = comment.replace(/\s+/g, " ");

  if ($(comment).text().replace(/\s/g, "").length > 0) {
    console.log(comment);
  } else {
    console.log("Empty");
  }

  //remove tags for length validation
  var removeTags = $(comment).text();

  var length = removeTags.replace(/\s/g, "").length;

  if (length > 0) {
    $.ajax({
      type: "post",
      url: "includes/comment.inc.php",
      data: {
        isMain: 1,
        content: comment,
        post_id: post_id,
        post_creator: post_creator,
      },
      success: function (data) {
        //prepend comment to comment section
        res = JSON.parse(data);

        tinyMCE.activeEditor.setContent("");
        $(".comment-section").prepend(res.response);
        $com_id = res.com_id;
        $.ajax({
          type: "post",
          url: "includes/comment.inc.php",
          data: {
            isPostNoti: 1,
            post_id: post_id,
            com_id: $com_id,
            post_creator: post_creator,
          },
        });
      },
    });
  } else {
    console.log("Not enough characters");
  }
});

//ADDING A REPLY TO MAIN COMMENTS
$("#addReply").on("click", function () {
  //get username and commentid of the main comment
  commentID = $("#addReply").attr("data-cid");
  username = $("#addReply").attr("data-uid");
  var post_id = $("#addComment").data("id");
  var post_creator = $(".creator").val();
  var reply_sec = ".replies-section" + commentID;

  //get the content of the editor (user input)
  var comment = tinyMCE.activeEditor.getContent();

  //check if user input is empty or not
  if ($(comment).text().replace(/\s/g, "").length > 0) {
    console.log("Has text");
  } else {
    console.log("Empty");
    return;
  }

  //remove html tags for length validation
  var removeTags = $(comment).text();

  //lenght calculation
  var length = removeTags.replace(/\s/g, "").length;

  //lenght validation
  if (length > 0) {
    //if validation is success
    //Send data to server
    $.ajax({
      type: "post",
      url: "includes/comment.inc.php",
      data: {
        isReply: 1,
        content: comment,
        parent_id: commentID,
        posted_to: username,
        post_creator: post_creator,
      },
      success: function (data) {
        res = JSON.parse(data);

        //set editor content to null or empty
        tinyMCE.activeEditor.setContent("");

        //append reply to main comment
        $(reply_sec).prepend(res.response);
        $("#addReply").parent().hide();

        $reply_id = res.reply_id;
        //ajax
        $.ajax({
          type: "post",
          url: "includes/comment.inc.php",
          data: {
            isReplyNoti: 1,
            post_id: post_id,
            reply_id: $reply_id,
            post_creator: post_creator,
          },
          success: function () {
            console.log("reply noti");
          },
        });
      },
    });
  } else {
    console.log("Not enough characters");
  }
});

$(".close").on("click", function () {
  $(".close").parent().hide();
});

function moveEditor(caller) {
  //get username and comment id from the comment
  commentID = $(caller).attr("data-cid");
  username = $(caller).attr("data-uid");

  //add data-attribute to editor and assign the values from above
  $("#addReply").attr("data-cid", commentID);
  $("#addReply").attr("data-uid", username);

  //Remove instance of tinymce editor from editor
  tinymce.execCommand("mceRemoveEditor", false, "reply");
  //move editor and append to the main comment
  $(".reply-form").insertAfter($(caller).parent().parent());

  //reinstantiate tinymce editor after moving
  tinymce.execCommand("mceAddEditor", false, {
    id: "reply",
    options: {
      branding: false,

      width: "600",
      height: "200",

      plugins: "link  codesample autolink lists advlist wordcount ",
      toolbar: "bold italic | numlist bullist | codesample blockquote",

      contextmenu: "link table",
      menubar: false,
      statusbar: false,
      toolbar_location: "bottom",

      content_style: "body {font-size: 0.9rem;}",
    },
  });

  //change display of editor to be visible.
  $(".reply-form").show();
}

$(document).ready(function () {
  if (window.localStorage) {
    if (!localStorage.getItem("firstLoad")) {
      console.log("reload");
      localStorage["firstLoad"] = true;
      window.location.reload();
    } else {
      console.log("dont reload");
      localStorage.removeItem("firstLoad");
    }
  }
});
