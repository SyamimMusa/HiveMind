tinymce.init({
  selector: "textarea.comment",
  branding: false,

  width: "640",
  height: "200",

  plugins: "link  codesample autolink lists advlist wordcount ",
  toolbar: "bold italic | numlist bullist | codesample blockquote",

  contextmenu: "link  table",
  menubar: false,
  statusbar: false,
  toolbar_location: "bottom",
  content_style: "body {font-size: 0.9rem;}",
});

tinymce.init({
  selector: "textarea#reply",
  branding: false,

  width: "640",
  height: "200",

  plugins: "link  codesample autolink lists advlist wordcount ",
  toolbar: "bold italic | numlist bullist | codesample blockquote",

  contextmenu: "link  table",
  menubar: false,
  statusbar: false,
  toolbar_location: "bottom",
  content_style: "body {font-size: 0.9rem;}",
});
