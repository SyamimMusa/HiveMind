//Initialize editor in JS

$(document).ready(function () {
  tinymce.execCommand("mceAddEditor", false, {
    id: "postEditor",
    options: {
      branding: false,
      width: "650",
      height: "400",
      content_style: "body {font-size: 1rem;}",
      remove_linebreaks: true,

      plugins: "link table codesample autolink lists advlist ",
      toolbar:
        "undo redo |styleselect | bold italic | numlist bullist | table codesample blockquote",

      menubar: false,
      statusbar: false,

      init_instance_callback: () => {},
    },
  });

  $(".post_title")
    .unbind("keyup change input paste")
    .bind("keyup change input paset", function (e) {
      var $this = $(this);
      var val = $this.val();
      var valLength = val.length;

      var maxCount = 90;

      if (val.length < 91) {
        $(".counter").text(val.length + "/90");
      }
      if (valLength > maxCount) {
        $this.val($this.val().substring(0, maxCount));
      }
    });

  $(".submitPost").on("click", function () {
    //get title, flair, tinymce content
    var flair = $('input[name="flair"]:checked').val();
    var title = $(".post_title").val();

    //Validate title (remove empty spaces);
    var title = title.trim();
    var title = title.replace(/\s+/g, " ");
    if (title.length < 1) {
      $(".post_title").addClass("invalid");
      $(".title")
        .css({
          opacity: "0",
          display: "block",
        })
        .show()
        .animate({ opacity: 1 });
    }
    console.log(title);
    //validate tinymce content
    var post = tinyMCE.activeEditor.getContent();

    //remove html tags
    var remove = $(post).text();

    //remove extra empty spaces
    var a = remove.replace(/\s+/g, " ");

    //get length
    var char = a.length;

    if (char > 10) {
      //remove nbsp
      var post = post.replace(/&nbsp;/g, "");
      //remove extra empty spaces
      var post = post.replace(/\s+/g, " ");
      console.log(post);

      //send data with ajax
      $.ajax({
        type: "post",
        url: "includes/post.inc.php",
        data: {
          submitPost: 1,
          content: post,
          title: title,
          flair: flair,
        },
        success: function () {
          window.location.href = "Home.php";
          console.log("success");
        },
      });
    } else {
      $(".content")
        .css({
          opacity: "0",
          display: "block",
        })
        .show()
        .animate({ opacity: 1 });
    }
  });
});

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
