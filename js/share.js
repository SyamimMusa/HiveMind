$(document).ready(function () {
  $(".share").on("click", function () {
    var link = $(this).children(".link");

    /* Select the text field */

    navigator.clipboard.writeText(link.val());

    alert("Post link copied : " + link.val());
  });
});
