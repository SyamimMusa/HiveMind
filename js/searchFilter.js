$(document).ready(function () {
  $("input[name='flair']").change(function () {
    $flair = $("input[name='flair']:checked").val();
    console.log($flair);

    $.ajax({
      type: "post",
      url: "includes/filter.php",
      data: {
        isFilter: 1,
        flair: $flair,
      },
      success: function (data) {
        $(".feed-right").html("");
        $(".feed-right").html(data);
      },
    });
  });

  $("#search-bar").on("keydown", function search(e) {
    if (e.keyCode == 13) {
      $search = $("#search-bar").val();

      $.ajax({
        type: "post",
        url: "includes/filter.php",
        data: {
          isSearch: 1,
          search: $search,
        },
        success: function (data) {
          $(".feed-right").html(data);
        },
      });
    }
  });

  setInterval(function () {
    $.ajax({
      type: "post",
      url: "includes/notification.inc.php",
      success: function (data) {
        console.log("hello");
        $(".fa-envelope").append(data);
      },
    });
  }, 10000);
});
