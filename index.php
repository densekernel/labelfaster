<!-- <html>
<head>
  <title>Label Faster</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../datasets/raw-data/35.json"></script>
  <script type="text/javascript">
    var data = JSON.parse();
    console.log(data);
  </script>
</head>
<body>

</body>
</html> -->

<!-- Credits
  http://stackoverflow.com/questions/7346563/loading-local-json-file
 -->

<html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <body>

  <h1>Label Faster</h1>

  <h2>Json File</h2>

  <form id="jsonFile" name="jsonFile" enctype="multipart/form-data" method="post">
    <fieldset>
      
       <input type='file' id='fileinput'>
       <input type='button' id='btnLoad' value='Load' onclick='loadFile();'>
    </fieldset>
  </form>

  <div style="width:80%; float:left;">

    <h2>View Article</h2>

    <div id="article-viewer">
      <h3 id="article-title"></h3>
      <p id="article-id"></p>
      <p id="article-content"></p>
    </div>

  </div>

  <div style="width:20%; float:left;">
    <h2>Navigation</h2>
    <button onclick="prev()">previous</button>
    <button onclick="next()">next</button>

    <h2>Save Label</h2>
    <!-- <form id="feedback" action="write_eval.php" method="POST"> -->
    <form id="feedback" method="POST">
      <label>Filename</label>
      <input name="fn" type="text" />
      <br>
      <label>Story</label>
      <input name="story" type="text" />
      <br>
      <label>Event</label>
      <input name="event" type="text" />
      <br>
      <label>Decision</label>
      <input name="decision" type="text" />
      <br>
      <input type="submit" name="submit" value="Save Data">
    </form>
  </div>

  <script type="text/javascript">

    var newArr = [];

    function loadFile() {
      var input, file, fr;

      if (typeof window.FileReader !== 'function') {
        alert("The file API isn't supported on this browser yet.");
        return;
      }

      input = document.getElementById('fileinput');
      if (!input) {
        alert("Um, couldn't find the fileinput element.");
      }
      else if (!input.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else if (!input.files[0]) {
        alert("Please select a file before clicking 'Load'");
      }
      else {
        file = input.files[0];
        fr = new FileReader();
        fr.onload = receivedText;
        fr.readAsText(file);
      }

      function receivedText(e) {
        lines = e.target.result;
        newArr = JSON.parse(lines); 
        console.log(newArr);
        viewArticle(newArr, 0);
      }

      // function postLabel() {
      //   $.post('write_eval.php', $('#feedback').serialize())
      // }
    }

    function viewArticle(newArr, index) {
      var el = newArr[index];
      var el_id = el["_id"];
      var el_title = el["_source"]["title"];
      var el_content = el["_source"]["content"];
      // var content = el["_source"]["content"];
      console.log("loading article");
      console.log(el_id);
      $("#article-id").html(el_id);
      $("#article-title").html(el_title);
      $("#article-content").html(el_content);
      $("input[name=story").val(el_id);
    }

    function prev() {
      // console.log(curr);
      if (curr > 0) { curr--; viewArticle(newArr, curr); console.log(curr);}
    }

    function next() {
      // console.log(curr);
      if (curr < newArr.length - 1) { curr++; viewArticle(newArr, curr); console.log(curr);}
    }

    var curr = 0;

    console.log(curr);

    $('#feedback').bind('submit',function() {
      var str = $('#feedback').serialize();
      console.log(str);
      $.post("write_eval.php", { formString: str }, 
          function(data) {

              alert("Saved: " + data);
              curr++;
              console.log(curr);
              viewArticle(newArr, curr)
          }
      );
      // more of your code
      return false;
    });
  </script>

  </body>
</html>