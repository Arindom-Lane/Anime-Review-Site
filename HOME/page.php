<!DOCTYPE html>
<html>
<head>
  <title>AJAX vs Without AJAX (Single File)</title>
  <style>
    body { font-family: Arial; }
    .box { border: 1px solid #333; padding: 15px; margin: 15px 0; }
  </style>
</head>
<body>
 
<h1>AJAX vs WITHOUT AJAX (Single File)</h1>
 
<!-- WITHOUT AJAX -->
<div class="box">
  <h2>Without AJAX</h2>
  <p>Page reload simulation</p>
 
  <button onclick="withoutAjax()">Load Message</button>
 
  <p id="noAjaxResult"></p>
</div>
 
<!-- WITH AJAX -->
<div class="box">
  <h2>With AJAX</h2>
  <p>No page reload</p>
 
  <button onclick="withAjax()">Load Message</button>
 
  <p id="ajaxResult"></p>
</div>
 
<script>
// Function  without  AJAX
function withoutAjax() {
  location.reload(); // reload page
}
 
// Function With AJAX
//here the function sends a request in the background and shows the response without reloading the page.
 
function withAjax() {
  var xhttp = new XMLHttpRequest();  //ai khae  AJAX request object create kora hoise
 
  xhttp.onreadystatechange = function ()
  {
    if (this.readyState === 4 && this.status === 200)
    {
      document.getElementById("ajaxResult").innerHTML = this.responseText;
    }
  };
 
  // Using a data URL so no external file is needed
  xhttp.open("GET", "data:text/plain,Hello! Loaded using AJAX", true);
  xhttp.send();
}
/*  
 
XMLHttpRequest() → Create AJAX
onreadystatechange → Wait for response
readyState == 4 → Response ready
status == 200 → Success
responseText → Server data
*/
 
 
</script>
 
</body>
</html>