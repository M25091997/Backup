<!DOCTYPE html>
<html>
<body>

<h1>The XMLHttpRequest Object</h1>

<button type="button" onclick="loadDoc()">Request data</button>

<p id="demo"></p>
 
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "https://cms.cybertizeweb.com/notificationServiceHandler/save-analytics", true);
  xhttp.setRequestHeader("Content-type", "application/json");
  
  var k = "93ea462079eb9b6f8ac89c664ded678c";
  
  var j = "{\"multicast_id\":1741207269401673372,\"success\":3,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"message_id\":\"5188d092-cf57-4593-a455-d0404cc6e2d6\"},{\"message_id\":\"37a81189-d0d5-4d7f-93af-a91c0312bc14\"},{\"error\":\"InvalidRegistration\"},{\"message_id\":\"34bcdbd6-3538-402a-b4ac-925447ca5dcf\"}]}";

  xhttp.send(JSON.stringify({key:k, result:j}));
}
</script>

</body>
</html>
